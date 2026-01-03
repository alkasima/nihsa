#!/bin/bash

# NIHSA Laravel Production Deployment Script
# This script handles the complete deployment process

set -e

# Configuration
PROJECT_NAME="nihsa"
IMAGE_TAG="latest"
REGISTRY_URL=""  # Add your container registry URL if using one

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Functions
log_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

log_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

log_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check prerequisites
check_prerequisites() {
    log_info "Checking prerequisites..."
    
    # Check if Docker is installed
    if ! command -v docker &> /dev/null; then
        log_error "Docker is not installed. Please install Docker first."
        exit 1
    fi
    
    # Check if Docker Compose is installed
    if ! command -v docker-compose &> /dev/null && ! docker compose version &> /dev/null; then
        log_error "Docker Compose is not installed. Please install Docker Compose first."
        exit 1
    fi
    
    # Check if .env.production exists
    if [ ! -f ".env.production" ]; then
        log_error ".env.production file not found. Please create it first."
        exit 1
    fi
    
    log_success "Prerequisites check passed!"
}

# Build the Docker image
build_image() {
    log_info "Building Docker image..."
    
    docker build -f Dockerfile.production -t ${PROJECT_NAME}:${IMAGE_TAG} .
    
    if [ $? -eq 0 ]; then
        log_success "Docker image built successfully!"
    else
        log_error "Failed to build Docker image!"
        exit 1
    fi
}

# Run database migrations
run_migrations() {
    log_info "Running database migrations..."
    
    docker run --rm \
        --env-file .env.production \
        ${PROJECT_NAME}:${IMAGE_TAG} \
        php artisan migrate --force --no-interaction
    
    if [ $? -eq 0 ]; then
        log_success "Database migrations completed!"
    else
        log_error "Database migrations failed!"
        exit 1
    fi
}

# Deploy with Docker Compose
deploy_compose() {
    log_info "Deploying with Docker Compose..."
    
    # Stop existing containers
    docker-compose -f docker-compose.production.yml down || true
    
    # Start new containers
    docker-compose -f docker-compose.production.yml up -d
    
    if [ $? -eq 0 ]; then
        log_success "Deployment completed!"
    else
        log_error "Deployment failed!"
        exit 1
    fi
}

# Health check
health_check() {
    log_info "Performing health check..."
    
    local max_attempts=30
    local attempt=1
    
    while [ $attempt -le $max_attempts ]; do
        if curl -f http://localhost:8080/health &> /dev/null; then
            log_success "Application is healthy!"
            return 0
        fi
        
        log_warning "Health check failed (attempt $attempt/$max_attempts). Waiting..."
        sleep 10
        attempt=$((attempt + 1))
    done
    
    log_error "Health check failed after $max_attempts attempts!"
    return 1
}

# Show logs
show_logs() {
    log_info "Showing application logs..."
    docker-compose -f docker-compose.production.yml logs -f
}

# Clean up
cleanup() {
    log_info "Cleaning up old Docker images..."
    docker system prune -f
    log_success "Cleanup completed!"
}

# Main deployment process
main() {
    echo "========================================"
    echo "  NIHSA Laravel Production Deployment"
    echo "========================================"
    
    # Parse command line arguments
    case "${1:-deploy}" in
        "build")
            check_prerequisites
            build_image
            ;;
        "migrate")
            check_prerequisites
            run_migrations
            ;;
        "deploy")
            check_prerequisites
            build_image
            run_migrations
            deploy_compose
            health_check
            ;;
        "logs")
            show_logs
            ;;
        "cleanup")
            cleanup
            ;;
        "help")
            echo "Usage: $0 [command]"
            echo ""
            echo "Commands:"
            echo "  build     - Build the Docker image"
            echo "  migrate   - Run database migrations"
            echo "  deploy    - Full deployment (build, migrate, deploy)"
            echo "  logs      - Show application logs"
            echo "  cleanup   - Clean up old Docker images"
            echo "  help      - Show this help message"
            echo ""
            echo "Examples:"
            echo "  $0 deploy"
            echo "  $0 build"
            echo "  $0 logs"
            ;;
        *)
            log_error "Unknown command: $1"
            echo "Use '$0 help' for available commands."
            exit 1
            ;;
    esac
}

# Run main function
main "$@"
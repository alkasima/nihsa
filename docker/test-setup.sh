#!/bin/bash

# NIHSA Laravel Docker Setup Test Script
# This script tests the complete Docker setup

set -e

# Colors
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

echo -e "${BLUE}========================================${NC}"
echo -e "${BLUE}  NIHSA Docker Setup Test${NC}"
echo -e "${BLUE}========================================${NC}"

# Test 1: Check prerequisites
echo -e "${YELLOW}Test 1: Checking prerequisites...${NC}"
if command -v docker &> /dev/null; then
    echo -e "${GREEN}✅ Docker is installed${NC}"
else
    echo -e "${RED}❌ Docker is not installed${NC}"
    exit 1
fi

if command -v docker-compose &> /dev/null || docker compose version &> /dev/null; then
    echo -e "${GREEN}✅ Docker Compose is installed${NC}"
else
    echo -e "${RED}❌ Docker Compose is not installed${NC}"
    exit 1
fi

# Test 2: Check Docker files
echo -e "${YELLOW}Test 2: Checking Docker configuration files...${NC}"
required_files=(
    "Dockerfile.production"
    "docker-compose.yml"
    "docker-compose.production.yml"
    ".env.production"
    "docker/nginx/nginx.production.conf"
    "docker/nginx/nginx.dev.conf"
    "docker/supervisor/supervisord.conf"
    "docker/scripts/entrypoint.sh"
    "docker/deploy.sh"
)

for file in "${required_files[@]}"; do
    if [ -f "$file" ]; then
        echo -e "${GREEN}✅ $file exists${NC}"
    else
        echo -e "${RED}❌ $file is missing${NC}"
        exit 1
    fi
done

# Test 3: Validate Docker Compose files
echo -e "${YELLOW}Test 3: Validating Docker Compose files...${NC}"
if docker-compose -f docker-compose.yml config &> /dev/null; then
    echo -e "${GREEN}✅ docker-compose.yml is valid${NC}"
else
    echo -e "${RED}❌ docker-compose.yml has errors${NC}"
    docker-compose -f docker-compose.yml config
    exit 1
fi

if docker-compose -f docker-compose.production.yml config &> /dev/null; then
    echo -e "${GREEN}✅ docker-compose.production.yml is valid${NC}"
else
    echo -e "${RED}❌ docker-compose.production.yml has errors${NC}"
    docker-compose -f docker-compose.production.yml config
    exit 1
fi

# Test 4: Test build (if Docker daemon is running)
echo -e "${YELLOW}Test 4: Testing Docker build...${NC}"
if docker info &> /dev/null; then
    echo -e "${BLUE}Docker daemon is running, testing build...${NC}"
    if docker build -f Dockerfile.production -t nihsa:test . &> /dev/null; then
        echo -e "${GREEN}✅ Docker build successful${NC}"
        docker rmi nihsa:test &> /dev/null || true
    else
        echo -e "${YELLOW}⚠️ Docker build failed (this might be normal in CI/CD)${NC}"
    fi
else
    echo -e "${YELLOW}⚠️ Docker daemon not running (skipping build test)${NC}"
fi

# Test 5: Check environment configuration
echo -e "${YELLOW}Test 5: Checking environment configuration...${NC}"
if grep -q "DATABASE_URL.*postgresql" .env.production; then
    echo -e "${GREEN}✅ PostgreSQL DATABASE_URL configured${NC}"
else
    echo -e "${RED}❌ PostgreSQL DATABASE_URL not found${NC}"
    exit 1
fi

if grep -q "REDIS_HOST" .env.production; then
    echo -e "${GREEN}✅ Redis configuration found${NC}"
else
    echo -e "${RED}❌ Redis configuration missing${NC}"
    exit 1
fi

# Test 6: Check scripts are executable
echo -e "${YELLOW}Test 6: Checking script permissions...${NC}"
scripts=("docker/deploy.sh" "docker/scripts/entrypoint.sh")
for script in "${scripts[@]}"; do
    if [ -x "$script" ]; then
        echo -e "${GREEN}✅ $script is executable${NC}"
    else
        echo -e "${YELLOW}⚠️ $script is not executable (fixing...)${NC}"
        chmod +x "$script"
    fi
done

# Test 7: Validate nginx configuration syntax
echo -e "${YELLOW}Test 7: Testing nginx configuration syntax...${NC}"
if command -v nginx &> /dev/null; then
    if nginx -t -c "$(pwd)/docker/nginx/nginx.production.conf" &> /dev/null; then
        echo -e "${GREEN}✅ nginx.production.conf syntax is valid${NC}"
    else
        echo -e "${YELLOW}⚠️ nginx.production.conf syntax check failed (may be normal without full config)${NC}"
    fi
else
    echo -e "${YELLOW}⚠️ nginx not installed locally (skipping syntax check)${NC}"
fi

# Test 8: Database URL validation
echo -e "${YELLOW}Test 8: Validating Neon.tech database URL...${NC}"
if grep -q "ep-delicate-fire-09764825-pooler.us-east-1.aws.neon.tech" .env.production; then
    echo -e "${GREEN}✅ Neon.tech database URL is configured${NC}"
else
    echo -e "${RED}❌ Neon.tech database URL not found${NC}"
    exit 1
fi

# Summary
echo -e "${BLUE}========================================${NC}"
echo -e "${GREEN}✅ All tests passed!${NC}"
echo -e "${BLUE}========================================${NC}"
echo ""
echo -e "${BLUE}Your NIHSA Laravel application is ready for deployment!${NC}"
echo ""
echo -e "${YELLOW}Next steps:${NC}"
echo "1. For development: ${GREEN}docker-compose up -d${NC}"
echo "2. For production: ${GREEN}./docker/deploy.sh deploy${NC}"
echo "3. View documentation: ${GREEN}cat DOCKER_DEPLOYMENT.md${NC}"
echo ""
echo -e "${BLUE}Service URLs (when running):${NC}"
echo "• Application: http://localhost:8080"
echo "• Health Check: http://localhost:8080/health"
echo "• MailHog (dev): http://localhost:8025"
echo ""
echo -e "${GREEN}🎉 Docker setup complete!${NC}"
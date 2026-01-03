# NIHSA Laravel Docker Quick Start Script for Windows
# This script starts the Docker development environment

Write-Host "🚀 NIHSA Laravel Docker Environment" -ForegroundColor Green
Write-Host "=======================================" -ForegroundColor Blue
Write-Host ""
Write-Host "Choose an option:" -ForegroundColor Yellow
Write-Host "1. Simple setup (PHP built-in server, no build)"
Write-Host "2. Full setup (Nginx + build process)"
Write-Host ""
$choice = Read-Host "Enter your choice (1 or 2)"

# Check if Docker is running
try {
    docker info | Out-Null
    Write-Host "✅ Docker is running" -ForegroundColor Green
} catch {
    Write-Host "❌ Docker is not running. Please start Docker Desktop and try again." -ForegroundColor Red
    exit 1
}

# Simple setup option
if ($choice -eq "1") {
    Write-Host "🎯 Using Simple Setup (PHP Built-in Server)" -ForegroundColor Cyan
    
    # Stop any existing containers
    Write-Host "🛑 Stopping any existing containers..." -ForegroundColor Yellow
    docker-compose -f docker-compose.simple.yml down 2>$null
    
    # Start simple services
    Write-Host "🚀 Starting simple services..." -ForegroundColor Yellow
    try {
        docker-compose -f docker-compose.simple.yml up -d
        if ($LASTEXITCODE -eq 0) {
            Write-Host "✅ Simple services started successfully" -ForegroundColor Green
        } else {
            throw "Failed to start services"
        }
    } catch {
        Write-Host "❌ Failed to start simple services" -ForegroundColor Red
        exit 1
    }
    
    # Wait for services
    Write-Host "⏳ Waiting for services to be ready..." -ForegroundColor Yellow
    Start-Sleep -Seconds 15
    
    # Check service status
    Write-Host "📊 Service Status:" -ForegroundColor Blue
    docker-compose -f docker-compose.simple.yml ps
    
    # Health check
    Write-Host "🏥 Checking application health..." -ForegroundColor Yellow
    try {
        $response = Invoke-WebRequest -Uri "http://localhost:8081" -UseBasicParsing -TimeoutSec 10
        if ($response.StatusCode -eq 200) {
            Write-Host "✅ Application is healthy!" -ForegroundColor Green
        } else {
            Write-Host "⚠️ Application returned: $($response.StatusCode)" -ForegroundColor Yellow
        }
    } catch {
        Write-Host "⚠️ Health check failed. Application may still be starting..." -ForegroundColor Yellow
    }
    
    Write-Host ""
    Write-Host "🎉 Simple NIHSA Laravel Environment is ready!" -ForegroundColor Green
    Write-Host ""
    Write-Host "📍 Service URLs:" -ForegroundColor Blue
    Write-Host "• Application: http://localhost:8081" -ForegroundColor Cyan
    Write-Host "• MailHog: http://localhost:8026" -ForegroundColor Cyan
    Write-Host ""
    Write-Host "🔧 Useful Commands:" -ForegroundColor Blue
    Write-Host "• View logs: docker-compose -f docker-compose.simple.yml logs -f" -ForegroundColor White
    Write-Host "• Stop services: docker-compose -f docker-compose.simple.yml down" -ForegroundColor White
    Write-Host "• Run migrations: docker-compose -f docker-compose.simple.yml exec app php artisan migrate" -ForegroundColor White
    Write-Host ""
    exit 0
}

# Full setup option (original code)
Write-Host "🎯 Using Full Setup (Nginx + Build Process)" -ForegroundColor Cyan

# Stop any existing containers
Write-Host "🛑 Stopping any existing containers..." -ForegroundColor Yellow
docker-compose down 2>$null

# Build the application image
Write-Host " Building application image..." -ForegroundColor Yellow
try {
    # Try development Dockerfile first (faster and more lenient)
    docker build -f Dockerfile.dev -t nihsa:dev .
    if ($LASTEXITCODE -ne 0) {
        Write-Host "⚠️ Development build failed, trying production build..." -ForegroundColor Yellow
        docker build -f Dockerfile.production -t nihsa:dev .
        if ($LASTEXITCODE -ne 0) {
            throw "All builds failed"
        }
    }
    Write-Host "✅ Image built successfully" -ForegroundColor Green
} catch {
    Write-Host "❌ Failed to build image" -ForegroundColor Red
    Write-Host "Please check the error messages above and ensure Docker is running properly." -ForegroundColor Yellow
    exit 1
}

# Start the services
Write-Host "🚀 Starting services..." -ForegroundColor Yellow
try {
    docker-compose up -d
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✅ Services started successfully" -ForegroundColor Green
    } else {
        throw "Failed to start services"
    }
} catch {
    Write-Host "❌ Failed to start services" -ForegroundColor Red
    exit 1
}

# Wait for services to be ready
Write-Host "⏳ Waiting for services to be ready..." -ForegroundColor Yellow
Start-Sleep -Seconds 10

# Check service status
Write-Host "📊 Service Status:" -ForegroundColor Blue
docker-compose ps

# Health check
Write-Host "🏥 Checking application health..." -ForegroundColor Yellow
try {
    $response = Invoke-WebRequest -Uri "http://localhost:8080/health" -UseBasicParsing -TimeoutSec 10
    if ($response.StatusCode -eq 200) {
        Write-Host "✅ Application is healthy!" -ForegroundColor Green
    } else {
        Write-Host "⚠️ Application health check returned: $($response.StatusCode)" -ForegroundColor Yellow
    }
} catch {
    Write-Host "⚠️ Health check failed. Application may still be starting..." -ForegroundColor Yellow
}

Write-Host ""
Write-Host "🎉 NIHSA Laravel Docker Environment is ready!" -ForegroundColor Green
Write-Host ""
Write-Host "📍 Service URLs:" -ForegroundColor Blue
Write-Host "• Application: http://localhost:8080" -ForegroundColor Cyan
Write-Host "• Health Check: http://localhost:8080/health" -ForegroundColor Cyan
Write-Host "• MailHog: http://localhost:8025" -ForegroundColor Cyan
Write-Host ""
Write-Host "🔧 Useful Commands:" -ForegroundColor Blue
Write-Host "• View logs: docker-compose logs -f" -ForegroundColor White
Write-Host "• Stop services: docker-compose down" -ForegroundColor White
Write-Host "• Run migrations: docker-compose exec app php artisan migrate" -ForegroundColor White
Write-Host "• Open shell: docker-compose exec app bash" -ForegroundColor White
Write-Host ""
Write-Host "📖 For more information, see DOCKER_DEPLOYMENT.md" -ForegroundColor Gray
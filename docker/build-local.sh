#!/bin/bash
# Script to build and test the Docker container locally

echo "Building Docker image for Render deployment..."
docker build -f Dockerfile.render -t nihsa-laravel:latest .

if [ $? -eq 0 ]; then
    echo "✓ Docker image built successfully!"
    echo ""
    echo "To run the container locally:"
    echo "  docker run -p 8080:8080 -e APP_KEY=base64:$(openssl rand -base64 32) nihsa-laravel:latest"
    echo ""
    echo "Then visit: http://localhost:8080"
else
    echo "✗ Docker build failed!"
    exit 1
fi

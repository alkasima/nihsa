# PowerShell script to build and test the Docker container locally on Windows

Write-Host "Building Docker image for Render deployment..." -ForegroundColor Cyan
docker build -f Dockerfile.render -t nihsa-laravel:latest .

if ($LASTEXITCODE -eq 0) {
    Write-Host "✓ Docker image built successfully!" -ForegroundColor Green
    Write-Host ""
    Write-Host "To run the container locally:" -ForegroundColor Yellow
    
    # Generate a random APP_KEY
    $bytes = New-Object Byte[] 32
    [Security.Cryptography.RandomNumberGenerator]::Create().GetBytes($bytes)
    $appKey = "base64:" + [Convert]::ToBase64String($bytes)
    
    Write-Host "  docker run -p 8080:8080 -e APP_KEY=$appKey nihsa-laravel:latest" -ForegroundColor White
    Write-Host ""
    Write-Host "Then visit: http://localhost:8080" -ForegroundColor Green
} else {
    Write-Host "✗ Docker build failed!" -ForegroundColor Red
    exit 1
}

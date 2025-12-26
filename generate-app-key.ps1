# PowerShell script to generate Laravel APP_KEY for Render.com

Write-Host "==================================" -ForegroundColor Cyan
Write-Host "  Laravel APP_KEY Generator" -ForegroundColor Cyan  
Write-Host "==================================" -ForegroundColor Cyan
Write-Host ""

# Check if we're in a Laravel project
if (Test-Path "artisan") {
    Write-Host "✓ Laravel project detected!" -ForegroundColor Green
    Write-Host ""
    Write-Host "Generating APP_KEY..." -ForegroundColor Yellow
    Write-Host ""
    
    $appKey = php artisan key:generate --show
    
    Write-Host "Your APP_KEY:" -ForegroundColor Green
    Write-Host $appKey -ForegroundColor White
    Write-Host ""
    Write-Host "==================================" -ForegroundColor Cyan
    Write-Host "Next Steps:" -ForegroundColor Yellow
    Write-Host "1. Copy the APP_KEY above" -ForegroundColor White
    Write-Host "2. Go to Render Dashboard" -ForegroundColor White
    Write-Host "3. Navigate to: Your Service → Environment" -ForegroundColor White
    Write-Host "4. Add environment variable:" -ForegroundColor White
    Write-Host "   Key: APP_KEY" -ForegroundColor White
    Write-Host "   Value: [paste the key above]" -ForegroundColor White
    Write-Host "5. Save and your service will redeploy" -ForegroundColor White
    Write-Host "==================================" -ForegroundColor Cyan
    
} else {
    Write-Host "✗ Error: Not a Laravel project!" -ForegroundColor Red
    Write-Host "Please run this script from your Laravel project root directory." -ForegroundColor Yellow
    Write-Host ""
    Write-Host "Alternative: Generate manually" -ForegroundColor Yellow
    Write-Host "Run this command: php artisan key:generate --show" -ForegroundColor White
}

Write-Host ""
Read-Host "Press Enter to exit"

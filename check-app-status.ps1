# Check NIHSA Application Status
# Since Docker is running, let's verify the application is working

Write-Host "✅ Docker containers are running!" -ForegroundColor Green
Write-Host "Now checking if the application is responding..." -ForegroundColor Yellow
Write-Host ""

# Test the application HTTP endpoint
Write-Host "1. Testing HTTP endpoint..." -ForegroundColor Yellow
try {
    $response = Invoke-WebRequest -Uri "http://localhost:8081" -UseBasicParsing -TimeoutSec 10
    Write-Host "✅ HTTP Response: $($response.StatusCode)" -ForegroundColor Green
    
    if ($response.Content -match "Nigeria Hydrological Services Agency|Laravel|NIHSA") {
        Write-Host "✅ Application content looks correct!" -ForegroundColor Green
    } else {
        Write-Host "⚠️ Application responding but content seems unexpected" -ForegroundColor Yellow
    }
} catch {
    Write-Host "❌ HTTP request failed: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host ""

# Check application container logs
Write-Host "2. Checking application logs..." -ForegroundColor Yellow
$logs = docker logs nihsa_app_simple --tail 15 2>&1
if ($LASTEXITCODE -eq 0) {
    Write-Host "📋 Recent application logs:" -ForegroundColor Cyan
    Write-Host $logs
    
    # Check for common issues
    if ($logs -match "error|Error|ERROR|fail|Fail|FAIL|exception|Exception|EXCEPTION") {
        Write-Host "⚠️ Potential issues found in logs" -ForegroundColor Yellow
    } else {
        Write-Host "✅ No obvious errors in logs" -ForegroundColor Green
    }
} else {
    Write-Host "❌ Failed to get logs" -ForegroundColor Red
}

Write-Host ""

# Check if Laravel is actually serving
Write-Host "3. Testing Laravel-specific endpoint..." -ForegroundColor Yellow
try {
    $response = Invoke-WebRequest -Uri "http://localhost:8081" -UseBasicParsing -TimeoutSec 5
    if ($response.Content -match "Laravel|laravel") {
        Write-Host "✅ Laravel framework is running" -ForegroundColor Green
    } else {
        Write-Host "⚠️ Content doesn't appear to be Laravel" -ForegroundColor Yellow
    }
} catch {
    Write-Host "❌ Laravel test failed" -ForegroundColor Red
}

Write-Host ""

# Check database connectivity from within container
Write-Host "4. Testing database connectivity..." -ForegroundColor Yellow
$dbTest = docker exec nihsa_app_simple php -r "
try {
    \$pdo = new PDO('pgsql:host=postgres;dbname=nihsa', 'nihsa_user', 'nihsa_password');
    echo '✅ External PostgreSQL: Connected successfully';
} catch(Exception \$e) {
    echo '❌ External PostgreSQL: ' . \$e->getMessage();
}
" 2>&1

Write-Host $dbTest

Write-Host ""

# Check if migrations ran
Write-Host "5. Checking database migrations..." -ForegroundColor Yellow
$migrationCheck = docker exec nihsa_app_simple php artisan migrate:status 2>&1
Write-Host $migrationCheck

Write-Host ""

# Final recommendations
Write-Host "6. Recommendations:" -ForegroundColor Yellow
Write-Host ""

if ($logs -match "Laravel development server started") {
    Write-Host "✅ Laravel server is running - try refreshing your browser" -ForegroundColor Green
    Write-Host "🌐 URL: http://localhost:8081" -ForegroundColor Cyan
} else {
    Write-Host "🔧 If application isn't responding, try:" -ForegroundColor Cyan
    Write-Host "   • Wait 30 seconds for full startup" -ForegroundColor White
    Write-Host "   • Check browser console for errors" -ForegroundColor White
    Write-Host "   • Try: docker-compose -f docker-compose.simple.yml restart app" -ForegroundColor White
}

Write-Host ""
Write-Host "📱 Quick browser test:" -ForegroundColor Cyan
Write-Host "1. Open: http://localhost:8081" -ForegroundColor White
Write-Host "2. If blank page, check browser developer tools (F12)" -ForegroundColor White
Write-Host "3. If 500 error, check logs above" -ForegroundColor White

Write-Host ""
Write-Host "🔍 For detailed logs: docker-compose -f docker-compose.simple.yml logs app" -ForegroundColor Gray
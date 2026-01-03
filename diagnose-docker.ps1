# NIHSA Laravel Docker Diagnostic Script
# This script helps identify why the site is not accessible

Write-Host "🔍 NIHSA Docker Diagnostic Tool" -ForegroundColor Green
Write-Host "================================" -ForegroundColor Blue
Write-Host ""

# Check if Docker is running
Write-Host "1. Checking Docker Status..." -ForegroundColor Yellow
try {
    $dockerInfo = docker info 2>&1
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✅ Docker is running" -ForegroundColor Green
    } else {
        Write-Host "❌ Docker is not responding properly" -ForegroundColor Red
        Write-Host "Error: $dockerInfo" -ForegroundColor Red
        exit 1
    }
} catch {
    Write-Host "❌ Docker is not running" -ForegroundColor Red
    exit 1
}

Write-Host ""

# Check running containers
Write-Host "2. Checking Running Containers..." -ForegroundColor Yellow
$containers = docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}" 2>&1
if ($LASTEXITCODE -eq 0) {
    Write-Host $containers
} else {
    Write-Host "❌ Failed to get container status" -ForegroundColor Red
    exit 1
}

Write-Host ""

# Check which docker-compose file is being used
Write-Host "3. Checking Available Docker Compose Files..." -ForegroundColor Yellow
$composeFiles = Get-ChildItem -Path "docker-compose*.yml" -ErrorAction SilentlyContinue
if ($composeFiles.Count -gt 0) {
    Write-Host "Found compose files:" -ForegroundColor Green
    foreach ($file in $composeFiles) {
        Write-Host "  - $($file.Name)" -ForegroundColor Cyan
    }
} else {
    Write-Host "❌ No docker-compose files found" -ForegroundColor Red
}

Write-Host ""

# Test network connectivity
Write-Host "4. Testing Network Connectivity..." -ForegroundColor Yellow

# Test different ports
$portsToTest = @(
    @{Port=8080; Name="Full Setup"},
    @{Port=8081; Name="Simple Setup"},
    @{Port=8025; Name="MailHog (Full)"},
    @{Port=8026; Name="MailHog (Simple)"}
)

foreach ($test in $portsToTest) {
    try {
        $tcpClient = New-Object System.Net.Sockets.TcpClient
        $connect = $tcpClient.BeginConnect("localhost", $test.Port, $null, $null)
        $wait = $connect.AsyncWaitHandle.WaitOne(2000, $false)
        
        if ($wait) {
            Write-Host "✅ Port $($test.Port) ($($test.Name)) - OPEN" -ForegroundColor Green
            $tcpClient.EndConnect($connect)
        } else {
            Write-Host "❌ Port $($test.Port) ($($test.Name)) - CLOSED" -ForegroundColor Red
        }
        $tcpClient.Close()
    } catch {
        Write-Host "❌ Port $($test.Port) ($($test.Name)) - ERROR: $($_.Exception.Message)" -ForegroundColor Red
    }
}

Write-Host ""

# Check container logs
Write-Host "5. Checking Container Logs..." -ForegroundColor Yellow
$runningContainers = docker ps --format "{{.Names}}" 2>&1
if ($LASTEXITCODE -eq 0 -and $runningContainers) {
    foreach ($container in $runningContainers.Split("`n")) {
        if ($container.Trim()) {
            Write-Host "📋 Logs for container: $container" -ForegroundColor Cyan
            $logs = docker logs --tail 10 $container 2>&1
            if ($LASTEXITCODE -eq 0) {
                Write-Host $logs
                if ($logs -match "error|Error|ERROR|fail|Fail|FAIL") {
                    Write-Host "⚠️ Potential issues found in logs" -ForegroundColor Yellow
                }
            } else {
                Write-Host "❌ Failed to get logs for $container" -ForegroundColor Red
            }
            Write-Host ""
        }
    }
} else {
    Write-Host "❌ No running containers found" -ForegroundColor Red
}

Write-Host ""

# Check if services are healthy
Write-Host "6. Checking Service Health..." -ForegroundColor Yellow

# Test HTTP endpoints
$endpoints = @(
    @{Url="http://localhost:8080"; Name="Full Setup"},
    @{Url="http://localhost:8081"; Name="Simple Setup"}
)

foreach ($endpoint in $endpoints) {
    try {
        $response = Invoke-WebRequest -Uri $endpoint.Url -UseBasicParsing -TimeoutSec 5
        Write-Host "✅ $($endpoint.Name): HTTP $($response.StatusCode)" -ForegroundColor Green
    } catch {
        Write-Host "❌ $($endpoint.Name): $($_.Exception.Message)" -ForegroundColor Red
    }
}

Write-Host ""

# Check disk space and resources
Write-Host "7. Checking System Resources..." -ForegroundColor Yellow

# Check Docker disk usage
$dockerDf = docker system df 2>&1
if ($LASTEXITCODE -eq 0) {
    Write-Host "Docker Disk Usage:" -ForegroundColor Cyan
    Write-Host $dockerDf
} else {
    Write-Host "❌ Failed to get Docker disk usage" -ForegroundColor Red
}

Write-Host ""

# Provide recommendations
Write-Host "8. Recommendations:" -ForegroundColor Yellow

Write-Host ""
Write-Host "🔧 If containers are not running:" -ForegroundColor Cyan
Write-Host "  • Try: docker-compose -f docker-compose.simple.yml up -d" -ForegroundColor White
Write-Host "  • Check logs: docker-compose logs" -ForegroundColor White

Write-Host ""
Write-Host "🔧 If containers are running but ports are closed:" -ForegroundColor Cyan
Write-Host "  • Check firewall settings" -ForegroundColor White
Write-Host "  • Verify port mappings in docker-compose files" -ForegroundColor White

Write-Host ""
Write-Host "🔧 If HTTP endpoints are not responding:" -ForegroundColor Cyan
Write-Host "  • Check application logs: docker-compose logs app" -ForegroundColor White
Write-Host "  • Restart services: docker-compose restart" -ForegroundColor White
Write-Host "  • Check database connectivity" -ForegroundColor White

Write-Host ""
Write-Host "🔧 Quick fixes to try:" -ForegroundColor Cyan
Write-Host "  • Simple setup: docker-compose -f docker-compose.simple.yml down && up -d" -ForegroundColor White
Write-Host "  • Clean restart: docker-compose down --volumes --remove-orphans && up -d" -ForegroundColor White
Write-Host "  • Rebuild: docker-compose up --build -d --force-recreate" -ForegroundColor White

Write-Host ""
Write-Host "📖 For more help, check TROUBLESHOOTING.md" -ForegroundColor Gray

Write-Host ""
Write-Host "🎯 Next steps: Run the recommended commands above based on the diagnostic results." -ForegroundColor Green
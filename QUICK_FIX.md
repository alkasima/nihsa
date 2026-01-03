# 🚨 Quick Fix for "Site Cannot Be Reached"

If Docker is running but the site can't be reached in browser, follow these steps:

## 🔍 Step 1: Run Diagnostic Tool
```powershell
.\diagnose-docker.ps1
```
This will check what's wrong and provide specific recommendations.

## 🛠 Step 2: Try Quick Fixes (in order)

### Fix 1: Use Simple Setup
```powershell
# Stop everything first
docker-compose down
docker-compose -f docker-compose.simple.yml down

# Start simple setup
docker-compose -f docker-compose.simple.yml up -d

# Check if it's running
docker-compose -f docker-compose.simple.yml ps
```
**Expected Result:** Container `nihsa_app_simple` should show "Up"

### Fix 2: Check Container Logs
```powershell
# Check application logs
docker-compose -f docker-compose.simple.yml logs app

# Check if there are errors
# Look for: error, Error, ERROR, fail, Fail, FAIL
```

### Fix 3: Clean Restart
```powershell
# Complete clean restart
docker-compose -f docker-compose.simple.yml down --volumes --remove-orphans
docker system prune -f
docker-compose -f docker-compose.simple.yml up -d
```

## 🌐 Step 3: Test Different URLs

Try these URLs in your browser:

### Simple Setup (Recommended)
- **Main App**: http://localhost:8081
- **MailHog**: http://localhost:8026

### Full Setup
- **Main App**: http://localhost:8080
- **Health Check**: http://localhost:8080/health
- **MailHog**: http://localhost:8025

## 🔧 Step 4: Manual Container Check

```powershell
# List all containers
docker ps -a

# Check specific container
docker logs nihsa_app_simple --tail 20

# Test if container is responding
docker exec nihsa_app_simple php -v

# Test network connectivity from container
docker exec nihsa_app_simple curl -I http://localhost:8081
```

## 🚨 Common Issues & Solutions

### Issue: Container Exited Immediately
**Symptoms:** Container shows "Exited (1)" in status
**Solution:**
```powershell
# Check the error
docker logs container_name

# Usually this fixes it:
docker-compose -f docker-compose.simple.yml up --force-recreate
```

### Issue: Port Already in Use
**Symptoms:** "Port 8080/8081 is already allocated"
**Solution:**
```powershell
# Find what's using the port
netstat -ano | findstr :8081

# Kill the process (replace PID)
taskkill /PID [PID_NUMBER] /F

# Or use a different port
# Edit docker-compose.simple.yml and change "8081:8000" to "8082:8000"
```

### Issue: Database Connection Failed
**Symptoms:** Application starts but database errors in logs
**Solution:**
```powershell
# Check if external database is accessible
docker run --rm postgres:15-alpine psql "postgresql://default:bn9CDyo5RrgV@ep-delicate-fire-09764825-pooler.us-east-1.aws.neon.tech/nihsa?sslmode=require" -c "SELECT 1;"

# If external DB fails, try local PostgreSQL
docker-compose -f docker-compose.simple.yml up postgres -d
```

### Issue: Application Not Responding
**Symptoms:** Container is running but HTTP requests timeout
**Solution:**
```powershell
# Check if PHP server is actually running
docker exec nihsa_app_simple ps aux | grep php

# Restart the application container
docker-compose -f docker-compose.simple.yml restart app
```

## 📱 Step 5: Alternative Test Methods

### Test with curl
```powershell
# Test HTTP endpoint
curl -I http://localhost:8081

# Test from inside container
docker exec nihsa_app_simple curl -I http://localhost:8000
```

### Test with PowerShell
```powershell
# Test connection
Test-NetConnection -ComputerName localhost -Port 8081

# Test HTTP
try {
    $response = Invoke-WebRequest -Uri "http://localhost:8081" -TimeoutSec 5
    Write-Host "Success: $($response.StatusCode)" -ForegroundColor Green
} catch {
    Write-Host "Failed: $($_.Exception.Message)" -ForegroundColor Red
}
```

## 🎯 Step 6: Verify Success

When working correctly, you should see:
```
✅ Container status shows "Up"
✅ No error messages in logs
✅ curl http://localhost:8081 returns 200 OK
✅ Browser loads the NIHSA homepage
```

## 🆘 If Nothing Works

### Nuclear Option - Complete Reset
```powershell
# Stop everything
docker stop $(docker ps -aq)
docker rm $(docker ps -aq)

# Clean Docker completely
docker system prune -a --volumes

# Start fresh with simple setup
docker-compose -f docker-compose.simple.yml up -d
```

### Get Help
1. Run diagnostic: `.\diagnose-docker.ps1`
2. Save logs: `docker-compose logs > docker-debug.log`
3. Check system: `docker info`
4. Review this guide: `TROUBLESHOOTING.md`

---

**💡 Pro Tip:** Start with the simple setup (port 8081) - it's the most reliable and doesn't require building frontend assets.
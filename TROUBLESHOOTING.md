# NIHSA Docker Setup Troubleshooting Guide

## 🚨 Common Issues and Solutions

### Issue 1: Docker Compose Version Warning
**Error:**
```
the attribute `version` is obsolete, it will be ignored, please remove it to avoid potential confusion
```

**Solution:** ✅ **FIXED** - The version has been removed from docker-compose files.

### Issue 2: Image Not Found Error
**Error:**
```
unable to get image 'nihsa-laravel-app': error during connect: Get "http://%2F%2F.%2Fpipe%2FdockerDesktopLinuxEngine/v1.49/images/nihsa-laravel-app/json"
```

**Solution:** You need to build the image first before running containers.

### Issue 3: Docker Desktop Not Running
**Error:**
```
Cannot connect to the Docker daemon at unix:///var/run/docker.sock. Is the docker daemon running?
```

**Solution:**
1. Start Docker Desktop
2. Wait for it to fully initialize
3. Try running the command again

### Issue 4: NPM/Vite Build Error
**Error:**
```
sh: vite: not found
ERROR: failed to solve: process "/bin/sh -c npm run build" did not complete successfully: exit code: 127
```

**Solution:**
1. **Use Simple Setup** (Recommended):
   ```powershell
   docker-compose -f docker-compose.simple.yml up -d
   ```

2. **Fix NPM Dependencies**:
   ```powershell
   # Delete node_modules and package-lock.json
   Remove-Item -Recurse -Force node_modules
   Remove-Item -Force package-lock.json
   
   # Clean install
   npm install
   npm run build
   
   # Try Docker build again
   docker-compose up --build -d
   ```

3. **Use Development Dockerfile**:
   ```powershell
   docker build -f Dockerfile.dev -t nihsa:dev .
   docker-compose up -d
   ```

## 🛠 Quick Start Commands for Windows

### Option 1: Use the PowerShell Script (Recommended)
```powershell
.\start-docker.ps1
```

### Option 2: Manual Commands
```powershell
# 1. Build the image
docker build -f Dockerfile.production -t nihsa:dev .

# 2. Start services
docker-compose up -d

# 3. Check status
docker-compose ps

# 4. View logs
docker-compose logs -f
```

### Option 3: Complete Setup
```powershell
# Stop any existing containers
docker-compose down

# Build and start everything
docker-compose up --build -d

# Wait for services to start
Start-Sleep -Seconds 30

# Check if application is healthy
curl http://localhost:8080/health
```

### Option 4: Simple Setup (No Build Required)
```powershell
# Use the simple setup with PHP built-in server
docker-compose -f docker-compose.simple.yml up -d

# Check status
docker-compose -f docker-compose.simple.yml ps

# Access the application
# http://localhost:8081 (simple setup)
```

### Option 5: PowerShell Interactive Setup
```powershell
# Run the interactive PowerShell script
.\start-docker.ps1

# This will give you options:
# 1. Simple setup (recommended for quick start)
# 2. Full setup (with Nginx and build process)
```

## 🔍 Diagnostic Commands

### Check Docker Status
```powershell
# Check if Docker is running
docker info

# Check Docker version
docker --version
docker-compose --version
```

### Check Container Status
```powershell
# List all containers
docker ps -a

# Check running services
docker-compose ps

# View service logs
docker-compose logs app
docker-compose logs nginx
docker-compose logs postgres
```

### Check Application Health
```powershell
# Test health endpoint
curl http://localhost:8080/health

# Test main application
curl http://localhost:8080
```

## 🐛 Debugging Steps

### 1. Check Container Logs
```powershell
# View all logs
docker-compose logs

# Follow logs in real-time
docker-compose logs -f

# View specific service logs
docker-compose logs app
```

### 2. Access Container Shell
```powershell
# Access application container
docker-compose exec app bash

# Access database container
docker-compose exec postgres psql -U nihsa_user -d nihsa
```

### 3. Check Resource Usage
```powershell
# Monitor resource usage
docker stats

# Check disk usage
docker system df
```

### 4. Network Connectivity
```powershell
# Test internal networking
docker-compose exec app ping postgres
docker-compose exec app ping redis
```

## 🔧 Common Solutions

### Port Already in Use
If you get "port already in use" errors:
```powershell
# Find what's using the port
netstat -ano | findstr :8080

# Kill the process (replace PID with actual process ID)
taskkill /PID <PID> /F

# Or use a different port
# Edit docker-compose.yml and change "8080:8080" to "8081:8080"
```

### Permission Denied Errors
```powershell
# Fix ownership (in container)
docker-compose exec app chown -R appuser:appuser /var/www/storage

# Fix permissions
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

### Database Connection Issues
```powershell
# Test database connectivity
docker-compose exec app php -r "
try {
    \$pdo = new PDO('pgsql:host=postgres;dbname=nihsa', 'nihsa_user', 'nihsa_password');
    echo 'Database connection successful';
} catch(Exception \$e) {
    echo 'Connection failed: ' . \$e->getMessage();
}
"

# Run migrations manually
docker-compose exec app php artisan migrate:status
```

### Memory Issues
```powershell
# Check memory usage
docker stats --no-stream

# Clean up unused resources
docker system prune -a
```

## 🆘 When All Else Fails

### Complete Reset
```powershell
# Stop all containers
docker-compose down

# Remove all containers and networks
docker-compose down --rmi all --volumes --remove-orphans

# Clean Docker system
docker system prune -a --volumes

# Rebuild from scratch
docker-compose up --build -d
```

### Check System Requirements
```powershell
# Check available disk space
df -h

# Check available memory
free -h

# Check CPU
Get-WmiObject Win32_Processor | Select-Object Name,NumberOfCores,NumberOfLogicalProcessors
```

## 📞 Getting Help

### Log Collection
If you need help, collect these logs:
```powershell
# Save logs to file
docker-compose logs > docker-logs.txt

# Save system info
docker version > docker-version.txt
docker-compose version > compose-version.txt
```

### Environment Information
```powershell
# Docker info
docker info > docker-info.txt

# Container status
docker-compose ps > container-status.txt
```

## ✅ Verification Checklist

After running the setup, verify these items:

- [ ] Docker Desktop is running
- [ ] `docker info` works without errors
- [ ] `docker-compose ps` shows services as "Up"
- [ ] `http://localhost:8080` loads the application
- [ ] `http://localhost:8080/health` returns "healthy"
- [ ] `http://localhost:8025` shows MailHog interface
- [ ] Database migrations completed successfully
- [ ] No error messages in `docker-compose logs`

## 🚀 Success Indicators

When everything is working correctly, you should see:

```
✅ Docker is running
✅ Image built successfully  
✅ Services started successfully
✅ Application is healthy!
```

Service URLs should be accessible:
- http://localhost:8080 (Main application)
- http://localhost:8080/health (Health check)
- http://localhost:8025 (MailHog for testing emails)

---

**Still having issues?** Check the main documentation in `DOCKER_DEPLOYMENT.md` or review the container logs with `docker-compose logs`.
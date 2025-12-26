# Docker Configuration for NIHSA Laravel

This directory contains all Docker-related configuration files for deploying the NIHSA Laravel application to Render.com.

## 📁 Files Overview

### Configuration Files

#### `nginx.conf`
Nginx web server configuration that:
- Listens on port 8080 (Render's required port)
- Serves Laravel's public directory
- Routes requests to PHP-FPM
- Handles static files and PHP processing

#### `supervisord.conf`
Supervisor configuration that manages:
- PHP-FPM process (handles PHP execution)
- Nginx process (web server)
- Ensures both services stay running
- Logs output to stdout/stderr for Render

#### `entrypoint.sh`
Container startup script that:
- Creates necessary directories (storage, cache, database)
- Sets correct permissions for Laravel
- Creates SQLite database file
- Runs Laravel optimizations (config, route, view cache)
- Executes database migrations
- Starts supervisor to manage services

### Testing Scripts

#### `build-local.ps1` (Windows)
PowerShell script to:
- Build Docker image locally
- Generate random APP_KEY
- Provide run command for testing
- Test the container on Windows

#### `build-local.sh` (Linux/Mac)
Bash script to:
- Build Docker image locally
- Generate random APP_KEY
- Provide run command for testing
- Test the container on Linux/Mac

## 🚀 Usage

### Build Docker Image

**Windows (PowerShell):**
```powershell
.\docker\build-local.ps1
```

**Linux/Mac:**
```bash
chmod +x docker/build-local.sh
./docker/build-local.sh
```

### Run Container Locally

After building, run the container:

```bash
docker run -p 8080:8080 \
  -e APP_KEY=base64:your-generated-key-here \
  -e APP_ENV=local \
  -e APP_DEBUG=true \
  nihsa-laravel:latest
```

Then visit: http://localhost:8080

### Stop Container

```bash
# Find container ID
docker ps

# Stop container
docker stop <container-id>

# Remove container
docker rm <container-id>
```

## 🔧 How It Works

### Container Startup Flow

1. **Dockerfile.render** builds the image:
   - Installs PHP 8.2 and required extensions
   - Installs Nginx and Supervisor
   - Copies application code
   - Installs Composer dependencies
   - Sets up directory structure

2. **entrypoint.sh** runs on container start:
   - Creates storage directories
   - Sets permissions
   - Creates SQLite database
   - Caches Laravel configuration
   - Runs migrations
   - Starts supervisor

3. **supervisord** manages processes:
   - Starts PHP-FPM on port 9000
   - Starts Nginx on port 8080
   - Keeps both running
   - Restarts if they crash

4. **nginx** handles web requests:
   - Receives HTTP requests on port 8080
   - Serves static files directly
   - Forwards PHP requests to PHP-FPM
   - Returns responses to clients

### Port Configuration

- **8080**: Nginx web server (external)
- **9000**: PHP-FPM (internal only, not exposed)

## 📝 Customization

### Modifying Nginx Configuration

Edit `nginx.conf` to:
- Change server settings
- Add custom headers
- Configure caching
- Set up redirects
- Modify PHP-FPM settings

After changes, rebuild the Docker image.

### Modifying Startup Process

Edit `entrypoint.sh` to:
- Add custom initialization logic
- Run additional artisan commands
- Set up cron jobs
- Configure services

Remember to make it executable:
```bash
chmod +x docker/entrypoint.sh
```

### Modifying Process Management

Edit `supervisord.conf` to:
- Add new processes (queue workers, etc.)
- Adjust restart policies
- Configure logging
- Set priorities

## 🐛 Debugging

### View Container Logs

```bash
# View all logs
docker logs <container-id>

# Follow logs in real-time
docker logs -f <container-id>

# View last 100 lines
docker logs --tail 100 <container-id>
```

### Access Container Shell

```bash
# Start a bash shell in running container
docker exec -it <container-id> bash

# Once inside, you can:
php artisan tinker
cat /var/log/nginx/error.log
tail -f /var/www/html/storage/logs/laravel.log
```

### Check Running Processes

Inside container:
```bash
supervisorctl status
ps aux
netstat -tulpn
```

### Test Nginx Configuration

```bash
# Inside container
nginx -t
```

### Check PHP-FPM

```bash
# Inside container
php-fpm -t
```

## 🔐 Security Notes

1. **Never commit sensitive data** to Docker images
2. **Use environment variables** for secrets
3. **Don't expose unnecessary ports**
4. **Keep base images updated**
5. **Review logs regularly**

## 📊 Resource Usage

Typical resource usage:
- **RAM**: ~150-250 MB (base)
- **CPU**: Varies with traffic
- **Disk**: ~300 MB (image) + database

## 🚀 Production Considerations

For production deployment:

1. **Database**: Consider PostgreSQL for better performance
2. **Caching**: Use Redis for sessions/cache
3. **Queue Workers**: Add supervisor config for queues
4. **File Storage**: Use S3 or similar cloud storage
5. **Monitoring**: Set up application monitoring
6. **Backups**: Regular database backups
7. **Scaling**: Use Render's scaling features

## 📚 Related Files

- `../Dockerfile.render` - Main Dockerfile
- `../render.yaml` - Render deployment config
- `../RENDER_DEPLOYMENT.md` - Full deployment guide
- `../DEPLOYMENT_CHECKLIST.md` - Deployment steps

## 🆘 Troubleshooting

### "Permission denied" errors
```bash
# Inside container
chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage
```

### "Database file not found"
```bash
# Inside container
touch /var/www/html/database/database.sqlite
chmod 666 /var/www/html/database/database.sqlite
php artisan migrate --force
```

### "Nginx won't start"
```bash
# Check nginx config
nginx -t

# Check nginx logs
cat /var/log/nginx/error.log
```

### "PHP-FPM won't start"
```bash
# Check PHP-FPM config
php-fpm -t

# Check PHP-FPM logs
tail -f /var/log/php8.2-fpm.log
```

## 💡 Tips

1. **Clean builds**: Use `docker build --no-cache` if you encounter caching issues
2. **Layer optimization**: The Dockerfile is optimized to cache dependencies
3. **Multi-stage builds**: Separate build and runtime stages for smaller images
4. **Health checks**: Render uses the `/` path by default
5. **Logs**: All logs go to stdout/stderr for Render to capture

---

**Need help?** Check the main deployment guide: `../RENDER_DEPLOYMENT.md`

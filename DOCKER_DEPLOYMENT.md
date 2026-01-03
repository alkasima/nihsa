# NIHSA Laravel Docker Deployment Guide

This guide provides comprehensive instructions for deploying the NIHSA Laravel application using Docker and PostgreSQL.

## 📋 Table of Contents

- [Overview](#overview)
- [Prerequisites](#prerequisites)
- [Quick Start](#quick-start)
- [Development Setup](#development-setup)
- [Production Deployment](#production-deployment)
- [Configuration](#configuration)
- [Monitoring & Logging](#monitoring--logging)
- [Troubleshooting](#troubleshooting)
- [Performance Optimization](#performance-optimization)

## 🎯 Overview

The NIHSA Laravel application is now fully Dockerized with:

- **PostgreSQL Database**: Using your Neon.tech database
- **Redis**: For caching and session management
- **Nginx**: High-performance web server
- **Supervisor**: Process management
- **Health Checks**: Built-in monitoring
- **Security**: Production-ready security headers

## 📦 Prerequisites

- Docker Engine 20.10+
- Docker Compose 2.0+
- 2GB RAM minimum (4GB recommended)
- 10GB disk space

### Install Docker (Ubuntu/Debian)
```bash
# Update package index
sudo apt update

# Install required packages
sudo apt install apt-transport-https ca-certificates curl gnupg lsb-release

# Add Docker's official GPG key
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

# Set up stable repository
echo "deb [arch=amd64 signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# Install Docker Engine
sudo apt update
sudo apt install docker-ce docker-ce-cli containerd.io docker-compose-plugin
```

### Install Docker (Windows/Mac)
Download and install Docker Desktop from [docker.com](https://www.docker.com/products/docker-desktop)

## 🚀 Quick Start

### 1. Clone and Setup
```bash
# Clone the repository
git clone <repository-url>
cd nihsa-laravel

# Copy environment file
cp .env.production .env

# Edit environment file with your settings
nano .env
```

### 2. Development Setup
```bash
# Start development environment
docker-compose up -d

# View logs
docker-compose logs -f

# Access the application
# Web: http://localhost:8080
# MailHog: http://localhost:8025
```

### 3. Production Deployment
```bash
# Make deployment script executable
chmod +x docker/deploy.sh

# Deploy to production
./docker/deploy.sh deploy

# Check deployment status
docker-compose -f docker-compose.production.yml ps
```

## 🛠 Development Setup

### Local Development with Docker

1. **Start the development environment:**
   ```bash
   docker-compose up -d
   ```

2. **Access services:**
   - **Application**: http://localhost:8080
   - **Database**: localhost:5432
   - **Redis**: localhost:6379
   - **MailHog**: http://localhost:8025

3. **Run Laravel commands:**
   ```bash
   docker-compose exec app php artisan migrate
   docker-compose exec app php artisan db:seed
   docker-compose exec app php artisan tinker
   ```

4. **Stop the environment:**
   ```bash
   docker-compose down
   ```

### Development Features

- **Hot reload**: Changes are reflected immediately
- **Database seeding**: Automatic for development
- **Mail testing**: MailHog catches all emails
- **Debug mode**: Enabled for development
- **Detailed logging**: Debug level logging

## 🏭 Production Deployment

### Automated Deployment

1. **Prepare environment:**
   ```bash
   # Copy and edit production environment
   cp .env.production .env
   nano .env
   ```

2. **Deploy:**
   ```bash
   ./docker/deploy.sh deploy
   ```

3. **Verify deployment:**
   ```bash
   curl http://localhost:8080/health
   ```

### Manual Deployment

1. **Build the image:**
   ```bash
   docker build -f Dockerfile.production -t nihsa:latest .
   ```

2. **Run migrations:**
   ```bash
   docker run --rm --env-file .env.production nihsa:latest php artisan migrate --force
   ```

3. **Start services:**
   ```bash
   docker-compose -f docker-compose.production.yml up -d
   ```

### SSL Configuration

For production with SSL:

1. **Obtain SSL certificates:**
   ```bash
   # Create SSL directory
   mkdir -p ssl

   # Add your certificates
   cp your-certificate.crt ssl/nihsa.crt
   cp your-private.key ssl/nihsa.key
   ```

2. **Uncomment SSL configuration in nginx.prod.conf**

3. **Restart services:**
   ```bash
   docker-compose -f docker-compose.production.yml restart nginx
   ```

## ⚙️ Configuration

### Environment Variables

Key environment variables in `.env.production`:

```bash
# Application
APP_ENV=production
APP_DEBUG=false
APP_URL=https://nihsa.gov.ng

# Database (Your Neon.tech database)
DATABASE_URL="postgresql://default:bn9CDyo5RrgV@ep-delicate-fire-09764825-pooler.us-east-1.aws.neon.tech/nihsa?sslmode=require&channel_binding=require"

# Redis
REDIS_HOST=redis
REDIS_PASSWORD=redis_secure_password_2024

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=noreply@nihsa.gov.ng
MAIL_PASSWORD=your_smtp_password
```

### Docker Compose Services

#### Application Container
- **Port**: 8080
- **Health Check**: `/health` endpoint
- **Resources**: 256MB-512MB RAM
- **Processes**: PHP-FPM, Laravel Queue Workers, Scheduler

#### Nginx Reverse Proxy
- **Port**: 80 (and 443 for SSL)
- **Features**: Rate limiting, Gzip compression, Security headers
- **Cache**: Static files cached for 1 year

#### PostgreSQL (Local Development)
- **Port**: 5432
- **Database**: nihsa
- **User**: nihsa_user
- **Password**: nihsa_password

#### Redis
- **Port**: 6379
- **Password**: redis_secure_password_2024
- **Usage**: Cache, Sessions, Queue

### Database Configuration

Your Neon.tech PostgreSQL database is already configured:

```bash
# Direct connection string
DATABASE_URL="postgresql://default:bn9CDyo5RrgV@ep-delicate-fire-09764825-pooler.us-east-1.aws.neon.tech/nihsa?sslmode=require&channel_binding=require"

# Or individual parameters
DB_CONNECTION=pgsql
DB_HOST=ep-delicate-fire-09764825-pooler.us-east-1.aws.neon.tech
DB_PORT=5432
DB_DATABASE=nihsa
DB_USERNAME=default
DB_PASSWORD=bn9CDyo5RrgV
```

## 📊 Monitoring & Logging

### Health Checks

The application includes built-in health checks:

- **Application**: `http://localhost:8080/health`
- **Database**: Automatic connection checks
- **Redis**: Connection and ping tests

### Logs

#### Application Logs
```bash
# View all logs
docker-compose logs -f app

# View specific service
docker-compose logs -f nginx
docker-compose logs -f redis
```

#### Log Locations
- **Nginx**: `/var/log/nginx/`
- **Application**: `storage/logs/laravel.log`
- **Supervisor**: `/var/log/supervisor/`

### Monitoring (Optional)

Enable monitoring stack:

```bash
# Start with monitoring
docker-compose -f docker-compose.production.yml --profile monitoring up -d

# Access Grafana
# http://localhost:3000 (admin/admin)
```

### Performance Monitoring

Monitor key metrics:

- **Response Time**: < 200ms for cached requests
- **Database Queries**: < 50ms average
- **Memory Usage**: < 512MB per container
- **CPU Usage**: < 80% sustained load

## 🔧 Troubleshooting

### Common Issues

#### 1. Database Connection Failed
```bash
# Check database connectivity
docker-compose exec app php artisan migrate:status

# Test database connection
docker-compose exec app php -r "try { new PDO('pgsql:host=postgres;dbname=nihsa', 'nihsa_user', 'nihsa_password'); echo 'Connected'; } catch(Exception \$e) { echo 'Failed: ' . \$e->getMessage(); }"
```

#### 2. Permission Denied Errors
```bash
# Fix permissions
docker-compose exec app chown -R appuser:appuser /var/www/storage
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

#### 3. Container Won't Start
```bash
# Check container logs
docker-compose logs app

# Check system resources
docker system df
free -h
df -h
```

#### 4. High Memory Usage
```bash
# Check memory usage
docker stats

# Clear Docker cache
docker system prune -a
```

### Debug Mode

Enable debug mode for troubleshooting:

```bash
# Edit .env
APP_DEBUG=true
LOG_LEVEL=debug

# Restart containers
docker-compose restart app
```

### Database Issues

#### Reset Database (Development Only)
```bash
# Drop and recreate database
docker-compose exec app php artisan migrate:fresh --seed

# Or reset specific tables
docker-compose exec app php artisan tinker
>>> DB::statement('DROP TABLE IF EXISTS table_name');
>>> exit
```

#### Backup Database
```bash
# Create backup
docker-compose exec postgres pg_dump -U nihsa_user nihsa > backup.sql

# Restore backup
docker-compose exec -T postgres psql -U nihsa_user nihsa < backup.sql
```

## ⚡ Performance Optimization

### Application Level

1. **Enable OPcache:**
   ```bash
   # Already enabled in production Dockerfile
   # Verify in php.ini
   docker-compose exec app php -i | grep opcache.enable
   ```

2. **Cache Configuration:**
   ```bash
   # Use Redis for cache and sessions
   CACHE_DRIVER=redis
   SESSION_DRIVER=redis
   ```

3. **Database Optimization:**
   ```bash
   # Add database indexes
   php artisan make:migration add_indexes
   ```

### Infrastructure Level

1. **Enable Gzip Compression:**
   ```bash
   # Already configured in nginx.prod.conf
   # Check if working
   curl -H "Accept-Encoding: gzip" -I http://localhost:8080
   ```

2. **Static File Caching:**
   ```bash
   # Already configured for 1-year cache
   # Verify headers
   curl -I http://localhost:8080/build/app.js
   ```

3. **Connection Pooling:**
   ```bash
   # Already configured in supervisor.conf
   # Monitor with
   docker-compose exec app supervisorctl status
   ```

### Scaling

#### Horizontal Scaling
```bash
# Scale application containers
docker-compose -f docker-compose.production.yml up -d --scale app=3

# Update nginx upstream (if load balancer is used)
# Edit docker/nginx/nginx.prod.conf
upstream php_backend {
    server app:9000;
    server app_1:9000;
    server app_2:9000;
    keepalive 32;
}
```

#### Vertical Scaling
```bash
# Increase resources in docker-compose.production.yml
deploy:
  resources:
    limits:
      memory: 1G
    reservations:
      memory: 512M
```

## 🔒 Security

### Security Features

- **Non-root containers**: Run as unprivileged user
- **Security headers**: XSS, CSRF, Content-Type protection
- **Rate limiting**: API and login endpoints
- **File access restrictions**: Hidden files blocked
- **SSL support**: Ready for HTTPS

### Security Checklist

- [ ] Change default passwords
- [ ] Enable SSL/TLS
- [ ] Configure firewall rules
- [ ] Regular security updates
- [ ] Monitor access logs
- [ ] Backup encryption
- [ ] Database connection encryption

### SSL/TLS Setup

1. **Obtain SSL certificate:**
   - Let's Encrypt (free)
   - Commercial certificate
   - Cloudflare SSL

2. **Configure SSL:**
   ```bash
   # Place certificates in ssl/ directory
   ssl/nihsa.crt
   ssl/nihsa.key
   
   # Uncomment SSL server block in nginx.prod.conf
   ```

3. **Restart nginx:**
   ```bash
   docker-compose -f docker-compose.production.yml restart nginx
   ```

## 📞 Support

### Getting Help

1. **Check logs first:**
   ```bash
   docker-compose logs -f app
   ```

2. **Health check:**
   ```bash
   curl http://localhost:8080/health
   ```

3. **Common solutions:**
   - Restart containers: `docker-compose restart`
   - Clear cache: `docker-compose exec app php artisan cache:clear`
   - Check permissions: `docker-compose exec app ls -la storage/`

### Useful Commands

```bash
# View running containers
docker-compose ps

# View resource usage
docker stats

# Execute commands in container
docker-compose exec app bash

# View container logs
docker-compose logs -f --tail=100 app

# Restart specific service
docker-compose restart app

# Scale services
docker-compose up -d --scale app=2

# Clean up
docker system prune -a
```

### Performance Testing

```bash
# Install Apache Bench
sudo apt install apache2-utils

# Test application performance
ab -n 1000 -c 10 http://localhost:8080/

# Test with authentication
ab -n 100 -c 5 -H "Authorization: Bearer your-token" http://localhost:8080/api/test
```

---

## 🎉 Deployment Complete!

Your NIHSA Laravel application is now production-ready with:

- ✅ PostgreSQL database integration
- ✅ Redis caching and sessions
- ✅ Nginx reverse proxy
- ✅ Health checks and monitoring
- ✅ Security hardening
- ✅ Performance optimization
- ✅ Automated deployment

**Next Steps:**
1. Configure your domain DNS
2. Set up SSL certificates
3. Configure monitoring alerts
4. Set up automated backups
5. Plan scaling strategy

For additional support, refer to the troubleshooting section or check the application logs.
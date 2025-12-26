# Deploying NIHSA Laravel Application to Render.com

This guide will help you deploy your Laravel application to Render.com using Docker and SQLite.

## Prerequisites

- A Render.com account (https://render.com)
- Your code pushed to a Git repository (GitHub, GitLab, or Bitbucket)

## Quick Deploy

### Option 1: Using render.yaml (Recommended)

1. Push your code to GitHub/GitLab/Bitbucket
2. Go to https://dashboard.render.com
3. Click "New +" → "Blueprint"
4. Connect your repository
5. Render will automatically detect `render.yaml` and set up your service
6. Click "Apply" to deploy

### Option 2: Manual Setup

1. Go to https://dashboard.render.com
2. Click "New +" → "Web Service"
3. Connect your repository
4. Configure the service:
   - **Name**: nihsa-laravel
   - **Runtime**: Docker
   - **Dockerfile Path**: ./Dockerfile.render
   - **Instance Type**: Free (or your preferred plan)

5. Add Environment Variables (click "Advanced" → "Add Environment Variable"):
   ```
   APP_NAME=NIHSA
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://your-app.onrender.com
   DB_CONNECTION=sqlite
   DB_DATABASE=/var/www/html/database/database.sqlite
   SESSION_DRIVER=file
   CACHE_STORE=file
   QUEUE_CONNECTION=database
   LOG_CHANNEL=stack
   ```

6. Generate APP_KEY:
   - You can generate this locally: `php artisan key:generate --show`
   - Or set it as an environment variable later

7. Add a Persistent Disk:
   - Click "Add Disk"
   - **Name**: nihsa-data
   - **Mount Path**: /var/www/html/database
   - **Size**: 1 GB

8. Click "Create Web Service"

## Important Notes

### Database
- This setup uses **SQLite** for the database
- The SQLite database file is stored in `/var/www/html/database/database.sqlite`
- Database persistence is ensured through Render's disk feature
- Migrations run automatically on each deployment

### Environment Variables
After deployment, make sure to set these critical environment variables in Render dashboard:

1. **APP_KEY**: Generate using `php artisan key:generate --show`
2. **APP_URL**: Your Render app URL (e.g., https://nihsa-laravel.onrender.com)
3. **DB_CONNECTION**: Must be set to `sqlite`
4. **DB_DATABASE**: Must be `/var/www/html/database/database.sqlite`

### File Storage
- Uploaded files and storage should use Render's disk feature or cloud storage (S3, etc.)
- The current setup uses local file storage, which persists in the disk mount

### Performance
- Free tier on Render spins down after 15 minutes of inactivity
- First request after spin-down may take 30-60 seconds
- Consider upgrading to a paid plan for production use

### Logs
View logs in Render dashboard:
1. Go to your service
2. Click "Logs" tab
3. Monitor application output and errors

## Post-Deployment

### Run Artisan Commands
You can run artisan commands using Render's Shell:

1. Go to your service dashboard
2. Click "Shell" tab
3. Run commands:
   ```bash
   php artisan migrate
   php artisan db:seed
   php artisan cache:clear
   php artisan config:cache
   ```

### Database Seeding
If you need to seed the database:
```bash
php artisan db:seed --force
```

## Troubleshooting

### Database Issues
If you encounter database issues:
1. Check that the disk is properly mounted at `/var/www/html/database`
2. Verify permissions: `ls -la /var/www/html/database`
3. Check the database file exists: `ls -la /var/www/html/database/database.sqlite`

### Permission Errors
If you see permission errors in logs:
```bash
chmod 666 /var/www/html/database/database.sqlite
chmod 775 /var/www/html/database
```

### Application Key Error
If you see "No application encryption key has been specified":
1. Generate a key: `php artisan key:generate --show`
2. Add it as APP_KEY environment variable in Render dashboard
3. Restart the service

### Migration Errors
If migrations fail:
1. Check the Shell tab and run: `php artisan migrate --force`
2. View detailed error messages
3. Check database permissions

## Files Created

- `Dockerfile.render` - Optimized Docker configuration for Render
- `docker/nginx.conf` - Nginx web server configuration
- `docker/supervisord.conf` - Process manager configuration
- `docker/entrypoint.sh` - Container startup script
- `render.yaml` - Render deployment configuration
- `.env.render` - Environment variables template

## Security Recommendations

1. **Never commit `.env` files** to your repository
2. Set `APP_DEBUG=false` in production
3. Use strong `APP_KEY` (32 character random string)
4. Configure proper CORS and CSRF settings
5. Set up SSL/HTTPS (Render provides this automatically)
6. Regularly update dependencies: `composer update`

## Scaling Considerations

When your app grows, consider:
1. Upgrading from SQLite to PostgreSQL (Render offers managed PostgreSQL)
2. Using Redis for cache and sessions
3. Implementing queue workers for background jobs
4. Using cloud storage (S3) for file uploads
5. Upgrading to a paid Render plan for better performance

## Support

- Render Documentation: https://render.com/docs
- Laravel Documentation: https://laravel.com/docs
- Render Community: https://community.render.com

## License

This application is licensed under the same license as your Laravel project.

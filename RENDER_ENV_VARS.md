# Render.com Environment Variables Quick Reference

## Required Environment Variables

Set these in your Render.com dashboard under "Environment" tab:

### Application Settings
```
APP_NAME=NIHSA
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.onrender.com
```

### Generate APP_KEY
Run this command locally to generate:
```bash
php artisan key:generate --show
```
Then add the output (including "base64:") as `APP_KEY` in Render.

### Database Configuration (SQLite)
```
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
```

### Session & Cache
```
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=database
```

### Logging
```
LOG_CHANNEL=stack
LOG_LEVEL=debug
```

## Optional Environment Variables

### Mail Configuration (if using email)
```
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

### AWS S3 (if using cloud storage)
```
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=your-access-key
AWS_SECRET_ACCESS_KEY=your-secret-key
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
```

## How to Add Environment Variables in Render

1. Go to your Render dashboard
2. Select your web service
3. Click "Environment" in the left sidebar
4. Click "Add Environment Variable"
5. Enter the key and value
6. Click "Save Changes"
7. Your service will automatically redeploy

## Auto-Generate Variables in render.yaml

The `render.yaml` file includes most of these variables. You only need to:
1. Generate and add `APP_KEY`
2. Update `APP_URL` to match your actual Render URL
3. Add any optional variables you need (mail, S3, etc.)

## Security Notes

- ⚠️ Never commit `.env` files to git
- ✅ Always set `APP_DEBUG=false` in production
- ✅ Use strong, randomly generated `APP_KEY`
- ✅ Keep sensitive credentials secure
- ✅ Regularly rotate API keys and passwords

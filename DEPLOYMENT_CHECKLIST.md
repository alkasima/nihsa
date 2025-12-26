# Pre-Deployment Checklist for Render.com

Use this checklist before deploying to Render.com:

## ✅ Pre-Deployment Steps

### 1. Generate Application Key
- [ ] Run: `php artisan key:generate --show`
- [ ] Copy the output (including "base64:" prefix)
- [ ] Save it - you'll need it for Render environment variables

### 2. Test Locally (Optional but Recommended)
- [ ] Open PowerShell in project root
- [ ] Run: `.\docker\build-local.ps1`
- [ ] If build succeeds, test the container
- [ ] Verify the application works at http://localhost:8080

### 3. Update Database Configuration
- [ ] Confirm `config/database.php` has default set to 'sqlite'
- [ ] Verify SQLite configuration is correct
- [ ] Check that `.env.example` has `DB_CONNECTION=sqlite`

### 4. Commit Changes to Git
```bash
git add .
git commit -m "Add Render.com deployment configuration with SQLite"
git push origin main
```
- [ ] All files committed
- [ ] Pushed to GitHub/GitLab/Bitbucket
- [ ] Repository is accessible from Render.com

## 🚀 Deployment Steps

### 5. Create Render Account
- [ ] Sign up at https://render.com (free account)
- [ ] Verify your email address
- [ ] Connect your GitHub/GitLab account

### 6. Deploy Using Blueprint (Easy Way)
- [ ] Go to Render Dashboard
- [ ] Click "New +" → "Blueprint"
- [ ] Select your repository
- [ ] Render auto-detects `render.yaml`
- [ ] Review the configuration
- [ ] Click "Apply"

### 7. Configure Environment Variables
Go to your service → Environment tab and add:

- [ ] **APP_KEY**: [paste the key you generated]
- [ ] **APP_URL**: Update to your actual Render URL
- [ ] Verify other variables from `render.yaml` are correct

### 8. Configure Persistent Disk
- [ ] Go to service → Settings → Disks
- [ ] Verify disk is created:
  - Name: `nihsa-data`
  - Mount Path: `/var/www/html/database`
  - Size: 1 GB
- [ ] If not created, add the disk manually

### 9. Monitor Deployment
- [ ] Watch the "Logs" tab during deployment
- [ ] Look for: "Build successful"
- [ ] Look for: "Database migrations completed"
- [ ] Wait for: "Your service is live at..."

### 10. Test Deployed Application
- [ ] Visit your Render URL
- [ ] Verify the app loads correctly
- [ ] Check database connectivity
- [ ] Test key features
- [ ] Check for any errors in Render logs

## 🔧 Post-Deployment Steps

### 11. Run Migrations (if needed)
If migrations didn't run automatically:
- [ ] Go to service → Shell tab
- [ ] Run: `php artisan migrate --force`
- [ ] Verify migrations completed successfully

### 12. Seed Database (if needed)
- [ ] Go to service → Shell tab
- [ ] Run: `php artisan db:seed --force`
- [ ] Verify seeding completed

### 13. Clear Caches
- [ ] Go to service → Shell tab
- [ ] Run: `php artisan cache:clear`
- [ ] Run: `php artisan config:cache`
- [ ] Run: `php artisan route:cache`

### 14. Security Check
- [ ] Verify `APP_DEBUG=false` in production
- [ ] Confirm `APP_ENV=production`
- [ ] Check SSL/HTTPS is working (Render provides this)
- [ ] Review environment variables for sensitive data

### 15. Monitor & Test
- [ ] Check application logs for errors
- [ ] Test all major features
- [ ] Monitor database size
- [ ] Check performance and response times

## 🐛 Troubleshooting

If deployment fails, check:
- [ ] Review build logs for errors
- [ ] Verify `Dockerfile.render` syntax
- [ ] Check environment variables are set
- [ ] Confirm persistent disk is mounted
- [ ] Review `RENDER_DEPLOYMENT.md` troubleshooting section

## 📝 Common Issues & Solutions

### "No application encryption key has been specified"
- Add `APP_KEY` environment variable
- Restart the service

### "Database file not writable"
- Check disk is mounted at `/var/www/html/database`
- Verify disk permissions in container

### "Service unavailable" after deployment
- Wait 2-3 minutes for full startup
- Check logs for errors
- Verify migrations completed

### Build fails
- Check Docker build logs
- Verify all dependencies in composer.json
- Ensure Dockerfile.render syntax is correct

## 🎉 Success Criteria

Your deployment is successful when:
- ✅ App loads at your Render URL
- ✅ No errors in deployment logs
- ✅ Database connection works
- ✅ Migrations completed successfully
- ✅ All features working as expected

## 📚 Resources

- Full deployment guide: `RENDER_DEPLOYMENT.md`
- Environment variables: `RENDER_ENV_VARS.md`
- All changes summary: `DEPLOYMENT_SUMMARY.md`
- Render docs: https://render.com/docs

---

**Next:** After completing this checklist, your application should be live on Render.com! 🚀

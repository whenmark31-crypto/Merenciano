# 🚀 Railway Deployment Guide with Cloudinary

## Problem
Railway uses ephemeral storage - uploaded files are deleted when containers restart. Profile pictures disappear after deployment.

## Solution
Use Cloudinary (free cloud storage) for profile pictures.

---

## Step 1: Install Cloudinary Package

Run this command in your project folder:

```bash
composer require cloudinary-labs/cloudinary-laravel
```

---

## Step 2: Create Cloudinary Account

1. Go to: https://cloudinary.com/users/register_free
2. Sign up for FREE account
3. After login, go to Dashboard
4. Copy these 3 values:
   - **Cloud Name**
   - **API Key**
   - **API Secret**

---

## Step 3: Update .env File

Add these lines to your `.env` file:

```env
FILESYSTEM_DISK=cloudinary

CLOUDINARY_CLOUD_NAME=your_cloud_name_here
CLOUDINARY_API_KEY=your_api_key_here
CLOUDINARY_API_SECRET=your_api_secret_here
```

Replace with your actual Cloudinary credentials.

---

## Step 4: Railway Environment Variables

In Railway dashboard:

1. Go to your project
2. Click **Variables** tab
3. Add these variables:

```
FILESYSTEM_DISK=cloudinary
CLOUDINARY_CLOUD_NAME=your_cloud_name
CLOUDINARY_API_KEY=your_api_key
CLOUDINARY_API_SECRET=your_api_secret
```

---

## Step 5: Push to GitHub

```bash
git add .
git commit -m "Add Cloudinary support for Railway"
git push origin main
```

Railway will automatically redeploy.

---

## Step 6: Test

1. Login to your Railway app
2. Go to Profile → Edit Profile
3. Upload a profile picture
4. Picture should now persist after redeployment!

---

## How It Works

### Local Development (XAMPP):
- Uses `public` disk (local storage)
- Files stored in `storage/app/public/profiles/`
- Accessed via `http://localhost:8000/storage/profiles/image.jpg`

### Production (Railway):
- Uses `cloudinary` disk (cloud storage)
- Files uploaded to Cloudinary servers
- Accessed via `https://res.cloudinary.com/your-cloud/image/upload/...`

The code automatically detects which storage to use based on `FILESYSTEM_DISK` environment variable.

---

## Local Testing with Cloudinary

If you want to test Cloudinary locally:

1. Update `.env`:
   ```env
   FILESYSTEM_DISK=cloudinary
   ```

2. Add Cloudinary credentials to `.env`

3. Upload a profile picture

4. Switch back to local:
   ```env
   FILESYSTEM_DISK=public
   ```

---

## Cloudinary Free Tier

✅ 25 GB storage  
✅ 25 GB bandwidth/month  
✅ Unlimited transformations  
✅ Perfect for student projects!  

---

## Troubleshooting

### Issue: "Class 'CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary' not found"

**Solution:**
```bash
composer install
php artisan config:clear
php artisan cache:clear
```

### Issue: Profile picture not showing

**Solution:**
1. Check Railway environment variables are set
2. Check Cloudinary credentials are correct
3. Clear browser cache (Ctrl+F5)

### Issue: Upload fails

**Solution:**
1. Verify Cloudinary credentials
2. Check image size (max 2MB)
3. Check file format (jpg, png, jpeg only)

---

## Railway Deployment Checklist

✅ Install Cloudinary package  
✅ Create Cloudinary account  
✅ Add environment variables to Railway  
✅ Push code to GitHub  
✅ Test profile picture upload  
✅ Verify picture persists after redeploy  

---

## Alternative: AWS S3

If you prefer AWS S3 instead of Cloudinary:

1. Install AWS SDK:
   ```bash
   composer require league/flysystem-aws-s3-v3 "^3.0"
   ```

2. Update `.env`:
   ```env
   FILESYSTEM_DISK=s3
   AWS_ACCESS_KEY_ID=your_key
   AWS_SECRET_ACCESS_KEY=your_secret
   AWS_DEFAULT_REGION=us-east-1
   AWS_BUCKET=your_bucket_name
   ```

3. Update Railway environment variables

---

## Files Modified

1. ✅ `composer.json` - Added Cloudinary package
2. ✅ `config/filesystems.php` - Added Cloudinary disk
3. ✅ `app/Http/Controllers/ProfileController.php` - Support both storage types
4. ✅ `resources/views/layouts/app.blade.php` - Display Cloudinary URLs
5. ✅ `resources/views/profile/show.blade.php` - Display Cloudinary URLs
6. ✅ `resources/views/profile/edit.blade.php` - Display Cloudinary URLs

---

## Summary

**Before:** Profile pictures deleted on Railway restart ❌  
**After:** Profile pictures stored in Cloudinary cloud ✅  

**Local:** Still works with local storage  
**Production:** Uses Cloudinary automatically  

---

## Quick Commands

```bash
# Install package
composer require cloudinary-labs/cloudinary-laravel

# Push to GitHub
git add .
git commit -m "Add Cloudinary support"
git push origin main

# Clear cache (if needed)
php artisan config:clear
php artisan cache:clear
```

---

**Your profile pictures will now work perfectly on Railway! 🎉**

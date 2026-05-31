# 🚀 QUICK REFERENCE - Railway + Cloudinary

## 📋 Checklist

### 1. Install Cloudinary
```bash
composer require cloudinary-labs/cloudinary-laravel
```
OR double-click: `install-cloudinary.bat`

### 2. Get Cloudinary Credentials
- Sign up: https://cloudinary.com/users/register_free
- Dashboard → Copy:
  - Cloud Name
  - API Key
  - API Secret

### 3. Railway Environment Variables
Add in Railway dashboard → Variables:
```
FILESYSTEM_DISK=cloudinary
CLOUDINARY_CLOUD_NAME=your_cloud_name
CLOUDINARY_API_KEY=your_api_key
CLOUDINARY_API_SECRET=your_api_secret
```

### 4. Push to GitHub
```bash
git add .
git commit -m "Add Cloudinary support"
git push origin main
```

### 5. Test
- Login to Railway app
- Upload profile picture
- Redeploy → Picture should persist ✅

---

## 🔧 Local Development

Keep using local storage:
```env
FILESYSTEM_DISK=public
```

No Cloudinary needed for local testing!

---

## 🌐 Production (Railway)

Automatically uses Cloudinary:
```env
FILESYSTEM_DISK=cloudinary
```

---

## ⚡ Quick Commands

```bash
# Install
composer require cloudinary-labs/cloudinary-laravel

# Clear cache
php artisan config:clear
php artisan cache:clear

# Push to GitHub
git add .
git commit -m "Update"
git push
```

---

## 🆓 Cloudinary Free Tier

- 25 GB storage
- 25 GB bandwidth/month
- Unlimited transformations
- Perfect for projects!

---

## 🐛 Troubleshooting

**Profile picture not showing?**
1. Check Railway environment variables
2. Verify Cloudinary credentials
3. Clear browser cache (Ctrl+F5)

**Upload fails?**
1. Check image size (max 2MB)
2. Check format (jpg, png, jpeg)
3. Verify Cloudinary credentials

---

## 📁 Files Changed

✅ composer.json  
✅ config/filesystems.php  
✅ ProfileController.php  
✅ layouts/app.blade.php  
✅ profile/show.blade.php  
✅ profile/edit.blade.php  

---

## 🎯 How It Works

**Local (XAMPP):**
- Storage: `storage/app/public/profiles/`
- URL: `http://localhost:8000/storage/profiles/image.jpg`

**Railway:**
- Storage: Cloudinary cloud
- URL: `https://res.cloudinary.com/.../image.jpg`

Code automatically detects which to use!

---

## ✅ Done!

Profile pictures now work on Railway! 🎉

Read `RAILWAY_DEPLOYMENT.md` for full guide.

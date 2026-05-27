# 🔧 FIX: Profile Picture Upload

## Problem
Profile pictures show as "none" or don't display after upload.

## Solution

### Step 1: Create Storage Link

Open Command Prompt in your project folder and run:

```bash
cd c:\xampp\htdocs\Merenciano
php artisan storage:link
```

**What this does:**
- Creates a symbolic link from `public/storage` to `storage/app/public`
- Allows uploaded images to be accessible via web browser

### Step 2: Verify Storage Directory

Make sure this folder exists:
```
c:\xampp\htdocs\Merenciano\storage\app\public\profiles
```

If it doesn't exist, create it manually or it will be created automatically on first upload.

### Step 3: Check Permissions (if needed)

Make sure the `storage` folder has write permissions:
- Right-click on `storage` folder
- Properties → Security
- Make sure your user has "Full control"

### Step 4: Test Upload

1. Login to the system
2. Go to Profile → Edit Profile
3. Click "Change Picture"
4. Select an image (JPG, PNG)
5. Click "Update Profile"
6. Check if image displays

---

## Alternative: Manual Storage Link (Windows)

If `php artisan storage:link` doesn't work, create manually:

### Option 1: Using Command Prompt (as Administrator)
```bash
cd c:\xampp\htdocs\Merenciano\public
mklink /D storage ..\storage\app\public
```

### Option 2: Using PowerShell (as Administrator)
```powershell
cd c:\xampp\htdocs\Merenciano\public
New-Item -ItemType SymbolicLink -Path "storage" -Target "..\storage\app\public"
```

---

## Verify Storage Link Works

After creating the link, check:

1. **Folder exists:**
   ```
   c:\xampp\htdocs\Merenciano\public\storage
   ```
   This should be a shortcut/link to `storage\app\public`

2. **Test in browser:**
   - Upload a profile picture
   - Right-click on the image
   - Copy image address
   - Should look like: `http://localhost:8000/storage/profiles/xxxxx.jpg`

---

## Common Issues

### Issue 1: "The link has already been created"
**Solution:** Delete the existing link first
```bash
# Windows Command Prompt
rmdir c:\xampp\htdocs\Merenciano\public\storage

# Then create again
php artisan storage:link
```

### Issue 2: Image uploads but doesn't show
**Solution:** 
1. Check if file exists in `storage/app/public/profiles/`
2. Check if `public/storage` link exists
3. Clear browser cache (Ctrl+F5)

### Issue 3: Permission denied
**Solution:**
1. Run Command Prompt as Administrator
2. Or manually set folder permissions

---

## File Structure

After successful setup:
```
Merenciano/
├── public/
│   └── storage/  ← Symbolic link
│       └── profiles/
│           └── uploaded-images.jpg
└── storage/
    └── app/
        └── public/  ← Actual storage location
            └── profiles/
                └── uploaded-images.jpg
```

---

## Quick Test

Run this command to check if storage link exists:
```bash
cd c:\xampp\htdocs\Merenciano\public
dir storage
```

Should show: `<SYMLINKD>` or `<JUNCTION>` next to storage

---

## Still Not Working?

### Check .env file:
```
FILESYSTEM_DISK=local
```

### Check config/filesystems.php:
```php
'default' => env('FILESYSTEM_DISK', 'local'),
```

### Clear config cache:
```bash
php artisan config:clear
php artisan cache:clear
```

---

## Summary

**Required Steps:**
1. ✅ Run `php artisan storage:link`
2. ✅ Upload profile picture
3. ✅ Verify image displays

**That's it! Profile pictures should now work! 🎉**

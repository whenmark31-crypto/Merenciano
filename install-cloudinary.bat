@echo off
echo ========================================
echo Installing Cloudinary for Railway
echo ========================================
echo.

cd /d "%~dp0"

echo Step 1: Installing Cloudinary package...
composer require cloudinary-labs/cloudinary-laravel

echo.
echo ========================================
echo Installation Complete!
echo ========================================
echo.
echo Next Steps:
echo 1. Create Cloudinary account at: https://cloudinary.com/users/register_free
echo 2. Get your credentials from Cloudinary dashboard
echo 3. Add to Railway environment variables:
echo    - FILESYSTEM_DISK=cloudinary
echo    - CLOUDINARY_CLOUD_NAME=your_cloud_name
echo    - CLOUDINARY_API_KEY=your_api_key
echo    - CLOUDINARY_API_SECRET=your_api_secret
echo 4. Push to GitHub
echo.
echo Read RAILWAY_DEPLOYMENT.md for detailed instructions
echo.
pause

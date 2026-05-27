@echo off
echo ========================================
echo Creating Storage Link for Profile Pictures
echo ========================================
echo.

cd /d "%~dp0"

echo Running: php artisan storage:link
php artisan storage:link

echo.
echo ========================================
echo Done!
echo ========================================
echo.
echo Profile picture upload should now work!
echo.
pause

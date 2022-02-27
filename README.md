# simple-url-shorter
Simple laravel url shorter with automatic removal

## Start
- Fill in the fields `APP_NAME` and `APP_URL`, they are used to generate and validate shortened links.
- Make mirations
- Start crontab job for laravel `* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1`

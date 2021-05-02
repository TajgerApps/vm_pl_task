To run project:
1. You need to configure mailer `./config/mailer.php` set gmail login and password.
2. Set up db: `./db-dump.sql` & `./config/db.php`
3. Set up cron: add line to crontab (crontab -e):
   `0 7 * * * [project path]/yii notify`
4. run it on whatever server You like, eg. ./yii serve
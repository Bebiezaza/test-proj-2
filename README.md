# SMCU MedCamp Registration System
Built on [Laravel](https://laravel.com/) framework, with [Materialize](https://materializecss.com/) front-end framework, currently powered by PHP 7 with Laravel 8

## Features
- One-stop service for students looking to join MedCamp to register, do quiz, see "admission" result, accepting or denying the offer, and payment slip attachment 
- Staffs can download registration form information anytime

## Local Installation
### Prerequisites
1. PHP Knowledge
   - PHP (currently preferably PHP 7 as PHP 8 had some problems during last test run), can be downloaded from https://www.php.net/
2. mySQL Knowledge
   - Find a way to run your own mySQL database on your computer.
3. Composer, a PHP package manager, can be downloaded from https://getcomposer.org/

### Steps
1. Do a git pull.
2. Rename `.env.example` to just `.env`
3. Inside .env file, change `DB_DATABASE` `DB_USERNAME` and `DB_PASSWORD` to match environment's credentials. The <ins>**empty**</ins> database <ins>**has**</ins> to be created by the user. Collation is "utf8mb4_unicode_ci".
4. Run `composer install`
5. Start local database, then run `php artisan migrate` to create tables for the database for use with MedCamp Registration System.
6. Run `php artisan key:generate`
7. For each time local dev site needs to be started:
   - Start local database.
   - Run `php artisan serve --port=80` to start hosting a local dev site.

#### If localhost login does not work
https://stackoverflow.com/questions/28635295/laravel-socialite-testing-on-localhost-ssl-certificate-issue

## Required Maintenance
This section doesn't include updating the website on docchula-server. For instructions on the server, see "Required Maintenance on Remote Server" section below.

### Frontend
- The website interface where users can see and interact are hosted inside `resources/views` folder. To edit, such as updating information for each new camp year, navigate to the folder and edit the blade templates.
- Data privacy notice page, personnel on display as data aggregatpr is the head of registration division (เฮดฝ่ายรับสมัคร)

### Quiz
- Quiz are written and stored inside the `quiz` table in the database.
- Examples of previous years' quiz TBD

### Backend, Database
- Upon changing database layouts, "database migration files" have to be updated. They are stored inside `database/migrations` folder. Tables can be automatically updated by deleting the insulting table and deleting migration info with matching filename on `migrations` table. Then, run `php artisan migrate` again.
- Some pages have additional data validation upon form submission, see older commits for examples on how to edit them[^1][^2].

### Data Privacy Form Approvals
- **ชื่อเรื่องแบบสอบถาม:** รับสมัครนักเรียนมัธยมศึกษาตอนปลายเข้าร่วมกิจกรรมค่ายอยากเป็นหมอครั้งที่ ...
- **ประเภทของแบบสอบถาม:** แบบสอบถามภายนอก
- **Link:** https://medcamp.docchula.com/
- **ช่องทางการติดต่อ:** mdcumedcamp@docchula.com
- **คำอธิบายแบบสอบถาม:** *copies https://medcamp.docchula.com/accept-data-privacy
- **ชั้นปีที่:** 5

## Required Maintenance on Remote Server (on docchula-server)
This section should include all the steps from getting on the server to finishing the deployment.

When on docchula-server, use sudo with git to bypass dubious ownership

*Items inside `<brackets>` should (must) be changed to appropriate values

### Prerequisites (cloning with SSH keys)
1. Get docchula-server SSH credential to login to the server from IT division administrators, or contact IT division administrators for help in maintaining instead.
2. Get into "www-data" usergroup by `sudo usermod -a -G www-data <your username>`

### Github SSH Credential Generation and Site Updating
1. https://docs.github.com/en/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent
2. https://docs.github.com/en/authentication/connecting-to-github-with-ssh/adding-a-new-ssh-key-to-your-github-account
3. Go to `/sites/MedCamp`
4. Do a git pull.

### Or just using https
1. read https://docs.github.com/en/get-started/git-basics/about-remote-repositories#cloning-with-https-urls
2. https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/managing-your-personal-access-tokens

### SQL
1. `mysqldump -u medcamp -p medcamp > <dump name.sql>`
2. Login to mysql with credentials insided .env file on the server. (`mysql -u medcamp -p`)
3. Get into the database. (`USE medcamp;`)
4. Drop all tables, but do not delete the database. (`DROP TABLE <table>;`)
5. Use `exit` to logout of mysql system.
6. Delete the insides of folder /sites/MedCamp/storage/app/public (.gitignore file may need to be recreated) 
   - `rm -rv /sites/MedCamp/storage/app/public`
   - then `mkdir /sites/MedCamp/storage/app/public`
   - then `nano /sites/MedCamp/storage/app/public/.gitignore` then write the file to match [.gitignore inside this repository](storage/app/public/.gitignore)
   - then `sudo chown -R <ownername>:www-data *` and maybe `sudo chmod -R g+rwx *`
7. Move database dump from step 1 to somewhere else secure.
8. Run `php artisan migrate` to recreate the tables inside the database.
9. Repeat steps 2 and 3.
10. Use `source <quiz file.sql>` to import exam questions.
11. Repeat step 5.
12. Verify integrity at https://medcamp.docchula.com/,
    - Use https://medcamp.docchula.com/instruction to bypass login screen to verify integrity inside the website, with `DENY_NEW_REGISTER=false` inside .env

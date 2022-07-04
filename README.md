<h1 align="center">
    System Requirements
</h1>
<p align="center">
    PHP Version : 8.1.6
</p>
<p align="center">
    Used Laravel Version : 9
</p>
<p align="center">
    Composer Version : 2.3.8
</p>
<p>
    If your windows user please clone the project on c:/Xampp/htdocs or if your ubuntu user clone the project in opt/lampp/htdocs
</p>

<p>
    Please clone the project by using this cmd <strong>git clone https://github.com/Kumaran-Donglee/StudentManagementSystem.git</strong>
</p>

<p>
    After clone the project please copy the .env.example as .env file
</p>

<ul>
    <li>In the env file i have my database credentials like below please the config your database credetials in the env file</li>
    <li>DB_CONNECTION=mysql</li>
    <li>DB_HOST=127.0.0.1</li>
    <li>DB_PORT=3306</li>
    <li>DB_DATABASE=StudentManageSystem</li>
    <li>DB_USERNAME=root</li>
    <li>DB_PASSWORD=</li>
</p>

<p>After config the env file we need to cache clear for that use this command <strong>php artisan cache:clear</strong></p>

<p>After cache clear Do this command for install packages <strong>composer install</strong></p>

<p>After composer install do fresh migrate by using this cmd <strong>php artisan migrate:fresh --seed</strong></p>

<p>Now we can start our project by <strong>php artisan serve</strong></p>

<p>Now our server will start at <a href="http://localhost:8080"><strong>http://localhost:8080</strong></a>. Use this url for our project.</p>

<p>Thank You</p>
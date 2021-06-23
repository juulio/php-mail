# Wordpress Project Template 2018

## Setup localhost environment
Please read and follow these steps carefully

1. Install [Virutal Box](https://www.virtualbox.org/wiki/Downloads)

2. Install [Vagrant](https://www.vagrantup.com)

3. Clone this repository to the desired folder.

4. Go into the folder porject and create a new **develop** branch.
    ```sh
    cd project-folder
    git checkout -b develop
    ```

5. To run the project using Vagrant, you need to install the ubuntu/trusty64 box. So the first time you run `vagrant up` it'll show a lot of things on the terminal. This will only happen once.
    ```sh
    vagrant up
    ```

6. To log into the local Vagrant machine using ssh, type
    ```sh
    vagrant ssh
    ```

7. Inside the Vagrant machine (ssh) log into MySql to create the project's database. You'll be asked for the password. MySql user: root  MySql password: wpDB2018

    ```sh
    mysql -uroot -p
    ```

8. There will be an empty database called **wordpressDB**.

    To verify, type:
    ```sh
    show databases;
    use wordpressDB;
    show tables;
    ```
    
    To log out of MySql type:
    ```sh
    exit
    ```

9. Create new MySQL DB user for Wordpress
    ```sh
    CREATE DATABASE IF NOT EXISTS wordpressDB;
    CREATE USER 'wpadmin'@'localhost' IDENTIFIED BY 'abc12345DEF.';
    GRANT ALL PRIVILEGES ON wordpressDB.* TO 'wpadmin'@'localhost';
    SHOW GRANTS FOR 'wpadmin'@'localhost';
    exit
    ```

10. Inside Vagrant machine (SSH), go to the project folder 
    ```sh
    cd /var/www
    ```

11. On a browser, test `http://localhost:8080 `  
    Wordpress will show you the language setup window  
    `http://localhost:8080/wp-admin/setup-config.php`    

12. Make sure you use the following information to setup Wordpress
    DB_NAME: wordpressDB
    DB_USER: wpadmin
    DB_PASSWORD: abc12345DEF.

## Permalinks  
Please make sure there's a **.htaccess** file on the project's root folder. That is the same folder where you have `wp-config.php` file and the `wp-content` and `wp-admin` folders. The basic file is on the repo, however it may vary on your server.  
You can grab the basic .htaccess file needed at `https://codex.wordpress.org/htaccess`  

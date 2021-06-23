# 2021 PHP Mail - OUT CR

## Steps to setup a localhost environment

1. Install [Virutal Box](https://www.virtualbox.org/wiki/Downloads)

2. Install [Vagrant](https://www.vagrantup.com)

3. Clone this repository to the desired folder.

4. To run the project using Vagrant, you need to install the ubuntu/trusty64 box. So the first time you run `vagrant up` it'll show a lot of things on the terminal. This will only happen once.
    ```sh
    vagrant up
    ```

5. To log into the local Vagrant machine using ssh, type
    ```sh
    vagrant ssh
    ```


6. Inside Vagrant machine (SSH), go to the project folder 
    ```sh
    cd /var/www
    ```

7. On a browser, test `http://localhost:8080 `  
 
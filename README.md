# Docker Wordpress Installation on ARM

This guide assumes that you have a folder `/home/blog-uploads` that stores your uploaded images on the host and not 
within the docker image

##  Install from scratch

For a fresh installation of Wordpress follow the following simple steps: 

1. Clone the git repo
    ```bash
    git clone https://github.com/patklaey/docker-wordpress
    cd docker-wordpress 
    ```
1. Modify the ```.env``` file to change passwords
    ```bash
    vi .env
    ```
1. Start up the containers
    ```bash
    docker-compose up -d
    ```
1. Point your browser to your blog, you should now see the Wordpress installation wizard

## Install from existing Wordpress installation

If there is an already existing installation, make sure you have your uploads copied (or mounted) to 
`/home/blog-uploads`, then follow those steps:

1. Clone the git repo
    ```bash
    git clone https://github.com/patklaey/docker-wordpress
    cd docker-wordpress 
    ```
1. Modify the ```.env``` file to change passwords
    ```bash
    vi .env
    ```
1. Start up the containers
    ```bash
    docker-compose up -d
    ```
1. Copy the database backup into the mysql container
    ```bash
    docker cp /path/to/backup/wordpress-utf.sql wordpress-db:/root
    ```
1. Import the database backup
    ```bash
    source .env
    docker exec wordpress-db sh -c "mysql --default-character-set=latin1 -u ${DB_USERNAME} --password=${DB_PASSWORD} ${DB_NAME} < /root/wordpress-utf.sql"  
    ```
1. Point your browser to ```%your-blog%/wp-admin``` to check if the database needs an update

Congrats, you're done.

### Troubleshooting
* Database might need an update depending on what version you had running before
* In case you see an error like "Too many redirects", point your browser to blog.yourdomain.tld/wp-admin, login and 
check your settings (Settings -> General). What does ```WordPress Address (URL)``` and ```Site Address (URL)``` say,
does it correspond a

# Backup
To backup your Wordpress installation you need to things: 
1. Backup the blog-uploads directory
    ```bash
    rsync --verbose --archive -h /home/blog-uploads /mnt/backup/home/
    ```
2. Backup the mysql db
    ```bash
    docker exec wordpress-db sh -c "mysqldump -u ${DB_USERNAME} --password=${DB_PASSWORD} ${DB_NAME} > /backup/wordpress-utf.sql"
    cp -p /root/db_backup/wordpress-utf.sql /mnt/backup/wordpress-utf.sql
    ```

# Update

1. Build and tag the new version of the docker wordpress image (see [wiki](http://wiki.patklaey.ch/index.php/Docker_Cheat_Sheet#Build_an_image))
1. Bring down docker-compose (careful: do NOT specify -v to leave the volmes (database) untouched)
    ```bash
    docker-compose down
    ``` 
1. Bring docker-compose up again:
    ```bash
    docker-compose up -d
    ```
1. Point your browser to ```%your-blog%/wp-admin``` to check if the database needs an update
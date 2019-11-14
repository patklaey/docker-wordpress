# Docker Wordpress Installation on ARM

This guide assumes that you have a folder `/home/blog-uploads` that stores your uploaded images on the host and not 
within the docker image

## Fresh installation

For a fresh installation of Wordpress follow the following simple steps: 

1. Clone the git repo
    ```bash
    git clone https://github.com/patklaey/docker-wordpress
    cd docker-wordpress 
    ```
2. Modify the ```.env``` file to change passwords
    ```bash
    vi .env
    ```
3. Start up the containers
    ```bash
    docker-compose up -d
    ```
4. Point your browser to your blog, you should now see the Wordpress installation wizard

## Restore from backup

If there is an already existing installation, make sure you have your uploads copied (or mounted) to 
`/home/blog-uploads`, then follow those steps:

1. Clone the git repo
    ```bash
    git clone https://github.com/patklaey/docker-wordpress
    cd docker-wordpress 
    ```
2. Modify the ```.env``` file to change passwords
    ```bash
    vi .env
    ```
3. Start up the containers
    ```bash
    docker-compose up -d
    ```
4. Copy the database backup into the mysql container
    ```bash
    docker cp /path/to/backup/wordpress-utf.sql wordpress-db:/root
    ```
5. Import the database backup
    ```bash
    source .env
    docker exec wordpress-db sh -c "mysql -u ${MYSQL_USER} --password=${MYSQL_PASSWORD} ${MYSQL_DB_NAME} < /root/wordpress-utf.sql"  
    ```
6. Point your browser to your blog, should be all fine

Congrats, you're done.

### Troubleshooting
* Database might need an update depending on what version you had running before
* In case you see an error like "Too many redirects", point your browser to blog.yourdomain.tld/wp-admin, login and 
check your settings (Settings -> General). What does ```WordPress Address (URL)``` and ```Site Address (URL)``` say,
does it correspond a
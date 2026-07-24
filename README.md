# Demo Web Phising

## Setup:
Install apache2, mysql-server, php-mysql
```bash
sudo apt install apache2 php php-mysql mysql-server -y
sudo systemctl restart apache2
```

Create database
```Bash
sudo mysql

CREATE DATABASE mlbb;
CREATE USER 'mlbb'@'localhost' IDENTIFIED BY 'mlbb';
GRANT ALL PRIVILEGES ON mlbb.* TO 'mlbb'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

Clone the git
```bash
cd /var/www/html
git clone https://github.com/Jodi-Therson/web-fishing.git

sudo chown -R www-data:www-data /var/www/html/web-fishing
sudo chmod -R 755 /var/www/html/web-fishing
```

Access the web
```bash
http://your_ip/web-fishing/index.html
```

Files:
```
index.html - main page
submit.php - logic for submitting to db
dashboard.php - to view the inputted data
```
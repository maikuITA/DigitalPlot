# DigitalPlot

## The perfect site for every reader

**DigitalPlot** is a web application developed for a university project. It allows users to write and read articles published by other users in a simple and accessible way.

In our application, there are four main types of users:
- BASIC: This user can read up to eight articles, earn points for each article read, and purchase a subscription.
- READER: This user can read all articles on the website. Additionally, they can write reviews, follow specific writers, and search for specific articles on the website.
- WRITER: This user has the same features as the Reader, with an additional privilege: they can post, modify, and delete their own articles.
- ADMIN: The Admin is the all-mighty user. They can manage every article on the website, and every article must be approved by them. They can also view log files and delete comments.

---

## 🚀 Installation Guide

Before starting, make sure you have the following installed:

- PHP (version 8.x or higher)
- A web server (e.g. Apache)
- A relational DBMS (e.g. MariaDB)
- Composer

After downloading the repository to your device, follow these steps:

### 1. Install dependencies

Open your terminal in the `DIGITALPLOT` folder and run:

```bash
composer install
```
### 2. Configure database

Edit the database settings in the following file:
```
DIGITALPLOT/Progetto/Utility/config.php
```
Be sure to set your host, database name, username, and password.<br>

### 3. Enjoy our application

Start your local server (e.g. with php artisan serve if using Laravel, or configure Apache/Nginx) and access the application via your browser by typing the URL hostname/DigitalPlot/dbInit in order to populate properly your db (at the end, you will be redirected to the home). <br>

Some advertisements:
- If you see an error message after browsing to dbInit, don’t worry—this is normal. The database is working correctly.
- If you are running the application locally, make sure to grant Apache permission to read and write in the following directories: proxy, template_c, and Logs. Otherwise, the application will not function correctly. Moreover, the redirect to https do not work with every browser because of the missing certificate. 

---

## 📝 Notes

This project is for academic purposes and not intended for production use.
Contributions and feedback are welcome.

---

## 👨‍💻 Author

Andrea – Engineering student <br>
Ludovica – Engineering student <br>
Giulio – Engineering student

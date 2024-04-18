```
██╗  ██╗ ██████╗  ██████╗ ██████╗     ██████╗  ██████╗  ██████╗ ██╗  ██╗
██║  ██║██╔═══██╗██╔═══██╗██╔══██╗    ██╔══██╗██╔═══██╗██╔═══██╗██║ ██╔╝
███████║██║   ██║██║   ██║██████╔╝    ██████╔╝██║   ██║██║   ██║█████╔╝ 
██╔══██║██║   ██║██║   ██║██╔═══╝     ██╔══██╗██║   ██║██║   ██║██╔═██╗ 
██║  ██║╚██████╔╝╚██████╔╝██║         ██████╔╝╚██████╔╝╚██████╔╝██║  ██╗
╚═╝  ╚═╝ ╚═════╝  ╚═════╝ ╚═╝         ╚═════╝  ╚═════╝  ╚═════╝ ╚═╝  ╚═╝
```

# 🏀 HOOPBOOK Project 🏀

This project is a web application built with PHP. It's a simple application that allows users to reserve a spot.

## 📂 Project Structure

The main file of the project is `home.php`. This file contains the HTML structure of the home page and some inline CSS for styling.

## 🚀 Getting Started

To get started with this project, clone the repository and set up a local development environment with a PHP server.

## 🎯 Usage

Navigate to the home page (`home.php`). You will see a "Reserve Now!" button. Click on this button to reserve a spot.

## 🔐 Login Details

**Staff**
- Email: client@email.com
- Password: client123

**Admin**
- Email: admin@email.com
- Password: admin123

**User**
- Email: user@email.com
- Password: user123


## 🗄️ Database Details

- phpMyAdmin: https://www.phpmyadmin.co/
- Server: sql6.freemysqlhosting.net
- Name: sql6698012
- Username: sql6698012
- Password: RktzTYAizq
- Port number: 3306

NOTE: We uses free online MySQL Hosting which is very limited in the number of allowed number of connections.
If you experience "max connections" error while using the site, please switch to the local database for temporary testing.
1. Create a database named "hoopbook_db" in your mysql server using preferred DBMS (e.g. PHPMyAdmin). Set all configuraions to default
2. Import /database/hoopbook_db.sql into the database
3. Edit /initialize.php, comment line 7-10 and uncomment line 16-19
5. Test

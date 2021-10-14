# PHP Message Board
A simple PHP message board project.
## Installation instructions
The following tutorial is for adding and configuring this in your University of Twente Portfolio Site. Some steps will be different when installing on another webserver.
### Step 1 - Download
Download the message-board files (Code > Download ZIP):

<img src="https://raw.githubusercontent.com/thiagoalbrecht/php-message-board/tutorial/images/download.png" width="300">

### Step 2 - Unzip and upload
Unzip the files and upload them to your website.

### Step 3 - Creating a database
(Skip this step if you already have a database in your website)

Go to https://portfolio.cr.utwente.nl/new/portfolio/ and create a database. You will get a password, copy and store it somewhere.

### Step 4 - Creating a table
Launch phpMyAdmin (https://portfolio.cr.utwente.nl/db-admin/) and log in to your database
<br>Your username is your student number (e.g. s1234567). Your password was given while creating your database. If you've lost it, go to the link in Step 3 to reset it.

Go to the SQL tab (make sure your database is selected from the left sidebar):

<img src="https://raw.githubusercontent.com/thiagoalbrecht/php-message-board/tutorial/images/phpmyadmin-sql.png">

Paste the following query in the query box and press 'Go':

```
CREATE TABLE `message_board` (
  `message_id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `message_board`
  ADD PRIMARY KEY (`message_id`);

ALTER TABLE `message_board`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
```

### Step 5 - Configuring your database credentials
Go to the includes folder and open the file setup.php
You will see the following lines of code:
```
<?php
$servername = "localhost";
$username = "s1234567"; 
$dbname = "s1234567";
$password = "Password";
```
Fill this in with your credentials. $username and $dbname are usually your student number (e.g. s1234567), and $password is the database password that was given to you when creating your database. Leave $servername as 'localhost'.

Open your message_board.php page on your site and test it.

## Deleting messages
You can delete messages by going to the delete_messages.php page. You will have to login with the same password of your database to access this page.

## Notes
The message_board.php file has most of the PHP code externally referenced to minimise clutter and help you to better work with the HTML part of your page. Be careful with the PHP tags when you're editing your page. The order of the included PHP code matters for the page to properly work.

The page also includes minimal CSS code, so you can style the page the way you want.

You can log out the delete_messages.php page by adding ?logout to the page URL (delete_messages.php?logout)

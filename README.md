# PHP Message Board
A simple PHP message board project.
## Install instructions
The following tutorial is for adding and configuring this in your University of Twente Portfolio Site. Some steps will be different when installing on another webserver.
### Step 1 - Download
Download the message-board files (Code > Download ZIP):

<img src="https://raw.githubusercontent.com/thiagoalbrecht/message-board/tutorial/images/download.png" width="300">

### Step 2 - Unzip and upload
Unzip the files and upload them to your website.

### Step 3 - Creating a database
(Skip this step if you already have a database in your website)

Go to https://portfolio.cr.utwente.nl/new/portfolio/ and create a database. You will get a password, copy and store it somewhere.

### Step 4 - Creating a table
Launch phpMyAdmin (https://portfolio.cr.utwente.nl/db-admin/) and log in to your database
<br>Your username is your student number (e.g. s1234567). Your password was given while creating your database. If you've lost it, go to the link in Step 3 to reset it.

Go to the SQL tab:

```
CREATE TABLE `message_board_2` (
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;
```

## 

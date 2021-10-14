<!DOCTYPE html>
<html>
<head>
    <style>
    label, h3 {
        color:red;
    }
    </style>
</head>
<body>

<h1>Delete messages</h1>
<h3>Be careful! Deleting messages cannot be undone.</h3>
<br>
<?php
include 'includes/setup.php';
session_start();

if ($_POST['password'] == $password || $_SESSION["password"]){ // Check if either the entered or stored password are correct
    $_SESSION["password"] = $password; // Save session information
    echo '<form action="delete_messages.php" method="post">';
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_set_charset($conn,"utf8mb4");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    foreach ($_POST as $key => $value) { 
        if ($key == "confirm_truncate"){
            $sql = "TRUNCATE TABLE `message_board`";
            $result = $conn->query($sql);
            echo "<h2>Table was reset.</h2>";
            unset($_POST['truncate']);
        }else if ($value == "on"){
            $sql = "DELETE FROM `message_board` WHERE `message_id` = '$key'";
            $result = $conn->query($sql);
            echo "<p><b>Post #".$key." has been deleted.</b></p>";
        }
    }
    
    
    $sql = "SELECT message_id, name, message, timestamp FROM message_board ORDER BY message_id DESC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Create the cards with the message posts for all records in the database
        while($row = $result->fetch_assoc()) {
            echo '<fieldset> 
                    <legend>Post #'.$row["message_id"].'</legend>
                    <p>'.$row["message"].'</p>
                    <input type="checkbox" id="'.$row["message_id"].'" name="'.$row["message_id"].'">
                    <label for="'.$row["message_id"].'">Delete</label>
                     </fieldset><br>';
        }
    } else {
        echo "<h2>No messages yet!</h2>";
    }
    $conn->close();
    echo '<input type="submit" value="Confirm Deletion">
    </form><br>';
    echo '<form action="delete_messages.php" method="post">';
    
    if (isset($_POST['truncate'])){
        echo '<input type="checkbox" id="confirm_truncate" name="confirm_truncate"> <label for="confirm_truncate">I\'m sure I want to delete all messages and reset the database table</label><br>';
    }
    
    echo '<input type="submit" value="Reset database table" name="truncate">
    </form>';
} 

else { // If user not logged in
    echo "<h2>Please, enter your database password to access this page:</h2>";
    echo '<form action="delete_messages.php" method="post">
          <label style="color:black" for="password">Password:</label>
          <input type="password" id="password" name="password">
          <input type="submit" value="Login">
          </form>';
    if (isset($_POST['password'])){ // If user not logged in but password is set, then password is incorrect.
        echo '<p style="color:red">Password incorrect. This should be your database password (the same you set in the includes/setup.php file)</p>';
    }
}
?>


<?php 
if (isset($_GET['logout'])){ // Unset session variable when query ?logout is used
    unset($_SESSION["password"]);
}
?>


</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get values of input fields
    $name = $_POST['name'];
    $message = $_POST['message'];
    // If number of charaters of name>50 or message>500, display error message and unset the texts from the variables. This prevents HTML inspections to change the allowed size of characters when posting.
    if (strlen($name) > 50 || strlen($message) > 500) {
    echo "<div class=\"alert\">\r\n  <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span> \r\n Illegal post request. Name or message length is greater than allowed.\r\n</div>";
    unset($name);
    unset($message);
    }
  if (empty($name) || empty($message)) { // Display error if name or message is empty
    echo "<div class=\"alert\">\r\n  <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span> \r\n You're missing one or more fields!\r\n</div>";
  } else {

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
     // Remove any HTML tags from name and message
    $name = strip_tags($name);
    $message = strip_tags($message);
    // Escape strings from $name and $message to prevent SQL Injections.
    $sanitized_name = mysqli_real_escape_string($conn,$name);
    $sanitized_message = mysqli_real_escape_string($conn,$message);
    mysqli_set_charset($conn,"utf8mb4");
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    // Check if message already exists, and if so, don't post it and display error message. (Useful if the user reloads the page and resends the POST request)
    $sql = "SELECT name, message FROM message_board WHERE message = '$sanitized_message' AND name = '$sanitized_name'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        echo "<div class=\"alert\">\r\n  <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span> \r\n Duplicate post. (Maybe you refreshed the page and resent the information)\r\n</div>";
    } else {
        $sql = "INSERT INTO message_board (name, message)
        VALUES ('$sanitized_name', '$sanitized_message')";
        
        if ($conn->query($sql) === TRUE) { // If SQL query executed, display a success message.
          echo "<div class=\"success\">\r\n  <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span> \r\n Your message has been posted!\r\n</div>";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
    
  }
}
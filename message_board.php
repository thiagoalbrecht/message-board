
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP message board</title>
<link rel="stylesheet" href="form.css">
<link rel="stylesheet" href="cards.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body {
    font-family: Arial, Helvetica, sans-serif;
}
</style>
</head>
<body>
<div align="center">
<h1>Message Board</h1>
<div class="form">
<?php 
include 'includes/setup.php';
include 'includes/post_message.php';
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <label for="name">Your name: </label><input id="name" type="text" name="name" placeholder="John Doe" maxlength = "28" required><br>
  <label for="message">Message:</label> <textarea id="message" name="message" rows="5" cols="30" placeholder="Type your message here" maxlength = "500" required></textarea>
  <input type="submit" value="Post message">
</form>
</div>
<?php include 'includes/display_messages.php'; // Cards for messages are created here. ?>
</div>
</body>
</html> 
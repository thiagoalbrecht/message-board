<?php
// Get messages from database
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8mb4");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, message, timestamp FROM message_board ORDER BY timestamp DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Create the cards with the message posts for all records in the database
    while($row = $result->fetch_assoc()) {
        echo '<div class="column">
                <div class="card">
                    <p>'.$row["message"].'</p>
                    <h3><img class="icon" src="person_black_24dp.svg">'.$row["name"].'</h3>
                    <p class="description"><img class="icon" src="today_black_24dp.svg">'.$row["timestamp"].'</p>
                </div>
            </div>';
    }
} else {
    echo "<h2>No messages yet!</h2>";
}

$conn->close();
<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the message
    $message = htmlspecialchars($_POST['message']);
    
    // Store the message in a text file
    $entry = "Message: $message\n";
    file_put_contents('messages.txt', $entry, FILE_APPEND);

    // Set a success message in session
    $_SESSION['success_message'] = "Message sent successfully! We will get back to you shortly.";
    
    // Redirect back to contact page
    header("Location: index.html");
    exit();
}
?>

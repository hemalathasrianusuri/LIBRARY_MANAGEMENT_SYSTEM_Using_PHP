<?php
// fetch_book_details.php

// Include necessary configurations and database connection
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_POST['bookId'])) {
    $bookId = $_POST['bookId'];

    // Fetch book details based on bookId
    $sql = "SELECT * FROM tblbooks WHERE id = :bookId";
    $query = $dbh->prepare($sql);
    $query->bindParam(':bookId', $bookId, PDO::PARAM_INT);
    $query->execute();
    $bookDetails = $query->fetch(PDO::FETCH_ASSOC);

    if ($bookDetails) {
        // Return book details as JSON
        echo json_encode($bookDetails);
    } else {
        echo "Book details not found.";
    }
} else {
    echo "Invalid request.";
}
?>

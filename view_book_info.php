<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_GET['bookid'])) {
    $bookid = intval($_GET['bookid']);

    $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblauthors.AuthorName,tblbooks.ISBNNumber,tblbooks.TotalCopies,tblbooks.AvailableNoOfBooks,tblbooks.LocationOfBook,tblbooks.BookPrice,tblbooks.id as bookid,tblbooks.bookImage FROM tblbooks
            JOIN tblcategory ON tblcategory.id = tblbooks.CatId
            JOIN tblauthors ON tblauthors.id = tblbooks.AuthorId
            WHERE tblbooks.id = :bookid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':bookid', $bookid, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
} else {
    header('location: manage-books.php');
    exit();
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Book Details</title>
     <!-- BOOTSTRAP CORE STYLE  -->
     <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="header-line">Book Details</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img src="admin/bookimg/<?php echo htmlentities($result->bookImage); ?>" width="300px">
                </div>
                <div class="col-md-6">
                    <p><strong>Book Name:</strong> <?php echo htmlentities($result->BookName); ?></p>
                    <p><strong>Category:</strong> <?php echo htmlentities($result->CategoryName); ?></p>
                    <p><strong>Author:</strong> <?php echo htmlentities($result->AuthorName); ?></p>
                    <p><strong>ISBN:</strong> <?php echo htmlentities($result->ISBNNumber); ?></p>
                    <p><strong>Total Copies:</strong> <?php echo htmlentities($result->TotalCopies); ?></p>
                    <p><strong>Available Copies:</strong> <?php echo htmlentities($result->AvailableNoOfBooks); ?></p>
                    <p><strong>Location:</strong> <?php echo htmlentities($result->LocationOfBook); ?></p>
                    <p><strong>Price:</strong> <?php echo htmlentities($result->BookPrice); ?></p>
                </div>
            </div>
        </div>
    </div>
 <!-- CONTENT-WRAPPER SECTION END-->
 <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>

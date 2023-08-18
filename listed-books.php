<?php
session_start();
error_reporting(0);
include('includes/config.php');

// // Check if user is logged in
// if (strlen($_SESSION['login']) == 0) {
//     header('location:index.php');
// } else {

    // Search functionality
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblauthors.AuthorName,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid,tblbooks.bookImage,tblbooks.isIssued FROM tblbooks
                JOIN tblcategory ON tblcategory.id = tblbooks.CatId
                JOIN tblauthors ON tblauthors.id = tblbooks.AuthorId
                WHERE tblbooks.BookName LIKE '%$search%'
                OR tblcategory.CategoryName LIKE '%$search%'
                OR tblauthors.AuthorName LIKE '%$search%'
                OR tblbooks.ISBNNumber LIKE '%$search%'";
    } else {
        $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblauthors.AuthorName,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid,tblbooks.bookImage,tblbooks.isIssued FROM tblbooks
                JOIN tblcategory ON tblcategory.id = tblbooks.CatId
                JOIN tblauthors ON tblauthors.id = tblbooks.AuthorId";
    }

    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System |  Issued Books</title>
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
            <div class="row pad-botm">
                <!-- ... (rest of your content) ... -->
                <!-- <div class="col-md-12">
                <h4 class="header-line">Books List</h4>
                 </div> -->
                <!-- Search Bar -->
                <div class="col-md-12">
                    <form method="post">
                        <input type="text" name="search" placeholder="Search for books" style="width: 500px;">
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>
                

            <div class="row">
            <?php
            if ($query->rowCount() > 0) {
                foreach ($results as $result) {
                    ?>
                    <div class="col-md-4" style="float:left; height:300px;">
                        <img src="admin/bookimg/<?php echo htmlentities($result->bookImage); ?>" width="100">
                        <br /><b><?php echo htmlentities($result->BookName); ?></b><br />
                        <?php echo htmlentities($result->CategoryName); ?><br />
                        <?php echo htmlentities($result->AuthorName); ?><br />
                        <?php echo htmlentities($result->ISBNNumber); ?> <br />
                        <?php if ($result->isIssued == '1'): ?>
                            <p style="color:red;">Book Already issued</p>
                            <?php else: ?>
                            <a href="view_book_info.php?bookid=<?php echo htmlentities($result->bookid); ?>">View More Details</a>
                        <?php endif; ?>
                    </div>
                    <?php
    }
} else {
    echo "<p>No matching results found.</p>";
}
?>

            <div class="col-md-12">
                   
                </div>
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
<!-- <?php ?> -->


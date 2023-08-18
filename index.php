<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']='';
}
if(isset($_POST['login']))
{

$email=$_POST['emailid'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password,StudentId,Status FROM tblstudents WHERE EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
 foreach ($results as $result) {
 $_SESSION['stdid']=$result->StudentId;
if($result->Status==1)
{
$_SESSION['login']=$_POST['emailid'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else {
echo "<script>alert('Your Account Has been blocked .Please contact admin');</script>";

}
}

} 

else{
echo "<script>alert('Invalid Details');</script>";
}
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
        .slideshow-container {
            max-width: 100%;
            position: relative;
            margin: auto;
        }

        .slide {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .myDiv {   
        text-align: center;
        height:500px;
        }
        div.transbox {
        margin: 30px;
        background-color: #ffffff;
        /* border: 1px solid black; */
        opacity: 0.6;
        padding: 10px;
        }

    </style>
</head>
<body > 
    <!-- style="background-color:#1d2a35;" -->
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
            <!-- SLIDESHOW SECTION START -->
            <div class="slideshow-container">
                <div class="slide"style="background-color:blue;" >
                    <div class="myDiv" style="background-image: url(img1.jpg);display: flex;justify-content: center;align-items: center;" >
                    <div class="transbox"><h1 style="color:black;font-weight: bold;font-size:6vw;">Welcome to Online Library Management</h1></div></div>
                    <!-- <img src="img1.jpg" style="height:1000px;width:1000px"alt="Slide 1" /> -->
                </div>
                <div class="slide"style="background-color:black;" >
                    <!-- <img src="img2.jpg" alt="Slide 2" /> -->
                    <div class="myDiv" style="background-image: url(img2.jpg);display:flex;justify-content: center;align-items: center;"  >
                    <div class="transbox"><h1 style="color:black;font-weight: bold;font-size:6vw;">Welcome to Online Library Management</h1></div>
                    </div>
                </div>
                <div class="slide"style="background-color:red;" >
                    <div class="myDiv" style="background-image: url(img3.jpeg);display:flex;justify-content: center;align-items: center;" >
                    <div class="transbox"><h1 style="color:black;font-weight: bold;font-size:6vw;">Welcome to Online Library Management</h1></div>
                </div>
                    <!-- <img src="img3.jpeg" alt="Slide 3" /> -->
                </div>
                <!-- Add more slides as needed -->
            </div>
            <!-- SLIDESHOW SECTION END -->

            <!-- OTHER CONTENT OF THE PAGE -->

    </div>
    <!-- CONTENT-WRAPPER SECTION END -->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END -->

    <!-- SLIDESHOW SCRIPTS -->
    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let slides = document.getElementsByClassName("slide");
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 2000); // Change slide every 2 seconds
        }
    </script>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>


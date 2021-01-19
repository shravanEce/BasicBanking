<?php include 'pdo.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="resources/css/all.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/grid.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/animate.css">
        <link rel="stylesheet" type="text/css" href="resources/css/styles.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/4.0.2/bootstrap-social.min.css" integrity="sha512-JcW9wu2uMONZLxuh9gA5ZWxzDePxi70WbMFxGPlVkkMR9oOUbdnZbn685ulVdat0tSpLSNOVbKjGhnAUMS7H3w==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Basic Banking</title>
    </head>
    <style>
        .trans{
            text-align:center;
            background-color:rgb(242, 231, 223);
            margin-left:20%;
            margin-right:20%;
            border-radius: 3%;
        }
   h1 {
  color: #ff5600;
  font-family: Lora,Oxygen, -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
  font-size: 1.5em;
  font-weight: bold;
  text-shadow: 1px 1px 1px #222;
  margin-top: 0;
  margin-bottom: 0.9;
  text-align:center;
  /line-height: .75;/
}
    </style>

    <body>
            <nav style="background-color:#353b48">
                <div class="row">
                    <ul class="main-nav js--main-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="quick.php">Quick Transfer</a></li>
                        <li><a href="trans_hist.php">Transaction History</a></li>
                        <li><a href="showuser.php">View Users</a></li>
                    </ul>
                </div>
            </nav>
    <div class="trans">
        <center><h1 style="margin-top: 70px;">Account Summery</h1></center>
    <div class="trans">
<?php 
$arr = array();
$stmt = $pdo->prepare("SELECT * FROM user  where AccountNo = :xyz");
$stmt->execute(array(":xyz" => $_GET['AccountNo']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 echo '<p>Name: '.$row['Name'];
 echo '</p><p>AccountNo: '.$row['AccountNo'];
 echo '</p><p>Email: '.$row['Email'];
 echo '</p><p>Mobile: '.$row['Mobile'];
 echo '</p><p>Date of Birth:  '.$row['DOB'];
 echo '</p><p>Address: '.$row['Address'];
 echo '</p><p> Current Balance:'.$row['CurrentBalance'];
 echo "</p>";
 $_SESSION["id"] = $row['AccountNo'];
 $_SESSION['Ac'] = $row['AccountNo'];
?>
</div>
<div class ="trans">
<a class="btn btn-primary" href="transfer.php"role="button">Transfer Money</a>
<a class="btn btn-primary" href="mstatement.php"role="button">Your Recent Transactions</a>
</div>
</div>

</div>

<footer class="footer" style="margin-top: 70px;">
            <div class="f1">
                <a href="#"class="">About Us</a>
                <a href="#"class="">Privacy policy</a>
                <a href="#"class="">Contact Us</a>
                
            </div>
            <div class="location">
                <p class="f2">LOCATION :</p>
                <p >MondalPara Ranabhutiya Garia, Kolkata-700152 <br> CONTACT:+91-9874561230</p>
            </div>
            <div class="f2">
                FOLLOW US ON
            </div>
            <div class=" f3">
                <a herf = "https://www.facebook.com/" target="_blank"><i class="fa fa-facebook" aria-hidden="true" style="color: #4267B2"></i></a>
                <a herf= "https://twitter.com/?lang=en" target="_blank"
                ><i class="fa fa-twitter" aria-hidden="true" style ="color: #1DA1F2"></i></a>
                <a herf="https://www.google.com/"> <i class="fa fa-google" aria-hidden="true" style="color: #db4a39"></i></a>
                <a herf="https://www.linkedin.com/feed/"target="_blank"><i class="fa fa-linkedin" aria-hidden="true" style="color:#0e76a8"></i></a>
                <a herf ="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube" aria-hidden="true" style="color: 	#FF0000"></i></a>
                
            </div>
    </footer>
</body>
</html>
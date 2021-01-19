<?php
require_once("pdo.php");
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
    <body>
            <nav style="background-color:#353b48">
                <div class="row">
                    <ul class="main-nav js--main-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="quick.php">Quick Transfer</a></li>
                        <li><a href="trans.hist.php">Transaction History</a></li>
                        <li><a href="showuser.php">View Users</a></li>
                    </ul>
                </div>
            </nav>


<?php
$sql = "SELECT * FROM transfer ";
$stmt = $pdo->query($sql);
    echo('<table class="table table-striped" style="font-size:16px;">
            <thead>
                <tr>
                    <th scope="col">Transfer Id</th>
                    <th scope="col">Sender Name</th>
                    <th scope="col">Sender Account No.</th>
                    <th scope="col">Receiver Name</th>
                    <th scope="col">Receiver Account No.</th>
                    <th scope="col">Transfer Amount</th>
                    <th scope="col">Transfer date and time</th>
                </tr>
            </thead><tbody>');
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo('<tr>
            <th scope="row">');
    echo(htmlentities($row['TransId']));
    echo('</th><td>');
    echo(htmlentities($row['fname']));
    echo('</td><td>');
    echo(htmlentities($row['fan']));
    echo('</td><td>');
    echo(htmlentities($row['lname']));
    echo('</td><td>');
    echo(htmlentities($row['lan']));
    echo('</td><td>');
    echo(htmlentities($row['amount']));
    echo('</td><td>');
    echo(htmlentities($row['Date']));
    echo('</td><td>');
    // echo('<a class="btn btn-success" href="view_profile.php?AccountNo='.$row['AccountNo'].'"role="button">View Profile</a>');
    echo('</td><td>');
    echo('</td></tr>');
}
echo('</tbody><table>'); 

?>

<footer class="footer">
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

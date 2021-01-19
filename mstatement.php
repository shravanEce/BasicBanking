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
    </body>
    <style>
   h3 {
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
<?php

if(isset($_SESSION["Ac"])){
    $val = $_SESSION["Ac"];
    session_unset();
    $sql = "SELECT * FROM transfer Where fan = '$val' ORDER BY Date DESC";
  
    $stmt = $pdo->query($sql);
      echo('<h3> Debited</h3>');
        echo('<table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Transaction Id</th>
                        <th scope="col"> Name</th>
                        <th scope="col"> Account Number</th>
                        <th scope="col">Amout Transferd</th>
                        <th scope="col">Date & Time</th>
                    </tr>
                </thead><tbody>');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo('<tr>
                <th scope="row">');
        echo(htmlentities($row['TransId']));
        echo('</th><td>');
        echo(htmlentities($row['lname']));
        echo('</td><td>');
        echo(htmlentities($row['lan']));
        echo('</td><td>');
        echo(htmlentities($row['amount']));
        echo('</td><td>');
        echo(htmlentities($row['Date']));
        echo('</td><td>');
        echo('</td></tr>');
    }
    echo('</tbody><table>'); 
    $sql = "SELECT * FROM transfer Where lan = '$val' ORDER BY Date DESC";
  
    $stmt = $pdo->query($sql);
    echo('<h3>Credited</h3>');
    echo('<table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Transaction Id</th>
                    <th scope="col"> Name</th>
                    <th scope="col"> Account Number</th>
                    <th scope="col">Amout Transferd</th>
                    <th scope="col">Date & Time</th>
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
    echo(htmlentities($row['amount']));
    echo('</td><td>');
    echo(htmlentities($row['Date']));
    echo('</td><td>');
    echo('</td></tr>');
}
echo('</tbody><table>'); 
}
else{
    echo '<script>alert("Access Denaied");
          window.location.replace("index.php");
        </script>';
      return;
}

  ?>
</html>
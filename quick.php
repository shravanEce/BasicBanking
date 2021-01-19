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

<style>
     input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

form{
  margin:10px;
  padding: 10px;
  text-align:center;
  margin-top:52px;
  margin-bottom:60px;
  font-size:16px;
}

.form label{

}
option{
  color:red;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
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

<?php
if ( isset($_POST['cancel']) ) {
      header('Location:index.php');
      return;
  }
if(isset($_POST['sub'])){
  if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['AM'])){
    $am = $_POST['AM'];
    if($am == 0){
    	 echo '<script>alert("Please Enter Amount");
    window.location.replace("transfer.php");
  </script>';
    }
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    if($lname == 1){
      echo '<script>alert("Wrong Account Number");
      window.location.replace("transfer.php");
    </script>';
    }
    $sql = "SELECT * FROM `user` WHERE AccountNo = '$fname'";
    $stmt = $pdo->query($sql);
    $count = $stmt->rowCount();
    $sql = "SELECT * FROM `user` WHERE AccountNo = '$lname'";
    $stmtt = $pdo->query($sql);
    $count2 = $stmt->rowCount();

    //echo $count;
  if($count == 0 && $count2 == 0){
    echo '<script>alert("Wrong Account Number");
    window.location.replace("transfer.php");
  </script>';
  }
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $fnamee = $row['Name'];
  $fba = $row['CurrentBalance'];
  $row = $stmtt->fetch(PDO::FETCH_ASSOC);
  $lnamee = $row['Name'];
  $lba = $row['CurrentBalance'];
  $net = $fba-$am;
  $fnew = $fba-$am;
  $lnew = $lba+$am;
  if($net<0){
    echo '<script>alert("Insufficient Balance");
              window.location.replace("index.php");
            </script>';
    return;
  }

  $sql = "INSERT INTO transfer (fname, fan, lname,lan,amount)
                    VALUES (:fn,:fa, :ln, :la,:am)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':fa' => $fname,
            ':fn' => $fnamee,
            ':la' => $lname,
            ':ln' => $lnamee,
            ':am' => $am)
        );
  $sql = " UPDATE `user` SET `CurrentBalance`='$fnew' WHERE AccountNo = '$fname'";
  $stmt = $pdo->query($sql);
  $sql = " UPDATE `user` SET `CurrentBalance`='$lnew' WHERE AccountNo = '$lname'";
  $stmt = $pdo->query($sql);
  echo '<script>alert("Transfer successfully!!!");
          window.location.replace("index.php");
        </script>';
      return;

}
else{
  echo '<script>alert("All Fields are Required");
</script>';
}
}

if(isset($_SESSION["id"])){
  $val = $_SESSION["id"];
  session_unset();

}
?>

<div class= "row, form">
<form method="post">
                    <div class="form-group row">
                        <label for="fname" class="col-md-2 col-form-label">Enter Your Account Number</label>
                        <div class="col-md-4">
                            <input type="number" name="fname" id="fname" class="form-control"  value="<?php echo $val; ?>" placeholder = "Enter Your Account Number:">
                        </div>
                    </div>

                  
                    <div class="form-group row">
                    <label for="lname" class="col-md-2 col-form-label">Enter Reciver Account Number</label>
                    <div class="col-md-4">
                    <select  id = "lname"name="lname" value = "lname" class="form-control">
                    <option value = "1">Select Reciver Account No</option> 
                    <?php
                       $qu = "SELECT * FROM user";
                       $stmt = $pdo->query($qu);
                       while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                    <option value="<?php echo(htmlentities( $row['AccountNo']));?>"><?php  echo(htmlentities($row['AccountNo']));?></option>
                    <?php 
                       }
                       ?>
                      </div>
                     
                      <div>
                        <label for="AM" class="col-md-2 col-form-label">Amount To Be Transferd</label>
                        <div class="col-md-4">
                            <input type="number" name="AM" id="AM" class="form-control"  placeholder = "Amount To be Transferd">
                        </div>
                    </diV>

                    <div class="form-group row">
                        <div class="col-md-10">
                        <button type="submit" class="btn btn-primary" name="sub">Transfer</button>
                        <button type="submit" class="btn btn-secondary" name="cancel">Cancel</button>
                    </div>
                  
            </div>
</form>
</div>

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
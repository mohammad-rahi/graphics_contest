<?php
session_start();
if(isset($_SESSION["email"]) and isset($_SESSION["password"])){
  header('location: index.php');
}

require_once 'config.php';
require_once('test_data.php');

$emailErr = $passwordErr = "";
$email = $password = "";

if(isset($_POST["sign_up"])){
  $email = test_data($_POST["email"]);

  if(strlen($_POST["password"]) < 6){
    $passwordErr = "Password length will be greater than 6 characters!";
  }
  else{
    $password = test_data($_POST["password"]);
  }

  $sql = "INSERT INTO login_info(email, password) VALUES('$email', '$password')";


  if(mysqli_query($conn, $sql)){
    header('location: login.php');
  }
  else{
    echo mysqli_error($conn);
  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Facebook</title>
  <!-- Custom Styles -->
  <link rel="stylesheet" href="style.css">
  <style>
    .error{
      color: #ff0000;
      font-size: 11px;
     }
  </style>
</head>

<body>
  <main>
    <div>
    <section class="wrapper">
      <div class="hero-wrapper">
        <div class="img-wrapper">
          <img src="images/logo.svg" alt="facebook_logo">
        </div>
        <p>Facebook helps you connect and share with the people in your life.</p>
      </div>
    </section>
    <section class="wrapper">
      <div class="login-wrapper">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <input type="email" name="email" placeholder="Email address" value="<?php echo $email; ?>" required/>
          <span class="error" >* <?php echo $emailErr; ?></span>
          <input type="password" name="password" placeholder="Password" required/>
          <span class="error" >* <?php echo $passwordErr; ?></span>
          <input type="submit" value="Sign Up" name="sign_up"/>
          <hr>
          <a href="login.php">
          <button type="button">
            Sign In
          </button>
          </a>
        </form>
      </div>
    </section>
   </div>
  </main>

</body>

</html>
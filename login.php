<?php 
    session_start();
    include_once('functions.php'); 
    
    $user = new Member();

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = $user->signin($username, $password);
        $num = mysqli_fetch_array($result);

        if ($num > 0) {
            $_SESSION['id'] = $num['NationalID'];
            $_SESSION['username'] = $num['Username'];
            echo "<script>alert('Login Successful!');</script>";
            echo "<script>window.location.href='profile-card.php'</script>";
        } else {
            echo "<script>alert('Something went wrong! Please try again.');</script>";
            echo "<script>window.location.href='login.php'</script>";
        }
    }

?>

<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Popup Login Form Design | CodingNepal</title>
      <link rel="stylesheet" href="style.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <header>
         <center><a href="#" class="logo">FANCLUB</a></center>
         <div class="line-1"></div>
      </header>
      <section>
         <div>
            <img src="image/cloud.png" id="clouds">
         </div>
      </section>
      <div class="center">
         <input type="checkbox" id="show">
         <label for="show" class="show-btn">Sign in</label>
         <div class="container">
            <label for="show" class="close-btn fas fa-times" title="close"></label>
            <div class="text">
               Login
            </div>
            <form method="post">
               <div class="data">
                  <label>Username</label>
                  <input type="text" id="username" name="username" required>
               </div>
               <div class="data">
                  <label>Password</label>
                  <input type="password" id="password" name="password" required>
               </div>
               <div class="forgot-pass">
                  <a href="#">Forgot Password?</a>
               </div>
               <div class="btn">
                  <div class="inner"></div>
                  <button type="submit" name="login">login</button>
               </div>
               <div class="signup-link">
                  Not a member? <a href="#">Signup now</a>
               </div>
            </form>
         </div>
      </div>
   </body>
</html>
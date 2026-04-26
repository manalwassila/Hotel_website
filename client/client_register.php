<?php
include '../components/connect.php';

if (isset($_POST['submit'])) {
   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
   $pass = sha1($_POST['pass']);
   $cpass = sha1($_POST['cpass']);

   // Vérifie si l'email est déjà utilisé
   $select_user = $conn->prepare("SELECT * FROM `clients` WHERE email = ?");
   $select_user->execute([$email]);

   if ($select_user->rowCount() > 0) {
      $warning_msg[] = 'Email already registered!';
   } else {
      if ($pass != $cpass) {
         $warning_msg[] = 'Passwords do not match!';
      } else {
         $insert_user = $conn->prepare("INSERT INTO `clients` (name, email, password) VALUES (?, ?, ?)");
         $insert_user->execute([$name, $email, $pass]);
         $success_msg[] = 'Registered successfully! You can login now.';
         header('refresh:2;url=../admin/login.php'); // Redirige après 2s vers la page de login
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Client Registration</title>
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php include '../components/adminlogin_header.php'; ?>
<section class="form-container" style="min-height: 100vh;">
   <form action="" method="POST">
      <h3>Create your account</h3>
      <input type="text" name="name" required placeholder="Enter your name" maxlength="50" class="box">
      <input type="email" name="email" required placeholder="Enter your email" maxlength="50" class="box">
      <input type="password" name="pass" required placeholder="Enter your password" maxlength="20" class="box">
      <input type="password" name="cpass" required placeholder="Confirm your password" maxlength="20" class="box">
      <input type="submit" value="Register now" name="submit" class="btn">
      <p>Already have an account? <a href="../admin/login.php">Login here</a></p>
   </form>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include '../components/message.php'; ?>

</body>
</html>

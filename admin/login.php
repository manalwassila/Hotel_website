<?php
include '../components/connect.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING); 
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING); 

   // On cherche d'abord dans la table admins
   $selectAdmin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ? LIMIT 1");
   $selectAdmin->execute([$name, $pass]);
   $admin = $selectAdmin->fetch(PDO::FETCH_ASSOC);

   if($selectAdmin->rowCount() > 0){
      // C'est un admin
      setcookie('admin_id', $admin['id'], time() + 60*60*24*30, '/');
      header('location:dashboard.php');
      exit;
   } else {
      // Sinon on cherche dans clients
      $selectClient = $conn->prepare("SELECT * FROM `clients` WHERE name = ? AND password = ? LIMIT 1");
      $selectClient->execute([$name, $pass]);
      $client = $selectClient->fetch(PDO::FETCH_ASSOC);

      if($selectClient->rowCount() > 0){
         setcookie('client_id', $client['id'], time() + 60*60*24*30, '/');
         setcookie('client_name', $client['name'], time() + 60*60*24*30, '/');
         header('location:../index.php?login=success');
         exit;
      } else {
         // Identifiants incorrects
         echo '<script>alert("Nom d\'utilisateur ou mot de passe incorrect.");</script>';
      }
   }
} 
?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
<?php include '../components/adminlogin_header.php'; ?>
<!-- login section starts  -->
<section class="form-container" style="min-height: 100vh;">

   <form action="" method="POST">
      <h3>Welcome back!</h3>
      <input type="text" name="name" placeholder="Enter username" maxlength="20" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" placeholder="Enter password" maxlength="20" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
      
      <input type="submit" value="Login now" name="submit" class="btn">
      <p>Not a client yet? <a href="../client/client_register.php">Create your account</a></p>

   </form>

</section>

<!-- login section ends -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include '../components/message.php'; ?>

</body>
</html>

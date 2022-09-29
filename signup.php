<?php

  require 'databases.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SingUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto+Mono:wght@500&family=Roboto:wght@900&family=Rubik:ital@1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
     <p> <?= $message ?></p>
   <?php endif; ?>

    <h1> SignUp</h1>
    <span>or <a href="login.php">Login</a> </span>
    <form  action="signup.php" method="post">
      <input type="text" name="email" placeholder="Enter your mail">
      <input type="password" name="password" placeholder="Enter your password">
      <input type="password" name="password_password" placeholder="Confirm your password">
      <input type="submit" value="SENT">
    </form>
  </body>
</html>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">    
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Article database">
  
  <title>Sign Up</title>
 
</head>

<?php
include_once('connect-db.php');
include_once('request-db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $bio = $_POST['bio'] ?? '';
    $phone = $_POST['phone'] ?? '';

    insertUser($name, $email, $phone, $bio, $password); 
    header("Location: index.php");
    exit;
}
?>

<h2>Create an Account</h2>
<form method="post">
    Name:<br>
    <input type="text" name="name" required><br><br>
    Username:<br>
    <input type="text" name="username" required><br><br>
    Email:<br>
    <input type="email" name="email" required><br><br>
    Phone: <br>
    <input type="text" name="phone" required><br><br>
    Bio: <br>
    <textarea name="bio"></textarea><br><br>
    Password:<br>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Sign Up">
</form>

<p>Already have an account? <a href="index.php">Login</a></p>
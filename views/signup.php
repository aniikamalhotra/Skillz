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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sign Up</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #fef8f4;
      font-family: 'Poppins', sans-serif;
    }

    .btn-skillz {
      background-color: #3c52e3;
      color: #fef8f4;
      border: none;
      transition: 0.3s;
    }

    .btn-skillz:hover {
      background-color: #2f45cf;
    }

    .text-skillz {
      color: #3c52e3;
    }

    .signup-card {
      background-color: #fff;
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      max-width: 450px;
      width: 100%;
    }

    .form-label {
      font-weight: 500;
    }
  </style>
</head>
<body>

<section class="min-vh-100 d-flex justify-content-center align-items-center">
  <div class="signup-card">

    <h2 class="fw-bold text-center mb-4 text-skillz">Create an Account</h2>

    <form method="post">
      <div class="form-outline mb-3">
        <label class="form-label" for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Full Name" required>
      </div>

      <div class="form-outline mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email Address" required>
      </div>

      <div class="form-outline mb-3">
        <label class="form-label" for="phone">Phone</label>
        <input type="text" id="phone" name="phone" class="form-control form-control-lg" placeholder="Phone Number" required>
      </div>

      <div class="form-outline mb-3">
        <label class="form-label" for="bio">Bio</label>
        <textarea id="bio" name="bio" class="form-control form-control-lg" placeholder="Tell us about yourself" rows="2"></textarea>
      </div>

      <div class="form-outline mb-4">
        <label class="form-label" for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-skillz btn-lg px-5">Sign Up</button>
      </div>
    </form>

    <p class="text-center mt-3 mb-0">Already have an account? 
      <a href="index.php" class="text-skillz">Login</a>
    </p>

  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

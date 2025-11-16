<?php
include_once('connect-db.php');
include_once('request-db.php');
include __DIR__ . '/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Add Review</title>
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

    .profile-card {
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
  <div class="profile-card">

    <h2 class="fw-bold text-center mb-4 text-skillz">Add Review</h2>

    <form method="post">
      <div class="form-outline mb-3">

      <div class="form-outline mb-3">
        <textarea id="review" name="review" class="form-control form-control-lg" rows="8">Add review here...</textarea>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-skillz btn-lg px-5">Done</button>
      </div>
    </form>

  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

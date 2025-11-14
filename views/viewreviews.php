<?php
include_once('connect-db.php');
include_once('request-db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>View Reviews</title>
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
    <h1 class="fw-bold text-center mb-4 text-skillz">View Reviews</h1>

    <form method="POST" class="mb-4">
      <div class="input-group">
        <input type="text" name="query" class="form-control" placeholder="Search...">
        <button class="btn btn btn-skillz btn-lg px-5" type="submit">Search</button>
      </div>
    </form>

    <?php 
      foreach ($review as $reviews) {
    ?>
      <div class="card-body">
        <h6 class="card-title"><em>Posted by <?= htmlspecialchars($review['user_name']) ?></em></h6>
        <p class="card-text"><?= htmlspecialchars($review['review_text']) ?></p>
      </div>
    <?php        
      }
    ?>

    <form method="post">
      <div class="text-center mt-4">
        <button type="submit" name="done" class="btn btn-skillz btn-lg px-5">Done</button>
      </div>
    </form>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
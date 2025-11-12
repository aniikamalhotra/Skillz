<?php
$loggedIn = isset($_SESSION['user_id']);
$name = $loggedIn ? $_SESSION['user_name'] : '';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">    
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Article database">
  <title>Topic Selection</title>

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
      color: #000000ff;
    }

    .divider {
      display: flex;
      align-items: center;
      text-align: center;
    }

    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      border-bottom: 1px solid #ddd;
    }

    .divider:not(:empty)::before {
      margin-right: 0.5em;
    }

    .divider:not(:empty)::after {
      margin-left: 0.5em;
    }

    .white-card {
      background-color: #fff;
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      padding: 2rem;
    }

  </style>
</head>

<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
      <h1 class="fw-bold mb-5 text-skillz">Hi, <?php echo $name ?>! What do you want to read today?</h1>
      
        <form method="post">
          <div class="white-card" style="width: 300px; margin: 0 auto;">
            <div class="text-center pt-2">
              <input type="submit" name="music" value="Music" class="btn btn-skillz btn-lg w-100">
            </div>
            <div class="text-center mt-4 pt-2">
              <input type="submit" name="art" value="Art" class="btn btn-skillz btn-lg w-100">
            </div>
            <div class="text-center mt-4 pt-2">
              <input type="submit" name="sports" value="Sports" class="btn btn-skillz btn-lg w-100">
            </div>
          </div>
        </form>
    </div>
  </div>
</body>
</html>
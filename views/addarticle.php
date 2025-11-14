<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /?page=login");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Article</title>

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
      <h1 class="fw-semibold mb-3 text-skillz">Add Article</h1>

      <?php if (!empty($errors)): ?>
        <div class="errors">
          <?php foreach ($errors as $e): ?>
            <p><?php echo htmlspecialchars($e); ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

        <div class="white-card" style="width: 500px;">
            <form method="post" action="/?page=addarticle">
              <label>Article Title<br>
                <input type="text" name="title" class="form-control form-control-lg" required>
              </label>
              <br><br>

              <label>Article Author<br>
                <input type="text" name="author" class="form-control form-control-lg">
              </label>
              <br><br>

              <label>Date of Publishing<br>
                <input type="date" name="date_article" class="form-control form-control-lg">
              </label>
              <br><br>

              <label>Article URL<br>
                <input type="url" name="link" class="form-control form-control-lg">
              </label>
              <br><br>

              <label>Type of Article<br>
                <input type="text" name="type" class="form-control form-control-lg">
              </label>
              <br><br>

              <button type="submit" class="btn btn-skillz btn-lg" style="width: 150px;">Add Article</button>
            </form>
        </div>
    </div>
  </div>
</body>
</html>
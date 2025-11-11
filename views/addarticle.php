<?php
session_start();
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
</head>
<body>
  <h1>Add Article</h1>

  <?php if (!empty($errors)): ?>
    <div class="errors">
      <?php foreach ($errors as $e): ?>
        <p><?php echo htmlspecialchars($e); ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="post" action="/?page=addarticle">
    <label>Article Title<br>
      <input type="text" name="title" required>
    </label>
    <br><br>

    <label>Article Author<br>
      <input type="text" name="author">
    </label>
    <br><br>

    <label>Date of Publishing<br>
      <input type="date" name="date_article">
    </label>
    <br><br>

    <label>Article URL<br>
      <input type="url" name="link">
    </label>
    <br><br>

    <label>Type of Article<br>
      <input type="text" name="type">
    </label>
    <br><br>

    <button type="submit">Add Article</button>
  </form>
</body>
</html>
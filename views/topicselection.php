<?php
$loggedIn = isset($_SESSION['user_id']);
$name = $loggedIn ? $_SESSION['user_name'] : '';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">    
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Article database">
  <title>Topic Selection</title>
</head>
<body>
    <h1>Hi, <?php echo $name ?>! What do you want to read today?</h1>
    <form method="post">
        <input type="submit" name="music" value="Music">
        <input type="submit" name="art" value="Art">
        <input type="submit" name="sports" value="Sports">
    </form>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">    
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Article database">
  
  <title> Home </title>
 
</head>



<?php
$loggedIn = isset($_SESSION['user_id']);
$name = $loggedIn ? $_SESSION['name'] : '';
?>

<!DOCTYPE html>
<html>
<body>
    <h1>Hi, <?php echo $name ?>! What do you want to read today?</h1>
</body>
</html>

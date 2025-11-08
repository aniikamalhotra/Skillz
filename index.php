<!DOCTYPE html>
<html>
<head>
  <title>PHP example</title>
</head>

<body>
  <form action="simpleform.php" method="post">
    <!-- <input type="text" name="yourname" /> <br/> -->
    Email
    <input type='text' class='form-control' id='requestedDate' name='requestedDate' placeholder='Email...'/>
    Password
    <input type="password" id="password" name="password" placeholder='Password...' required>
    <input type="submit" value="Submit" />
  </form>
  
<!-- <?php
$str = "Hello world"; 
if (isset($_POST['yourname']))
   $str = "You've entered ". $_POST['yourname'];
echo $str;  
?> -->

</body>
</html>   
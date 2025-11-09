
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">    
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Maintenance request form, a small/toy web app for ISP homework assignment, used by CS 3250 (Software Testing)">
  <meta name="keywords" content="CS 3250, Upsorn, Praphamontripong, Software Testing">
  
  <title>Maintenance Services</title>
 
</head>

<body>  
<div class="container">
  <div class="row g-3 mt-2">
    <div class="col">
      <h1>Hi, welcome to Skillz!</h1>
    </div>  
  </div>
  
  <?php
      include('connect-db.php');
      include('request-db.php');
  ?>

    <form action="/topicselection.php" method="post">
    <label for="email">Email</label><br>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email..." required>
    <br><br>

    <label for="password">Password</label><br>
    <input type="password" id="password" name="password" placeholder="Password..." required>
    <br><br>

    <input type="submit" value="Submit"><br>

    <div class="text-center mt-3">
        Don’t have an account?
        <a href="/signup.php">Create one</a>
    </div>

    </form>
  
    <!-- <?php
    $str = "Hello world"; 
    if (isset($_POST['yourname']))
    $str = "You've entered ". $_POST['yourname'];
    echo $str;  
    ?> -->
</div>

<hr/>

<br/><br/>

<?php // include('footer.html') ?> 

<!-- <script src='maintenance-system.js'></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
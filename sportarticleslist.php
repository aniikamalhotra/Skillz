
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
      <h1>What would you like to read today?</h1>
    </div>  
  </div>
  
  <?php
      include('connect-db.php');
      include('request-db.php');
  ?>

    <form action="search.php" method="GET">
        <input type="text" name="query" placeholder="Search...">
    </form>
</div>

<div class="row row-cols-2 g-3">
  <div class="col">
    <div class="card">
      <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/041.webp" class="card-img-top"
        alt="Hollywood Sign on The Hill" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          This is a longer card with supporting text below as a natural lead-in to
          additional content. This content is a little bit longer.
        </p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp" class="card-img-top"
        alt="Palm Springs Road" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          This is a longer card with supporting text below as a natural lead-in to
          additional content. This content is a little bit longer.
        </p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/043.webp" class="card-img-top"
        alt="Los Angeles Skyscrapers" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
          additional content.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/044.webp" class="card-img-top"
        alt="Skyscrapers" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          This is a longer card with supporting text below as a natural lead-in to
          additional content.
        </p>
      </div>
    </div>
  </div>
</div>

<hr/>

<br/><br/>

<?php // include('footer.html') ?> 

<!-- <script src='maintenance-system.js'></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
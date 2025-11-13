<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">    
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Maintenance request form, a small/toy web app for ISP homework assignment, used by CS 3250 (Software Testing)">
  <meta name="keywords" content="CS 3250, Upsorn, Praphamontripong, Software Testing">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>Maintenance Services</title>
</head>

<body>  
  <div class="container mt-4">
    <div class="row g-3 mb-3">
      <div class="col">
        <h1>What would you like to read today?</h1>
      </div>  
    </div>

    <form method="POST" class="mb-4">
      <div class="input-group">
        <input type="text" name="query" class="form-control" placeholder="Search...">
        <button class="btn btn-primary" type="submit">Search</button>
      </div>
    </form>

<div class="row g-3">
  <?php
    foreach ($articles as $article) :
  ?>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($article['title']) ?></h5>
            <p class="card-text"><em>Author: <?= htmlspecialchars($article['author']) ?></em></p>
            <p class="card-text"><em>Date Published: <?= htmlspecialchars($article['date_article']) ?></em></p>
            <p class="card-text"><a href="<?= htmlspecialchars($article['link']) ?>" target="_blank">Go to Article</a></p>
            <form method="post">
              <input type="hidden" id="articleId" name="aticleId" value="<?php echo $article["article_id"] ?>">
              <button type="submit" name="view-reviews" class="btn btn-skillz btn-lg px-5">View Review</button>
              <button type="submit" name="add-review" class="btn btn-skillz btn-lg px-5">Add Review</button>
            </form>
          </div>
        </div>
      </div>
  <?php
    endforeach;
  ?>
</div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

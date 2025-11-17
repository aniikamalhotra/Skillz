<?php include __DIR__ . '/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">    
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Maintenance request form, a small/toy web app for ISP homework assignment, used by CS 3250 (Software Testing)">
  <meta name="keywords" content="CS 3250, Upsorn, Praphamontripong, Software Testing">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>Music Articles</title>

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

    .bookmark-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background: none;
      border: none;
      font-size: 1.5rem;
      color: #3c52e3;
      cursor: pointer;
    }
    .bookmark-btn:hover{
      color: #2f45cf;
    }

    .card{
      position: relative;
    }
  </style>
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
    <?php $favorited = isFavorited($_SESSION["user_id"], $article["article_id"]); ?>
      <div class="col-sm-6">
        <div class="card">
           <form method="post">
                <input type="hidden" name="articleId" value="<?= $article['article_id'] ?>">
                <button
                  type="submit"
                  name="favorite"
                  class="bookmark-btn"
                  aria-pressed="<?= $favorited ? 'true' : 'false' ?>"
                  aria-label="<?= $favorited ? 'Remove favorite' : 'Add favorite' ?>"
                  title="<?= $favorited ? 'Remove favorite' : 'Add favorite' ?>">

                  <?php if ($favorited): ?>
                    <!-- FILLED / FAVORITED SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bookmarks-fill" viewBox="0 0 16 16">
                      <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5z"/>
                      <path d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1z"/>
                    </svg>
                  <?php else: ?>
                    <!-- OUTLINE / UNFAVORITED SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16" role="img" aria-hidden="true">
                      <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1z"/>
                      <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1"/>
                    </svg>
                  <?php endif; ?>

                </button>
           </form>
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($article['title']) ?></h5>
            <p class="card-text"><em>Author: <?= htmlspecialchars($article['author']) ?></em></p>
            <p class="card-text"><em>Date Published: <?= htmlspecialchars($article['date_article']) ?></em></p>
            <p class="card-text"><a href="<?= htmlspecialchars($article['link']) ?>" target="_blank">Go to Article</a></p>
            <form method="post">
              <input type="hidden" id="articleId" name="articleId" value="<?php echo $article["article_id"] ?>">
              <button type="submit" name="view-reviews" class="btn btn-skillz btn-lg px-5">View Review</button>
              <?php if (count(getSpecificArticleReview($_SESSION["user_id"], $article["article_id"])) == 0) { ?>
                <button type="submit" name="add-review" class="btn btn-skillz btn-lg px-5">Add Review</button>              
              <?php } else { ?>
                <button type="submit" name="edit-review" class="btn btn-skillz btn-lg px-5">Edit Review</button>
              <?php } ?>
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

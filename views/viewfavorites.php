<?php 
include __DIR__ . '/navbar.php'; 
$articles = getFavoritedArticles($_SESSION['user_id']); // Make sure this function returns 'type'
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">    
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Favorites</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

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
    .btn-skillz:hover { background-color: #2f45cf; }

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
    .bookmark-btn:hover{ color: #2f45cf; }

    .card{ position: relative; }
  </style>
</head>

<body>
  <div class="container mt-4">
    <h1 class="mb-4">My Favorites</h1>

    <?php if (empty($articles)): ?>
      <p>You haven't favorited any articles yet.</p>
    <?php else: ?>
      <div class="row g-3">
        <?php foreach ($articles as $article): ?>
          <?php $favorited = isFavorited($_SESSION["user_id"], $article["article_id"]); ?>
          <div class="col-sm-6">
            <div class="card">
              <form method="post" action="/?page=addFavorite&type=<?= $article['type'] ?>&article_id=<?= $article['article_id'] ?>">
                <input type="hidden" name="articleId" value="<?= $article['article_id'] ?>">
                <input type="hidden" name="articleType" value="<?= $article['type'] ?>">
                <input type="hidden" name="redirect" value="myfavorites">
                <button
                  type="submit"
                  name="favorite"
                  class="bookmark-btn"
                  aria-pressed="<?= $favorited ? 'true' : 'false' ?>"
                  aria-label="<?= $favorited ? 'Remove favorite' : 'Add favorite' ?>"
                  title="<?= $favorited ? 'Remove favorite' : 'Add favorite' ?>">

                  <?php if ($favorited): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bookmarks-fill" viewBox="0 0 16 16">
                      <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5z"/>
                      <path d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1z"/>
                    </svg>
                  <?php else: ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
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

                <form method="post" action="/?page=<?= $article['type'] ?>articleslist">
                  <input type="hidden" name="articleId" value="<?= $article["article_id"] ?>">
                  <button type="submit" name="view-reviews" class="btn btn-skillz btn-lg px-5">View Review</button>

                  <?php if (count(getSpecificArticleReview($_SESSION["user_id"], $article["article_id"])) === 0): ?>
                    <button type="submit" name="add-review" class="btn btn-skillz btn-lg px-5">Add Review</button>
                  <?php else: ?>
                    <button type="submit" name="edit-review" class="btn btn-skillz btn-lg px-5">Edit Review</button>
                  <?php endif; ?>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

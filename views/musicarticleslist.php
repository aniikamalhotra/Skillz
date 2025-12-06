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
     .like-btn {
      position: relative;
      background: none;
      border: none;
      font-size: 1.5rem;
      color: #0c5d37ff;
      cursor: pointer;
    }
    .like-btn:hover{
      color: #16ab4aff;
    }
     .dislike-btn {
      position: relative;
      background: none;
      border: none;
      font-size: 1.5rem;
      color: #5d0c0cff;
      cursor: pointer;
    }
    .dislike-btn:hover{
      color: #ab1616ff;
    }
    .rating-buttons {
      position: absolute;
      bottom: 10px;
      right: 10px;
      display: flex;
      gap: 10px;
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
              <div class="rating-buttons">
                <?php if ($liked): ?>
                  <form method="post">
                    <input type="hidden" id="articleId" name="articleId" value="<?php echo $article["article_id"] ?>">
                    <button type="submit" name="like_on" class="like-btn">

                      <!-- FILLED / LIKE SVG -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                        <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                      </svg>

                    </button>
                  </form>
                <?php else: ?>
                  <form method="post">
                    <input type="hidden" id="articleId" name="articleId" value="<?php echo $article["article_id"] ?>">
                    <button type="submit" name="like_off" class="like-btn">

                      <!-- OUTLINE / LIKE SVG -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                        <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                      </svg>

                    </button>
                  </form>
                <?php endif; ?>

                <?php if ($disliked): ?>
                  <form method="post">
                    <input type="hidden" id="articleId" name="articleId" value="<?php echo $article["article_id"] ?>">
                    <button type="submit" name="dislike_on" class="dislike-btn">

                      <!-- FILLED / DISLIKE SVG -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16">
                        <path d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.38 1.38 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51q.205.03.443.051c.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.9 1.9 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2 2 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.2 3.2 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.8 4.8 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591"/>
                      </svg>

                    </button>
                  </form>
                <?php else: ?>
                  <form method="post">
                    <input type="hidden" id="articleId" name="articleId" value="<?php echo $article["article_id"] ?>">
                    <button type="submit" name="dislike_off" class="dislike-btn">

                      <!-- OUTLINE / DISLIKE SVG -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                        <path d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1"/>
                      </svg>               

                    </button>
                  </form>
                <?php endif; ?>
          </div>
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

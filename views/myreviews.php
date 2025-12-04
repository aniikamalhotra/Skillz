<?php

// TODO: Fix edit review functionality -- it works, but getting type error on editreview.php
// TODO: Fix edit "button" styling

include_once('connect-db.php');
include_once('request-db.php');
include __DIR__ . '/navbar.php';

$user_id = $_SESSION['user_id'];
$reviews = getReviewsByUser($user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My Reviews</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body { background-color: #fef8f4; font-family: 'Poppins', sans-serif; }
    .btn-skillz { background-color: #3c52e3; color: #fef8f4; border: none; transition: 0.3s; }
    .btn-skillz:hover { background-color: #2f45cf; }
    .text-skillz { color: #3c52e3; }
    .white-card { background-color: #fff; border-radius: 1rem; box-shadow: 0 4px 20px rgba(0,0,0,0.1); padding: 1.5rem; }
    .review-card { margin-bottom: 1rem; padding: 1rem; border-radius: .75rem; background: #fff; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
    .meta { color: #666; font-size: .9rem; }
  </style>

</head>
<body>
<section class="min-vh-100 d-flex justify-content-center align-items-start py-5">
  <div class="white-card" style="max-width:800px; width:100%;">
    <h2 class="fw-bold text-center mb-3 text-skillz">My Reviews</h2>

    <?php if (empty($reviews)): ?>
      <p class="text-center">You haven't posted any reviews yet.</p>
      <div class="text-center mt-3">
        <a href="/?page=addreview" class="btn-skillz">Write a Review</a>
      </div>
    <?php else: ?>
      <div class="mt-3">
        <?php foreach ($reviews as $r): ?>
          <div class="review-card d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <strong><?php echo htmlspecialchars($r['title'] ?? 'Untitled'); ?></strong>
              </div>
            </div>

            <p class="mt-2 mb-2"><?php echo nl2br(htmlspecialchars($r['review_text'] ?? '')); ?></p>

            <div class="d-flex gap-2 mt-2">
              <a href="/?page=editreview&article_id=<?php echo urlencode($r['article_id']); ?>&id=<?php echo urlencode($r['id']); ?>" class="btn btn-skillz btn-lg px-5">Edit</a>
              <form method="post" action="/?page=deletereview" style="display:inline;">
                <input type="hidden" name="article_id" value="<?php echo htmlspecialchars($r['article_id']); ?>">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                <button type="submit" class="btn btn-skillz btn-lg px-5" onclick="return confirm('Delete this review?');">Delete</button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
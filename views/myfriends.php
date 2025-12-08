<?php
include_once('connect-db.php');
include_once('request-db.php');
include __DIR__ . '/navbar.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /?page=login");
    exit;
}

$user_id = $_SESSION['user_id'];
$friends = getFriendsByUser($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My Friends</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #fef8f4;
      font-family: 'Poppins', sans-serif;
    }

    .btn-skillz {
      background-color: #3c52e3;
      color: #fef8f4;
      border: none;
      padding: .45rem 1rem;
      border-radius: .5rem;
      font-weight: 600;
      transition: background 0.25s, transform 0.2s;
    }

    .btn-skillz:hover {
      background-color: #2f45cf;
      transform: translateY(-2px);
    }

    .section-card {
      background-color: #fff;
      border-radius: 1.25rem;
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
      padding: 2rem;
      width: 100%;
      max-width: 800px;
      margin-bottom: 2rem;
    }

    .friend-card, .review-card {
      background: #fff;
      border-radius: .9rem;
      padding: 1.2rem 1.4rem;
      margin-bottom: 1rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.06);
      transition: transform .2s, box-shadow .2s;
    }

    .friend-card:hover, .review-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.09);
    }

    .meta {
      color: #666;
      font-size: .9rem;
    }

    h2 {
      font-weight: 700;
      color: #3c52e3;
      margin-bottom: 1.25rem;
    }
  </style>
</head>

<body>
<section class="min-vh-100 d-flex justify-content-center align-items-start py-5 flex-column align-items-center">

  <div class="section-card">
    <h2 class="text-center">Friend Requests</h2>

    <?php if (empty($received_requests)): ?>
      <p class="text-center text-muted">You do not have any pending friend requests at this time.</p>
    <?php else: ?>
      <?php foreach ($received_requests as $request): ?>
        <?php $sender = getUser($request['sender_id'])[0]; ?>

        <div class="review-card">
          <strong><?php echo htmlspecialchars($sender['user_name']); ?></strong>

          <div class="mt-3 d-flex gap-2">
            <form method="post" class="d-flex gap-2">
              <input type="hidden" name="user_id" value="<?php echo $request['sender_id'] ?>">
              <button name="accept" class="btn btn-skillz">Accept</button>
              <button name="reject" class="btn btn-skillz">Reject</button>
            </form>
          </div>
        </div>

      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <div class="section-card">
    <h2 class="text-center">My Friends</h2>

    <?php if (empty($friends)): ?>
      <p class="text-center text-muted">You don't have any friends at this time.</p>
    <?php else: ?>
      <?php foreach ($friends as $f): ?>
        <div class="friend-card d-flex justify-content-between align-items-center">
          <div>
            <strong><?php echo htmlspecialchars($f['user_name'] ?? 'Unknown'); ?></strong>
            <div class="meta"><?php echo htmlspecialchars($f['email'] ?? 'No email'); ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

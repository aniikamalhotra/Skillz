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
    body { background-color: #fef8f4; font-family: 'Poppins', sans-serif; }
    .btn-skillz { background-color: #3c52e3; color: #fef8f4; border: none; transition: 0.3s; }
    .btn-skillz:hover { background-color: #2f45cf; }
    .text-skillz { color: #3c52e3; }
    .white-card { background-color: #fff; border-radius: 1rem; box-shadow: 0 4px 20px rgba(0,0,0,0.1); padding: 1.5rem; }
    .friend-card { margin-bottom: 1rem; padding: 1rem; border-radius: .75rem; background: #fff; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
    .meta { color: #666; font-size: .9rem; }
    a.btn-skillz { display: inline-block; text-decoration: none; }
  </style>

</head>
<body>
<section class="min-vh-100 d-flex justify-content-center align-items-start py-5">
  <div class="white-card" style="max-width:800px; width:100%;">
    <h2 class="fw-bold text-center mb-3 text-skillz">My Friends</h2>

    <?php if (empty($friends)): ?>
      <p class="text-center">You don't have any friends at this time.</p>
    <?php else: ?>
      <div class="mt-3">
        <?php foreach ($friends as $f): ?>
          <div class="friend-card d-flex justify-content-between align-items-center">
            <div>
              <strong><?php echo htmlspecialchars($f['user_name'] ?? 'Unknown'); ?></strong>
              <div class="meta"><?php echo htmlspecialchars($f['email'] ?? 'No email'); ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="white-card" style="max-width:800px; width:100%;">
    <h2 class="fw-bold text-center mb-3 text-skillz">Friend Requests</h2>
    <?php if (empty($received_requests)): ?>
      <p class="text-center">You do not have any pending friend requests at this time.</p>
    <?php else: ?>
      <div class="mt-3">
        <?php foreach ($received_requests as $request): ?>
          <div class="review-card d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <strong><?php echo htmlspecialchars(getUser($request['sender_id'])); ?></strong>
              </div>
            </div>
            <div class="d-flex gap-2 mt-2">
              <form method="post" action="/?page=deletereview" style="display:inline;">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user["sender_id"] ?>">
                <button name="accept" class="btn btn-skillz" disabled>Accept</button>
                <button name="reject" class="btn btn-skillz" disabled>Reject</button>
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
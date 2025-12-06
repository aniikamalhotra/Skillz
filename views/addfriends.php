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
  <title>Sport Articles</title>

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
        <h1>Add Friends</h1>
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
    foreach ($all_users as $user) :
        $uid = $user['user_id'];

        $isFriend = in_array($uid, array_column($friends, 'user_id')) ?? [];
        $isPendingSent = in_array($uid, array_column($sent_requests, 'user_id')) ?? [];
        $isPendingReceived = in_array($uid, array_column($received_requests, 'user_id')) ?? [];
  ?>
      <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($user['user_name']) ?></h5>
              <p class="card-text"><em>Bio: <?= htmlspecialchars($user['bio']) ?></em></p>
              <form method="post">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user["user_id"] ?>">
                <?php if ($isFriend) { ?>
                    <button type="submit" name="unfriend" class="btn btn-skillz btn-lg px-5">Delete Friend</button>
                <?php } elseif ($isPendingSent) { ?>
                    <button name="pending_sent" class="btn btn-skillz btn-lg px-5" disabled>Pending - Request Sent</button>
                <?php } elseif ($isPendingReceived) { ?>
                    <button name="pending_received" class="btn btn-skillz btn-lg px-5" disabled>Pending - Request Received</button>
                <?php } else { ?>
                    <button type="submit" name="addfriend" class="btn btn-skillz btn-lg px-5">Add Friend</button>
                <?php } ?>
              </form>
          </div>
        </div>
      </div>
  <?php endforeach; ?>
</div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

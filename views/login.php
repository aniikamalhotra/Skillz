<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
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
      transition: 0.3s;
    }

    .btn-skillz:hover {
      background-color: #2f45cf;
    }

    .text-skillz {
      color: #3c52e3;
    }

    .divider {
      display: flex;
      align-items: center;
      text-align: center;
    }

    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      border-bottom: 1px solid #ddd;
    }

    .divider:not(:empty)::before {
      margin-right: 0.5em;
    }

    .divider:not(:empty)::after {
      margin-left: 0.5em;
    }

    .login-card {
      background-color: #fff;
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      padding: 2rem;
    }

  </style>
</head>
<body>

<section class="vh-100 d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center align-items-center">

      <!-- logo left side -->
      <div class="col-md-9 col-lg-6 col-xl-5 text-center">
        <img src="/static/logo.png" class="img-fluid" alt="Skillz Logo" style="max-width: 80%;">
      </div>

      <!-- login form card -->
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <div class="login-card">
          <h2 class="fw-bold text-center mb-4 text-skillz">Welcome to Skillz!</h2>

          <form method="post">
            <div class="form-outline mb-4">
              <label class="form-label">Email address</label>
              <input type="email" name="email" class="form-control form-control-lg"
                placeholder="Email address" required />
            </div>

            <div class="form-outline mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control form-control-lg"
                placeholder="Password" required />
            </div>

            <div class="text-center mt-4 pt-2">
              <button type="submit" class="btn btn-skillz btn-lg px-5">Login</button>
              <p class="small fw-bold mt-3 mb-0">Don’t have an account?
                <a href="/?page=signup" class="text-skillz">Register</a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

 
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

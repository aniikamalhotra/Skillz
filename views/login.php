<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>
<body>
    <h1>Hi, welcome to Skillz!</h1>

    <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>

    <form method="post">
        <label>Email</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>

    <p>Don’t have an account? <a href="/?page=signup">Create one</a></p>
</body>
</html>

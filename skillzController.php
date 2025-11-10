<?php

class skillzController {

    public function home() {
        include 'views/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            global $db;
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $stmt = $db->prepare("SELECT * FROM Users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && $user['password'] === $password) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['user_name'];
                header("Location: /?page=topicselection");
                exit;
            } else {
                $error = "Invalid credentials";
            }
        }

        include 'views/login.php';
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $bio = $_POST['bio'] ?? '';

            insertUser($name, $email, $phone, $bio, $password);

            header("Location: /?page=login");
            exit;
        }
        include 'views/signup.php';
    }

    public function topicSelection() {
        include 'views/topicselection.php';
    }

    public function sportArticlesList() {
        include 'views/sportarticleslist.php';
    }
}

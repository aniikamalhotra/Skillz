<?php

class skillzController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

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

            if ($user && password_verify($password, $user["password"])) {
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
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $bio = $_POST['bio'];

            insertUser($name, $email, $phone, $bio, $password);

            header("Location: /?page=login");
            exit;
        }
        include 'views/signup.php';
    }

    public function topicSelection() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['music'])) {
                header("Location: /?page=musicarticleslist");
                exit;
            } elseif (isset($_POST['art'])) {
                header("Location: /?page=artarticleslist");
                exit;
            } elseif (isset($_POST['sports'])) {
                header("Location: /?page=sportarticleslist");
                exit;
            }
        }

        include 'views/topicselection.php';
    }

    public function sportArticlesList() {
        $search_query = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $search_query = $_POST['query'] ?? '';
        }
        $articles = getAllSportsArticles($search_query);
        include 'views/sportarticleslist.php';
    }

    public function musicArticlesList() {
        $search_query = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $search_query = $_POST['query'] ?? '';
        }
        $articles = getAllMusicArticles($search_query);
        include 'views/musicarticleslist.php';
    }

    public function artArticlesList() {
        $search_query = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $search_query = $_POST['query'] ?? '';
        }
        $articles = getAllArtArticles($search_query);
        include 'views/artarticleslist.php';
    }

    public function addArticle() {

        if (!isset($_SESSION['user_id'])) {
            header("Location: /?page=login");
            exit;
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $author = trim($_POST['author'] ?? '');
            $date = $_POST['date_article'] ?? null;
            $link = trim($_POST['link'] ?? '');

            if ($title === '') {
                $errors[] = "Title is required.";
            }
            if ($link !== '' && !filter_var($link, FILTER_VALIDATE_URL)) {
                $errors[] = "URL is invalid.";
            }

            if (empty($errors)) {
                insertArticle($_SESSION['user_id'], $title, $link ?: null, $date ?: null, $author ?: null);
                header("Location: /?page=addarticle&success=1");
                exit;
            }
        }

        include 'views/addarticle.php';
    }
}

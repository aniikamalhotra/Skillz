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
            if (isset($_POST['view-reviews'])) {
                header("Location: /?page=viewreviews");
            } elseif (isset($_POST['add-review'])) {
                $article_id = $_POST['articleId'] ?? null;
                if ($article_id) {
                    header("Location: /?page=addreview&type=sports&article_id=" . urlencode($article_id));
                    exit;
                }
            } elseif (isset($_POST['edit-review'])) {
                $article_id = $_POST['articleId'] ?? null;
                if ($article_id) {
                    header("Location: /?page=editreview&type=sports&article_id=" . urlencode($article_id));
                    exit;
                }
            } else {
                $search_query = $_POST['query'] ?? '';
            }
        }
        $articles = getAllSportsArticles($search_query);
        include 'views/sportarticleslist.php';
    }

    public function musicArticlesList() {
        $search_query = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['view-reviews'])) {
                header("Location: /?page=viewreviews");
            } elseif (isset($_POST['add-review'])) {
                $article_id = $_POST['articleId'] ?? null;
                if ($article_id) {
                    header("Location: /?page=addreview&type=music&article_id=" . urlencode($article_id));
                    exit;
                }
            } elseif (isset($_POST['edit-review'])) {
                $article_id = $_POST['articleId'] ?? null;
                if ($article_id) {
                    header("Location: /?page=editreview&type=music&article_id=" . urlencode($article_id));
                    exit;
                }
            } else {
                $search_query = $_POST['query'] ?? '';
            }
        }
        $articles = getAllMusicArticles($search_query);
        include 'views/musicarticleslist.php';
    }

    public function artArticlesList() {
        $search_query = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['view-reviews'])) {
                header("Location: /?page=viewreviews");
            } elseif (isset($_POST['add-review'])) {
                header("Location: /?page=addreview");
            } elseif (isset($_POST['edit-review'])) {
                $article_id = $_POST['articleId'] ?? null;
                if ($article_id) {
                    header("Location: /?page=editreview&type=art&article_id=" . urlencode($article_id));
                    exit;
                }
            } else {
                $article_id = $_POST['articleId'] ?? null;
                if ($article_id) {
                    header("Location: /?page=addreview&type=art&article_id=" . urlencode($article_id));
                    exit;
                }
                $search_query = $_POST['query'] ?? '';
            }
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

    public function updateProfilePage() {
        $search_query = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $password = $_POST['password'] ?? '';
            $bio = $_POST['bio'] ?? '';
            $phone = $_POST['phone'] ?? '';

            updateUsername($name, $_SESSION['user_id']);
            updatePhone($phone, $_SESSION['user_id']);
            updateBio($bio, $_SESSION['user_id']);
            updatePassword($password, $_SESSION['user_id']);
        }
        include 'views/updateprofilepage.php';
    }

    public function addReview($article_id, $type) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $review = $_POST['review'] ?? '';

            insertReview($_SESSION['user_id'], $article_id, $review );
            if ($type == "sports") {
                header("Location: /?page=sportarticleslist");
            } elseif ($type == "music") {
                header("Location: /?page=musicarticleslist");
            } elseif ($type == "art") {
                header("Location: /?page=artarticleslist");
            } else {}
            exit;
        }
        include 'views/addreview.php';
    }

    public function editReview($article_id, $type) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $review = $_POST['review'] ?? '';

            if (isset($_POST['update'])) {
                updateReviewText($_SESSION['user_id'], $article_id, $review );
            }
            elseif (isset($_POST['done'])) {
                if ($type == "sports") {
                    header("Location: /?page=sportarticleslist");
                } elseif ($type == "music") {
                    header("Location: /?page=musicarticleslist");
                } elseif ($type == "art") {
                    header("Location: /?page=artarticleslist");
                } else {}
                exit;
            }
        }
        $review_text = getSpecificArticleReview($_SESSION["user_id"], $article_id)["review_text"];
        include 'views/editreview.php';
    }

    public function viewReviews() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        }
        include 'views/viewreviews.php';
    }
}




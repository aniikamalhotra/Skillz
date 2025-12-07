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

    public function formatPhoneNumber($phone) {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($phone) == 10) {
            return substr($phone, 0, 3) . '-' . substr($phone, 3, 3) . '-' . substr($phone, 6, 4);
        }
        
        if (strlen($phone) == 11 && $phone[0] == '1') {
            $phone = substr($phone, 1);
            return substr($phone, 0, 3) . '-' . substr($phone, 3, 3) . '-' . substr($phone, 6, 4);
        }
        
        return $phone;
    }

    public function signup() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $bio = $_POST['bio'];

            $phone_digits = preg_replace('/[^0-9]/', '', $phone);

            if (strlen($phone_digits) < 10) {
                $error = 'Please enter a valid phone number with at least 10 digits.';
            } else {
                $phone_number = $this->formatPhoneNumber($phone);
                insertUser($name, $email, $phone_number, $bio, $password);

                header("Location: /?page=login");
                exit;
            }

            
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
                $article_id = $_POST['articleId'] ?? null;
                if ($article_id) {
                    header("Location: /?page=viewreviews&type=sports&article_id=" . urlencode($article_id));
                    exit;
                }
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
            } elseif (isset($_POST['favorite'])){
                $article_id = $_POST['articleId'] ?? null;
                 if ($article_id) {
                    $this->addFavorite($_SESSION['user_id'], $article_id, 'sport');
                    header("Location: /?page=sportarticleslist");
                    exit;
                }
            } elseif (isset($_POST['like_off'])){
                $article_id = $_POST['articleId'] ?? null;
                // echo "<script>console.log('like_on clicked for article_id: " . $article_id . "');</script>";
                 if ($article_id) {
                    upVote($_SESSION['user_id'], $article_id);
                    header("Location: /?page=sportarticleslist");
                    exit;
                }
            } elseif (isset($_POST['dislike_off'])){
                $article_id = $_POST['articleId'] ?? null;
                // echo "<script>console.log('dislike_on clicked for article_id: " . $article_id . "');</script>";
                if ($article_id) {
                    downVote($_SESSION['user_id'], $article_id);
                    header("Location: /?page=sportarticleslist");
                    exit;
                }
            } elseif (isset($_POST['like_on']) or isset($_POST['dislike_on'])){
                $article_id = $_POST['articleId'] ?? null;
                // echo "<script>console.log('like_off or dislike_off clicked for article_id: " . $article_id . "');</script>";
                if ($article_id) {
                    cancelVote($_SESSION['user_id'], $article_id);
                    header("Location: /?page=sportarticleslist");
                    exit;
                }
            }
            else {
                $search_query = $_POST['query'] ?? '';
            }
        }
        $articles = getAllSportsArticles($search_query);

        if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetic') {
            usort($articles, function($a, $b) {
            return strcasecmp($a['title'], $b['title']);
            });
        }

        include 'views/sportarticleslist.php';
    }

    public function musicArticlesList() {
        $search_query = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['view-reviews'])) {
                $article_id = $_POST['articleId'] ?? null;
                if ($article_id) {
                    header("Location: /?page=viewreviews&type=music&article_id=" . urlencode($article_id));
                    exit;
                }
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
            } elseif (isset($_POST['favorite'])){
                $article_id = $_POST['articleId'] ?? null;
                 if ($article_id) {
                    $this->addFavorite($_SESSION['user_id'], $article_id, 'music');
                    exit;
                }
            } elseif (isset($_POST['like_off'])){
                $article_id = $_POST['articleId'] ?? null;
                // echo "<script>console.log('like_on clicked for article_id: " . $article_id . "');</script>";
                 if ($article_id) {
                    upVote($_SESSION['user_id'], $article_id);
                    header("Location: /?page=musicarticleslist");
                    exit;
                }
            } elseif (isset($_POST['dislike_off'])){
                $article_id = $_POST['articleId'] ?? null;
                // echo "<script>console.log('dislike_on clicked for article_id: " . $article_id . "');</script>";
                if ($article_id) {
                    downVote($_SESSION['user_id'], $article_id);
                    header("Location: /?page=musicarticleslist");
                    exit;
                }
            } elseif (isset($_POST['like_on']) or isset($_POST['dislike_on'])){
                $article_id = $_POST['articleId'] ?? null;
                // echo "<script>console.log('like_off or dislike_off clicked for article_id: " . $article_id . "');</script>";
                if ($article_id) {
                    cancelVote($_SESSION['user_id'], $article_id);
                    header("Location: /?page=musicarticleslist");
                    exit;
                }
            }
            else {
                $search_query = $_POST['query'] ?? '';
            }
        }
        $articles = getAllMusicArticles($search_query);

        if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetic') {
            usort($articles, function($a, $b) {
            return strcasecmp($a['title'], $b['title']);
            });
        }
        include 'views/musicarticleslist.php';
    }

    public function artArticlesList() {
        $search_query = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['view-reviews'])) {
                $article_id = $_POST['articleId'] ?? null;
                if ($article_id) {
                    header("Location: /?page=viewreviews&type=art&article_id=" . urlencode($article_id));
                    exit;
                }
            } elseif (isset($_POST['add-review'])) {
                $article_id = $_POST['articleId'] ?? null;
                if ($article_id) {
                    header("Location: /?page=addreview&type=art&article_id=" . urlencode($article_id));
                    exit;
                }
                $search_query = $_POST['query'] ?? '';
            } elseif (isset($_POST['edit-review'])) {
                $article_id = $_POST['articleId'] ?? null;
                if ($article_id) {
                    header("Location: /?page=editreview&type=art&article_id=" . urlencode($article_id));
                    exit;
                }
            } elseif (isset($_POST['favorite'])){
                $article_id = $_POST['articleId'] ?? null;
                 if ($article_id) {
                    $this->addFavorite($_SESSION['user_id'], $article_id, 'art');
                    exit;
                }
            } elseif (isset($_POST['like_off'])){
                $article_id = $_POST['articleId'] ?? null;
                // echo "<script>console.log('like_on clicked for article_id: " . $article_id . "');</script>";
                 if ($article_id) {
                    upVote($_SESSION['user_id'], $article_id);
                    header("Location: /?page=artarticleslist");
                    exit;
                }
            } elseif (isset($_POST['dislike_off'])){
                $article_id = $_POST['articleId'] ?? null;
                // echo "<script>console.log('dislike_on clicked for article_id: " . $article_id . "');</script>";
                if ($article_id) {
                    downVote($_SESSION['user_id'], $article_id);
                    header("Location: /?page=artarticleslist");
                    exit;
                }
            } elseif (isset($_POST['like_on']) or isset($_POST['dislike_on'])){
                $article_id = $_POST['articleId'] ?? null;
                // echo "<script>console.log('like_off or dislike_off clicked for article_id: " . $article_id . "');</script>";
                if ($article_id) {
                    cancelVote($_SESSION['user_id'], $article_id);
                    header("Location: /?page=artarticleslist");
                    exit;
                }
            }            
            else {
                $search_query = $_POST['query'] ?? '';
            }
        }
        $articles = getAllArtArticles($search_query);

        if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetic') {
            usort($articles, function($a, $b) {
            return strcasecmp($a['title'], $b['title']);
            });
        }
        
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
    $error = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $password = $_POST['password'] ?? '';
        $bio = $_POST['bio'] ?? '';
        $phone = $_POST['phone'] ?? '';

        $phone_digits = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($phone_digits) < 10) {
            $error = 'Please enter a valid phone number with at least 10 digits.';
        } else {
            $phone_number = $this->formatPhoneNumber($phone);

            updateUsername($name, $_SESSION['user_id']);
            updatePhone($phone_number, $_SESSION['user_id']);
            updateBio($bio, $_SESSION['user_id']);

            if (!empty($password)) {
                updatePassword($password, $_SESSION['user_id']);
            }
            
        }
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
        $review_text = getSpecificArticleReview($_SESSION["user_id"], $article_id)[0]["review_text"];
        include 'views/editreview.php';
    }

    public function viewReviews($type, $article_id) {
        $search_query = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['done'])) {
                if ($type == "sports") {
                    header("Location: /?page=sportarticleslist");
                } elseif ($type == "music") {
                    header("Location: /?page=musicarticleslist");
                } elseif ($type == "art") {
                    header("Location: /?page=artarticleslist");
                } else {}
                exit;
            }

            $search_query = $_POST['query'] ?? '';
        }

        $reviews = getArticleReviews($article_id, $search_query);
        include 'views/viewreviews.php';
    }

    public function myReviews() {
        include 'views/myreviews.php';
    }

    public function myFriends() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /?page=login");
            exit;
        }
        $user_id = $_POST['user_id'] ?? null;
        if (isset($_POST['accept'])) {
            if ($user_id) {
                insertFriend($user_id, $_SESSION['user_id']);
                deleteRequest($user_id, $_SESSION['user_id']);
                header("Location: /?page=myfriends");
                exit;
            }
        } elseif (isset($_POST['reject'])) {
            if ($user_id) {
                deleteRequest($user_id, $_SESSION['user_id']);
                header("Location: /?page=myfriends");
                exit;
            }
        } else {}
        
        $user_id = $_SESSION['user_id'];
        $friends = getFriendsByUser($user_id);
        $received_requests = getReceivedRequests($user_id);
        include 'views/myfriends.php';
    }

    public function addFriends() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /?page=login");
            exit;
        }
        $user_id = $_POST['user_id'] ?? null;
        if (isset($_POST['addfriend'])) {
            if ($user_id) {
                insertRequest($_SESSION['user_id'], $user_id);
                header("Location: /?page=addfriends");
                exit;
            }
        } elseif (isset($_POST['unfriend'])) {
            if ($user_id) {
                deleteFriend($_SESSION['user_id'], $user_id);
                header("Location: /?page=addfriends");
                exit;
            }
        } else {}
        
        $user_id = $_SESSION['user_id'];
        $all_users = getAllUsers() ?? [];
        $friends = getFriendsByUser($user_id) ?? [];
        $sent_requests = getSentRequests($_SESSION['user_id']) ?? [];
        $received_requests = getReceivedRequests($user_id) ?? [];
        include 'views/addfriends.php';
    }

    public function addFavorite($user_id, $article_id, $type) {
        insertFavorite($user_id, $article_id, $type);

        $redirect = $_POST['redirect'] ?? $type . 'articleslist'; // default fallback
        header("Location: /?page=" . $redirect);
        exit;
    }

    public function viewFavorite() {
        if (!isset($_SESSION['user_id'])) {
        header("Location: /?page=login");
        exit;
        }

        if (isset($_GET['export']) && $_GET['export'] === 'csv') {
            $articles = getFavoritedArticles($_SESSION['user_id']);
            $this->exportCSV($articles);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['favorite'])) {
            $article_id = $_POST['articleId'] ?? null;
            $type = $_POST['articleType'] ?? null;
            if ($article_id && $type) {
                insertFavorite($_SESSION['user_id'], $article_id, $type); // toggle favorite
                header("Location: /?page=viewfavorites"); // reload page
                exit;
            }
        }

        $articles = getFavoritedArticles($_SESSION['user_id']); 
        include 'views/viewfavorites.php';
    }

    private function exportCSV($articles) {
        $filename = "my_favorites_" . date('Y-m-d_His') . ".csv";
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        if (!empty($articles)) {
        $headers = ['title', 'author', 'date_article', 'link', 'type'];
        fputcsv($output, $headers);
        
            foreach ($articles as $article) {
                $row = [];
                foreach ($headers as $header) {
                    $row[] = $article[$header] ?? '';
                }
                fputcsv($output, $row);
            }
        }
        
        fclose($output);
    }   
}




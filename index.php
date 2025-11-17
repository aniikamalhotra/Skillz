<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include_once('connect-db.php');
include_once('request-db.php');
include_once('skillzController.php');

$controller = new skillzController($db);

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'login':
        $controller->login();
        break;
    case 'signup':
        $controller->signup();
        break;
    case 'addarticle':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /?page=login");
            exit;
        }
        $controller->addArticle();
        break;
    case 'topicselection':
        // only accessible if logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: /?page=login");
            exit;
        }
        $controller->topicSelection();
        break;
    case 'sportarticleslist':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /?page=login");
            exit;
        }
        $controller->sportArticlesList();
        break;
    case 'musicarticleslist':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /?page=login");
            exit;
        }
        $controller->musicArticlesList();
        break;
    case 'artarticleslist':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /?page=login");
            exit;
        }
        $controller->artArticlesList();
        break;
    case 'updateprofilepage':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /?page=login");
            exit;
        }
        $controller->updateProfilePage();
        break;
    case 'addreview':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /?page=login");
            exit;
        }
        $type = $_GET['type'];
        $article_id = $_GET['article_id'];
        $controller->addReview($article_id, $type);
        break;
    case 'editreview':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /?page=login");
            exit;
        }
        $type = $_GET['type'];
        $article_id = $_GET['article_id'];
        $controller->editReview($article_id, $type);
        break;
    case 'viewreviews':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /?page=login");
            exit;
        }
        $type = $_GET['type'];
        $article_id = $_GET['article_id'];
        $controller->viewReviews($type, $article_id);
        break;
    case 'myreviews':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /?page=login");
            exit;
        }
        $controller->myReviews();
        break;
    case 'addFavorite':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /?page=login");
            exit;
        }
        $type = $_GET['type'];
        $article_id = $_GET['article_id'];
        $controller->addFavorite($_SESSION['user_id'], $article_id, $type);
        break;
    default:
        $controller->login();
        break;
}

?>
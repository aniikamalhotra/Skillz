<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
?>

<?php
session_start();
include_once('connect-db.php');
include_once('request-db.php');
include_once('skillzController.php');

$controller = new skillzController();

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'login':
        $controller->login();
        break;
    case 'signup':
        $controller->signup();
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
        $controller->sportarticleslist();
    default:
        $controller->home();
        break;
}

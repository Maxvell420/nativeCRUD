<?php
require_once 'autoload.php';
use Core\Router\Router;
use Core\Dispatcher\Dispatcher;

session_start();
$uri = $_SERVER['REQUEST_URI'];
try {
    $route = (new Router())->getRoute($uri);
    $page = (new Dispatcher($route))->getPage();
    echo $page->render();
} catch (Exception $e) {
    echo $e->getMessage();
}
unset($_SESSION['error']);
unset($_SESSION['message']);
unset($_SESSION['data']);
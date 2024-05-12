<?php

use App\Controllers\UserController;
use Core\Route\Route;
use App\Controllers\PageController;

return [
    new Route('GET','/userCreate',UserController::class,'create'),
    new Route('POST','/userSave',UserController::class,'save'),
    new Route('GET','/login',UserController::class,'login'),
    new Route('POST','/auth',UserController::class,'auth'),
    new Route('GET','/logout',UserController::class,'logout'),
    new Route('GET','/userEdit',UserController::class,'edit'),
    new Route('POST','/userUpdate',UserController::class,'update'),
    new Route('GET','',PageController::class,'dashboard'),
];
<?php

$app->get('/users/list', 'App\Users\Controller\IndexController::listAction')->bind('users.list');
$app->get('/users/edit/{id}', 'App\Users\Controller\IndexController::editAction')->bind('users.edit');
$app->get('/users/new', 'App\Users\Controller\IndexController::newAction')->bind('users.new');
$app->post('/users/delete/{id}', 'App\Users\Controller\IndexController::deleteAction')->bind('users.delete');
$app->post('/users/save', 'App\Users\Controller\IndexController::saveAction')->bind('users.save');

$app->get('/stars/list', 'App\Stars\Controller\IndexController::listAction')->bind('stars.list');
$app->get('/stars/edit/{id}', 'App\Stars\Controller\IndexController::editAction')->bind('stars.edit');
$app->get('/stars/new', 'App\Stars\Controller\IndexController::newAction')->bind('stars.new');
$app->post('/stars/delete/{id}', 'App\Stars\Controller\IndexController::deleteAction')->bind('stars.delete');
$app->post('/stars/save', 'App\Stars\Controller\IndexController::saveAction')->bind('stars.save');

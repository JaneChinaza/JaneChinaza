<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__."/../functions/Helper.php";
require_once __DIR__."/../functions/Mailer.php";

use app\Router;
use app\controllers\propertyController;
use app\controllers\HomeController;
use app\controllers\UserController;
use app\controllers\AdminController;
use app\controllers\AgentController;

$router = new Router();

$router->post('/properties/create', [propertyController::class, 'create']);
$router->get('/properties/create', [propertyController::class, 'create']);
$router->get('/properties/update', [propertyController::class, 'update']);
$router->post('/properties/update', [propertyController::class, 'update']);
$router->post('/properties/delete', [PropertyController::class, 'delete']);

$router->get('/properties', [propertyController::class, 'properties']);
$router->get('/property_single', [propertyController::class, 'property_single']);
$router->get('/property_crud', [propertyController::class, 'showActions'],);

$router->get('/', [HomeController::class, 'index']);
$router->get('/index', [HomeController::class, 'index']);

$router->get('/about', [HomeController::class, 'about'],);
$router->get('/contact', [HomeController::class, 'contact'],);
$router->post('/contact', [HomeController::class, 'contact'],);

$router->get('/login', [UserController::class, 'login'],);
$router->post('/login', [UserController::class, 'login'],);
$router->get('/signup', [UserController::class, 'signup'],);
$router->post('/signup', [UserController::class, 'signup'],);

$router->get('/request', [UserController::class, 'request']);
$router->post('/request', [UserController::class, 'request']);
$router->get('/log_out', [UserController::class, 'log_out']);
$router->get('/agent_request', [AdminController::class, 'agent_request']);
$router->get('/request_list', [AdminController::class, 'request_list']);
$router->get('/admin_dashboard', [AdminController::class, 'dashboard']);
$router->get('/request_accept', [AdminController::class, 'request_accept']);
$router->get('/request_decline', [AdminController::class, 'request_decline']);
$router->get('/agent_dashboard', [AgentController::class, 'dashboard']);
$router->get('/agent_property', [AgentController::class, 'showAgentProperty']);
$router->get('/agents', [AgentController::class, 'agents']);
$router->get('/agent_actions', [PropertyController::class, 'showAgentActions']);

$router->post('/properties/request', [PropertyController::class, 'request_mail']);
$router->get('/properties/request', [PropertyController::class, 'request_mail']);
$router->get('/properties/request_message', [PropertyController::class, 'request_message']);
$router->get('/house_sale', [PropertyController::class, 'propertiesForSale']);

$router->resolve();
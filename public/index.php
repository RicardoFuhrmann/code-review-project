<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\TaskManager;

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

if ($method === 'GET') {
    echo json_encode(TaskManager::getTasks());
} elseif ($method === 'POST') {
    echo json_encode(TaskManager::addTask($data['task'] ?? ''));
} elseif ($method === 'DELETE') {
    echo json_encode(TaskManager::deleteTask($data['id'] ?? ''));
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}

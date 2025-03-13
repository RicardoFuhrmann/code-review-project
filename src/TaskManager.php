<?php

namespace App;

class TaskManager {
    private const DB_FILE = __DIR__ . '/../db/db.json';

    public static function getTasks() {
        if (!file_exists(self::DB_FILE)) {
            return [];
        }

        
        $content = file_get_contents(self::DB_FILE);
        if ($content === false) {
            throw new \RuntimeException('Failed to read the database file.');
        }

        
        return json_decode($content, true) ?? [];
    }

    public static function addTask($task) {
        $tasks = self::getTasks();
        $newTask = ['id' => uniqid(), 'task' => $task];
        $tasks[] = $newTask;
        file_put_contents(self::DB_FILE, json_encode($tasks, JSON_PRETTY_PRINT));
        return $newTask;
    }

    public static function deleteTask($id) {
        $tasks = self::getTasks();
        $filteredTasks = array_filter($tasks, fn($t) => $t['id'] !== $id);
        file_put_contents(self::DB_FILE, json_encode(array_values($filteredTasks), JSON_PRETTY_PRINT));
        return ['success' => true];
    }
}

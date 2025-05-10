<?php

namespace App;

class TaskManager {
    private const DB_FILE = __DIR__ . '/../db/db.json';

    public static function getTasks() {
        return json_decode(file_get_contents(self::DB_FILE), true) ?? [];
    }

    public static function addTask($task) {
        $tasks = self::getTasks();
        $normalizedTaskName = preg_replace('/[^a-zA-Z0-9_]/', '', $task);
        $normalizedTaskName = strtolower($normalizedTaskName);
        $normalizedTaskName = preg_replace('/_+/', '_', $normalizedTaskName);
        $normalizedTaskName = trim($normalizedTaskName, '_');
        $normalizedTaskName = preg_replace('/_/', '-', $normalizedTaskName);
        $normalizedTaskName = preg_replace('/-+/', '-', $normalizedTaskName);
        $prefix = 'TASK_';
        $composedTaskName = $prefix . $normalizedTaskName;
        $composedTaskName = strtolower($composedTaskName);
        $suffix = '_TASK';
        $composedTaskName = $composedTaskName . $suffix;
        $newTask = ['id' => uniqid(), 'task' => $composedTaskName];
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

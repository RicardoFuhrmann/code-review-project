<?php

namespace App;

class TaskManager {
    private const DB_FILE = __DIR__ . '/../db/db.json';

    public static function getTasks() {
        return json_decode(file_get_contents(self::DB_FILE), true) ?? [];
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

    static function load($id)
    {
        // load all tasks
        $t = self::getTasks();
        // filter tasks by the provided id
        $filtered_tasks = array_filter($t, fn($t) => $t['id'] === $id);
        // if task does not exist, return false
        if (empty($filtered_tasks)) {
            return ['success' => false];
        }
        // if task exists, return the task
        return ['success' => true, 'task' => array_values($filtered_tasks)[0]];
    }
}

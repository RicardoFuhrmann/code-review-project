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

    public static function updateTask($id, $task) {
        $tasks = self::getTasks();
        foreach ($tasks as &$t) {
            if ($t['id'] === $id) {
                $t['task'] = $task;
            }
        }
        file_put_contents(self::DB_FILE, json_encode($tasks, JSON_PRETTY_PRINT));
        return ['success' => true];
    }

    public static function notifyWhenAddTask(array $tasks): array {
        $task = self::addTask($tasks);
        if (isset($task['success'])) {
            $email = $task['email'];
            $name = $task['name'];
            $addedDate = $task['$addedDate'];

            return [
                'success' => true,
                'email' => $email,
                'name' => $name,
                'addedDate' => $addedDate
            ];
        }

        return ['success' => false];
    }
}

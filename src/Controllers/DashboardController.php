<?php
    namespace App\Controllers;
    use App\Models\UserTasksModel;

    class DashboardController {
        public function assignTask(array $data): bool {
            return UserTasksModel::insert([
                'title'        => $data['title'],
                'description'  => $data['description'],
                'assigned_to'  => $data['assigned_to']
            ]);
        }

        public function listTasks(int $userId): array|bool {
            return UserTasksModel::fetchAll($userId);
        }

        public function updateTaskStatus(array $data): bool {
            return UserTasksModel::update([
                'id'          => $data['id'],
                'title'       => $data['title'],
                'description' => $data['description'],
                'status'      => $data['status'],
                'assigned_to' => $data['assigned_to']
            ]);
        }
    }
?>
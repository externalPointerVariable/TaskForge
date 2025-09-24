<?php
    namespace App\Controllers;
    use App\Models\UserTasksModel;

    class DashboardController {
        public function assignTask(array $data): array {
            $title       = trim($data['title'] ?? '');
            $description = trim($data['description'] ?? '');
            $assignedTo  = $data['assigned_to'] ?? null;
            $assignedBy  = $_SESSION['user']['id'] ?? null;

            if (!$title || !$description || !$assignedTo || !$assignedBy) {
                return ['view' => 'Dashboard', 'data' => ['message' => 'All fields are required']];
            }

            $success = UserTasksModel::insert([
                'title'        => $title,
                'description'  => $description,
                'assigned_to'  => $assignedTo,
                'assigned_by'  => $assignedBy
            ]);

            return $success
                ? ['view' => 'Dashboard', 'data' => ['message' => 'Task assigned successfully']]
                : ['view' => 'Dashboard', 'data' => ['message' => 'Failed to assign task']];
        }

        public function listTasks(int $userId): array {
            $tasks = UserTasksModel::fetchAll($userId);

            return is_array($tasks)
                ? ['view' => 'Dashboard', 'data' => ['tasks' => $tasks]]
                : ['view' => 'Dashboard', 'data' => ['message' => 'No tasks found']];
        }

        public function listTasksAdmin(int $managerId): array {
            $tasks = UserTasksModel::fetchAllAdmin($managerId);

            // 🔍 Debug: Print raw tasks array
            echo "<h3>📦 Raw Tasks from Model:</h3><pre>";
            print_r($tasks);
            echo "</pre>";

            $response = is_array($tasks)
                ? ['view' => 'Dashboard', 'data' => ['tasks' => $tasks]]
                : ['view' => 'Dashboard', 'data' => ['message' => 'No tasks found']];

            // 🔍 Debug: Print final response structure
            echo "<h3>📋 Final Response:</h3><pre>";
            print_r($response);
            echo "</pre>";

            return $response;
        }

        public function updateTaskStatus(array $data): array {
            $id          = $data['id'] ?? null;
            $title       = trim($data['title'] ?? '');
            $description = trim($data['description'] ?? '');
            $status      = $data['status'] ?? '';
            $assignedTo  = $data['assigned_to'] ?? null;
            $assignedBy  = $_SESSION['user']['id'] ?? null;

            if (!$id || !$title || !$description || !$status || !$assignedTo || !$assignedBy) {
                return ['view' => 'Dashboard', 'data' => ['message' => 'All fields are required']];
            }

            $success = UserTasksModel::update([
                'id'           => $id,
                'title'        => $title,
                'description'  => $description,
                'status'       => $status,
                'assigned_to'  => $assignedTo,
                'assigned_by'  => $assignedBy
            ]);

            return $success
                ? ['view' => 'Dashboard', 'data' => ['message' => 'Task updated successfully']]
                : ['view' => 'Dashboard', 'data' => ['message' => 'Failed to update task']];
        }
    }
?>
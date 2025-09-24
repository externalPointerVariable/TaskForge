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
            $response = is_array($tasks)
                ? ['view' => 'Dashboard', 'data' => ['tasks' => $tasks]]
                : ['view' => 'Dashboard', 'data' => ['message' => 'No tasks found']];

            return $response;
        }

        public function updateTaskStatus(array $data): array {
            $id     = $data['id'] ?? null;
            $status = $data['status'] ?? null;

            if (!$id || !$status) {
                return ['view' => 'Dashboard', 'data' => ['message' => 'Task ID and status are required']];
            }

            $success = UserTasksModel::updateStatusOnly($id, $status);

            return $success
                ? ['view' => 'Dashboard', 'data' => ['message' => 'Status updated successfully']]
                : ['view' => 'Dashboard', 'data' => ['message' => 'Failed to update status']];
        }
    }
?>
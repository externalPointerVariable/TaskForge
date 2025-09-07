<?php
namespace App\Controllers;

class DashboardController {
    public function index(): array {
        $tasks = [
            ["title" => "Fix login bug", "assigned_to" => "Abhishek"],
            ["title" => "Design task UI", "assigned_to" => "Jane"],
            ["title" => "Optimize database", "assigned_to" => "Ravi"]
        ];

        return [
            'view' => 'dashboard',
            'data' => ['tasks' => $tasks]
        ];
    }
}
?>
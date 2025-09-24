<?php
    namespace App\Helpers;

    class Schema {
        public static function getSchema(): string {
            return "
                CREATE TABLE IF NOT EXISTS user (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name TEXT NOT NULL,
                    email TEXT UNIQUE NOT NULL,
                    password TEXT NOT NULL,
                    role TEXT,
                    created_at TEXT DEFAULT CURRENT_TIMESTAMP
                );

                CREATE TABLE IF NOT EXISTS user_profile (
                    profile_url TEXT,
                    profession TEXT NOT NULL,
                    user_id INTEGER NOT NULL,
                    bio TEXT DEFAULT 'Tell us about yourself',
                    experience INTEGER NOT NULL,
                    salary TEXT NOT NULL,
                    languages TEXT NOT NULL,
                    skills TEXT NOT NULL,
                    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
                );

                CREATE TABLE IF NOT EXISTS tasks (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    title TEXT NOT NULL,
                    description TEXT,
                    status TEXT DEFAULT 'pending',
                    assigned_to INTEGER,
                    assigned_by INTEGER,
                    created_at TEXT DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (assigned_to) REFERENCES user(id) ON DELETE CASCADE,
                    FOREIGN KEY (assigned_by) REFERENCES user(id) ON DELETE SET NULL
                );

                CREATE TABLE IF NOT EXISTS employee_roster (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    manager_id INTEGER NOT NULL,
                    associated_employees_id TEXT
                );
            ";
        }
    }
?>
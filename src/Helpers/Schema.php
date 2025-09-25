<?php
    namespace App\Helpers;

    class Schema {
        public static function getSchema(): string {
            return "
                CREATE TABLE IF NOT EXISTS \"user\" (
                    id SERIAL PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    password TEXT NOT NULL,
                    role VARCHAR(50),
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                );

                CREATE TABLE IF NOT EXISTS user_profile (
                    profile_url TEXT,
                    profession VARCHAR(255) NOT NULL,
                    user_id INTEGER NOT NULL,
                    bio TEXT DEFAULT 'Tell us about yourself',
                    experience INTEGER NOT NULL,
                    salary VARCHAR(50) NOT NULL,
                    languages TEXT NOT NULL,
                    skills TEXT NOT NULL,
                    FOREIGN KEY (user_id) REFERENCES \"user\"(id) ON DELETE CASCADE
                );

                CREATE TABLE IF NOT EXISTS tasks (
                    id SERIAL PRIMARY KEY,
                    title VARCHAR(255) NOT NULL,
                    description TEXT,
                    status VARCHAR(50) DEFAULT 'Pending',
                    assigned_to INTEGER,
                    assigned_by INTEGER,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (assigned_to) REFERENCES \"user\"(id) ON DELETE CASCADE,
                    FOREIGN KEY (assigned_by) REFERENCES \"user\"(id) ON DELETE SET NULL
                );

                CREATE TABLE IF NOT EXISTS employee_roster (
                    id SERIAL PRIMARY KEY,
                    manager_id INTEGER NOT NULL,
                    associated_employees_id TEXT
                );
            ";
        }
    }
?>
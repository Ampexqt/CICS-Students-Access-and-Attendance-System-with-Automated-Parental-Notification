-- Test data for login system
-- This script creates sample users for testing the login functionality
-- Passwords are hashed using PHP's password_hash() function

USE cics_attendance_db;

-- Insert test admin
INSERT INTO admin (name, email, password, role) VALUES 
('John Admin', 'admin@zppsu.edu.ph', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dean');
-- Password: password

-- Insert test instructor  
INSERT INTO instructor (admin_id, first_name, last_name, email, password, assigned_subject, section_handled, schedule_day, schedule_time) VALUES 
(1, 'Jane', 'Instructor', 'instructor@zppsu.edu.ph', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Computer Science', 'CS-1A', 'Monday', '8:00-10:00');
-- Password: password

-- Insert test student
INSERT INTO student (instructor_id, first_name, last_name, email, password, section, device_id, status) VALUES 
(1, 'Bob', 'Student', 'student@zppsu.edu.ph', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CS-1A', 'device123', 'active');
-- Password: password

-- Insert student with numeric ID for testing student ID login
INSERT INTO student (instructor_id, first_name, last_name, email, password, section, device_id, status) VALUES 
(1, 'Alice', 'Student2', '2023001@zppsu.edu.ph', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CS-1A', 'device456', 'active');
-- Password: password
-- Can login with student_id: 2 (auto-increment) or email: 2023001@zppsu.edu.ph

-- Test credentials:
-- Admin: admin@zppsu.edu.ph / password
-- Instructor: instructor@zppsu.edu.ph / password  
-- Student: student@zppsu.edu.ph / password
-- Student by ID: 2 / password (or 2023001@zppsu.edu.ph / password)

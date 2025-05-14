-- Create the database
CREATE DATABASE IF NOT EXISTS university_timetable;
USE university_timetable;

-- Create tables
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NULL
);

CREATE TABLE IF NOT EXISTS subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    course_id INT NOT NULL,
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE IF NOT EXISTS rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    capacity INT DEFAULT 0,
    building VARCHAR(50) NULL
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    first_name VARCHAR(50) NULL,
    last_name VARCHAR(50) NULL,
    age INT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student') NOT NULL DEFAULT 'student',
    major INT NULL,
    FOREIGN KEY (major) REFERENCES courses(id)
);

CREATE TABLE IF NOT EXISTS timetables (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_id INT NOT NULL,
    subject_id INT NOT NULL,
    day_of_week ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday') NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    FOREIGN KEY (room_id) REFERENCES rooms(id),
    FOREIGN KEY (subject_id) REFERENCES subjects(id)
);

-- Insert default admin user
INSERT INTO users (username, password, role, first_name, last_name)
VALUES ('admin', '$2y$10$tU9AQhKIVbGZKN0dSv0oYe9j5uqP2vZ9VEqcD4FAHGnjU06Ro9q76', 'admin', 'Admin', 'User');
-- Password is 'password'

-- Insert some sample courses
INSERT INTO courses (name, description) VALUES 
('Computer Science', 'Bachelor of Science in Computer Science'),
('Electrical Engineering', 'Bachelor of Engineering in Electrical Engineering'),
('Business Administration', 'Bachelor of Business Administration');

-- Add some sample rooms
INSERT INTO rooms (name, capacity, building) VALUES 
('Room 101', 30, 'Main Building'),
('Room 102', 25, 'Main Building'),
('Lab 201', 20, 'Science Building');

-- Add some sample subjects
INSERT INTO subjects (name, course_id) VALUES 
('Introduction to Programming', 1),
('Database Systems', 1),
('Circuit Analysis', 2),
('Accounting Principles', 3);

-- Add some sample timetable entries
INSERT INTO timetables (room_id, subject_id, day_of_week, start_time, end_time) VALUES
(1, 1, 'Monday', '09:00:00', '11:00:00'),
(2, 2, 'Tuesday', '13:00:00', '15:00:00'),
(3, 3, 'Wednesday', '10:00:00', '12:00:00'),
(1, 4, 'Thursday', '14:00:00', '16:00:00'); 
-- Add program field to instructor table
-- This script adds a program/course field to store BS-InfoTech or BS-InfoSys

ALTER TABLE `instructor` 
ADD COLUMN `program` ENUM('BS-InfoTech', 'BS-InfoSys') DEFAULT 'BS-InfoTech' 
AFTER `section_handled`;

-- Update the main database schema file as well
-- You can run this SQL script in phpMyAdmin or your MySQL client

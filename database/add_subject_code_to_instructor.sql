-- Add subject_code field to instructor table
-- This allows storing one primary subject code per instructor

ALTER TABLE `instructor` 
ADD COLUMN `subject_code` VARCHAR(50) DEFAULT NULL 
AFTER `assigned_subject`;

-- Optional: Add index for better performance
CREATE INDEX idx_instructor_subject_code ON instructor(subject_code);

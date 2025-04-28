-- Add name and email columns to booking table
ALTER TABLE booking
ADD COLUMN name VARCHAR(255) AFTER UserID,
ADD COLUMN email VARCHAR(255) AFTER name;

-- Add foreign key constraints
ALTER TABLE booking
ADD CONSTRAINT fk_user_name FOREIGN KEY (name) REFERENCES user(name),
ADD CONSTRAINT fk_user_email FOREIGN KEY (email) REFERENCES user(email);

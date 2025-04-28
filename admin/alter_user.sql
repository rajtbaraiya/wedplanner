-- Add foreign keys to user table
ALTER TABLE user
ADD FOREIGN KEY (name) REFERENCES booking(name),
ADD FOREIGN KEY (email) REFERENCES booking(email);

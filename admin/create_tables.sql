-- Create admin table
CREATE TABLE IF NOT EXISTS admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create invitation_photos table
CREATE TABLE IF NOT EXISTS invitation_photos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    image_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create bookings table if not exists
CREATE TABLE `booking` (
  `BookingID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `EventStartDate` date NOT NULL,
  `EventEndDate` date NOT NULL,
  `PackageID` int(11) NOT NULL,
  `VenueID` int(11) NOT NULL,
  `AdditionalRequest` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create users table if not exists
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin user (password: admin123)
INSERT INTO admin (username, password) VALUES 
('admin', '$2y$10$8K1p/95btF6Ye6F3EZqZu.xs8HhPv4Nc274zG8fh/kUWp8qRP56Iy');


-- First drop the venue foreign key (if it exists)
ALTER TABLE booking
DROP FOREIGN KEY booking_ibfk_2;

-- Drop the VenueID column
ALTER TABLE booking
DROP COLUMN VenueID;

-- Add name and email columns and create foreign keys
ALTER TABLE booking
ADD COLUMN name VARCHAR(255) AFTER UserID,
ADD COLUMN email VARCHAR(255) AFTER name,
ADD FOREIGN KEY (name) REFERENCES users(name),
ADD FOREIGN KEY (email) REFERENCES users(email);

-- Add foreign keys to user table
ALTER TABLE users
ADD FOREIGN KEY (name) REFERENCES booking(name),
ADD FOREIGN KEY (email) REFERENCES booking(email);
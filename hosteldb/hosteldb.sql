-- Create furniture table
CREATE TABLE furniture (
 furnitureid INT AUTO_INCREMENT PRIMARY KEY,
 ftype VARCHAR(50) NULL,
 fcondition VARCHAR(50) NULL
);

-- Create rooms table
CREATE TABLE rooms (
 roomnumber INT AUTO_INCREMENT PRIMARY KEY,
 capacity INT,
 occupancy INT,
 furnitureid INT NULL,
 FOREIGN KEY (furnitureid) REFERENCES furniture(furnitureid)
);

-- Create admission table
CREATE TABLE admission (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(255),
 email VARCHAR(255),
 phone VARCHAR(15),
 message TEXT NULL
);

-- Create user table
CREATE TABLE user (
 userid INT AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(50),
 phone VARCHAR(15) NULL,
 email VARCHAR(255),
 usertype VARCHAR(20),
 password VARCHAR(255)
);

-- Create student table
CREATE TABLE student (
 studentid INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(255),
 gender VARCHAR(10),
 contactnumber VARCHAR(15),
 roomnumber INT NULL,
 admissionid INT NULL,
 userid INT,
 FOREIGN KEY (roomnumber) REFERENCES rooms(roomnumber),
 FOREIGN KEY (admissionid) REFERENCES admission(id),
 FOREIGN KEY (userid) REFERENCES user(userid)
);

-- Create fees table
CREATE TABLE fees (
 feesid INT AUTO_INCREMENT PRIMARY KEY,
 studentid INT NULL,
 amount DECIMAL(10, 2) NULL,
 paymentdate DATE NULL,
 FOREIGN KEY (studentid) REFERENCES student(studentid)
);

-- Create visitors table
CREATE TABLE visitors (
 visitid INT AUTO_INCREMENT PRIMARY KEY,
 visitdate DATE NULL,
 studentid INT NULL,
 visitorname VARCHAR(255) NULL,
 UNIQUE (visitid),
 FOREIGN KEY (studentid) REFERENCES student(studentid)
);

-- Insert sample data into furniture table
INSERT INTO furniture (ftype, fcondition) VALUES
('Chair', 'Good'),
('Desk', 'Excellent'),
('Bed', 'Fair'),
('Table', 'Poor'),
('Cabinet', 'Excellent');

-- Insert sample data into rooms table
INSERT INTO rooms (capacity, occupancy, furnitureid) VALUES
(4, 2, 1), -- Use existing furnitureid from the furniture table
(2, 1, 2), -- Use existing furnitureid from the furniture table
(3, 2, 3), -- Use existing furnitureid from the furniture table
(3, 3, 4), -- Use existing furnitureid from the furniture table
(2, 1, 5); -- Use existing furnitureid from the furniture table

-- Insert sample data into admission table
INSERT INTO admission (name, email, phone, message) VALUES
('John Doe', 'john@example.com', '5556667770', 'Application for admission'),
('Jane Smith', 'jane@example.com', '7778889990', 'Request for admission information'),
('Michael Johnson', 'michael@example.com', '9990001110', 'Inquiry about admission process'),
('Emily Brown', 'emily@example.com', '1112223330', 'Application for enrollment'),
('William Davis', 'william@example.com', '3334445550', 'Inquiry about admission deadlines');

-- Insert sample data into user table
INSERT INTO user (username, phone, email, usertype, password) VALUES
('admin', '9998887770', 'admin@example.com', 'admin', 'password'),
('student1', '1112223330', 'student1@example.com', 'student', 'password1'),
('student2', '4445556660', 'student2@example.com', 'student', 'password2'),
('student3', '7778889990', 'student3@example.com', 'student', 'password3'),
('student4', '2223334440', 'student4@example.com', 'student', 'password4');

-- Insert sample data into student table
INSERT INTO student (name, gender, contactnumber, roomnumber, admissionid, userid) VALUES
('Alice', 'Female', '5556667770', 1, 1, 2), -- Use existing userid from the user table
('Bob', 'Male', '7778889990', 2, 2, 3),     -- Use existing userid from the user table
('Charlie', 'Male', '9990001110', 3, 3, 4), -- Use existing userid from the user table
('Daisy', 'Female', '1112223330', 4, 4, 5), -- Use existing userid from the user table
('Ella', 'Female', '3334445550', 5, 5, 6);  -- Use existing userid from the user table

-- Insert sample data into fees table
INSERT INTO fees (studentid, amount, paymentdate) VALUES
(1, 100.00, '2024-03-15'),
(2, 150.00, '2024-03-15'),
(3, 200.00, '2024-03-15'),
(4, 250.00, '2024-03-15'),
(5, 300.00, '2024-03-15');

-- Insert sample data into visitors table
INSERT INTO visitors (visitdate, studentid, visitorname) VALUES
('2024-03-16', 1, 'Visitor 1'),
('2024-03-17', 2, 'Visitor 2'),
('2024-03-18', 3, 'Visitor 3'),
('2024-03-19', 4, 'Visitor 4'),
('2024-03-20', 5, 'Visitor 5');

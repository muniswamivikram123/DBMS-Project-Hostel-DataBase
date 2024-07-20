-- Create furniture table
CREATE TABLE furniture (
    furnitureid INT AUTO_INCREMENT PRIMARY KEY,
    ftype VARCHAR(50),
    fcondition VARCHAR(50)
) ENGINE=InnoDB;

-- Create rooms table
CREATE TABLE rooms (
    roomnumber INT AUTO_INCREMENT PRIMARY KEY,
    capacity INT,
    occupancy INT,
    furnitureid INT,
    FOREIGN KEY (furnitureid) REFERENCES furniture(furnitureid)
) ENGINE=InnoDB;

-- Create admission table
CREATE TABLE admission (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(15),
    message TEXT
) ENGINE=InnoDB;

-- Create user table
CREATE TABLE user (
    userid INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    phone VARCHAR(15),
    email VARCHAR(255),
    usertype VARCHAR(20),
    password VARCHAR(255)
) ENGINE=InnoDB;

-- Create students table
CREATE TABLE students (
    studentid INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    gender VARCHAR(10),
    contactnumber VARCHAR(15),
    roomnumber INT,
    admissionid INT,
    userid INT,
    FOREIGN KEY (roomnumber) REFERENCES rooms(roomnumber),
    FOREIGN KEY (admissionid) REFERENCES admission(id),
    FOREIGN KEY (userid) REFERENCES user(userid)
) ENGINE=InnoDB;

-- Create fees table
CREATE TABLE fees (
    feeid INT AUTO_INCREMENT PRIMARY KEY,
    studentid INT,
    amount DECIMAL(10, 2),
    paymentdate DATE,
    FOREIGN KEY (studentid) REFERENCES students(studentid)
) ENGINE=InnoDB;

-- Create visitors table
CREATE TABLE visitors (
    visitorid INT,
    studentid INT,
    visitorname VARCHAR(255),
    visitdate DATE,
    FOREIGN KEY (studentid) REFERENCES students(studentid)
) ENGINE=InnoDB;

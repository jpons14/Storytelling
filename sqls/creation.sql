
DROP TABLE IF EXISTS users;
CREATE TABLE users(
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(150),
  email VARCHAR(100),
  password VARCHAR(50)
);
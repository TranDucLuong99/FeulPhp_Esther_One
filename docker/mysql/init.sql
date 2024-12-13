-- CREATE DATABASE IF NOT EXISTS fuelphp_test_db;
CREATE DATABASE IF NOT EXISTS fuelphp_test_db;
CREATE TABLE IF NOT EXISTS fuelphp_test_db.test (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL
    );
INSERT INTO fuelphp_test_db.test (name, email) VALUES ('User1', 'user1@example.com');
GRANT ALL PRIVILEGES ON fuelphp_test_db.* TO 'fuelphp'@'%';
FLUSH PRIVILEGES;
-- CREATE DATABASE IF NOT EXISTS fuelphp_db;
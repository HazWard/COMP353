# Initialize database
DROP DATABASE company_cms;
CREATE DATABASE company_cms;
USE company_cms;

# Initialize tables
CREATE TABLE client_companies(
    company_name VARCHAR(255) PRIMARY KEY,
    company_email VARCHAR(255),
    rep_first_name VARCHAR(255),
    rep_last_name VARCHAR(255),
    rep_middle_initial VARCHAR(255),
    city VARCHAR(255),
    province VARCHAR(255)
);

CREATE TABLE departments(
    department_id INT PRIMARY KEY,
    department_name VARCHAR(255)
);

CREATE TABLE employees(
    employee_id INT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    department INT,
    FOREIGN KEY (department) REFERENCES departments(department_id),
    manager_id INT,
    FOREIGN KEY (manager_id) REFERENCES employees(employee_id)
);

CREATE TABLE contracts(
    contract_id INT PRIMARY KEY AUTO_INCREMENT,
    contract_type VARCHAR(255),
    type_of_service VARCHAR(255),
    acv FLOAT,
    initial_amount FLOAT,
    service_start_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    manager_id INT,
    FOREIGN KEY (manager_id) REFERENCES employees(employee_id),
    company_name VARCHAR(255),
    FOREIGN KEY (company_name) REFERENCES client_companies(company_name)
);

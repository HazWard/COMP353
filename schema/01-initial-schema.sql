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

CREATE TABLE contracts(
    contract_id INT PRIMARY KEY,
    contract_type VARCHAR(255),
    type_of_service VARCHAR(255),
    acv FLOAT,
    initial_amount FLOAT,
    service_start_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE contract_managers(
    # one-to-many
    manager_id INT,
    contract_id INT,
    PRIMARY KEY (manager_id, contract_id)
);

CREATE TABLE departments(
    department_id INT PRIMARY KEY,
    department_name VARCHAR(255)
);

CREATE TABLE employees(
    employee_id INT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255)
);

CREATE TABLE employee_managers(
    # one-to-many
    manager_id INT,
    employee_id INT,
    PRIMARY KEY (manager_id, employee_id)
);

CREATE TABLE department_employees(
    # one-to-many
    department_id INT,
    employee_id INT,
    PRIMARY KEY (department_id, employee_id)
);

CREATE TABLE client_contracts(
    # one-to-many
    company_name INT,
    contract_id INT,
    PRIMARY KEY (company_name, contract_id)
);
# Init
DROP DATABASE company_cms;
CREATE DATABASE company_cms;
USE company_cms;

# Initialize tables
CREATE TABLE provinces (
    prov_abbrev CHAR(2) PRIMARY KEY,
    prov_name VARCHAR(255),
);

CREATE TABLE cities (
    city_id INT PRIMARY KEY,
    city_name VARCHAR(255),
    province CHAR(2),
    FOREIGN KEY (province) REFERENCES provinces(abbrev)
);

CREATE TABLE client_companies(
    company_name VARCHAR(255) PRIMARY KEY,
    company_email VARCHAR(255),
    rep_first_name VARCHAR(255),
    rep_last_name VARCHAR(255),
    rep_middle_initial VARCHAR(255),
    city INT,
    FOREIGN KEY (city) REFERENCES cities(city_id)
);

CREATE TABLE departments(
    department_id INT PRIMARY KEY,
    department_name VARCHAR(255)
);

CREATE TABLE insurance_plans(
    plan_id INT PRIMARY KEY,
    plan_name VARCHAR(255),
    reimbursement_perc FLOAT(4,2)
);

CREATE TABLE employees(
    employee_id INT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    department_id INT,
    FOREIGN KEY (department_id) REFERENCES departments(department_id),
    manager_id INT,
    FOREIGN KEY (manager_id) REFERENCES employees(employee_id),
    insurance_plan INT,
    FOREIGN KEY (insurance_plan) REFERENCES insurance_plans(plan_id)
);

CREATE TABLE contracts(
    contract_id INT PRIMARY KEY,
    contract_type VARCHAR(255),
    type_of_service VARCHAR(255),
    acv FLOAT,
    initial_amount FLOAT,
    service_start_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    manager_id INT,
    FOREIGN KEY (manager_id) REFERENCES employees(employee_id),
    company_name VARCHAR(255),
    FOREIGN KEY (company_name) REFERENCES client_companies(company_name),
    satisfaction_score INT DEFAULT 5
);
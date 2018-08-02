# Init
DROP DATABASE IF EXISTS company_cms;
CREATE DATABASE company_cms;
USE company_cms;

# Initialize tables
CREATE TABLE provinces(
    prov_abbrev CHAR(2) PRIMARY KEY,
    prov_name VARCHAR(255) NOT NULL
);

CREATE TABLE cities(
    city_name VARCHAR(255) NOT NULL,
    province CHAR(2) NOT NULL,
    FOREIGN KEY (province) REFERENCES provinces(prov_abbrev),
    CONSTRAINT city primary key (city_name, province)
);

CREATE TABLE clients(
    company_name VARCHAR(255) PRIMARY KEY,
    contact_number NUMERIC(10,0) NOT NULL,
    company_email VARCHAR(255) NOT NULL,
    rep_first_name VARCHAR(255) NOT NULL,
    rep_last_name VARCHAR(255) NOT NULL,
    rep_middle_initial VARCHAR(255) DEFAULT NULL,
    city VARCHAR(255),
    province CHAR(2),
    line_of_business VARCHAR(255) NOT NULL,
    FOREIGN KEY (city, province) REFERENCES cities(city_name, province)
);

CREATE TABLE insurances(
    plan_name VARCHAR(255) PRIMARY KEY,
    reimbursement_perc FLOAT(2,1) NOT NULL
);

CREATE TABLE employees(
    employee_id INT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    manager_id INT DEFAULT NULL,
    FOREIGN KEY (manager_id) REFERENCES employees(employee_id),
    insurance_plan VARCHAR(255) NOT NULL DEFAULT 'Normal Employee Plan',
    FOREIGN KEY (insurance_plan) REFERENCES insurances(plan_name)
);

CREATE TABLE categories(
    # entity describes the number of days for each deliverable based on category of contract
    contract_category varchar(255) primary key,
    deliv1 int not null,
    deliv2 int not null,
    deliv3 int not null,
    deliv4 int default null
);

CREATE TABLE contracts(
    contract_id INT PRIMARY KEY,
    contract_category VARCHAR(255) NOT NULL,
    type_of_service VARCHAR(255) NOT NULL,
    acv FLOAT NOT NULL,
    initial_amount FLOAT NOT NULL,
    
    service_start_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    1_delivered INT NULL, #updated when first deliverable is finished
    2_delivered INT NULL, #just records the number of days it took to finish 1,2,3,4 delivs
    3_delivered INT NULL,
    4_delivered INT NULL,
    score INT DEFAULT NULL, #score assigned post performance by client; to be updated
    
    manager_id INT NOT NULL,
    FOREIGN KEY (manager_id) REFERENCES employees(employee_id),
    company_name VARCHAR(255) NOT NULL,
    FOREIGN KEY (company_name) REFERENCES clients(company_name)
);

CREATE TABLE desired_contracts(
    # entity is populated when employee makes a request to work on a (category, type) of contract
    # each employee may work on multiple (or no) contracts.
    employee_id int primary key,
    desired_category varchar(255) not null,
    desired_type varchar(255) not null,
    foreign key (employee_id) references employees(employee_id)
);

CREATE TABLE assigned_contracts(
    # entity is populated when manager assigns a contract wrt employees preferences
    employee_id int not null,
    contract_id int not null,
    hours_worked int default 0,
    foreign key (employee_id) references employees(employee_id),
    foreign key (contract_id) references contracts(contract_id),
    constraint pkg_ec primary key (employee_id, contract_id)
);

CREATE TABLE user_credentials(
    username VARCHAR(50),
    user_type VARCHAR(10),
    password VARCHAR(50),
    constraint credentials primary key (username, password)
);

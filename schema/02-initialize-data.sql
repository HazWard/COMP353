USE company_cms;

SET FOREIGN_KEY_CHECKS=0;
# Departments
INSERT INTO departments(department_id, department_name) VALUES (1,'Development');
INSERT INTO departments(department_id, department_name) VALUES (2,'QA');
INSERT INTO departments(department_id, department_name) VALUES (3,'UI');
INSERT INTO departments(department_id, department_name) VALUES (4,'Design');
INSERT INTO departments(department_id, department_name) VALUES (5,'Business Intelligence');
INSERT INTO departments(department_id, department_name) VALUES (6,'Networking');

# Contracts
INSERT INTO contracts(contract_id, contract_type, type_of_service, acv, initial_amount, manager_id, company_name) VALUES(0, 'Gold', 'On-premises', 3000, 1500.00, 1234, 'Walmart');
INSERT INTO contracts(contract_id, contract_type, type_of_service, acv, initial_amount, manager_id, company_name) VALUES(1, 'Silver', 'Cloud', 20000, 500.00, 1337, 'Wallgreens');
INSERT INTO contracts(contract_id, contract_type, type_of_service, acv, initial_amount, manager_id, company_name) VALUES(2, 'Diamond', 'On-premises', 6500, 1000.00, 1234, 'IKEA');
INSERT INTO contracts(contract_id, contract_type, type_of_service, acv, initial_amount, manager_id, company_name) VALUES(3, 'Premium', 'Cloud', 10000, 2500.00, 1337, 'IKEA');
INSERT INTO contracts(contract_id, contract_type, type_of_service, acv, initial_amount, manager_id, company_name) VALUES(4, 'Silver', 'On-premises', 8500, 250.00, 1234, 'Walmart');

# Companies
INSERT INTO client_companies(company_name, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province) VALUES('Walmart', 'walmart@email.com', 'Simba', 'Lion','S', 'Quebec', 'QC');
INSERT INTO client_companies(company_name, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province) VALUES('Wallgreens', 'walgreens@email.com', 'Jack', 'Sparrow','S', 'Saskatoon', 'SK');
INSERT INTO client_companies(company_name, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province) VALUES('IKEA', 'ikea@email.com', 'Britanica', 'Encyclopaedia', 'S', 'Toronto', 'ON');

# Employees
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(1337, 'Rea', 'Sharma', 1, NULL);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(222, 'Jack', 'Karouac', 2, 1337);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(223, 'Dany', 'Collagen', 3, 1337);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(224, 'Ivan', 'Mann', 4, 1337);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(225, 'Ori', 'Bobba', 0, 1337);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(226, 'Sam', 'Wood', 1, 1337);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(227, 'Paul', 'Amsterdam', 2, 1337);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(228, 'Paula', 'Bambam', 3, 1337);



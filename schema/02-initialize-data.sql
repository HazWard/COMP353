USE company_cms;

SET FOREIGN_KEY_CHECKS=0;

# Departments
INSERT INTO insurances(plan_name, reimbursement_perc) VALUES ('Premium',0.90);
INSERT INTO insurances(plan_name, reimbursement_perc) VALUES ('Silver',0.80);
INSERT INTO insurances(plan_name, reimbursement_perc) VALUES ('Normal', 0.70);

# Companies
INSERT INTO clients(company_name, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province) VALUES('Walmart', 'walmart@email.com', 'Simba', 'Lion','S', 'Quebec', 'QC');
INSERT INTO clients(company_name, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province) VALUES('Wallgreens', 'walgreens@email.com', 'Jack', 'Sparrow','S', 'Saskatoon', 'SK');
INSERT INTO clients(company_name, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province) VALUES('IKEA', 'ikea@email.com', 'Britanica', 'Encyclopaedia', 'S', 'Toronto', 'ON');
INSERT INTO clients(company_name, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province) VALUES('Nike', 'nike@nike.com', 'Erica', 'Badu', 'V', 'Toronto', 'ON');

# Employees
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(0, 'Juan', 'Vasquez', 1, NULL);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(1337, 'Rea', 'Sharma', 1, NULL);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(222, 'Jack', 'Karouac', 2, 1337);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(223, 'Dany', 'Collagen', 3, 1337);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(224, 'Ivan', 'Mann', 4, 1337);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(225, 'Ori', 'Bobba', 1, 1337);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(226, 'Sam', 'Wood', 1, 1337);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(227, 'Paul', 'Amsterdam', 2, 1337);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(228, 'Paula', 'Bambam', 3, 1337);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(229, 'Jocelyn', 'Cambridge', 4, 0);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(230, 'Tom', 'Oooma', 5, 0);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(231, 'Unagi', 'Sushi', 5, 0);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(232, 'Paul', 'Amsterdam', 4, 0);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(233, 'Boston', 'Tourists', 3, 0);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(234, 'Random', 'Namehere', 2, 0);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(235, 'Meme', 'Gene', 1, 0);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(236, 'Halo', 'Beyonce', 3, 0);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(237, 'Mcdo', 'Nouggats', 1, 0);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(238, 'Dave', 'Biggie', 2, 0);
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id) VALUES(239, 'David', 'Smith', 2, NULL);

# Contracts
INSERT INTO contracts(contract_id, contract_category, type_of_service, acv, initial_amount, manager_id, company_name, service_start_date) VALUES(0, 'Gold', 'On-premises', 3000, 1500.00, 0, 'Walmart', '2016-01-01 00:00:00');
INSERT INTO contracts(contract_id, contract_category, type_of_service, acv, initial_amount, manager_id, company_name, service_start_date) VALUES(1, 'Silver', 'Cloud', 2000, 500.00, 1337, 'Wallgreens', '2016-01-01 00:00:00');
INSERT INTO contracts(contract_id, contract_category, type_of_service, acv, initial_amount, manager_id, company_name, service_start_date) VALUES(2, 'Diamond', 'On-premises', 6500, 1000.00, 0, 'IKEA', '2017-01-01 00:00:00');
INSERT INTO contracts(contract_id, contract_category, type_of_service, acv, initial_amount, manager_id, company_name, service_start_date) VALUES(3, 'Premium', 'Cloud', 10000, 2500.00, 1337, 'IKEA', '2017-01-01 00:00:00');
INSERT INTO contracts(contract_id, contract_category, type_of_service, acv, initial_amount, manager_id, company_name, service_start_date) VALUES(4, 'Silver', 'On-premises', 750, 250.00, 0, 'Walmart', '2017-01-01 00:00:00');
INSERT INTO contracts(contract_id, contract_category, type_of_service, acv, initial_amount, manager_id, company_name, service_start_date) VALUES(5, 'Gold', 'On-premises', 750, 250.00, 239, 'Nike', '2017-01-01 00:00:00');
INSERT INTO contracts(contract_id, contract_category, type_of_service, acv, initial_amount, manager_id, company_name, service_start_date) VALUES(6, 'Premium', 'Cloud', 10000, 2500.00, 1337, 'IKEA', '2017-01-01 00:00:00');
INSERT INTO contracts(contract_id, contract_category, type_of_service, acv, initial_amount, manager_id, company_name, service_start_date) VALUES(7, 'Diamond', 'On-premises', 70000, 250.00, 0, 'Walmart', '2017-01-01 00:00:00');
INSERT INTO contracts(contract_id, contract_category, type_of_service, acv, initial_amount, manager_id, company_name, service_start_date) VALUES(8, 'Silver', 'On-premises', 50000, 250.00, 1337, 'Nike', '2017-01-01 00:00:00');

SET FOREIGN_KEY_CHECKS=1;
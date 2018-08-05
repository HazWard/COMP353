USE company_cms;

/*
Queries to populate the database
  10 Client Companies (1 Travel, 2 Tech, 1 Food, 1 Financial, 5 Retail)
  50 Contracts (10 per line of business)
  12 Managers (2 per department; Also arranged it so that each Manager only works with contracts from one line of business)
  *HOWEVER NO ASSUMPTION IS BEING MADE ABOUT THE RELATIONSHIP BETWEEN MANAGERS AND LINES OF BUSINESSES*
  Organized employee id as 8 digit numeric with 1 in the front if Manager, and 2 in the front if employee.
  48 Employees/Non-Managerial (4 per Manager)
  Gave each manager a Premium Employee Insurance
  2/2 Employees with Silver/Normal Employee Insurance per Manager
*/

# Company clients
# Line of Business : Tech, Travel, Retail, Financial, Food
INSERT INTO clients(company_name, contact_number, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province, line_of_business)
VALUES('Apple Inc.', 4632343154, 'apple@email.com', 'Steve', 'Jobs', 'A', 'Waterloo', 'ON', 'Tech');
INSERT INTO clients(company_name, contact_number, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province, line_of_business)
VALUES('Air Canada', 2241236712, 'aircanada@email.com', 'Horacio', 'Avarez', 'S', 'Rockland', 'ON', 'Travel');
INSERT INTO clients(company_name, contact_number, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province, line_of_business)
VALUES('Digital Extremes', 8023574523, 'de@email.com', 'Connor', 'Yves', 'A', 'Calgary', 'AB', 'Tech');
INSERT INTO clients(company_name, contact_number, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province, line_of_business)
VALUES('Essence', 5282526613, 'essence@email.com', 'Ron', 'Gray', 'G', 'Zurich', 'ON', 'Retail');
INSERT INTO clients(company_name, contact_number, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province, line_of_business)
VALUES('IKEA', 3496734958, 'ikea@email.com', 'River', 'Song', null, 'Toronto', 'ON', 'Retail');
INSERT INTO clients(company_name, contact_number, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province, line_of_business)
VALUES('Koryo', 9462345758, 'koryo@email.com', 'Jannelle', 'Pempenco', 'R', 'Montreal', 'QC', 'Retail');
INSERT INTO clients(company_name, contact_number, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province, line_of_business)
VALUES('Manulife', 6341282453, 'manulife@email.com', 'Xiqui', 'Wong', null, 'Edmonton', 'AB', 'Food');
INSERT INTO clients(company_name, contact_number, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province, line_of_business)
VALUES('Nike', 8058533495, 'nike@email.com', 'Erica', 'Badu', 'A', 'Toronto', 'ON', 'Retail');
INSERT INTO clients(company_name, contact_number, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province, line_of_business)
VALUES('Walmart', 5143250692, 'walmart@email.com', 'James', 'Carter', 'M', 'Quebec', 'QC', 'Retail');
INSERT INTO clients(company_name, contact_number, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province, line_of_business)
VALUES('Wallgreens', 2485069202, 'walgreens@email.com', 'Ichigo', 'Sana', null, 'Saskatoon', 'SK', 'Retail');

# Insurance plan
insert into insurances(plan_name, reimbursement_perc) values ('Premium Employee Plan', 0.9);
insert into insurances(plan_name, reimbursement_perc) values ('Silver Employee Plan', 0.8);
insert into insurances(plan_name, reimbursement_perc) values ('Normal Employee Plan', 0.7);

# Managers
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(10000000, 'Juan', 'Vasquez', 'Development', NULL, 'Premium Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(10000001, 'Rea', 'Sharma', 'Development', NULL, 'Premium Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(10000002, 'Jack', 'Karouac', 'QA', NULL, 'Premium Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(10000003, 'Girard', 'Chou', 'QA', NULL, 'Premium Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(10000004, 'Carla', 'Kim', 'UI', NULL, 'Premium Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(10000005, 'Abra', 'Levitas', 'UI', NULL, 'Premium Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(10000006, 'Yesse', 'Salas', 'Design', NULL, 'Premium Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(10000007, 'Mystique', 'Karo', 'Design', NULL, 'Premium Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(10000008, 'Devon', 'Masque', 'Business Intelligence', NULL, 'Premium Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(10000009, 'Evan', 'Yann', 'Business Intelligence', NULL, 'Premium Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(10000010, 'Farran', 'Ahn', 'Networking', NULL, 'Premium Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(10000011, 'Hassan', 'Sih', 'Networking', NULL, 'Premium Employee Plan');

# Employees Juan
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000001, 'Iman', 'Oak', 'Development', 10000000, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000002, 'Jas', 'Abat', 'Development', 10000000, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000003, 'Imadake', 'Hamato', 'Development', 10000000, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000004, 'Limchang', 'Kim', 'Development', 10000000, 'Normal Employee Plan');

# Employees Rea
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000005, 'Timothy', 'Sin', 'Development', 10000001, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000006, 'Kyung', 'Ko', 'Development', 10000001, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000007, 'Jishi', 'Chang', 'Development', 10000001, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000008, 'Chuling', 'Li', 'Development', 10000001, 'Normal Employee Plan');

# Employees Jack
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000009, 'Ivanna', 'James', 'QA', 10000002, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000010, 'Abigail', 'Oak', 'QA', 10000002, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000011, 'Hanna', 'Curry', 'QA', 10000002, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000012, 'Janna', 'Sun', 'QA', 10000002, 'Normal Employee Plan');

# Employees Girard
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000013, 'Ophelia', 'Darle', 'QA', 10000003, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000014, 'Persephone', 'Ralla', 'QA', 10000003, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000015, 'Miranda', 'Mykochev', 'QA', 10000003, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000016, 'Kyle', 'Sammich', 'QA', 10000003, 'Normal Employee Plan');

# Employees Carla
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000017, 'Samantha', 'Ogilovich', 'UI', 10000004, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000018, 'Tatiana', 'Mann', 'UI', 10000004, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000019, 'Jeannette', 'Dore', 'UI', 10000004, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000020, 'Paul', 'Sommersby', 'UI', 10000004, 'Normal Employee Plan');

# Employees Abra
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000021, 'Quinton', 'Banal', 'UI', 10000005, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000022, 'Rastabul', 'Ega', 'UI', 10000005, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000023, 'Wally', 'Wall', 'UI', 10000005, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000024, 'Manny', 'Telos', 'UI', 10000005, 'Normal Employee Plan');

# Employees Yesse
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000025, 'Xanther', 'Black', 'Design', 10000006, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000026, 'Vivien', 'Viola', 'Design', 10000006, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000027, 'Viola', 'Davis', 'Design', 10000006, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000028, 'Dennis', 'Walk', 'Design', 10000006, 'Normal Employee Plan');

# Employees Mystique
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000029, 'China', 'White', 'Design', 10000007, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000030, 'April', 'Renore', 'Design', 10000007, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000031, 'Bruce', 'Springstein', 'Design', 10000007, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000032, 'Bruce', 'Jenner', 'Design', 10000007, 'Normal Employee Plan');

# Employees Devon
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000033, 'Samantha', 'Collins', 'Business Intelligence', 10000008, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000034, 'Ebony', 'Lenner', 'Business Intelligence', 10000008, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000035, 'Ivory', 'Hanna', 'Business Intelligence', 10000008, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000036, 'Destiny', 'Banting', 'Business Intelligence', 10000008, 'Normal Employee Plan');

# Employees Evan
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000037, 'Samantha', 'Collins', 'Business Intelligence', 10000009, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000038, 'Ebony', 'Lenner', 'Business Intelligence', 10000009, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000039, 'Ivory', 'Hanna', 'Business Intelligence', 10000009, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000040, 'Destiny', 'Banting', 'Business Intelligence', 10000009, 'Normal Employee Plan');

# Employees Farran
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000041, 'Tanis', 'Lanister', 'Networking', 10000010, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000042, 'Jamie', 'Stark', 'Networking', 10000010, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000043, 'Wallace', 'Greene', 'Networking', 10000010, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000044, 'Gemini', 'Scope', 'Networking', 10000010, 'Normal Employee Plan');

# Employees Hassan
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000045, 'Lemony', 'Snicket', 'Networking', 10000011, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000046, 'Honor', 'Lemings', 'Networking', 10000011, 'Silver Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000047, 'Duncan', 'Shurima', 'Networking', 10000011, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(20000048, 'Ayn', 'Rand', 'Networking', 10000011, 'Normal Employee Plan');

# Deliverables/Categories of Contracts
INSERT INTO categories(contract_category, deliv1, deliv2, deliv3) values ('Premium', 3, 5, 10);
INSERT INTO categories(contract_category, deliv1, deliv2, deliv3) values ('Diamond', 6, 11, 18);
INSERT INTO categories(contract_category, deliv1, deliv2, deliv3) values ('Gold', 8, 14, 20);
INSERT INTO categories(contract_category, deliv1, deliv2, deliv3, deliv4) values ('Silver', 5, 15, 20, 28);

# Contracts
# Contracts in 'Tech' (with Apple Inc. and Digital Extremes)
# Manager in charge of Tech Line of business: 10000000, 10000001
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Premium', 'Cloud', 50000, 10000, '2017-01-19 03:14:07', 10000000, 'Apple Inc.');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Premium', 'On-premises', 55000, 15000, '2017-02-21 03:14:07', 10000001, 'Apple Inc.');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Premium', 'On-premises', 60000, 20000, '2017-07-19 03:14:07', 10000000, 'Digital Extremes');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Silver', 'Cloud', 10000, 2000, '2017-08-09 03:14:07', 10000001, 'Apple Inc.');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Silver', 'On-premises', 15000, 3000, '2017-09-19 03:14:07', 10000000, 'Digital Extremes');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Gold', 'On-premises', 20000, 4000, '2017-10-19 03:14:07', 10000001, 'Apple Inc.');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Gold', 'Cloud', 25000, 5000, '2017-11-19 03:14:07', 10000000, 'Apple Inc.');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Diamond', 'On-premises', 30000, 6000, '2018-02-19 03:14:07', 10000001, 'Apple Inc.');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Diamond', 'Cloud', 35000, 7000, '2018-07-19 03:14:07', 10000000, 'Digital Extremes');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Diamond', 'Cloud', 40000, 8000, '2018-05-19 03:14:07', 10000001, 'Apple Inc.');

# Contracts in 'Travel' (with Air Canada)
# Manager in charge of this line of business: 10000002, 10000003
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Premium', 'Cloud', 60000, 20000, '2017-08-19 03:14:07', 10000002, 'Air Canada');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Premium', 'On-premises', 50000, 10000, '2017-09-19 03:14:07', 10000003, 'Air Canada');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Diamond', 'Cloud', 40000, 8000, '2017-010-19 03:14:07', 10000002, 'Air Canada');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Diamond', 'Cloud', 30000, 6000, '2017-11-19 03:14:07', 10000003, 'Air Canada');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Gold', 'Cloud', 20000, 4000, '2017-12-19 03:14:07', 10000002, 'Air Canada');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Gold', 'Cloud', 20000, 4500, '2018-01-19 03:14:07', 10000003, 'Air Canada');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Silver', 'On-premises', 5000, 1000, '2018-02-19 03:14:07', 10000002, 'Air Canada');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Silver', 'Cloud', 4500, 1000, '2018-03-19 03:14:07', 10000003, 'Air Canada');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Silver', 'Cloud', 5000, 1000, '2018-04-19 03:14:07', 10000002, 'Air Canada');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Silver', 'Cloud', 10000, 1000, '2018-05-19 03:14:07', 10000003, 'Air Canada');

# Contracts in 'Food' (with Koryo)
# Manager in charge of the line of business: 10000004, 10000005
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Premium', 'Cloud', 50000, 10000, '2017-01-19 03:14:07', 10000004, 'Koryo');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Premium', 'Cloud', 50000, 10000, '2017-02-04 03:14:07', 10000005, 'Koryo');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Premium', 'Cloud', 50000, 15000, '2017-02-16 03:14:07', 10000004, 'Koryo');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Premium', 'Cloud', 80000, 15000, '2017-04-18 03:14:07', 10000005, 'Koryo');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Premium', 'On-premises', 60000, 12000, '2018-01-22 03:14:07', 10000004, 'Koryo');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Diamond', 'Cloud', 40000, 7000, '2018-03-19 03:14:07', 10000005, 'Koryo');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Gold', 'On-premises', 20000, 5000, '2018-05-20 03:14:07', 10000004, 'Koryo');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Gold', 'On-premises', 25000, 60000, '2017-11-04 03:14:07', 10000005, 'Koryo');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Silver', 'On-premises', 5000, 1000, '2017-12-01 03:14:07', 10000004, 'Koryo');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Silver', 'On-premises', 5500, 1000, '2018-04-24 03:14:07', 10000005, 'Koryo');

# Contracts in 'Financial' (with Manulife)
# Managers in charge of this line of business: 10000006, 10000007
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Premium', 'Cloud', 50000, 15000, '2017-01-04 03:14:07', 10000006, 'Manulife');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Premium', 'On-premise', 50000, 10000, '2017-02-04 03:14:07', 10000007, 'Manulife');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Diamond', 'Cloud', 45000, 9000, '2017-02-02 03:14:07', 10000006, 'Manulife');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Diamond', 'Cloud', 30000, 7000, '2017-03-02 03:14:07', 10000007, 'Manulife');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Diamond', 'On-premise', 35000, 7000, '2017-04-05 03:14:07', 10000006, 'Manulife');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Diamond', 'Cloud', 40000, 6000, '2018-01-05 03:14:07', 10000007, 'Manulife');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Gold', 'Cloud', 25000, 5000, '2018-03-07 03:14:07', 10000006, 'Manulife');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Gold', 'Cloud', 25000, 5000, '2017-11-19 03:14:07', 10000007, 'Manulife');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Gold', 'Cloud', 20000, 4000, '2017-12-19 03:14:07', 10000006, 'Manulife');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Silver', 'Cloud', 5000, 1000, '2017-09-19 03:14:07', 10000007, 'Manulife');

# Contracts in Retail (with Essence, IKEA, Nike, Wallgreens, Walmart)
# Managers in charge of the line of business : 10000008, 10000009, 10000010, 10000011
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Premium', 'Cloud', 100000, 20000, '2017-01-19 03:14:07', 10000008, 'Essence');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Diamond', 'Cloud', 40000, 10000, '2017-01-19 03:14:07', 10000009, 'IKEA');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Diamond', 'On-premises', 40000, 10000, '2017-01-19 03:14:07', 10000010, 'Nike');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Gold', 'Cloud', 30000, 4000, '2017-01-19 03:14:07', 10000011, 'Wallgreens');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Gold', 'On-premises', 20000, 4500, '2017-01-19 03:14:07', 10000008, 'Walmart');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Gold', 'Cloud', 25000, 4000, '2017-01-19 03:14:07', 10000009, 'Nike');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Gold', 'On-premises', 25000, 4500, '2017-01-19 03:14:07', 10000010, 'Wallgreens');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Gold', 'Cloud', 20000, 4000, '2017-01-19 03:14:07', 10000011, 'IKEA');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Silver', 'Cloud', 2000, 400, '2017-01-19 03:14:07', 10000008, 'Essence');
insert into contracts( contract_category, type_of_service, acv, initial_amount, service_start_date, manager_id, company_name)
    values ('Silver', 'On-premise', 5000, 1000, '2017-01-19 03:14:07', 10000009, 'Walmart');

/*
# TO INCLUDE IF INCLUDING SALES ASSOCIATES AND ADMIN
10 Sales Associates (id: 3 at the front, 8 digits)
1 Admins (id: 4 at the front, 8 digits)
*/

# Sales Associates
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(30000000, 'Wayne', 'Cornfield', 'Sales', NULL, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(30000001, 'Winnie', 'Bluebird', 'Sales', NULL, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(30000002, 'James', 'Cornell', 'Sales', NULL, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(30000003, 'Homer', 'Bayes', 'Sales', NULL, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(30000004, 'Sherlock', 'Hansen', 'Sales', NULL, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(30000005, 'Allie', 'Wong', 'Sales', NULL, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(30000006, 'Jessica', 'Hudson', 'Sales', NULL, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(30000007, 'Yossi', 'Haman', 'Sales', NULL, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(30000008, 'Ben', 'Gordon', 'Sales', NULL, 'Normal Employee Plan');
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(30000009, 'Louis', 'Salamander', 'Sales', NULL, 'Normal Employee Plan');

# Admin
INSERT INTO employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
VALUES(40000000, 'Oulianna', 'Rachmaninoff', 'Administration', NULL, 'Premium Employee Plan');

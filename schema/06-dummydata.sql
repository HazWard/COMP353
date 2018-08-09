USE tcc353_1;

#
## for one of the queries ##
# Number of Premium contracts delivered in more than 10 business days having
# more than 35 employees with “Silver Employee Plan”.

# dummy client
insert into clients(company_name, contact_number, company_email, rep_first_name, rep_last_name, rep_middle_initial, city, province, line_of_business)
    values ('dummy company', 1111111111, 'dummy@email', 'dummyfn', 'dummyln', 'd', 'Montreal', 'QC', 'Travel');
# dummy manager
insert into employees(employee_id, first_name, last_name, department, manager_id, insurance_plan)
    values (300, 'd1', 'd0', 'Dummy', Null, 'Silver Employee Plan');

# dummy employee
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (301, 'd1', 'd1', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (302, 'd1', 'd2', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (303, 'd1', 'd3', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (304, 'd1', 'd4', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (305, 'd1', 'd5', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (306, 'd1', 'd6', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (307, 'd1', 'd7', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (308, 'd1', 'd8', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (309, 'd1', 'd9', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (310, 'd1', 'd10', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (311, 'd1', 'd11', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (312, 'd1', 'd12', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (313, 'd1', 'd13', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (314, 'd1', 'd14', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (315, 'd1', 'd15', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (316, 'd1', 'd16', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (317, 'd1', 'd17', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (318, 'd1', 'd18', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (319, 'd1', 'd19', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (320, 'd1', 'd20', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (321, 'd1', 'd21', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (322, 'd1', 'd22', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (323, 'd1', 'd23', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (324, 'd1', 'd24', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (325, 'd1', 'd25', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (326, 'd1', 'd26', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (327, 'd1', 'd27', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (328, 'd1', 'd28', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (329, 'd1', 'd29', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (330, 'd1', 'd30', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (331, 'd1', 'd31', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (332, 'd1', 'd32', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (333, 'd1', 'd33', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (334, 'd1', 'd34', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (335, 'd1', 'd35', 'Dummy', Null);
insert into employees(employee_id, first_name, last_name, department, manager_id)
    values (336, 'd1', 'd36', 'Dummy', Null);

update employees
set insurance_plan = 'Silver Employee Plan', manager_id = 300
where (employee_id != 300 AND department = 'Dummy');

# two contracts
insert into contracts(contract_category, type_of_service, acv, initial_amount, first_deliv, second_deliv, third_deliv, score, manager_id, company_name)
    values('Premium', 'Cloud', 1, 1, 10, 10, 12, 2, 300, 'dummy company');
insert into contracts(contract_category, type_of_service, acv, initial_amount, first_deliv, second_deliv, third_deliv, score, manager_id, company_name)
    values('Diamond', 'Cloud', 2, 2, 10, 10, 10, 2, 300, 'dummy company');
insert into contracts(contract_category, type_of_service, acv, initial_amount, first_deliv, second_deliv, third_deliv, score, manager_id, company_name)
    values('Premium', 'Cloud', 3, 3, 1, 1, 7, 8, 300, 'dummy company');
insert into contracts(contract_category, type_of_service, acv, initial_amount, first_deliv, second_deliv, third_deliv, score, manager_id, company_name)
    values('Premium', 'Cloud', 4, 4, 10, 10, 15, 2, 300, 'dummy company');
insert into contracts(contract_category, type_of_service, acv, initial_amount, first_deliv, second_deliv, third_deliv, score, manager_id, company_name)
    values('Premium', 'Cloud', 5, 5, 10, 10, 10, 2, 300, 'dummy company');

# assignment
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(301, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(301, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(301, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(301, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(301, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(302, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(302, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(302, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(302, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(302, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(303, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(303, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(303, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(303, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(303, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(304, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(304, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(304, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(304, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(304, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(305, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(305, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(305, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(305, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(305, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(306, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(306, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(306, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(306, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(306, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(307, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(307, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(307, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(307, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(307, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(308, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(308, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(308, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(308, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(308, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(309, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(309, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(309, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(309, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(309, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(310, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(310, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(310, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(310, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(310, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(311, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(311, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(311, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(311, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(311, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(312, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(312, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(312, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(312, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(312, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(313, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(313, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(313, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(313, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(313, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(314, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(314, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(314, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(314, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(314, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(315, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(315, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(315, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(315, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(315, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(316, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(316, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(316, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(316, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(316, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(317, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(317, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(317, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(317, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(317, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(318, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(318, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(318, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(318, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(318, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(319, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(319, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(319, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(319, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(319, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(320, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(320, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(320, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(320, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(320, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(321, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(321, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(321, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(321, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(321, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(322, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(322, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(322, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(322, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(322, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(323, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(323, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(323, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(323, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(323, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(324, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(324, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(324, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(324, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(324, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(325, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(325, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(325, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(325, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(325, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(326, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(326, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(326, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(326, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(326, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(327, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(327, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(327, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(327, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(327, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(328, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(328, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(328, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(328, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(328, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(329, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(329, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(329, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(329, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(329, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(330, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(330, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(330, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(330, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(330, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(331, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(331, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(331, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(331, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(331, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(332, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(332, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(332, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(332, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(332, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(333, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(333, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(333, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(333, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(333, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(334, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(334, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(334, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(334, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(334, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(335, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(335, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(335, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(335, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(335, 555, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(336, 551, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(336, 552, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(336, 553, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(336, 554, 1);
insert into assigned_contracts(employee_id, contract_id, hours_worked) values(336, 555, 1);

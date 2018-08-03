<?php

class Employee
{
    private $connection;
    private $table_name = "employees";

    public $id;
    public $firstName;
    public $lastName;
    public $department;
    public $managerID;
    public $insurance;

    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getEmployee() {
        $employeeID = $_REQUEST["id"];
        if (!isset($province)) {
          return NULL;
        }

        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table_name . " WHERE employee_id=:id");
        $stmt->bindValue(':id', $employeeID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function getEmployees() {
        $managerID = $_REQUEST["manager"];
        $idList = $_REQUEST["list"];
        if (isset($managerID) && !isset($idList) ) {
            // Handle search using manager ID
            return NULL;
        }

        if (!isset($managerID) && isset($idList) ) {
            // Handle search using list of IDs
            return NULL;
        }

        return false;
    }

    public function setPreferences() {
        // Set the desired_contracts values
    }

}

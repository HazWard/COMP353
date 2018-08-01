<?php
/**
 * Created by PhpStorm.
 * User: hazward
 * Date: 19/07/18
 * Time: 4:22 PM
 */

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


}
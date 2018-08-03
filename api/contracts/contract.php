<?php

class Contract
{
    private $connection;
    private $table_name = "contracts";

    public $id;
    public $category;
    public $service_type;
    public $acv;
    public $initial_amount;
    public $manager_id;
    public $company_name;

    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
      // Use the attributes to create
      // a new contract inside the database
    }

    public function getContracts() {
      
    }
}

<?php

class Location
{
    private $connection;
    private $prov_table_name = "provinces";
    private $city_table_name = "cities";

    // constructor with $db as database connection
    public function __construct($db) {
        $this->connection = $db;
    }

    public function getProvinces() {
        $queryText = "SELECT * FROM " . $this->prov_table_name . "";

        $stmt = $this->connection->prepare($queryText);
        $stmt->execute();
        return $stmt;
    }

    public function getCities() {
        $province = $_REQUEST["province"];
        if (!isset($province)) {
          return NULL;
        }

        $stmt = $this->connection->prepare("SELECT city_name FROM " . $this->city_table_name . " WHERE province=:name");
        $stmt->bindValue(':name', $province, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }
}

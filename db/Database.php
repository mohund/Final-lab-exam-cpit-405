<?php

class Database {
    private $dbHost;
    private $dbPort;
    private $dbName;
    private $dbUser;
    private $dbPassword;
    private $dbConnection;

    public function __construct() {
        $this->dbHost = 'localhost';
        $this->dbPort = 3306; 
        $this->dbName = 'bookmarking_db';
        $this->dbUser = 'root';
        $this->dbPassword ='root';
        if (empty($this->dbHost) || empty($this->dbPort) || empty($this->dbName) || empty($this->dbUser) || empty($this->dbPassword)) {
            die('Database configuration is missing');
        }
    }

    public function connect() {
        try {
            $dsn = 'mysql:host=' . $this->dbHost . ';port=' . $this->dbPort . ';dbname=' . $this->dbName;
            $this->dbConnection = new PDO($dsn, $this->dbUser, $this->dbPassword);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->dbConnection;
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }
}

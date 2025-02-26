<?php
// Class Database untuk koneksi dan query database

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh; // database handler
    private $stmt; // statement

    public function __construct() {
        // DSN (Data Source Name)
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        
        // Opsi konfigurasi PDO
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        // Mencoba koneksi ke database
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            die('Koneksi gagal: ' . $e->getMessage());
        }
    }

    // Menyiapkan query
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    // Binding parameter
    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        
        $this->stmt->bindValue($param, $value, $type);
    }

    // Eksekusi query
    public function execute() {
        return $this->stmt->execute();
    }

    // Mendapatkan banyak data
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mendapatkan satu data
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Menghitung jumlah baris
    public function rowCount() {
        return $this->stmt->rowCount();
    }
}
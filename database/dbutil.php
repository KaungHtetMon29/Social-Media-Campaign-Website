<?php
// (function () {
//     $host = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "testdb";
//     $creatdb_query = "CREATE DATABASE if not exists $dbname";
//     $connect = new mysqli($host, $username, $password);
//     $connect->query($creatdb_query);
//     $connection = mysqli_connect($host, $username, $password, $dbname);
//     return $connection;
// });
class Dbconnect
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "testdb";

    private $connection;
    private $dbconnection;

    public function connect()
    {
        $creatdb_query = "CREATE DATABASE if not exists $this->dbname";
        $connect = new mysqli($this->host, $this->username, $this->password);
        $db = $connect->select_db($this->dbname);
        $connect->query($creatdb_query);
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);

        return $this->connection;
    }
    public function disconnect()
    {
        mysqli_close($this->connection);
    }
    public function migrate()
    {
        // $json = file_get_contents('database/Schema/user.json');
        // $data = json_decode($json, true);
        // $key = array_keys($data);
        // print_r($data["User"]);
        $query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$this->dbname'";
        $result = $this->connection->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Table: " . $row["TABLE_NAME"] . "<br>";
            }
        } else {
            echo "No tables found in the database.";
        }
    }
    public function createTable()
    {
        $json = file_get_contents('database/Schema/user.json');
        $data = json_decode($json, true);
        $createquery = "create table if not exists ";
        foreach ($data as $x => $y) {
            $table = $x;
            $columns = "";
            $counter = 0;
            foreach ($y as $key => $value) {
                $counter++;
                if ($key === "FK") {
                    $columns = $columns . "FOREIGN KEY (" . $value["ref_field"] . ")" . " REFERENCES " . $value["ref_table"] . "(" . $value["ref_table_field"] . ")";
                } else {
                    $columns = $columns . $key . " " . $value;
                }
                if ($counter < count($y)) {
                    $columns = $columns . ",";
                }
            }
            echo $createquery . $table . " (" . $columns . ")" . "\n";
            $this->connection->query($createquery . $table . " (" . $columns . ")");
        }
    }
}
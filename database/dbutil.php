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
declare(strict_types=1);
class Dbconnect
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "testdb";

    private $connection;
    private $dbconnection;
    public function connect(): mysqli
    {
        $creatdb_query = "CREATE DATABASE if not exists $this->dbname";
        $connect = new mysqli($this->host, $this->username, $this->password);
        $connect->query($creatdb_query);
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);

        return $this->connection;
    }
    public function disconnect(): void
    {
        mysqli_close($this->connection);
    }
    public function migrate(): void
    {
        // $json = file_get_contents('database/Schema/user.json');
        // $data = json_decode($json, true);
        // $key = array_keys($data);
        // print_r($data["User"]);
    }
    public function createTable(): void
    {
        $existingtables = array();
        $query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$this->dbname'";
        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($existingtables, $row["TABLE_NAME"]);
            }
            // } else {
            //     echo "No tables found in the database.";
            // }
            if (is_dir('database/Schema')) {
                $files = scandir('database/Schema');
                // print_r($files);
                foreach ($files as $file) {
                    if ($file !== "." && $file !== "..") {
                        $json = file_get_contents('database/Schema/' . $file);
                        $tblname = explode(".", $file)[0];
                        $data = json_decode($json, true);
                        $createquery = "create table if not exists ";
                        if (!in_array($tblname, $existingtables)) {
                            $table = $tblname;
                            $columns = "";
                            $counter = 0;
                            print_r($data);
                            $col = $data[$table];
                            foreach ($col as $key => $value) {
                                $counter++;
                                if ($key === "FK") {
                                    $columns = $columns . "FOREIGN KEY (" . $value["ref_field"] . ")" . " REFERENCES " . $value["ref_table"] . "(" . $value["ref_table_field"] . ")";
                                } else {
                                    $columns = $columns . $key . " " . $value;
                                }
                                if ($counter < count($col)) {
                                    $columns = $columns . ",";
                                }
                            }
                            echo $createquery . $table . " (" . $columns . ")" . "\n";
                            $this->connection->query($createquery . $table . " (" . $columns . ")");
                        }

                    }
                }
            }

        }
    }

    public function insert(string $tblname, array $data, string $identifier = null): string
    {
        $tblcontents = $this->connection->query("select * from " . $tblname);
        $tblcontents = $tblcontents->fetch_all(MYSQLI_ASSOC);
        if ($identifier !== null) {
            foreach ($tblcontents as $row) {
                if ($row[$identifier] === $data[$identifier]) {
                    return "Record already exists";
                }
            }
        }
        $query = "INSERT INTO $tblname (";
        foreach ($data as $key => $value) {
            $query = $query . $key;
            if ($key !== array_key_last($data)) {
                $query = $query . ",";
            } else {
                $query = $query . ") values (";
            }
        }
        foreach ($data as $key => $value) {
            $query = $query . "'" . $value . "'";
            if ($key !== array_key_last($data)) {
                $query = $query . ",";
            } else {
                $query = $query . ");";
            }
        }
        print_r($query);
        $this->connection->query($query);
        return "success";
    }
}
<?php
declare(strict_types=1);

class Dbconnect
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "smc";

    private $connection;
    private $dbconnection;


    public function __construct()
    {

    }
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
    public function createTable(): void
    {

        $existingtables = array();
        $query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$this->dbname'";
        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($existingtables, $row["TABLE_NAME"]);
            }
        }
        if (is_dir(__DIR__ . '/Schema')) {
            $files = scandir(__DIR__ . '/Schema');
            // print_r($files);
            foreach ($files as $file) {
                if ($file !== "." && $file !== "..") {
                    $json = file_get_contents(__DIR__ . '/Schema/' . $file);
                    $tblname = explode(".", $file)[0];
                    $data = json_decode($json, true);
                    $createquery = "create table if not exists ";
                    if (!in_array($tblname, $existingtables)) {
                        $table = $tblname;
                        $columns = "";
                        $counter = 0;
                        $col = $data[$table];
                        foreach ($col as $key => $value) {
                            $counter++;
                            if ($key === "FK") {
                                $columns = $columns . "FOREIGN KEY (" . $value["ref_field"] . ")" . " REFERENCES " .
                                    $value["ref_table"] . "(" . $value["ref_table_field"] . ")";
                            } else {
                                $columns = $columns . $key . " " . $value;
                            }
                            if ($counter < count($col)) {
                                $columns = $columns . ",";
                            }
                        }
                        if ($this->connection->query($createquery . $table . " (" . $columns . ")")) {
                            echo "Table $table created successfully";
                        } else {
                            echo "Error creating table: " . $this->connection->error;
                        }
                        ;
                    }

                }
            }
        }
    }

    public function insert(string $tblname, array $data, string $identifier = null): array
    {
        $tblcontents = $this->connection->query("select * from " . $tblname);
        $tblcontents = $tblcontents->fetch_all(MYSQLI_ASSOC);
        if ($identifier !== null) {
            foreach ($tblcontents as $row) {
                if ($row[$identifier] === $data[$identifier]) {
                    return ["type" => "email", "detail" => "exist"];
                }
            }
        }
        $query = "INSERT INTO $tblname (";
        foreach ($data as $key => $value) {
            $query = $query . "`" . $key . "`";
            if ($key !== array_key_last($data)) {
                $query = $query . ",";
            } else {
                $query = $query . ") values (";
            }
        }
        foreach ($data as $key => $value) {
            $query = $query . "'" . $this->connection->real_escape_string($value) . "'";
            if ($key !== array_key_last($data)) {
                $query = $query . ",";
            } else {
                $query = $query . ");";
            }
        }

        $this->connection->query($query);
        return ["type" => "success"];
    }

    public function update(string $tblname, array $data, string $identifier = null): array
    {
        $tblcontents = $this->connection->query("select * from " . $tblname);
        $identifier_data = $this->connection->real_escape_string($data["identifier"]);
        unset($data["identifier"]);
        $tblcontents = $tblcontents->fetch_all(MYSQLI_ASSOC);
        $query = "UPDATE $tblname SET ";
        foreach ($data as $key => $value) {
            $escaped_value = $this->connection->real_escape_string($value);
            $query = $query . $key . " = '" . $escaped_value . "'";
            if ($key !== array_key_last($data)) {
                $query = $query . ",";
            } else {
                $query = $query . " where " . $identifier . " = '" . $identifier_data . "';";
            }
        }
        $this->connection->query($query);
        return ["type" => "success"];
    }
    public function select_one(array $input, string $tblname)
    {
        $result = array();
        $query = "select * from $tblname where ";
        foreach ($input as $key => $value) {
            $query = $query . $key . " = '" . $value . "'";
            if ($key !== array_key_last($input)) {
                $query = $query . " and ";
            } else {
                $query = $query . ";";
            }
        }
        $result = $this->connection->query($query)->fetch_assoc();
        return $result;
    }
    public function select_all(string $tblname, array $fields = null, string $condition = null)
    {
        $query = "select ";
        if ($fields !== null) {
            for ($counter = 0; $counter < count($fields); $counter++) {
                if ($counter === 0) {
                    $query = $query . $fields[$counter] . ",";
                } else if ($counter === count($fields) - 1) {
                    $query = $query . $fields[$counter];
                } else {
                    $query = $query . $fields[$counter] . ",";
                }
            }
        } else {
            $query = $query . "*";
        }

        if ($condition !== null) {
            $query = $query . " from $tblname where $condition;";
        } else {
            $query = $query . " from $tblname;";
        }
        $result = $this->connection->query($query)->fetch_all(MYSQLI_ASSOC);
        return $result;

    }
    public function delete_one(string $tblname, array $input)
    {

        $query = "delete from $tblname where ";
        foreach ($input as $key => $value) {
            $query = $query . $key . " = '" . $value . "'";
            if ($key !== array_key_last($input)) {
                $query = $query . " and ";
            } else {
                $query = $query . ";";
            }
        }
        if ($this->connection->query($query)) {
            return ["type" => "success"];
        }
    }


}
<?php
abstract class DataBaseOperetor
{
    protected $db;

    public function __construct($host, $username, $password, $databasename)
    {
        $this->db = new mysqli($host, $username, $password);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
        //if not exists, creating new database for mybot
        $this->queryTreatment("CREATE DATABASE IF NOT EXISTS $databasename CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $this->db->select_db($databasename);
        //if not exists, creating new table : 'quastions and answers' and 'history' for mybot database.
        $this->queryTreatment("CREATE TABLE IF NOT EXISTS `qa` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `question` VARCHAR(1000) NOT NULL , `answer` VARCHAR(1000) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
        $this->queryTreatment("CREATE TABLE IF NOT EXISTS `history` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `rows` VARCHAR(1000) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB");

    }

    // mysqli query multi function treatment.
    protected function queryTreatment($query)
    {
        $queryResult = $this->db->query($query);
        $typeOfResult = gettype($queryResult);

        if ($typeOfResult == "boolean") {
            return $queryResult;
        } else {
            $returnArray = [];
            while ($row = $queryResult->fetch_assoc()) {
                array_push($returnArray, $row);
            }
            return $returnArray;
        }
    }

    //querys constructors for chatbot.
    protected function select($table_name, $columns = '*', $condition = 1)
    {
        return $this->queryTreatment("SELECT $columns FROM $table_name WHERE $condition");
    }

    protected function insert($table_name, $columns, $values)
    {
        return $this->queryTreatment("INSERT INTO $table_name ($columns) VALUES ('$values')");
    }

    protected function update($table_name, $columns, $values, $condition)
    {
        return $this->queryTreatment("UPDATE $table_name SET $columns='$values' WHERE $condition");
    }
    protected function delete($table_name, $condition)
    {
        return $this->queryTreatment("DELETE FROM $table_name WHERE $condition");
    }
    protected function truncate($table_name)
    {
        return $this->queryTreatment("TRUNCATE $table_name");
    }
}

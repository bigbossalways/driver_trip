<?php
require_once 'Connect.class.php';

class DataBaseClass
{
    public $conn;
    public $tableName;

    public function __construct($tableName)
    {
        $db = new ConnectClass();
        $this->conn = $db->connect();
        $this->tableName = $tableName;
    }

    public function insert($data)
    {
        $columns = implode(", ", array_map(fn($col) => "`$col`", array_keys($data)));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));
        $query = "INSERT INTO {$this->tableName} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->conn->prepare($query);
        try {
            return $stmt->execute(array_values($data));
        } catch (Exception $e) {
            die('Error Insert ' . $e->getMessage());
        }
    }


    public function lastInsertId()
    {
        try {
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            die('Error Retrive ID ' . $e->getMessage());
        }
    }



    public function updateinfo($data, $id, $columnName = 'id')
    {
        if (empty($columnName)) {
            $columnName = 'id';
        }

        $setPart = '';
        foreach ($data as $key => $value) {
            if ($key === 'order') {
                $setPart .= "`{$key}` = ?, ";
            } else {
                $setPart .= "{$key} = ?, ";
            }
        }
        $setPart = rtrim($setPart, ', ');

        $query = "UPDATE {$this->tableName} SET {$setPart} WHERE {$columnName} = ?";


        $stmt = $this->conn->prepare($query);
        try {
            if ($stmt->execute(array_merge(array_values($data), [$id]))) {
                return true;
            } else {
                if ($stmt->rowCount() === 0) {
                    echo "No rows updated. Check if the ID exists.";
                }
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function update($data, $id)
    {
        $set = "";
        foreach ($data as $column => $value) {
            $set .= "$column = ?, ";
        }
        $set = rtrim($set, ", ");
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET $set WHERE id = ?");
        return $stmt->execute(array_merge(array_values($data), [$id]));
    }


    public function delete($condition)
    {
        $query = "DELETE FROM {$this->tableName} WHERE {$condition}";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }

    public function getAll($Column = null, $value = null)
    {
        $query = "SELECT * FROM {$this->tableName}";





        if ($Column !== null) {
            $query .= " where :colmn = :value";
            $stmt = $this->conn->prepare($query,);
            //$stmt->bindParam(':colmn', $Column, PDO::PARAM_STR);

            $stmt->bindParam(":colmn", $Column);
            $stmt->bindParam(":value", $value);
            //$stmt->bindParam(':value', $value, PDO::PARAM_INT);
        }

        print $query;

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    public function getTotal($columnName = null, $value = null)
    {

        $query = "SELECT COUNT(*) AS total FROM {$this->tableName}";

        $params = [];
        if ($columnName && $value !== null) {
            $query .= " WHERE {$columnName} = :value";
            $params[':value'] = $value;
        }

        $stmt = $this->conn->prepare($query);

        if ($params) {
            foreach ($params as $key => $val) {
                $stmt->bindValue($key, $val);
            }
        }

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }


    public function readBy($column, $value, $condition = '1')
    {
        $query = "SELECT * FROM {$this->tableName} WHERE {$column} = ? AND {$condition}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getValuesByForeignKey($foreign_key)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE user_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $foreign_key, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }


    public function executeQuery($query, $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readAllOrdered($column, $direction = 'ASC')
    {
        $column = $this->sanitize($column);
        $direction = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';

        $query = "SELECT * FROM {$this->table} ORDER BY $column $direction";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    private function sanitize($column)
    {
        return preg_replace('/[^a-zA-Z0-9_]/', '', $column);
    }
}

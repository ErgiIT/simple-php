<?php

namespace App\Core\Database;

use Exception;
use PDO;

class QueryBuilder
{
    /**
     * The PDO instance.
     *
     * @var PDO
     */
    protected $pdo;

    /**
     * Create a new QueryBuilder instance.
     *
     * @param PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Select all records from a database table.
     *
     * @param string $table
     */
    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Execute a prepared statement with the given parameters.
     *
     * @param string $query
     * @param array $parameters
     * @return mixed
     */
    protected function execute($query, $parameters = [])
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute($parameters);

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }


    /**
     * Retrieve a record from the database table by ID.
     *
     * @param string $table
     * @param int $id
     * @return mixed
     */
    public function selectById($table, $id)
    {
        $query = "SELECT * FROM {$table} WHERE id = :id";
        $parameters = ['id' => $id];

        // Execute the query and fetch the record
        $result = $this->execute($query, $parameters);
        return $result ? $result[0] : null;
    }

    /**
     * Insert a record into a table.
     *
     * @param  string $table
     * @param  array  $parameters
     */
    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        } catch (Exception $e) {
            throw new Exception("Error inserting data into {$table}: " . $e->getMessage());        }
    }
    /**
     * Update a record in a table.
     *
     * @param  string $table
     * @param  int    $id
     * @param  array  $parameters
     */
    public function update($table, $id, $parameters)
    {
        $columns = array_map(function ($column) {
            return $column . ' = :' . $column;
        }, array_keys($parameters));

        $sql = sprintf(
            'UPDATE %s SET %s WHERE id = :id',
            $table,
            implode(', ', $columns)
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute(array_merge($parameters, ['id' => $id]));
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Delete a record from a table.
     *
     * @param  string $table
     * @param  int    $id
     */
    public function delete($table, $id)
    {
        $sql = sprintf(
            'DELETE FROM %s WHERE id = :id',
            $table
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute(['id' => $id]);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Execute a SELECT query with the given table and conditions.
     *
     * @param string $table
     * @param array $conditions
     * @return mixed
     */
    public function select($table, $conditions = [])
    {
        $query = "SELECT * FROM $table";
        $parameters = [];

        if (!empty($conditions)) {
            $query .= " WHERE ";
            $conditionsCount = count($conditions);
            $i = 0;

            foreach ($conditions as $column => $value) {
                $query .= "$column = ?";
                $parameters[] = $value;
                $i++;

                if ($i < $conditionsCount) {
                    $query .= " AND ";
                }
            }
        }

        return $this->execute($query, $parameters);
    }
}

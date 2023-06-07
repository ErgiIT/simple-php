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
}

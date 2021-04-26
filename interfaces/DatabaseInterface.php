<?php

interface DatabaseInterface{

    /**
     * @return bool
     */
    function connect();

    /**
     * @return void
     */
    function disconnect();

    /**
     * @param string $tableName
     * @param array $columns
     * @param array $values
     * @return mixed
     */
    function insert($tableName, $columns, $values);

    /**
     * @param string $tableName
     * @param array $conditions
     * @param array $columns
     * @param array $values
     * @return mixed
     */
    function update($tableName, $columns, $values, $conditions);

    /**
     * @param string $tableName
     * @param string $columns
     * @param array $conditions
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    function select($tableName, $columns,  $conditions, $limit, $offset);

    /**
     * @param string $tableName
     * @param array $conditions
     * @return mixed
     */
    function delete($tableName, $conditions);

    /**
     * @param string $tableName
     * @return array
     */
    function fetchFields($tableName);
}
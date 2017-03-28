<?php


class DB
{

    private $host;

    private $username;

    private $password;

    private $db;

    /**
     * @var mysqli
     */
    private $connection;

    /**
     * Table to fetch
     * @var
     */
    protected $table;

    /**
     * Contents the fields of the table
     * @var array
     */
    protected $fields = [];


    /**
     * Define if the table has timestamps or not
     * @var boolean
     */
    protected $timestamps = true;

    /**
     * define if the table has id
     * @var bool
     */
    protected $hasId = true;

    /**
     * Model constructor.
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $db
     * @param string $charset
     * @throws DBException
     */
    public function __construct(
        $host = '192.168.10.10',
        $username = 'homestead',
        $password = 'secret',
        $db = 'storytelling_db',
        $charset = 'UTF8'
    )
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;

        $this->connection = new mysqli( $host, $username, $password, $db );
        $this->connection->set_charset( $charset );
        if ( $this->connection == null )
            throw new DBException( "Connection is null" );
    }

    public function setTable( $table )
    {
        $this->table = $table;
    }

    /**
     * @return int
     */
    public function countNumFields()
    {
        return count( $this->fields );
    }

    /**
     * @param array $fields
     * @return array|null
     * @throws DBException
     */
    public function select( $fields = [] )
    {
        if ( $fields == [] )
            $fields = $this->fields;
        if ( !is_array( $fields ) )
            throw new DBException( '$fields Has to be an array' );

        $toReturn = implode( ',', $fields );
        $sql = 'SELECT ' . $toReturn . ' FROM ' . $this->table;

        $result = $this->executeQuery( $sql );
        return $result;
    }

    /**
     * @param $id
     * @return array|null
     * @throws DBException
     */
    public function find( $id )
    {
        if ( !is_int( $id ) || $id == null )
            throw new DBException( '$id has to be an Integer' );
        $sql = "SELECT * FROM $this->table WHERE `id` = $id";
        return $this->executeQuery( $sql );
    }

    public function where( $fieldName, $value, $table = '' )
    {
        if ( !is_string( $fieldName ) || $fieldName == null )
            throw new DBException( '$fieldName has to be a String' );
        if ( !is_string( $value ) || $value == null )
            throw new DBException( '$value has to be a String' );
        if ( $table != '' )
            $this->setTable( $table );
        $sql = "SELECT * FROM $this->table WHERE `$fieldName` = '$value'";
        return $this->executeQuery( $sql );
    }

    /**
     * Build an insert query and execute it
     * @param array $values
     * @return bool|mysqli_result
     * @throws DBException
     */
    public function insert( $values = [] )
    {
        if ( empty( $values ) ) {
            throw new DBException( '$values is empty' );
            return;
        }
        if ( !is_array( $values ) ) {
            throw new DBException( '$values has to be an array' );
            return;
        }
        if ( count( $values ) > $this->countNumFields() ) {
            throw new DBException( '$values has to many fields' );
            return;
        }
        $array = array();
        foreach ( $values as $index => $value ) {
            $array[ '`' . $index . '`' ] = '\'' . $value . '\'';
        }
        $keys = array_keys( $array );
        $sql = "INSERT INTO " . $this->table . ' ( ' . implode( ', ', $keys ) . ' ) VALUES ( ' . implode( ', ', $array ) . ' );';
        return $this->executeUpdate( $sql );
    }

    /**
     * @param $values
     * @param $id
     * @return bool|void
     * @throws DBException
     */
    public function update( $values, $id )
    {
        if ( $values == [] or empty( $values ) ) {
            throw new DBException( '$values should not be empty' );
            return;
        }
        if ( !is_array( $values ) ) {
            throw new DBException( '$values has to be an array' );
            return;
        }
        if ( count( $values ) > $this->countNumFields() ) {
            throw new DBException( '$values has to many fields' );
            return;
        }

        $array = array();
        foreach ( $values as $index => $value ) {
            $array[ '`' . $index . '`' ] = '`' . $index . '` = \'' . $value . '\'';
        }

        $sql = "UPDATE $this->table SET " . implode( ' & ', $array ) . ' WHERE `id` = ' . $id . ';';
        return $this->executeUpdate( $sql );
    }

    /**
     * @param $id
     * @throws DBException
     */
    public function destroy( $id )
    {
        if ( is_array( $id ) ) {
            foreach ( $id as $item ) {
                $sql = "DELETE FROM $this->table WHERE `id` = $item";
                $this->executeUpdate( $sql );
            }
            return;
        }
        if ( !is_int( $id ) | $id == null )
            throw new DBException( '$id has to be an Integer or an Array' );

        $sql = "DELETE FROM $this->table WHERE `id` = $id";
        $this->executeUpdate( $sql );
        return;
    }

    /**
     * @param $sql
     * @return array|null
     */
    private function executeQuery( $sql )
    {
        return mysqli_fetch_all( mysqli_query( $this->connection, $sql ) );
    }

    /**
     * @param $sql
     * @return bool
     */
    private function executeUpdate( $sql )
    {
        return $this->connection->query( $sql ) or die( 'Error on executeUpdate()<br /> ' . mysqli_error( $this->connection ) );
    }
}
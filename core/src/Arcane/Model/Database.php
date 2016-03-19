<?php

namespace Arcane\Model;

use PDO;    
use Illuminate\Database\Capsule\Manager as Capsule; 

class Database extends Capsule
{
    /**
     * [$pdo description]
     * @var [type]
     */
    private $pdo;

    /**
     * 
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return [type]
     */
    public function connect()
    {
        $config = include_once CONFIG_FILE;

        $driver =  $config['database'];

        $this->addConnection($driver);          

        $this->bootEloquent();

        $this->pdo = $this->getConnection()->getPdo();
    }   

    /**
     * @param  [type]
     * @param  [type]
     * @return [type]
     */
    public function select($statement, $values = null)
    {
        if ( $values == null ) {
            return $this->pdo->query($statement)->fetchAll(PDO::FETCH_ASSOC);
        }

        return $this->preparedQueries($statement, $values);
    } 


    /**
     *  Executa uma consulta no modo "prepare"
     *
     * @param string $statement
     * @param string $values
     * @return array
     */
    public function preparedQueries($statement, $values)
    {

        $drivers = array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY);

        $sth = $this->pdo->prepare($statement, $drivers);

        $sth->execute($values);

        return $sth->fetchAll(PDO::FETCH_ASSOC);    
    }

    /**
     * Execute a sql command
     * 
     * @param  string SQL command
     * @return bool
     */
    public function exec($sql)
    {
        return $this->pdo->exec($sql);
    }    
}
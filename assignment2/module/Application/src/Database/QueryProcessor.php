<?php

namespace Application\Database;

use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;

class QueryProcessor
{
    protected $sql;
    protected $adapter;

    /**
     * Table constructor.
     *
     * @param string $hostname
     * @param $database
     * @param $username
     * @param $password
     * @param string $driver
     */
    public function __construct($database, $username, $password, $hostname = 'tpc2017.cnd231jurlnn.us-west-2.rds.amazonaws.com',  $driver = 'Pdo_Mysql')
    {
        $this->adapter = new Adapter([
            'driver'   => $driver,
            'hostname' => $hostname,
            'username' => $username,
            'password' => $password,
            'database' => $database,
        ]);

        $this->sql = new Sql($this->adapter);
    }

    public function getPictures($num, $count)
    {
        /*
            select 
                pictures_id, 
                authors_firstName, 
                authors_lastName, 
                pictures_title, 
                pictures_description, 
                pictures_title 
            from pictures 
            join authors on pictures.authors_id = authors.authors_id;
        */

        $select;

        if(!isset($count) && !isset($num)){
            $select = $this->sql
                ->select()
                ->columns(['pictures_id',
                            'pictures_title',
                            'pictures_description', 
                            'pictures_title',
                            'pictures_filename',
                            //'authors_firstName',
                            //'authors_lastName'
                            ])
                ->from('pictures')
                //->join('authors', 'pictures.authors_id = authors.authors_id')
                ->limit(8)
                ;
        }
        else{
            $select = $this->sql
                ->select()
                ->columns(['pictures_id',
                            'pictures_title',
                            'pictures_description', 
                            'pictures_title',
                            'pictures_filename',
                            //'authors_firstName',
                            //'authors_lastName'
                            ])
                ->from('pictures')
                //->join('authors', 'pictures.authors_id = authors.authors_id')
                ->offset($num)
                ->limit($count)
            ;
        }

        $query = $this->sql->buildSqlString($select);

        return $this->adapter->query($query)->execute();
    }

    public function getComments($pictures_id)
    {
        /* 
           select comments_comment from comments where pictures_id = 1; 
        */
        $select = $this->sql
            ->select()
            ->columns(['comments_comment'])
            ->from('comments')
            ->where('pictures_id = '.$pictures_id.'');
        ;
            
        $query = $this->sql->buildSqlString($select);

        return $this->adapter->query($query)->execute();
    }
    
    
    public function searchPicture($searchString)
    {
        /*
        select pictures_id from pictures where pictures_title like '%second%';
        */

        $select = $this->sql
            ->select()
             ->columns(['pictures_id',
                            'pictures_title',
                            'pictures_description', 
                            'pictures_title',
                            'pictures_filename',
                            //'authors_firstName',
                            //'authors_lastName'
                            ])
            ->from('pictures')
            ->where('pictures_title like "'.$searchString.'"');
        ;
            
        $query = $this->sql->buildSqlString($select);

    }
    

}

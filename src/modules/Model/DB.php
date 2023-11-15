<?php
namespace Modules\Model;

// require $base_path . 'src\helpers.php';
class DB implements \Iterator
{
    private static $connection = null;
    private static $connection_count = 0;
    //Properties are related to Iterator
    private $query = null;
    private $record = false;


    function __construct()
    {
        function connect_to_db()
        {
            try {
                $conn_str = \Settings\DB_HOST .
                    \Settings\DB_NAME . 'charset=utf8';
                return new \PDO(
                    $conn_str,
                    \Settings\DB_USERNAME,
                    \Settings\DB_PASSWORD
                );

                //$conn_str -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            } catch (\PDOException $e) {
                exit("Connection failed " . $e->getMessage());
            }
        }
        if (!self::$connection)
            self::$connection = connect_to_db(); {
            self::$connection_count++;
        }
    }

    function __destruct()
    {
        self::$connection_count--;
        if (self::$connection_count == 0) {
            self::$connection = NULL;
        }
    }

    function run(string $sql, $params = false)
    {
        if ($this->query) {
            $this->query->closeCursor();
        }
        $this->query = self::$connection->prepare($sql);
        if ($params) {
            foreach ($params as $key => $value) {
                $k = is_int($key) ? $key + 1 : $key;
                switch (gettype($value)) {
                    case 'integer':
                        $type = \PDO::PARAM_INT;
                        break;
                    case 'boolean':
                        $type = \PDO::PARAM_BOOL;
                        break;
                    case 'NULL':
                        $type = \PDO::PARAM_NULL;
                        break;
                    default:
                        $type = \PDO::PARAM_STR;
                        break;
                }
                $this->query->bindValue($k, $value, $type);
            }
        }
        $this->query->execute();
    }


    function current()
    {
        return $this->record;
    }

    function key()
    {
        return 0;
    }

    function next()
    {
        $this->record = $this->query->fetch(\PDO::FETCH_ASSOC);
    }

    function rewind()
    {
        $this->record = $this->query->fetch(\PDO::FETCH_ASSOC);
    }

    function valid()
    {
        return $this->record !== FALSE;
    }

    function get_record(string $sql, $params = null)
    {
        $this->record = FALSE;
        $this->run($sql, $params);
        return $this->query->fetch(\PDO::FETCH_ASSOC);
    }
}
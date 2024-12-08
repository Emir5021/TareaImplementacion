<?php
class Database
{        
    private $_connection;
    private static $_instance;
    private $_host = "localhost";
    private $_username = "root";
    private $_password = "";
    private $_database = "desarrollo2024";

    public static function getInstance()
    {
        if (!self::$_instance) { 
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
        if (mysqli_connect_error()) {
            trigger_error("Failed to connect to MySQL: " . mysqli_connect_error(), E_USER_ERROR);
        }
    }

    public function __clone() { }

    public function getConnection()
    {
        return $this->_connection;
    }
     
    public function get_data($sql)
    {
        $ret = array('STATUS'=>'ERROR','ERROR'=>'','DATA'=>array());
        $mysqli = $this->getConnection();
        $res = $mysqli->query($sql);

        if ($res) {
            $ret['STATUS'] = "OK";
            while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                $ret['DATA'][] = $row;
            }
        } else {
            $ret['ERROR'] = mysqli_error($mysqli);
        }

        return $ret;
    }
     
    public function exec($sql)
    {
        $ret = array('STATUS'=>'ERROR','ERROR'=>'');
        $mysqli = $this->getConnection();
        $res = $mysqli->query($sql);

        if ($res)
            $ret['STATUS'] = "OK";
        else
            $ret['ERROR'] = mysqli_error();

        return $ret;
    }

    // Métodos para actualizar y eliminar registros
    public function update($id, $nombre, $apellido, $email, $telefono, $edad)
    {
        $sql = "UPDATE Alumnos SET Nombre = '$nombre', Apellido = '$apellido', Email = '$email', Telefono = '$telefono', Edad = '$edad' WHERE id = $id";
        return $this->exec($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM Alumnos WHERE id = $id";
        return $this->exec($sql);
    }
}
?>

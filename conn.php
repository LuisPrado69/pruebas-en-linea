<?php
$db_host     = "mach.com.ec";
$db_usuario  = "mach_mach";
$db_password = "Sistemas12.";
$db_nombre   = "mach_pruebasmach";

$conexion = mysql_connect($db_host, $db_usuario, $db_password) or die(mysql_error());
$db       = mysql_select_db($db_nombre, $conexion) or die(mys());

function get_campo($c, $t, $cb, $i)
{
    $q = mysql_query("select $c from $t where $cb=$i");
    if (mysql_num_rows($q) == 0) {
        return "";
    } else {
        $f = mysql_fetch_assoc($q);
        return $f[$c];
    }
}

function get_campoj($c, $t, $cb, $i, $ce, $e)
{
    $q = mysql_query("select $c from $t where $cb=$i and $ce=$e");
    if (mysql_num_rows($q) == 0) {
        return "";
    } else {
        $f = mysql_fetch_assoc($q);
        return $f[$c];
    }
}

mysql_query("SET NAMES 'utf8'");

//all the variables defined here are accessible in all the files that include this one
$con = new mysqli('mach.com.ec', 'mach_mach', 'Sistemas12.', 'mach_pruebasmach') or die("Could not connect to mysql" . mysqli_error($con));

//DB details
$dbHost     = 'mach.com.ec';
$dbUsername = 'mach_mach';
$dbPassword = 'Sistemas12.';
$dbName     = 'mach_pruebasmach';

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("No se puede conectar a la base de datos: " . $db->connect_error);
}

class Database
{

    private $host     = "mach.com.ec";
    private $db_name  = "mach_pruebasmach";
    private $username = "mach_mach";
    private $password = "Sistemas12.";
    public $conn;

    public function dbConnection()
    {

        $this->conn = null;
        try
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
<?php

class Database {

    private $_dbname, $_dbhost, $_dbuser, $_dbpasswd, $_connection_status;
    public $_dblink;
    public $save_queries = false; //Asignar a true si se desea obtener la bitacora de los SQL ejecutados
    public $arr_queries = array();
    private $_numRows, $_numCols, $_affectedRows, $_lastError, $_lastOid;
    private $_pathlog;

    function __construct() {
        
    }

    function __destruct() {
        $this->close($this->_dblink);
    }

    public function getNumRows() {
        return $this->_numRows;
    }

    public function getNumCols() {
        return $this->_numCols;
    }

    public function getAffectedRows() {
        return $this->_affectedRows;
    }

    public function getLastError() {
        return $this->_lastError;
    }

    public function getLastOID() {
        return $this->_lastOid;
    }

    /*
     * Obtener la conexion a la BD
     * @access public
     * return enlace conexion BD
     */

    public function getConexion() {
        return $this->_dblink;
    }

    public function query($sql) {
        $result = false;
        if (is_resource($this->_dblink) && !is_null($this->status())) {
            $result = mysql_query($sql, $this->_dblink);
            if ($this->save_queries) {
                $this->arr_queries[] = $sql;
            }

            if ($result == true) {
                $this->_numRows = mysql_num_rows($result);
                $this->_numCols = mysql_num_fields($result);
                $this->_affectedRows = mysql_affected_rows();
                $this->_lastOid = 0;
                $this->_lastError = null;
            } else {
                $this->_lastError = mysql_error();
                $this->_numRows = null;
                $this->_numCols = null;
                $this->_affectedRows = null;
                $this->_lastOid = null;
            }
        }
        return $result;
    }

    public function fetch_assoc($result) {
        return mysql_fetch_assoc($result);
    }

    public function fetch_array($result) {
        return mysql_fetch_array($result);
    }

    public function field_name($result) {
        $arr = array();
        for ($i = 0; $i < $this->getNumCols(); $i++) {
            $arr[] = mysql_field_name($result, $i);
        }
        return $arr;
    }

    /**
     * Metodo que setea los datos de conexion a la BD
     * @access public
     * @param string $dbhost Nombre o IP del host de la BD
     * @param string $dbname Nombre BD
     * @param string $dbuser Usuario de BD
     * @param string $dbpasswd Clave usuario BD
     * @return boolean {true|false}
     */
    public function setParametrosBD($dbhost, $dbname, $dbuser, $dbpasswd) {
        $this->_dbhost = $dbhost;
        $this->_dbname = $dbname;
        $this->_dbuser = $dbuser;
        $this->_dbpasswd = $dbpasswd;
        return $this->connect();
    }

    /**
     * Funcion que retorna un boolean dependiendo si pudo o no conectarse a la BD
     * en base a las configuraciones que fueron seteadas en el metodo setParametrosBD
     * @access private
     * @return boolean
     */
    private function connect() {
        $this->_dblink = mysql_connect($this->_dbhost , $this->_dbuser, $this->_dbpasswd);
        if ($this->_dblink) {
            mysql_select_db($this->_dbname, $this->_dblink);
            $this->_connection_status = mysql_stat($this->_dblink);
            return true;
        }
        return false;
    }

    private function status() {
        return mysql_stat($this->_dblink);
    }

    /**
     * Ejecuta una sentencia SQL
     * @access private
     * @param string $tSql Cadena SQL a ser ejecutada
     * @return resource $res
     */
    private function _query($tSql) {
        $res = false;

        if (is_resource($this->_dblink) && !is_null($this->status())) {
            $res = mysql_query($tSql, $this->_dblink);
        }
        return $res;
    }

    /*
     * Permite ejecutar sentencias SQL SELECT y obtiene los registros en un array asociativo
     * @access public
     * @param string $tSql Cadena SQL a ser ejecutada
     * @return array asociativo si el SQL tuvo exito, boolean si hubo algun problema $result
     */

    public function select($tSql) {
        $result = false;
        $res = $this->_query($tSql);

        if (!is_bool($res)) {
            $result = array();
            while ($row = mysql_fetch_assoc($res)) {
                $result[] = $row;
            }
            mysql_free_result($res);
        } else {
            $php = $_SERVER["PHP_SELF"];
            error_log(date("Y-m-d H:i:s") . " [/home/lib/db.php] [$php] [$tSql] [" . mysql_error($this->_dblink) . "]\n", 3, $this->_pathlog);
        }
        return $result;
    }

    /**
     * Retorna el ultimo query ejecutado
     * @access	public
     * @return	false si no existe sentencias sql ejecutas, caso contrario retorna la mas reciente
     */
    public function last_query() {
        return end($this->arr_queries);
    }

    /**
     * Cierra la conexion a la BD
     */
    private function close() {
        if (!empty($this->_dblink)) {
            mysql_close($this->_dblink);
            unset($this->_dblink);
        }
    }

}

?>
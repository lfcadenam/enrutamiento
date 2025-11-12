<?php

namespace App\Models;
use mysqli;

class Model
{
    // Base model functionality
    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;

    protected $conexion;
    protected $query;
    protected $table;

    public function __construct()
    {
        $this->conectar();
    }

    public function conectar()
    {
        $this->conexion = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if ($this->conexion->connect_error) {
            die('Error de conexión: ' . $this->conexion->connect_error);
        }

        
    }

    public function query($sql)
    {        
        $this->query = $this->conexion->query($sql);                
        return $this;
    }

    public function first()
    {
        return $this->query->fetch_assoc();        
    }

    public function get()
    {
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    //consultas
    public function all(){        
        $sql = "select * from {$this->table}";
        return $this->query($sql)->get();
    }

    public function find($id){        
        $sql = "select * from {$this->table} where id_venta = {$id}";
        return $this->query($sql)->first();
    }

    public function where($columna, $operador, $valor){  
        if($operador == null){
            $operador = '=';   
        }      
        $value = $this->conexion->real_escape_string($valor);
        $sql = "select * from {$this->table} where {$columna} {$operador} '{$valor}'";
        $this->query($sql);

        return $this;
    }
}
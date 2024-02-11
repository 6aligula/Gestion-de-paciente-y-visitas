<?php

class Paciente
{
    private $id;
    private $nombre;
    private $direccion;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function __construct($id, $nombre, $direccion)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
    }

    public function toString()
    {
        return $this->id . ", " . $this->nombre . ", " . $this->direccion;
    }
}

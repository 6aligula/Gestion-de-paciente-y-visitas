<?php
class Visita {
    public $paciente;
    public $fecha;
    public $importe;
    public $pagada;

    public function getPaciente() {
        return $this->paciente;
    }

    public function setPaciente($paciente) {
        $this->paciente = $paciente;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getImporte() {
        return $this->importe;
    }

    public function setImporte($importe) {
        $this->importe = $importe;
    }

    public function getActiveImage()
	{
		return $this->pagada == 'True' ? 'img05.gif' : 'img06.gif';
	}

    public function setPagada($pagada) {
            $this->pagada = $pagada;
       
    }
    

    public function __construct($paciente, $fecha, $importe, $pagada) {
        $this->paciente = $paciente;
        $this->fecha = $fecha;
        $this->importe = $importe;
        $this->pagada = $pagada;
    }

    public function toString() {
        return $this->paciente . "," . $this->fecha . "," . $this->importe . "," . ($this->pagada ? "Sí" : "No");
    }

}

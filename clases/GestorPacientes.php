<?php
class GestorPacientes {
    private $pacientes = [];

    // persist data
    public function guardarPacientes() {
        $file = fopen("pacientes.csv", "w");
        foreach ($this->pacientes as $paciente) {
            fputcsv($file, [$paciente->getId(), $paciente->getNombre(), $paciente->getDireccion()]);
        }
        fclose($file);
    }

    // load data
    public function cargarPacientes($archivo) {
        if (!file_exists($archivo) || !is_readable($archivo)) {
            return false; // Archivo no existe o no se puede leer
        }

        $file = fopen($archivo, "r");
        while (($element = fgetcsv($file)) !== false) {
            array_push(
                $this->pacientes,
                new Paciente(...$element)
            );
        }
        fclose($file);
    }

    public function getPacientebyId($id){
		foreach ($this->pacientes as $paciente) {
			if ($paciente->getId() == $id) {
				return $paciente;
			}
		}
		return null; // Retornar null si el cliente no se encuentra
	}

    public function agregarPaciente($datosPaciente) {
        // Crear un nuevo objeto Paciente con los datos recibidos
        $nuevoPaciente = new Paciente($datosPaciente['id'], $datosPaciente['nombre'], $datosPaciente['direccion']);
        array_push($this->pacientes, $nuevoPaciente);
        $this->guardarPacientes(); // Guardar cambios
    }

    public function DeleteById($id) {
        foreach ($this->pacientes as $key => $paciente) {
            if ($paciente->getId() == $id) {
                unset($this->pacientes[$key]);

            }
        }
        $this->guardarPacientes(); // Guardar cambios
    }

	public function update($datos) {
        //var_dump($datos);
        foreach ($this->pacientes as $pacient) {
            if ($pacient->getId() == $datos["id_original"]) {
                $pacient->setId($datos["id_paciente"]);
                $pacient->setNombre($datos["nombre"]);
                $pacient->setDireccion($datos["direccion"]);
            }
        }
        $this->guardarPacientes(); // Guardar los cambios en el archivo CSV
    }

    public function visualizarPacientes() {
        $html = '';

        foreach ($this->pacientes as $paciente) {
            
            $html .= "<tr>";
            $html .= '<td><a href="verVisitasPorPaciente.php?pacienteId=' . htmlspecialchars($paciente->getId()) . '">' . htmlspecialchars($paciente->getId()) . '</a></td>';
            $html .= '<td>' . htmlspecialchars($paciente->getNombre()) . '</td>';
            $html .= '<td>' . htmlspecialchars($paciente->getDireccion()) . '</td>';
            // Añadir la columna de acciones si es necesario
            $html .= '<td>';
            $html .= '<a href="Delete_paciente.php?paciente=' . $paciente->getId() . '"><img src="del_icon.png" alt="Eliminar" width="30" height="30"></a>';
            $html .= '<a href="edit_paciente.php?paciente=' . $paciente->getId() . '"><img src="edit_icon.png" alt="Editar" width="30" height="30"></a>';
            $html .= '</td>';

            $html .= '</tr>';
        }
        return $html;
    }
}

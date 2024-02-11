<?php
class GestorPacientes {
    private $pacientes = [];

    public function cargarPacientes($archivo) {
        if (!file_exists($archivo) || !is_readable($archivo)) {
            return false; // Archivo no existe o no se puede leer
        }

        $file = fopen($archivo, "r");
        while (($line = fgetcsv($file)) !== false) {
            $this->pacientes[] = new Paciente(...$line);
        }
        fclose($file);
    }

    public function guardarPacientes($archivo) {
        $file = fopen($archivo, "w");
        foreach ($this->pacientes as $paciente) {
            fputcsv($file, [$paciente->getId(), $paciente->getNombre(), $paciente->getDireccion()]);
        }
        fclose($file);
    }

    public function agregarPaciente($paciente) {
        $this->pacientes[] = $paciente;
        $this->guardarPacientes('pacientes.csv'); // Guardar cambios
    }

    public function eliminarPacientePorId($id) {
        foreach ($this->pacientes as $key => $paciente) {
            if ($paciente->getId() == $id) {
                unset($this->pacientes[$key]);
                $this->pacientes = array_values($this->pacientes); // Reindexar el array
                break;
            }
        }
        $this->guardarPacientes('pacientes.csv'); // Guardar cambios
    }

    public function modificarPaciente($id, $nuevoNombre, $nuevaDireccion) {
        foreach ($this->pacientes as $paciente) {
            if ($paciente->getId() == $id) {
                $paciente->setNombre($nuevoNombre);
                $paciente->setDireccion($nuevaDireccion);
                break;
            }
        }
        $this->guardarPacientes('pacientes.csv'); // Guardar cambios
    }

    public function visualizarPacientes() {
        $html = '';

        foreach ($this->pacientes as $paciente) {
            
            $html .= "<tr>";
            $html .= '<td>' . htmlspecialchars($paciente->getId()) . '</td>';
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

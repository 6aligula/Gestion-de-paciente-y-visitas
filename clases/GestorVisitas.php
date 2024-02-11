<?php
class GestorVisitas
{
    public $visitas = [];

    public function persist()
    {
        $file = fopen("data_1.csv", "w");
        // Opcionalmente, puede escribir los encabezados aquí
        // fputcsv($file, ["Paciente", "Fecha", "Importe", "Pagada"]);
        foreach ($this->visitas as $visita) {
            fputcsv($file, [$visita->getPaciente(), $visita->getImporte(), $visita->getFecha(), $visita->getPagada()]);
        }
        fclose($file);
    }

    public function loadData($fichero)
    {
        $gestor = fopen($fichero, "r");
        // Si tu CSV tiene una cabecera, esta línea la lee y descarta
        // $headers = fgetcsv($gestor);
        while (($element = fgetcsv($gestor)) !== false) {
            //$pagada = $element[3] === "Sí" ? true : false;
            //echo "Cargando: {$element[0]}, Pagada: {$element[3]}, Interpretación: {$pagada}<br>";
            array_push(
                $this->visitas,
                new Visita(...$element)
            );
        }
        
        fclose($gestor);
    }

    public function agregarVisita($visita)
    {
        array_push($this->visitas, $visita);
        $this->persist(); // Guardar cambios
    }

    public function drawList()
    {
        $html = '';

        foreach ($this->visitas as $visita) {
            // Clases adicionales según el importe y si está pagada
            $classPagada = $visita->getPagada() == 'True' ? 'visita-pagada' : 'visita-no-pagada';
            $classImporte = $visita->getImporte() > 250 ? 'importe-alto' : '';
            
            $html .= "<tr class='$classPagada $classImporte'>";
            $html .= '<td>' . htmlspecialchars($visita->paciente) . '</td>';
            $html .= '<td>' . number_format($visita->importe, 2, ',', '.') . ' €</td>';
            $html .= '<td>' . htmlspecialchars($visita->fecha) . '</td>';
            $html .= '<td><img src="' . $visita->getActiveImage() . '" alt="' . ($visita->pagada == 'True' ? 'Active' : 'Inactive') . '"></td>';

            // Añadir la columna de acciones si es necesario
            $html .= '<td>';
            $html .= '<a href="Delete_visita.php?paciente=' . $visita->getPaciente() . '"><img src="del_icon.png" alt="Eliminar" width="30" height="30"></a>';
            $html .= '<a href="edit.php?paciente=' . $visita->getPaciente() . '"><img src="edit_icon.png" alt="Editar" width="30" height="30"></a>';
            $html .= '</td>';

            $html .= '</tr>';
        }
        return $html;
    }

    
    public function deleteByPaciente($nombrePaciente) {
        foreach ($this->visitas as $key => $visita) {
            if ($visita->getPaciente() == $nombrePaciente) {
                unset($this->visitas[$key]);
                break;
            }
        }
        $this->persist(); // Guardar los cambios después de eliminar
    }

    public function getPacientebyName($id){
		foreach ($this->visitas as $visita) {
			if ($visita->getPaciente() == $id) {
				return $visita;
			}
		}
		return null; // Retornar null si el cliente no se encuentra
	}
    
	public function update($datos) {
        //var_dump($datos);
        foreach ($this->visitas as $visit) {
            if ($visit->getPaciente() == $datos["id_original"]) {
                $visit->setPaciente($datos["paciente"]);
                $visit->setImporte($datos["importe"]);
                $visit->setFecha($datos["fecha"]);
                $visit->setPagada($datos["pagada"]);
                // Asegúrate de actualizar todos los campos necesarios
            }
        }
        $this->persist(); // Guardar los cambios en el archivo CSV
    }

	public function insert($datos) {
		// Crear un nuevo ID único para el nuevo cliente, esto es opcional y depende de tu implementación
		$newVisit = new Visita($datos["paciente"], $datos["importe"], $datos["fecha"], $datos["pagada"]);
		array_push($this->visitas, $newVisit);
		$this->persist(); // Guardar los cambios en el archivo CSV
	}

    public function drawListByPacienteId($pacienteId) {
        $html = '';
    
        foreach ($this->visitas as $visita) {
            if ($visita->getPaciente() == $pacienteId) {
                // Clases adicionales según el importe y si está pagada
                $classPagada = $visita->getPagada() == 'True' ? 'visita-pagada' : 'visita-no-pagada';
                $classImporte = $visita->getImporte() > 250 ? 'importe-alto' : '';
    
                $html .= "<tr class='$classPagada $classImporte'>";
                $html .= '<td>' . htmlspecialchars($visita->getPaciente()) . '</td>';
                $html .= '<td>' . number_format($visita->getImporte(), 2, ',', '.') . ' €</td>';
                $html .= '<td>' . htmlspecialchars($visita->getFecha()) . '</td>';
                $html .= '<td>' . ($visita->getPagada() == 'True' ? 'Sí' : 'No') . '</td>';
                $html .= '</tr>';
            }
        }
    
        $html .= '</table>';
        return $html;
    }
    
}

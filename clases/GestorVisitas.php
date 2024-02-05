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
            fputcsv($file, [$visita->paciente, $visita->fecha, $visita->importe, $visita->pagada ? "Sí" : "No"]);
        }
        fclose($file);
    }

    public function loadData($fichero)
    {
        $gestor = fopen($fichero, "r");
        // Si tu CSV tiene una cabecera, esta línea la lee y descarta
        // $headers = fgetcsv($gestor);
        while (($element = fgetcsv($gestor)) !== false) {
            $pagada = $element[3] === "Sí" ? true : false;
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
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($visita->paciente) . '</td>';
            $html .= '<td>' . number_format($visita->importe, 2, ',', '.') . ' €</td>';
            $html .= '<td>' . htmlspecialchars($visita->fecha) . '</td>';
            $html .= '<td><img src="' . $visita->getActiveImage() . '" alt="' . ($visita->pagada == 'True' ? 'Active' : 'Inactive') . '"></td>';

            // Añadir la columna de acciones si es necesario
            // $html .= '<td>';
            // $html .= '<a href="delete_visita.php?paciente=' . urlencode($visita->paciente) . '"><img src="del_icon.png" alt="Eliminar" width="30" height="30"></a>';
            // $html .= '<a href="edit_visita.php?paciente=' . urlencode($visita->paciente) . '"><img src="edit_icon.png" alt="Editar" width="30" height="30"></a>';
            // $html .= '</td>';

            $html .= '</tr>';
        }
        return $html;
    }


    // public function mostrarVisitas() {
    //     foreach ($this->visitas as $visita) {
    //         echo $visita->toString() . "<br>";
    //     }
    // }
}

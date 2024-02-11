<?php
require_once "./clases/GestorVisitas.php";
require_once "./clases/Visita.php"; // Asegúrate de incluir también la clase Empresa

$objetoVisitas = new GestorVisitas();
$objetoVisitas->loadData("data_1.csv"); // Carga los datos antes de intentar eliminar

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Llamar al método insert de Cartera con los datos enviados por POST
    $objetoVisitas->insert($_POST);
    header("Location: index.php"); // Redireccionar
    exit; // Asegurar que el script se detiene después de la redirección
}

?>

<form method="post" action="create.php">
    <div>
        <label for="paciente">Paciente:</label>
        <input type="text" id="paciente" name="paciente">
    </div>
    <div>
        <label for="importe">Importe:</label>
        <input type="importe" id="importe" name="importe">
    </div>
    <div>
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha">
    </div>
    <div>
        <label for="pagado">Pagado:</label>
        <select id="pagado" name="pagada">
            <option value="True" >Sí</option>
            <option value="False">No</option>
        </select>
    </div>
    <button type="submit">Añadir</button>
</form>
<?php
require_once "./clases/GestorPacientes.php";
require_once "./clases/Paciente.php"; // Asegúrate de incluir también la clase Empresa

$objetoPacientes = new GestorPacientes();
$objetoPacientes->cargarPacientes("pacientes.csv"); // Carga los datos antes de intentar eliminar

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Llamar al método agregarPaciente de Cartera con los datos enviados por POST
    $objetoPacientes->agregarPaciente($_POST);
    header("Location: ListaPacientes.php"); // Redireccionar
    exit; // Asegurar que el script se detiene después de la redirección
}

?>

<form method="post" action="createPatient.php">
    <div>
        <label for="id">ID Paciente:</label>
        <input type="text" id="id" name="id">
    </div>
    <div>
        <label for="nombre">Nombre:</label>
        <input type="nombre" id="nombre" name="nombre">
    </div>
    <div>
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion">
    </div>

    <button type="submit">Añadir</button>
</form>
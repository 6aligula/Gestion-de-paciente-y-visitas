<?php
require_once "./clases/GestorPacientes.php";
require_once "./clases/Paciente.php"; // Asegúrate de incluir también la clase Empresa

$objetoPacientes = new GestorPacientes();
$objetoPacientes->cargarPacientes("pacientes.csv"); // Carga los datos antes de intentar eliminar

// Recuperar el ID del cliente desde GET
$id = isset($_GET['paciente']) ? $_GET['paciente'] : null;

// Intentar recuperar el cliente con ese ID
$paciente = $objetoPacientes->getPacientebyId($id);

// Verificar si el formulario ha sido enviado
if (count($_POST) > 0) {
    // Llamar al método modificarPaciente de Cartera con los datos enviados por POST
    $objetoPacientes->update($_POST);
    header("location: ListaPacientes.php"); // Redireccionar
}

// Mostrar el formulario si no se ha enviado o si es la primera carga de la página
?>

<form id="form_x" class="class_x" method="post" action="edit_paciente.php?paciente=<?= $id ?>">
    <input type="hidden" name="id_original" value="<?= $id ?>">
    <div>
        <label for="id_paciente">Id Paciente:</label>
        <input type="text" id="id_paciente" name="id_paciente" value="<?= $paciente->getId(); ?>">
    </div>
    <div>
        <label for="nombre">Nombre:</label>
        <input type="nombre" id="nombre" name="nombre" value="<?= $paciente->getNombre(); ?>">
    </div>
    <div>
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?= $paciente->getDireccion(); ?>">
    </div>

    <button type="submit">Guardar</button>
</form>


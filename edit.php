<?php
require_once "./clases/GestorVisitas.php";
require_once "./clases/Visita.php"; // Asegúrate de incluir también la clase Empresa

$objetoVisitas = new GestorVisitas();
$objetoVisitas->loadData("data_1.csv"); // Carga los datos antes de intentar eliminar

// Recuperar el ID del cliente desde GET
$id = isset($_GET['paciente']) ? $_GET['paciente'] : null;

// Intentar recuperar el cliente con ese ID
$paciente = $objetoVisitas->getPacientebyName($id);

// Verificar si el formulario ha sido enviado
if (count($_POST) > 0) {
    // Llamar al método update de Cartera con los datos enviados por POST
    $objetoVisitas->update($_POST);
    header("location: index.php"); // Redireccionar
}

// Mostrar el formulario si no se ha enviado o si es la primera carga de la página
?>

<form id="form_x" class="class_x" method="post" action="edit.php?paciente=<?= $id ?>">
    <input type="hidden" name="id_original" value="<?= $id ?>">
    <div>
        <label for="paciente">Paciente:</label>
        <input type="text" id="paciente" name="paciente" value="<?= $paciente->getPaciente(); ?>">
    </div>
    <div>
        <label for="importe">Importe:</label>
        <input type="importe" id="importe" name="importe" value="<?= $paciente->getImporte(); ?>">
    </div>
    <div>
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" value="<?= $paciente->getFecha(); ?>">
    </div>
    <div>
        <label for="pagado">Pagado:</label>
        <select id="pagado" name="pagada">
            <option value="True" <?= $paciente->getPagada() == 'True' ? 'selected' : '' ?>>Sí</option>
            <option value="False" <?= $paciente->getPagada() == 'False' ? 'selected' : '' ?>>No</option>
        </select>
    </div>
    <button type="submit">Guardar</button>
</form>


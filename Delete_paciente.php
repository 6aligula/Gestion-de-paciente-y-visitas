<?php
require_once "./clases/GestorPacientes.php";
require_once "./clases/Paciente.php"; // Asegúrate de incluir también la clase Empresa

$objetoPacientes = new GestorPacientes();
$objetoPacientes->cargarPacientes("pacientes.csv"); // Carga los datos antes de intentar eliminar

// Verificar si se pasó el nombre del paciente en la URL

$objetoPacientes->DeleteById(isset($_GET['paciente']) ? $_GET['paciente'] : null); // Eliminar la visita



header("location: ListaPacientes.php");
exit();
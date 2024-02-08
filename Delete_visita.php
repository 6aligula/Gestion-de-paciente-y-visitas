<?php
require_once "./clases/GestorVisitas.php";
require_once "./clases/Visita.php"; // Asegúrate de incluir también la clase Empresa

$objetoVisitas = new GestorVisitas();
$objetoVisitas->loadData("data_1.csv"); // Carga los datos antes de intentar eliminar

// Verificar si se pasó el nombre del paciente en la URL

$objetoVisitas->deleteByPaciente(isset($_GET['paciente']) ? $_GET['paciente'] : null); // Eliminar la visita



header("location: index.php");
exit();
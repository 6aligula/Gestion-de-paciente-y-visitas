<?php

require_once "Autoloader.php";

$objetoVisitas = new GestorVisitas();
$objetoVisitas->loadData("data_1.csv");

$objetoPacientes = new GestorPacientes();
$objetoPacientes->cargarPacientes("pacientes.csv");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DAW Advertising</title>
	<style>
		table.redTable {
			border: 2px solid #A40808;
			background-color: #EEE7DB;
			width: 100%;
			text-align: center;
			border-collapse: collapse;
		}

		table.redTable td,
		table.redTable th {
			border: 1px solid #AAAAAA;
			padding: 3px 2px;
		}

		table.redTable tbody td {
			font-size: 13px;
		}

		table.redTable thead {
			background: #A40808;
		}

		table.redTable thead th {
			font-size: 19px;
			font-weight: bold;
			color: #FFFFFF;
			text-align: center;
			border-left: 2px solid #A40808;
		}

		table.redTable thead th:first-child {
			border-left: none;
		}

		table.redTable tfoot {
			font-size: 13px;
			font-weight: bold;
			color: #FFFFFF;
			background: #A40808;
		}

		table.redTable tfoot td {
			font-size: 13px;
		}

		table.redTable tfoot .links {
			text-align: right;
		}

		table.redTable tfoot .links a {
			display: inline-block;
			background: #FFFFFF;
			color: #A40808;
			padding: 2px 8px;
			border-radius: 5px;
		}

		.vip {
			font-weight: bolder;
			color: blue;
		}

		.visita-pagada {
			background-color: lightgreen;
			/* Verde claro para visitas pagadas */
		}

		.visita-no-pagada {
			background-color: orange;
			/* Rojo claro para visitas no pagadas */
		}

		.importe-alto {
			font-weight: bold;
			/* Negrita para importes altos */
			color: #004085;
			/* Cambiar el color del texto si prefieres */
		}
	</style>
</head>

<body>
	<table class="redTable">
		<thead>
			<tr>
				<th>Paciente</th>
				<th>Importe</th>
				<th>Fecha</th>
				<th>Pagado</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="5">
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?= $objetoVisitas->drawList() ?>
		</tbody>
	</table>
	<br>
	<div>
		<a href="create.php" class="btn btn-primary">Añadir Visita</a>
	</div>
	<br>
	<div>
		<a href="ListaPacientes.php" class="btn btn-primary">Listado de pacientes</a>
	</div>


</body>

</html>
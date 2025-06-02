<?php
/*
Controlador que realiza la descarga de un reporte con los datos medicos del usuario
*/
require '../config/conexion.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

// Cargar plantilla
$spreadsheet = IOFactory::load('../documentation/Excel/Libro1.xlsx');

// Seleccionar la hoja activa
$sheet = $spreadsheet->getActiveSheet();

 
if (!isset($_GET['matricula'])) {
    echo "No se ha proporcionado una matrícula.";
    exit;
}

// Obtener los datos del usuario a traves de la matricula
//consulta a la base de datos
$matricula = $_GET['matricula']; // Cambia esto por la matricula que necesites

$sql = "SELECT P.nombre, 
P.matricula,
P.apellido_paterno, 
P.apellido_materno, 
P.fecha_nacimiento, 
P.genero, 
P.tipo_sangre, 
P.contacto_emergencia_nombre,
P.contacto_emergencia_telefono,
P.contacto_emergencia_relacion,
H.alergias,
H.enfermedades,
H.cirugias,
H.medicacion,
H.discapacidad,
S.aseguradora,
S.numero_poliza,
S.hospital_referencia
FROM personas P
INNER JOIN historialmedico H
ON P.matricula = H.matricula
INNER JOIN seguromedico S
ON P.matricula = S.matricula
WHERE P.matricula = :matricula";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $fila) {
    
    $nombre = $fila['nombre'];
    $matricula = $fila['matricula'];
    $apellido_paterno = $fila['apellido_paterno'];
    $apellido_materno = $fila['apellido_materno']; 
    $fecha_nacimiento = $fila['fecha_nacimiento'];
    $genero = $fila['genero'];
    $tipo_sangre = $fila['tipo_sangre'];
    $contacto_emergencia_nombre = $fila['contacto_emergencia_nombre'];
    $contacto_emergencia_telefono = $fila['contacto_emergencia_telefono'];
    $contacto_emergencia_relacion = $fila['contacto_emergencia_relacion'];
    $alergias = $fila['alergias'];
    $enfermedades = $fila['enfermedades'];
    $cirugias = $fila['cirugias'];
    $medicacion = $fila['medicacion'];
    $discapacidad = $fila['discapacidad'];
    $aseguradora = $fila['aseguradora'];
    $numero_poliza = $fila['numero_poliza'];
    $hospital_referencia = $fila['hospital_referencia'];

}

$logoTecnologico = '../assets/img/Logo.jpeg';

// Verificar si existe la imagen
if (file_exists($logoTecnologico)) {
    $drawing = new Drawing();
    $drawing->setName('Foto');
    $drawing->setDescription('Foto del usuario');
    $drawing->setPath($logoTecnologico); // Ruta local
    $drawing->setHeight(130); // Altura en píxeles
    $drawing->setCoordinates('B1'); // Celda donde se insertará la imagen
    $drawing->setWorksheet($sheet);
}

// Insertar datos en las celdas deseadas (ajusta según tu plantilla)
$sheet->setCellValue('B8', $nombre);
$sheet->setCellValue('B10', $matricula);
$sheet->setCellValue('F8', $apellido_paterno);
$sheet->setCellValue('I8', $apellido_materno);
$sheet->setCellValue('F10', $fecha_nacimiento);
$sheet->setCellValue('J10', $genero);
$sheet->setCellValue('I10', $tipo_sangre);
$sheet->setCellValue('B14', $contacto_emergencia_nombre);
$sheet->setCellValue('I14', $contacto_emergencia_telefono);
$sheet->setCellValue('B16', $contacto_emergencia_relacion);
$sheet->setCellValue('G21', $alergias);
$sheet->setCellValue('B21', $enfermedades);
$sheet->setCellValue('B26', $cirugias);
$sheet->setCellValue('G26', $medicacion);
$sheet->setCellValue('B31', $discapacidad);
$sheet->setCellValue('B40', $aseguradora);
$sheet->setCellValue('I37', $numero_poliza);
$sheet->setCellValue('B37', $hospital_referencia);
// Guardar el archivo en la ruta deseada


// Preparar descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="formato_emergencia_'.$matricula.'.xlsx"');
header('Cache-Control: max-age=0');

// Crear archivo en la salida
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

header($_SERVER['HTTP_REFERER']);
exit;

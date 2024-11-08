<?php
// El archivo
$nombre_archivo = '/fotos_patios/MAD/MSMU7274524/2103151006803/LN0004.jpg';
$Nombrefinal = '/fotos_patios/MAD/MSMU7274524/2103151006803/LN00041.jpg';
$porcentaje = 0.5;

// Tipo de contenido
header('Content-Type: image/jpeg');

// Obtener nuevas dimensiones
list($ancho, $alto) = getimagesize($nombre_archivo);
$nuevo_ancho = $ancho * $porcentaje;
$nuevo_alto = $alto * $porcentaje;

// Redimensionar
$imagen_p = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
$imagen = imagecreatefromjpeg($nombre_archivo);
imagecopyresampled($imagen_p, $imagen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

// Imprimir
imagejpeg($imagen_p, $Nombrefinal, 75);
?>

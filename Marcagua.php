<?php
$patio=trim($_GET['patio']);
$conte=trim($_GET['conte']);
$Nombrefinal=trim($_GET['ruta']);
$fecha=trim($_GET['fecha']);



$exif = exif_read_data($Nombrefinal, 0, true);
$fecha_ori=date("d-m-Y (H:i:s)",$exif['EXIF']['DateTimeOriginal']);

/*if (empty($fecha_ori)){
$fec=$fecha;
}
else
{
$fec=$fecha_ori;
}*/

marca($patio,$conte,$Nombrefinal,$fecha);



function marca($patio,$conte,$Nombrefinal,$fecha){
$porcentaje = 0.5;
echo "Ruta marca agua: ".$Nombrefinal;
$im = imagecreate(600, 30);
$fondo = imagecolorallocate($im, 0, 0, 0);
$color_texto = imagecolorallocate($im, 237, 218, 7);
imagestring($im, 5, 10, 0, "CONTENEDOR: $patio - $conte - Fecha $fecha  ", $color_texto);
imagejpeg($im,"/fotos/$patio/$conte/marca.jpg",50);
imagedestroy($im);

header( "Content-type: image/jpeg" );
$abajo = imagecreatefromjpeg( "$Nombrefinal",50 );
$arriba = imagecreatefromjpeg("/fotos/$patio/$conte/marca.jpg" ); 
imagecopy( $abajo, $arriba, 0, 0, 0, 0, 1024, 25 );
// Obtener los nuevos tamaños
list($ancho, $alto) = getimagesize($abajo);
$nuevo_ancho = $ancho * $porcentaje;
$nuevo_alto = $alto * $porcentaje;
imagejpeg( $abajo, "$Nombrefinal",50 );
//imagecopyresized($abajo, "$NombreFinal", 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
imagedestroy( $abajo );
imagedestroy( $arriba );
unlink("/fotos/$patio/$conte/marca.jpg");
}
?>

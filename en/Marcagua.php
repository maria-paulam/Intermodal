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
echo "Ruta marca agua: ".$Nombrefinal;
$im = imagecreate(600, 30);
$fondo = imagecolorallocate($im, 0, 0, 0);
$color_texto = imagecolorallocate($im, 237, 218, 7);
imagestring($im, 5, 10, 0, "CONTENEDOR: $patio - $conte - Fecha $fecha  ", $color_texto);
imagejpeg($im, "/fotos_patios/$patio/$conte/marca.jpg");
imagedestroy($im);

header( "Content-type: image/jpeg" );
$abajo = imagecreatefromjpeg( "$Nombrefinal" );
$arriba = imagecreatefromjpeg( "/fotos_patios/$patio/$conte/marca.jpg" ); 
imagecopy( $abajo, $arriba, 0, 0, 0, 0, 1024, 25 );
imagejpeg( $abajo, "$Nombrefinal" );
imagedestroy( $abajo );
imagedestroy( $arriba );
unlink("/fotos_patios/$patio/$conte/marca.jpg");
}
?>
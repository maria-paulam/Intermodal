<?php
//ASIGNA LOS DATOS PROVENIENTES DEL DISPOSITIVO MOVIL 
$tempFile = $_FILES['file']['tmp_name'];
$fileName = $_FILES['file']['name'];
$fileSize = $_FILES['file']['size'];
$Fmarca = "";

ECHO  $patio;
ECHO $mov;
if (!$vin == '0'){
ECHO  $patio;
ECHO $mov;
Contenedor($vin, $patio, $mov);
Cfoto ($patio,$vin,$mov,$tempFile,$fileName,$fecha);
}
else {
    $vin = "NNN";
    $patio = "NNN";
    $mov = trim($_POST['conse']);
    $nombre_fichero="/var/www/html/internew/fotos/$patio/$vin/$mov";
    mkdir($nombre_fichero, 0777, true);
    Cfoto ($patio,$vin,$mov,$tempFile,$fileName,$fecha);
}

//CREA Y REVISA SI EXISTE EL FICHERO DEL CONTENEDOR 
function Contenedor($vin, $patio, $mov)
{
  $nombre_fichero="/var/www/html/internew/fotos/$patio/$vin/$mov";
  if (file_exists($nombre_fichero)) {
  echo "<BR>";
  echo "El fichero $nombre_fichero existe";
  Guia($vin,$patio,$mov);
 }else {
     echo "<BR>";
     echo "El fichero $nombre_fichero no existe";
     mkdir($nombre_fichero, 0777, true);
     Guia($vin,$patio,$mov);
}
}

//CREA Y REVISA SI EXISTE EL FICHERO DE LA GUIA 
function Guia($vin,$patio,$mov)
{
 $nombre_fichero="/var/www/html/internew/fotos/$patio/$vin/$mov";
    if (file_exists($nombre_fichero)) {
    echo "<BR>";
    echo "El fichero $nombre_fichero existe";
    } else {
    echo "<BR>"; 
    echo "El fichero $nombre_fichero no existe";
    mkdir($nombre_fichero, 0777, true);
    }
}

//FUNCION PARA CARGAR LA FOTO
function Cfoto ($patio,$vin,$mov,$tempFile,$fileName,$fecha){
$ArchivoFinal  = "/var/www/html/internew/fotos/$patio/$vin/$mov/". $fileName;
echo $Nombrefinal = "/var/www/html/internew/fotos/$patio/$vin/$mov/$fileName";
move_uploaded_file($tempFile, $ArchivoFinal);
$CL   = 'CL000';
$pos = strpos($fileName, $CL);
echo "<BR>";
echo  $pos;
$operacion = "";
echo "<BR>";
marca($patio,$vin,$Nombrefinal,$fecha);
Echo "SubioTodaLaInformacion";
}



//FUNCION PARA AGREGAR LA MARCA DE AGUA A LA FOTO
function marca($patio,$vin,$Nombrefinal,$fecha,$operacion){
echo $Nombrefinal;
$im = imagecreate(1024, 30);
$fondo = imagecolorallocate($im, 0, 0, 0);
$color_texto = imagecolorallocate($im, 237, 218, 7);
imagestring($im, 10, 10, 0, "VIN: $patio-$vin-  Fecha $fecha  ", $color_texto);
imagejpeg($im, "/var/www/html/internew/fotos/$patio/$vin/marca.jpg");
imagedestroy($im);

header( "Content-type: image/jpeg" );
$abajo = imagecreatefromjpeg( "$Nombrefinal" );
$arriba = imagecreatefromjpeg( "/var/www/html/internew/fotos/$patio/$vin/marca.jpg" ); 
imagecopy( $abajo, $arriba, 0, 0, 0, 0, 1024, 25 );
imagejpeg( $abajo, "$Nombrefinal" );
imagedestroy( $abajo );
imagedestroy( $arriba );
unlink("/var/www/html/internew/fotos/$patio/$vin/marca.jpg");
}
OCIFreeStatement($stmt);

?>

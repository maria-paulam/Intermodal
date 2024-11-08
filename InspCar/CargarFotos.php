<?php
//ASIGNA LOS DATOS PROVENIENTES DEL DISPOSITIVO MOVIL 
$tempFile = $_FILES['file']['tmp_name'];
$fileName = $_FILES['file']['name'];
$fileSize = $_FILES['file']['size'];
$Fmarca = "";

$conse = $_POST['conse'];

//$sql  = "SELECT CONTENEDOR, PATIO, DECODE(PATIO,'BUN',LABEL,'CTG',LABEL,IDMOVIMIENTO) IDMOVIMIENTO, to_char(FECHA, 'DD/MM/YYYY HH:MI') FECHA, CONSEC_FOTOS('".$fileName."',DECODE(PATIO,'BUN',LABEL,'CTG',LABEL,IDMOVIMIENTO)) CONSECUTIVO FROM  MOVIMIENTO_PATIO WHERE IDMOVIMIENTO = '".trim($_POST['conse'])."' OR LABEL = '".trim($_POST['conse'])."'";
$sql  = "SELECT DISTINCT CIUDAD, IDOPERACIONVIN, V.VIN, to_char(sysdate,'DD/MM/YYYY HH:MI') FECHA FROM VIN_CARGUE V, OPERACIONVIN O WHERE V.IDOPERACION = O.IDOPERACIONVIN AND V.VIN ='".trim($conse)."'";

$db="(DESCRIPTION = 
    (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.13)(PORT = 1522)) 
    (CONNECT_DATA = (SID = nvsft)) 
     )";

if (!$db = @ocinlogon("AUTOLOG","AUTOLOG", $db)) 
{
    $error = ocierror();
    printf("CONNECT error: %s", $error["message"]);
}


if (!$stmt = @ociparse($db,$sql)) 
{
    $error = ocierror($db);
    printf("ociparse error: %s", $error["message"]);
} else {
    if (!@OCIexecute($stmt)) {
        $error = ocierror($stmt);
		printf ($sql ); 		
        printf("OCIEXECUTE Failure. Error was: %s\n", $error["message"]);
    } else {
    while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
    $operacion = $row["IDOPERACIONVIN"];
    $vin = $row["VIN"];
    $fecha = $row["FECHA"];
	$ciudad = $row["CIUDAD"];

         }
}
	}

//if (!$operacion == '0'){
//ECHO  $ciudad;
//ECHO $vin;
Contenedor($vin, $ciudad, $operacion);
//$sql  ="INSERT INTO FOTOS_LOG (FECHA, GUIA, USUARIO, MENSAJE) VALUES (sysdate, '$_POST['conse']', '".trim($_POST['oficina'])."' ,' No se Encontro Contenedor asociado a la Guia IP ORIGEN: $ipaddress')";
//    query($sql);
//Cfoto ($ciudad,$operacion,$vin,$tempFile,$fileName,$fecha);
//}
//else {
    $operacion = "NNN";
    $ciudad = "NNN";
    $vin = trim($_POST['conse']);
    $nombre_fichero="/fotos_patios/InspCar/$ciudad/$operacion/$vin";
    mkdir($nombre_fichero, 0777, true);
    //Cfoto ($patio,$conte,$mov,$tempFile,$fileName,$fecha);
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $sql  ="INSERT INTO FOTOS_LOG (FECHA, GUIA, USUARIO, MENSAJE) VALUES (sysdate, '$vin', '".trim($_POST['oficina'])."' ,'Error Consulta: No se Encontro Vehiculo asociado al VIN ".trim($_POST['conse'])." IP ORIGEN: $ipaddress')";
    query($sql);
//}

//CREA Y REVISA SI EXISTE EL FICHERO DEL CONTENEDOR 
function Contenedor($vin, $ciudad, $operacion)
{
  $nombre_fichero="/fotos/InspCar/$ciudad/$operacion";
  if (file_exists($nombre_fichero)) {
  echo "<BR>";
  echo "El fichero $nombre_fichero existe";
  Guia($conte,$patio,$mov);
 }else {
     echo "<BR>";
     echo "El fichero $nombre_fichero no existe";
     mkdir($nombre_fichero, 0777, true);
     Guia($vin,$ciudad,$operacion);
}
}

//CREA Y REVISA SI EXISTE EL FICHERO DE LA GUIA 
function Guia($vin,$ciudad,$operacion)
{
 $nombre_fichero="/fotos/InspCar/$ciudad/$operacion/$vin";
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
function Cfoto ($ciudad,$operacion,$vin,$tempFile,$fileName,$fecha){
$ArchivoFinal  = "/fotos_patios/InspCar/$ciudad/$operacion/$vin/". $fileName;
echo $Nombrefinal = "/fotos_patios/InspCar/$ciudad/$operacion/$vin/$fileName";
move_uploaded_file($tempFile, $ArchivoFinal);
$CL   = 'CL000';
$LN   = 'LN000';
$RP   = 'RP000';
$pos = strpos($fileName, $CL);
echo "<BR>";
$operacion = "";
$ipaddress = $_SERVER['REMOTE_ADDR'];
/*if (strpos($fileName, $CL) === false && strpos($fileName, $RP) === false) {
$sql  ="INSERT INTO FOTOS (GUIA, ID_MOVIMIENTO, RUTA, USUARIO, FECHA, TIPO, PATIO,CARGO,ORIGEN) VALUES ($mov, $mov, '$Nombrefinal',  '".trim($_POST['oficina'])."' , sysdate , 1,'$patio', 'LINEA','$ipaddress')";
query($sql);
} 
elseif (strpos($fileName, $LN) === false && strpos($fileName, $RP) === false) {
$sql  ="INSERT INTO FOTOS (GUIA, ID_MOVIMIENTO, RUTA, USUARIO, FECHA, TIPO, PATIO,CARGO,ORIGEN) VALUES ($mov, $mov, '$Nombrefinal',  '".trim($_POST['oficina'])."' , sysdate , 1,'$patio', 'CLIENTE','$ipaddress')";
query($sql);
}
elseif (strpos($fileName, $LN) === false && strpos($fileName, $CL) === false) {
$sql  ="INSERT INTO FOTOS (GUIA, ID_MOVIMIENTO, RUTA, USUARIO, FECHA, TIPO, PATIO,CARGO,ORIGEN) VALUES ($mov, $mov, '$Nombrefinal',  '".trim($_POST['oficina'])."' , sysdate , 1,'$patio', 'REPARACION','$ipaddress')";
query($sql);
}
else 
{*/
$sql  ="INSERT INTO FOTOS (GUIA, ID_MOVIMIENTO, RUTA, USUARIO, FECHA, TIPO, PATIO,CARGO,ORIGEN) VALUES ($vin, $operacion, '$Nombrefinal', 'AUTOLOG' , sysdate , 1,'$ciudad', 'INSPCAR','$ipaddress')";
query($sql);
//}

echo "<BR>";
marca($ciudad,$vin,$Nombrefinal,$fecha);
Echo "SubioTodaLaInformacion";
}

//INSERTAR EL REGISTRO DE LA INSERCION DE LA FOTO 
function query($sql){
echo "<BR>";
echo $sql;

$db="(DESCRIPTION = 
    (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.13)(PORT = 1522)) 
    (CONNECT_DATA = (SID = nvsft)) 
  )";

if (!$db = @ocinlogon("AUTOLOG","AUTOLOG", $db)) 
{
    $error = ocierror();
    printf("CONNECT error: %s", $error["message"]);
}

if (!$stmt = @ociparse($db,$sql)) 
{
    $error = ocierror($db);
    printf("ociparse error: %s", $error["message"]);
} else {

    if (!@OCIexecute($stmt)) {
        $error = ocierror($stmt);
		printf ($sql ); 		
        printf("OCIEXECUTE Failure. Error was: %s\n", $error["message"]);
    } 
	}
}

//FUNCION PARA AGREGAR LA MARCA DE AGUA A LA FOTO
function marca($ciudad,$vin,$Nombrefinal,$fecha){
//function marca($patio,$conte,$Nombrefinal,$fecmarca){
echo $Nombrefinal;
//$fmarca = date("d") . "/" . date("m") . "/" . date("Y") . " " . date("H");
$time=time();
$fmarca=date("d-m-Y (H:i:s)", $time);
$im = imagecreate(600, 30);
$fondo = imagecolorallocate($im, 0, 0, 0);
$color_texto = imagecolorallocate($im, 237, 218, 7);
imagestring($im, 5, 10, 0, "VIN: $ciudad - $vin - Fecha $fmarca ", $color_texto);
imagejpeg($im, "/fotos_patios/$ciudad/$vin/marca.jpg");
imagedestroy($im);

header( "Content-type: image/jpeg" );
$abajo = imagecreatefromjpeg( "$Nombrefinal" );
$arriba = imagecreatefromjpeg( "/fotos_patios/$ciudad/$vin/marca.jpg" ); 
imagecopy( $abajo, $arriba, 0, 0, 0, 0, 1024, 25 );
imagejpeg( $abajo, "$Nombrefinal" );
imagedestroy( $abajo );
imagedestroy( $arriba );
unlink("/fotos_patios/$ciudad/$vin/marca.jpg");
}
OCIFreeStatement($stmt);

?>

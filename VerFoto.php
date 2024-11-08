<?php

//error_reporting(E_ERROR);

$sql  = "SELECT RUTA FROM Fotos WHERE RUTA = '".$_GET['id']."'";

 
$db="(DESCRIPTION = 
     (ADDRESS = (PROTOCOL = TCP)(HOST = 190.242.124.185)(PORT = 1521)) 
    (CONNECT_DATA = (SID = csavcl)) 
  )";


if (!$db = @ocinlogon("Digitalizacion","Digitalizacion", $db)) 
{
    $error = ocierror();
    printf("CONNECT error: %s", $error["message"]);
    die();
}

if (!$stmt = @ociparse($db,$sql)) 
{
    $error = ocierror($db);
    printf("ociparse error: %s", $error["message"]);
} else {

    if (!@OCIexecute($stmt)) {
        $error = ocierror($stmt);
        printf("OCIEXECUTE Failure. Error was: %s\n", $error["message"]);
    } else {
	
        while (ocifetch($stmt)) {

	$archivo =  ociresult($stmt, 1 );

	//$archivo="fotos_patios/MAD/MSCU1614972/16090146658/LN0007.jpg";
        }
    }
}
$fp = fopen($archivo,'rb');			
//echo "ok";			
			header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
			header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
			header('Content-type: image/jpg');
			// It will be called downloaded.pdf
			header('Content-Disposition:inline; filename="imagen.jpg"');
			// The PDF source is in original.pdf
			fpassthru($fp);
			//echo $archivo;
//======================================================== envio del archivo pdf 
OCIFreeStatement($stmt);
OCILogoff($conn);

?>

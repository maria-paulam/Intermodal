<?php

//error_reporting(E_ERROR);
$patio= substr($_GET['id'],14,3);

$sql  = "SELECT FT_RUTA_SERVIDOR FROM FILE_FOTOS WHERE FT_RUTA_SERVIDOR = '".$_GET['id']."'";

 
if ($patio=='MAD'){	
$db="(DESCRIPTION=
    (ADDRESS=
      (PROTOCOL=TCP)
      (HOST=192.168.1.122)
      (PORT=1522)
    )
    (CONNECT_DATA=
      (SID=NVSFT)
    )
  )";
if (!$db = @ocinlogon("patiomad","patiomad", $db)) 
	{
    $error = ocierror();
    printf("CONNECT error: %s", $error["message"]);
    die();
	}
	}
else if ($patio=='MDE') {
	$db="(DESCRIPTION = 
     (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.122)(PORT = 1522)) 
    (CONNECT_DATA = (SID = nvsft)) 
  )";

if (!$db = @ocinlogon("patiomed","patiomed", $db)) 
	{
    $error = ocierror();
    printf("CONNECT error: %s", $error["message"]);
    die();
	}
	}
else if ($patio=='CLO') {
	$db="(DESCRIPTION = 
     (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.230)(PORT = 1522)) 
    (CONNECT_DATA = (SID = nvsft)) 
  )";

if (!$db = @ocinlogon("patiocali","patiocali", $db)) 
	{
    $error = ocierror();
    printf("CONNECT error: %s", $error["message"]);
    die();
	}
	}
else if ($patio=='CTG') {
	$db="(DESCRIPTION = 
     (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.210)(PORT = 1522)) 
    (CONNECT_DATA = (SID = nvsft)) 
  )";

if (!$db = @ocinlogon("patioctg","patioctg", $db)) 
	{
    $error = ocierror();
    printf("CONNECT error: %s", $error["message"]);
    die();
	}
	}
else if ($patio=='BUN') {
	$db="(DESCRIPTION = 
     (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.230)(PORT = 1522)) 
    (CONNECT_DATA = (SID = nvsft)) 
  )";

if (!$db = @ocinlogon("patiobun","patiobun", $db)) 
	{
    $error = ocierror();
    printf("CONNECT error: %s", $error["message"]);
    die();
	}
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


    header("Content-Type: image/png");
    header("Content-Length: " . filesize($archivo));

    //fpassthru($handle);
			// It will be called downloaded.pdf
			header('Content-Disposition:inline; filename="imagen.jpg"');
			// The PDF source is in original.pdf
			fpassthru($fp);
			//echo $archivo;
//======================================================== envio del archivo pdf 
OCIFreeStatement($stmt);
OCILogoff($conn);

?>
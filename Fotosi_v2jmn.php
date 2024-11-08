<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8">

	<title>Fotografias</title>

	<meta name="description" lang="en" content=""/>
	<meta name="author" content="Lokesh Dhakar">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="1800">
	
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Karla%7CMontserrat">
	<link rel="stylesheet" href="css/screen.css">
	<link rel="stylesheet" href="css/lightbox.css">
	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="js/lightbox.js"></script>

	<script>
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-2196019-1']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	</script>
   <script>
   
   
	var links = [
<?php


	
	$patio= $_GET['patio'];
	 //if ($patio=='CTG')
	 //$sql  = "SELECT DISTINCT replace(FT_RUTA_SERVIDOR,'/fotos','') RUTA, substr(FT_RUTA_SERVIDOR,19,11) CONTENEDOR FROM FILE_FOTOS where (ID_MOVIMIENTO = ".$_GET['id']." or ID_MOVIMIENTO = nvl(".$_GET['label'].",-1) ) and PATIO = '".$_GET['patio']."'";
	 //else
	 $sql = "SELECT DISTINCT replace(FT_RUTA_SERVIDOR,'/fotos','') RUTA, substr(FT_RUTA_SERVIDOR,19,11) CONTENEDOR FROM FILE_FOTOS where FT_STICKER = ".$_GET['id']." and FT_PATIO = '".$_GET['patio']."'";
	//$sql  = "SELECT replace(RUTA,'/fotos_patios','') RUTA, substr(RUTA,19,11) CONTENEDOR FROM Fotos where ID_MOVIMIENTO = 1803123000273 and PATIO = '".$_GET['patio']."'";	

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
	} 
	else 
	{
    if (!@OCIexecute($stmt)) {
        $error = ocierror($stmt);
        printf("OCIEXECUTE Failure. Error was: %s\n", $error["message"]);
		
    } else 
		{
	        while (ocifetch($stmt)) 
		{
			$i = $i +1;
			$idarchivo =  ociresult($stmt, 1 );
			$contenedor= ociresult($stmt, 2 );

			echo  "'http://fotos.intermodal.com.co/images$idarchivo',";
			
	        }
    }
	}
 
					
?>
];

		function downloadAll(urls) {
		  var link = document.createElement('a');

		  link.setAttribute('download', '<?php echo $contenedor.".jpg"?>');
		  link.style.display = 'none';

		  document.body.appendChild(link);

		  for (var i = 0; i < urls.length; i++) {
			link.setAttribute('href', urls[i]);
			link.click();
		  }

		  document.body.removeChild(link);
		}
   
   </script>

</head>
<body style="background-color:Navy" >
        <center><h3>INTERMODAL SAS</h3></center>

	<section id="examplese" class="examples-sectione">
        <center><h4>Da&ntilde;os</h4></center>					
			<div class="image-rowe">
				<div class="image-set">
	<?php

	 //$sql  = "SELECT RUTA FROM Fotos where ID_MOVIMIENTO = 16090146658 and PATIO = '".$_GET['patio']."'";
	$patio= $_GET['patio'];
	 //if ($patio=='CTG')
	 //{$sql  = "SELECT DISTINCT FT_RUTA_SERVIDOR FROM FILE_FOTOS where ( FT_STICKER = ".$_GET['id']." or FT_STICKER = nvl(".$_GET['label'].",-1)) and FT_CARGO<>'REPARACION' and FT_PATIO = '".$_GET['patio']."'";}
	 //else{
	 $sql  = "SELECT DISTINCT FT_RUTA_SERVIDOR FROM FILE_FOTOS where FT_STICKER = ".$_GET['id']." and FT_CARGO<>'REPARACION' and FT_PATIO = '".$_GET['patio']."'";
	 //}
	 
	 //$sql  = "SELECT DISTINCT RUTA FROM Fotos where ID_MOVIMIENTO = ".$_GET['id']." and PATIO = '".$_GET['patio']."'";
	 // $sql  = "SELECT ID_MOVIMIENTO FROM Fotos where  ID_MOVIMIENTO = 16090146658 and PATIO = '".$_GET['patio']."'";
//echo $_GET['label'];
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
	} 
	else 
	{
    if (!@OCIexecute($stmt)) {
        $error = ocierror($stmt);
        printf("OCIEXECUTE Failure. Error was: %s\n", $error["message"]);
		
    } else 
		{
	        while (ocifetch($stmt)) 
		{
			$i = $i +1;
			$idarchivo =  ociresult($stmt, 1 );
			
			echo  "<a class=\"example-image-link\" href=\"VerFoto_v2jmn.php?id=$idarchivo\"  width=\"300\" height=\"300\"   data-lightbox=\"example-set\" data-title=\"Ingreso ".$_GET['ID_MOVIMIENTO']." 2021\"><img class=\"example-image\" src=\"VerFoto_v2jmn.php?id=$idarchivo\"  width=\"200\" height=\"100\"/></a>";
			
	        }
    }
	}
 
					
?>
					
				</div>
			</div>
		</div>
	</section>
	
<section id="examplese" class="examples-sectione">
			        <center><h4>Reparaciones</h4></center>					
		
			<div class="image-rowe">
				<div class="image-set">
	<?php

	 //$sql  = "SELECT RUTA FROM Fotos where ID_MOVIMIENTO = 16090146658 and PATIO = '".$_GET['patio']."'";
	$patio= $_GET['patio'];
	 //if ($patio=='CTG')
	 //{$sql  = "SELECT DISTINCT FT_RUTA_SERVIDOR FROM FILE_FOTOS where ( FT_STICKER = ".$_GET['id']." or FT_STICKER = nvl(".$_GET['label'].",-1)) and FT_CARGO='REPARACION' and FT_PATIO = '".$_GET['patio']."'";}
	 //else{
	 $sql  = "SELECT DISTINCT FT_RUTA_SERVIDOR FROM FILE_FOTOS where FT_STICKER = ".$_GET['id']." and FT_CARGO='REPARACION' and FT_PATIO = '".$_GET['patio']."'";
	 //}
	 
	 //$sql  = "SELECT DISTINCT RUTA FROM Fotos where ID_MOVIMIENTO = ".$_GET['id']." and PATIO = '".$_GET['patio']."'";
	 // $sql  = "SELECT ID_MOVIMIENTO FROM Fotos where  ID_MOVIMIENTO = 16090146658 and PATIO = '".$_GET['patio']."'";
//echo $_GET['label'];
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
	} 
	else 
	{
    if (!@OCIexecute($stmt)) {
        $error = ocierror($stmt);
        printf("OCIEXECUTE Failure. Error was: %s\n", $error["message"]);
		
    } else 
		{
	        while (ocifetch($stmt)) 
		{
			$i = $i +1;
			$idarchivo =  ociresult($stmt, 1 );
			
			echo  "<a class=\"example-image-link\" href=\"VerFoto_v2jmn.php?id=$idarchivo\"  width=\"300\" height=\"300\"   data-lightbox=\"example-set\" data-title=\"Ingreso ".$_GET['ID_MOVIMIENTO']." 2017\"><img class=\"example-image\" src=\"VerFoto_v2jmn.php?id=$idarchivo\"  width=\"200\" height=\"100\"/></a>";
			
	        }
    }
	}
 
					
?>
					
					
				</div>
			</div>
		</div>
	</section>	

		
	<center><button onclick="downloadAll(window.links)">Descargar Fotos</button></center>
</body>
    </html>
<footer>

<?php
printf( "<b>Powered By Navesoft S.A.S.</b>");

?>
</footer>

<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8">

	<title>Fotografias</title>

	<meta name="description" lang="en" content=""/>
	<meta name="author" content="Lokesh Dhakar">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="30">
	
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
   

</head>
<body style="background-color:Navy" >
        <center><h3>INTERMODAL</h3></center>

	<section id="examplese" class="examples-sectione">
					
			<div class="image-rowe">
				<div class="image-set">
	<?php

	 //$sql  = "SELECT RUTA FROM Fotos where ID_MOVIMIENTO = 16090146658 and PATIO = '".$_GET['patio']."'";
	 $sql  = "SELECT RUTA FROM Fotos where LABEL = ".$_GET['id']." and PATIO = '".$_GET['patio']."'";
	 // $sql  = "SELECT ID_MOVIMIENTO FROM Fotos where  ID_MOVIMIENTO = 16090146658 and PATIO = '".$_GET['patio']."'";
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
			
			echo  "<a class=\"example-image-link\" href=\"VerFotoBUN.php?id=$idarchivo\"  width=\"300\" height=\"300\"   data-lightbox=\"example-set\" data-title=\"Ingreso ".$_GET['ID_MOVIMIENTO']." Fecha 2014-02-10\"><img class=\"example-image\" src=\"VerFoto.php?id=$idarchivo\"  width=\"200\" height=\"100\"/></a>";
			
	        }
    }
	}
 
					
?>
					
					
				</div>
			</div>
		</div>
	</section>

		
	
</body>
    </html>
<footer>

<?php
printf( "<b>Powered By Navesoft Ltda</b>");

?>
</footer>

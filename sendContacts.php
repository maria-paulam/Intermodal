<?php
	// GFE Colombia
	// Ricardo Andrés López Naranjo - Fri Aug 01 15:13:03 GMT-05:00 2008
	// 
	
	// Set flag that this is a parent file
	define( '_JEXEC', 1 );
	
	define('JPATH_BASE', dirname(__FILE__) );
	
	define( 'DS', DIRECTORY_SEPARATOR );
	
	require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
	require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
	
	
	
	$ins_JUtility = new JUtility();
	$ins_config = new JConfig();
	
	$from = ($_POST["from"]) ? $_POST["from"] : "unknown";
	$fromname = ($_POST["fromname"]) ? $_POST["fromname"] : "unknown";
	$subject = ($_POST["subject"]) ? $_POST["subject"] : "unknown";
	
	$conexion_mysql = mysql_connect($ins_config -> host, $ins_config -> user, $ins_config -> password);
	mysql_select_db($ins_config -> db, $conexion_mysql);
	
	if (!$_POST["email"]) header("Location: ./");
	
	$SQL_obtener_email_recipient = "SELECT * FROM jos_contact_details WHERE published = true";
	$res_obtener_email_recipient = mysql_query($SQL_obtener_email_recipient);
	if (mysql_num_rows($res_obtener_email_recipient) == 0) {
		$recipient = "";
	} else {		
		while ($filas = mysql_fetch_array($res_obtener_email_recipient, MYSQL_NUM)) {
			$recipient = $filas[14];
		}
	}
	
	if ($_POST["email_copy"])
		$replayTo = $_POST["email"];
	
	$cuerpo_correo = $_POST["name"]."<br>".$_POST["company"]."<br>".$_POST["phone"]."<br>".$_POST["email"]."<br><br>".$_POST["text"];
	
	$ins_JUtility -> sendMail($from, $fromname, $recipient, $subject, $cuerpo_correo, true, null, null, null, $replayTo);
	
	header("Location: ./");
	
	// FINAL Ricardo Andrés López Naranjo - Fri Aug 01 15:13:03 GMT-05:00 2008
?>
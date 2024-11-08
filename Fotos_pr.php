<?php
$directorio = '/fotos_patios/NNN/';



function listar_directorios_ruta($ruta)
 {

 // abrir un directorio y listarlo recursivo
 if (is_dir($ruta))
 {
 if ($dh = opendir($ruta))
 {
 //echo "<br /><strong>$ruta</strong>"; // Aqui se imprime el nombre de la carpeta o directorio

 while (($file = readdir($dh)) !== false)
 {
 //if (is_dir($ruta . $file) && $file!="." && $file!="..") // Si se desea mostrar solo directorios
 if ($file!="." && $file!="..") // Si se desea mostrar directorios y archivos
 {
 //solo si el archivo es un directorio, distinto que "." y ".."
 echo "<br />$ruta$file"; // Aqui se imprime el nombre del Archivo con su ruta relativa
//echo $ruta.$file;
 listar_directorios_ruta($ruta . $file . DIRECTORY_SEPARATOR); // Ahora volvemos a llamar la función
 }
 }
 closedir($dh);
 }
 }
 }
$p=listar_directorios_ruta($directorio);
echo $p;
?>


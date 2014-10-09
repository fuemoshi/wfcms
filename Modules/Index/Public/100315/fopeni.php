<?php
$main = $_GET["main"];
$src = $_SERVER["REMOTE_ADDR"];;
if ($main) {
	 

	$fangweiweburl = "http://www.86800.net/productty/cx.php";
	
	//$fangweiweburl = "http://ty-315.8866.org/fw.php";
 
	if (1) {
		$fp1 = @ fopen("$fangweiweburl" . "?main=$main&src=$src", "r") ;
		if ($fp1) {
			$buffer = "";
			while (!feof($fp1)) {
				$buffer = $buffer . fgets($fp1, 1024);
			}
			echo $buffer;
		} else {
			 
					echo "连接防伪服务器失败,请检测";
				 
			 
		}
	}
}

?>
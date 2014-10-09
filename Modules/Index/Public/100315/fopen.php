<?php
$main = $_GET["main"];
$src = "315mobile";
if ($main) {
	include "../../100315/place.php";

	$fangweiweburl = "http://ty3152009.gicp.net:81/fw.php";
	
	//$fangweiweburl = "http://ty-315.8866.org/fw.php";
	$fangweiweburl = "http://" . $place . ":81/fw.php";
	if (1) {
		$fp1 = @ fopen("$fangweiweburl" . "?M=$main&N=$src", "r") ;
		if ($fp1) {
			$buffer = "";
			while (!feof($fp1)) {
				$buffer = $buffer . fgets($fp1, 1024);
			}
			echo $buffer;
		} else {
			$fangweiweburl = "http://ty-315.8866.org:81/fw.php";
			
			if (1) {
				$fp1 = @ fopen("$fangweiweburl" . "?M=$main&N=$src", "r") or die("web查询端连接失败");
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
	}
}

?>
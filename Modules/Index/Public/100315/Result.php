<?php
$main = $_GET["main"];
$src = $_SERVER["REMOTE_ADDR"];;
if ($main) {
	$fangweiweburl = "http://tyfw888.gicp.net:6080/fwquery.asp";
	
	//$fangweiweburl = "http://tyfw888.gicp.net:6080/fwquery.asp";
 
	if (1) {
		$fp1 = @ fopen("$fangweiweburl" . "?fwcode=$main&src=$src", "r") ;
		if ($fp1) {
			$buffer = "";
			while (!feof($fp1)) {
				$buffer = $buffer . fgets($fp1, 1024);
			}
			echo $buffer;
		} else {
					echo "���ӷ�α������ʧ��,����";
		}
	}
}
?>
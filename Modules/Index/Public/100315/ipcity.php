<?
include "place.php";
$ip = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"]; 
if($ip==$place){
echo  $place;
}else{
$f_id=fopen("place.php","w");
$txt="<? \$place=\"".trim($ip)."\"; ?>";
fputs($f_id,$txt);
fclose($f_id);
echo $ip;
}
?>
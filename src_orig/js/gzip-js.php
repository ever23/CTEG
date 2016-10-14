<?php
header("Content-type:  application/javascript");;
if(empty($_GET['f']))
	exit;
$js=file_get_contents($_GET['f']);

$acep=explode(",",$_SERVER['HTTP_ACCEPT_ENCODING']);
if(!in_array('gzip',$acep))
{
	echo $js;
	exit;
}
$jsgzip=gzencode($js,9,FORCE_GZIP);
header('Content-Encoding: gzip');
header('Content-Length: ' .strlen($jsgzip));
echo $jsgzip;

?>
<?php

$campus = isset($_GET['campus']) ? $_GET['campus'] : '';
$campuses = ['cams'=>'Cameras', 'printers'=>'Network Printers', 'servers'=>'Servers'];

echo "<h1>".$campuses[$campus]."</h1>";

function cmp($a, $b) {
	if ($a[1] == $b[1]) {
		return 0;
	}
	return ($a[1] < $b[1]) ? -1 : 1;
}

$cams = [];
// $file = file('cams.txt');
$file = file($campus.'.txt');

foreach ($file AS $line) {
	array_push($cams, explode('|', $line));
}

function checkCams() {
	global $cams;

	foreach ($cams AS $cam) {
		$start = microtime(true);
		if ($fp=fsockopen($cam[1], $cam[2], $errno, $errstr, 0.2)) {
			$time = microtime(true) - $start;
			echo "<div class=\"active\"><span>".$cam[0]."</span><span>(".trim($cam[1]).":".trim($cam[2]).")</span><span>".number_format($time*1000,1,'.','')." ms</span></div>";
			fclose($fp);
		} else {
			$time = microtime(true) - $start;
			echo "<div class=\"inactive\"><span>".$cam[0]."</span><span>(".trim($cam[1]).":".trim($cam[2]).")</span><span>".number_format($time*1000,1,'.','')." ms</span></div>";
		}
	}
}

echo "<div class=\"container\">";
checkCams();
echo "</div>";

?>

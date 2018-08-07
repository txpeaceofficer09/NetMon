<?php

$cams = [];

for ($i=1;$i<=254;$i++) {
	if ($fp=@fsockopen('192.168.100.'.$i, 80, $errno, $errstr, 0.2)) {
		array_push($cams, '192.168.100.'.$i.'|192.168.100.'.$i);
		fclose($fp);
	}
}

$fp = fopen('cams.txt', 'w');
fputs($fp, join("\n", $cams));
fclose($fp);

?>

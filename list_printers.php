<?php

$db = file('printers.txt');

foreach ($db AS $line) {
	$arr = explode('|', $line);
	if ($fp=@fsockopen($arr[0], $arr[1], $errno, $errstr, 0.2)) {
		echo "<span class=\"online\">".$arr[2]."<br />(".$arr[0].":".$arr[1].")</span>";
		fclose($fp);
	} else {
		echo "<span class=\"offline\">".$arr[2]."<br />(".$arr[0].":".$arr[1].")</span>";
	}
}

?>

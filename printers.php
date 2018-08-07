<?php

$results = [];

$nets = [
	'192.168.8.',
	'192.168.9.',
	'192.168.10.',
	'192.168.11.',
	'192.168.15.',
	'192.168.22.',
	'192.168.35.',
	'192.168.36.',
	'192.168.37.',
	'192.168.75.',
	'192.168.76.',
];

foreach ($nets AS $subnet) {
	for ($i=1;$i<255;$i++) {
		$addr = $subnet.$i;
			if ($fp=@fsockopen($addr, 631, $errno, $errstr, 0.2)) {
				array_push($results, gethostbyaddr($addr)."|".$addr."|631");
				fclose($fp);
			} elseif ($fp=@fsockopen($addr, 9100, $errno, $errstr, 0.2)) {
				array_push($results, gethostbyaddr($addr)."|".$addr."|9100");
				fclose($fp);
			}
	}
}

if ($fp = fopen('printers.txt', 'w')) {
	fputs($fp, join("\n", $results));
	fclose($fp);
}

?>

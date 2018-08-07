<?php

$files = ['netmap', 'es-netmap', 'jh-netmap', 'hs-netmap'];
$filename = isset($_REQUEST['file']) ? $_REQUEST['file'].".txt" : "netmap.txt";

echo "<form action=\"edit.php\" method=\"GET\">";
echo "<select id=\"file\" name=\"file\">";
foreach ($files AS $n) {
	if ($filename == $n.".txt") {
		echo "<option selected>".$n."</option>";
	} else {
		echo "<option>".$n."</option>";
	}
}
echo "</select>";
echo "<input type=\"submit\" value=\"Change File\" />";
echo "</form>";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$lines = [];
	for ($i=0;$i<count($_REQUEST['id']);$i++) {
		array_push($lines, $_REQUEST['id'][$i]."|".$_REQUEST['title'][$i]."|".$_REQUEST['addr'][$i]."|".$_REQUEST['port'][$i]."|".$_REQUEST['parent'][$i]."|".$_REQUEST['desc'][$i]);
	}

	$fp = fopen($filename, 'w');
	fputs($fp, join("\n", $lines));
	fclose($fp);

//	echo join("<br />", $lines);
}

$file = file($filename);

echo "<form action=\"edit.php\" method=\"POST\">";
echo "<table><tr><th>ID</th><th>Title</th><th>Address</th><th>Port</th><th>Parent</th><th>Description</th></tr>";


$parents = [];
$parents[0] = 'None';

foreach ($file AS $line) {
	$data = explode('|', $line);
	$parents[$data[0]] = $data[1];
}

$max = 1;

foreach ($file AS $num=>$line) {
	$data = explode('|', $line);
	echo "<tr>";
	echo "<td><input type=\"text\" id=\"id[".$num."]\" name=\"id[".$num."]\" value=\"".$data[0]."\" /></td>";
	echo "<td><input type=\"text\" id=\"title[".$num."]\" name=\"title[".$num."]\" value=\"".$data[1]."\" /></td>";
	echo "<td><input type=\"text\" id=\"addr[".$num."]\" name=\"addr[".$num."]\" value=\"".$data[2]."\" /></td>";
	echo "<td><input type=\"text\" id=\"port[".$num."]\" name=\"port[".$num."]\" value=\"".$data[3]."\" /></td>";
//	echo "<td><input type=\"text\" id=\"parent[".$num."]\" name=\"parent[".$num."]\" value=\"".$data[4]."\" /></td>";

	echo "<td><select id=\"parent[".$num."]\" name=\"parent[".$num."]\">";
	foreach ($parents AS $id=>$parent) {
		if ($id == $data[4]) {
			echo "<option selected value=\"".$id."\">".$parent."</option>";
		} else {
			echo "<option value=\"".$id."\">".$parent."</option>";
		}
	}
	echo "</select></td>";

	echo "<td><input type=\"text\" id=\"desc[".$num."]\" name=\"desc[".$num."]\" value=\"".$data[5]."\" /></td>";
	echo "</tr>";

	$max++;
}

if ($_REQUEST['action'] == 'add') {
	$num = $max++;
	echo "<tr>";
	echo "<td><input type=\"text\" id=\"id[".$num."]\" name=\"id[".$num."]\" value=\"".$num."\" /></td>";
	echo "<td><input type=\"text\" id=\"title[".$num."]\" name=\"title[".$num."]\" value=\"\" /></td>";
	echo "<td><input type=\"text\" id=\"addr[".$num."]\" name=\"addr[".$num."]\" value=\"\" /></td>";
	echo "<td><input type=\"text\" id=\"port[".$num."]\" name=\"port[".$num."]\" value=\"\" /></td>";

	echo "<td><select id=\"parent[".$num."]\" name=\"parent[".$num."]\">";
	foreach ($parents AS $id=>$parent) {
		echo "<option value=\"".$id."\">".$parent."</option>";
	}
	echo "</select></td>";

	echo "<td><input type=\"text\" id=\"desc[".$num."]\" name=\"desc[".$num."]\" value=\"\" /></td>";
	echo "</tr>";
}

echo "</table>";
echo "<input type=\"button\" value=\"Add\" onClick=\"top.location.href = 'edit.php?action=add&file=".substr($filename, 0, -4)."';\" /> <input type=\"submit\" value=\"Save\" />";
echo "</form>";

/*
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	echo "<plaintext>";

	print_r($_REQUEST);
}
*/

?>

<?php

$campus = (isset($_GET['campus']) && $_GET['campus'] != '') ? $_GET['campus'].'-netmap.txt' : 'netmap.txt';

function cmp($a, $b) {
	if ($a[1] == $b[1]) {
		return 0;
	}
	return ($a[1] < $b[1]) ? -1 : 1;
}

function chkHost($child) {
	if ($fp=fsockopen($child[2], $child[3], $errno, $errstr, 0.2)) {
		$retVal = "online";
		fclose($fp);
	} else {
		$retVal = "offline";
	}

	return $retVal;
}

function getDB() {
	global $campus;
	$db = array();
	$file = file($campus);
	foreach ($file AS $num=>$line) {
		$db[$num] = explode('|', $line);
	}
	return $db;
}

$db = getDB();

function getChildren($line) {
	global $db;
	// reset($db);
	$retArr = array();

	foreach ($db AS $num=>$arr) {
		if ($arr[4] == $line) {
			array_push($retArr, $arr);
		}
	}

	uasort($retArr, 'cmp');

	return $retArr;
}

function printChildren($line) {
	$arr = getChildren($line);

	if (count($arr) > 0) {
		echo "<ul>";
		foreach ($arr AS $num=>$child) {
			$start = microtime(true);
			if ($fp=fsockopen($child[2], $child[3], $errno, $errstr, 0.2)) {
			$time = microtime(true) - $start;
			echo "<li><a href=\"#\" class=\"online\">".$child[1]."<br />(".$child[2].":".$child[3].")<br />".number_format($time*1000,1,'.','')." ms</a>";
			fclose($fp);
		} else {
			$time = microtime(true) - $start;
			echo "<li><a href=\"#\" class=\"offline\">".$child[1]."<br />(".$child[2].":".$child[3].")<br />&gt;".number_format($time*1000,1,'.','')." ms</a>";
		}
			$child[0] = (int)$child[0];
			if (count(getChildren($child[0])) > 0) {
				printChildren($child[0]);
			}
			echo "</li>";
		}
		echo "</ul>";
	}
}

function printTree() {
	global $db;
	$child = $db[0];

	$start = microtime(true);
	if ($fp=fsockopen($child[2], $child[3], $errno, $errstr, 1)) {
		$time = microtime(true) - $start;
		echo "<div class=\"tree\"><ul><li><a href=\"#\" class=\"online\">".$child[1]."<br />(".$child[2].":".$child[3].")<br />".number_format($time*1000,1,'.','')." ms</a>";
		fclose($fp);
	} else {
		// if (!isset($_COOKIE['noalarm'])) echo "<audio src=\"alarm.mp3\" loop autoplay />";
		$time = microtime(true) - $start;
		echo "<div class=\"tree\"><ul><li><a href=\"javascript:void(0);\" onClick=\"stopAlarm();\" class=\"offline\">".$child[1]."<br />(".$child[2].":".$child[3].")<br />&gt;".number_format($time*1000,1,'.','')." ms</a>";
	}
	printChildren(1);
	echo "</li></ul></div>";
}


$header = ['es-netmap.txt'=>'Elementary', 'jh-netmap.txt'=>'Junior High', 'hs-netmap.txt'=>'High School'];

echo "<h1>".(isset($header[$campus]) ? $header[$campus] : 'Overview')."</h1>";

/*
switch($campus) {
	case 'es':
		echo "<h1>Elementary</h1>";
		break;
	case 'jh':
		echo "<h1>Junior High</h1>";
		break;
	case 'hs':
		echo "<h1>High School</h1>";
		break;
	default:
		echo "<h1>Overview</h1>";
		break;
}

echo "<h2>Campus: ".$campus."</h2>";
*/

printTree();

?>

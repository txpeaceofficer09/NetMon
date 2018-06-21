<?php

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
	$db = array();
	$file = file('netmap.txt');
	foreach ($file AS $num=>$line) {
		$db[$num] = explode('|', $line);
	}
	return $db;
}

$db = getDB();

function getChildren($line) {
	global $db;
	reset($db);
	$retArr = array();

	foreach ($db AS $num=>$arr) {
		if ($arr[4] == $line) {
			array_push($retArr, $arr);
		}
	}

	return $retArr;
}

function printChildren($line) {
	$arr = getChildren($line);

	if (count($arr) > 0) {
		echo "<ul>";
		foreach ($arr AS $num=>$child) {
			if ($fp=fsockopen($child[2], $child[3], $errno, $errstr, 0.2)) {
			echo "<li><a href=\"#\" class=\"online\">".$child[1]."</a>";
			fclose($fp);
		} else {
			echo "<li><a href=\"#\" class=\"offline\">".$child[1]."</a>";
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

	if ($fp=fsockopen($child[2], $child[3], $errno, $errstr, 1)) {
		echo "<div class=\"tree\"><ul><li><a href=\"#\" class=\"online\">".$child[1]."</a>";
		fclose($fp);
	} else {
		if (!isset($_COOKIE['noalarm'])) echo "<audio src=\"alarm.mp3\" loop autoplay />";
		echo "<div class=\"tree\"><ul><li><a href=\"javascript:void(0);\" onClick=\"stopAlarm();\" class=\"offline\">".$child[1]."</a>";
	}
	printChildren(1);
	echo "</li></ul></div>";
}

printTree();

?>

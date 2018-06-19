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
		echo "<div class=\"tree\"><ul><li><a href=\"#\" class=\"offline\">".$child[1]."</a>";
	}
	printChildren(1);
	echo "</li></ul></div>";
}

// print_r(getChildren(5))
// printChildren(5);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Network Monitor</title>
		<link rel="stylesheet" type="text/css" href="stylesheet.css" />
	</head>
<!--
We will create a family tree using just CSS(3)
The markup will be simple nested lists
-->

<?php printTree() ?>

<!--
<div class="tree">
	<ul>
		<li><a href="#">Internet</a>
		<?php printChildren(1); ?>
		</li>
	</ul>
</div>
-->

<!--
<div class="tree">
	<ul>
		<li>
			<a href="#">Parent</a>
			<ul>
				<li>
					<a href="#">Child</a>
					<ul>
						<li>
							<a href="#">Grand Child</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#">Child</a>
					<ul>
						<li><a href="#">Grand Child</a></li>
						<li>
							<a href="#">Grand Child</a>
							<ul>
								<li>
									<a href="#">Great Grand Child</a>
								</li>
								<li>
									<a href="#">Great Grand Child</a>
								</li>
								<li>
									<a href="#">Great Grand Child</a>
								</li>
							</ul>
						</li>
						<li><a href="#">Grand Child</a></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
</div>
-->
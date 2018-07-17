<!DOCTYPE html>
<html>
	<head>
		<title>Network Monitor</title>
		<meta charset="utf-8" />
		<script src="jquery-3.2.1.min.js"></script>
		<script src="javascript.js"></script>

<?php

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

if (isMobile()) {
	echo "\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=0, viewport-fit=cover\" />\n";
	echo "\t\t<link rel=\"stylesheet\" href=\"mobile.css\" />\n";
} else {
	echo "\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=0, viewport-fit=cover\" />\n";
	echo "\t\t<link rel=\"stylesheet\" href=\"stylesheet.css\" />\n";
}

?>
	</head>

	<body onLoad="loadTree();">
		<header>
			<h1>Network Monitor</h1>
		</header>
		<!--<input type="button" onClick="campus='';" value="Overview" />
		<input type="button" onClick="campus='es';" value="Elementary" />
		<input type="button" onClick="campus='jh';" value="Junior High" />
		<input type="button" onClick="campus='hs';" value="High School" />-->
		<section id="tree_container"><center><img src="loading.gif" /></center></section>
		<!--<section id="printers_container"><center><img src="loading.gif" /></center></section>-->
	</body>
</html>

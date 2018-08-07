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

	<body>
		<header>
			&nbsp;
		</header>
		<input type="button" onClick="changeScreen(0);" value="Overview" />
		<input type="button" onClick="changeScreen(1);" value="Elementary" />
		<input type="button" onClick="changeScreen(2);" value="Junior High" />
		<input type="button" onClick="changeScreen(3);" value="High School" />
		<input type="button" onClick="changeScreen(4);" value="Cameras" />
		<input type="button" onClick="changeScreen(5);" value="Printers" />
		<input type="button" onClick="changeScreen(6);" value="Servers" />
		<div class="flipswitch">
			<input type="checkbox" name="flipswitch" class="flipswitch-cb" id="fs" checked>
			<label class="flipswitch-label" for="fs">
				<div class="flipswitch-inner"></div>
				<div class="flipswitch-switch"></div>
			</label>
		</div>
		<section id="tree_container"><center><img src="loading.gif" /></center></section>
		<!--<section id="printers_container"><center><img src="loading.gif" /></center></section>-->

		<div class="tooltip"></div>
	</body>
</html>

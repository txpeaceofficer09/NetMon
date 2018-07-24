var campus = '';
var campuses = ['', 'es', 'jh', 'hs', 'cams', 'printers', 'servers', 'aps']
var i = 0;
var page = 'tree.php';

function loadTree() {
	setInterval(function() {
		ajaxRefresh(page, 'tree_container');
		/* ajaxRefresh('list_printers.php', 'printers_container'); */
	}, 5000);
	ajaxRefresh(page, 'tree_container');
	/* ajaxRefresh('list_printers.php', 'printers_container'); */
	setInterval(function() {
		rotateScreens();
	}, 20000);
}

function rotateScreens() {
/*
	$('section').each(function() {
		this.toggle(display);
	});
*/

	/*if ( $('#playbtn').val() == 'Pause' ) {*/
	if ( $('#fs').prop("checked") ) {
		i++;

		if (i == campuses.length) {
			i = 0;
		}

		if (i < 4) {
			page = 'tree.php';
		} else {
			page = 'devices.php';
		}

		campus = campuses[i];
	}
}

function toggleTimer() {
	if ( $('#playbtn').val() == 'Pause' ) {
		$('#playbtn').val('Play');
	} else {
		$('#playbtn').val('Pause');
	}
}

function changeScreen(e) {
	campus = campuses[e];
	if (e < 4) {
		page = 'tree.php';
	} else {
		page = 'devices.php';
	}
	ajaxRefresh(page, 'tree_container');
}

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires="+ d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function stopAlarm() {
	setCookie("noalarm", true, 1);
	ajaxRefresh('tree.php', 'tree_container');
}

function ajaxRefresh(url, e) {
		/* url = page; */
                var xmlhttp;
                if (window.XMLHttpRequest)
                {
                        xmlhttp=new XMLHttpRequest();
                } else {
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.onreadystatechange=function()
                {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200)
                        {
                                document.getElementById(e).innerHTML=xmlhttp.responseText;
                        }
                }

                xmlhttp.open("GET", url+'?campus='+campus, true);
                xmlhttp.send();
	console.log(url+'?campus='+campus+':'+i);
}

var campus = '';
var campuses = ['', 'es', 'jh', 'hs']
var i = 0;

function loadTree() {
	setInterval(function() {
		ajaxRefresh('tree.php', 'tree_container');
		/* ajaxRefresh('list_printers.php', 'printers_container'); */
	}, 5000);
	ajaxRefresh('tree.php', 'tree_container');
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

	i++;

	if (i == campuses.length) {
		i = 0;
	}

	campus = campuses[i];
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
	/* console.log(url+'?campus='+campus); */
}

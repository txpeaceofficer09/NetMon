function loadTree() {
	setInterval(function() {
		ajaxRefresh('tree.php', 'tree_container');
		ajaxRefresh('list_printers.php', 'printers_container');
	}, 10000);
	ajaxRefresh('tree.php', 'tree_container');
	ajaxRefresh('list_printers.php', 'printers_container');
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

                xmlhttp.open("GET", url, true);
                xmlhttp.send();
}

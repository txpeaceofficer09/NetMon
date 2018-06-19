function loadTree() {
	setInterval(function() {
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
				document.getElementById('tree_container').innerHTML=xmlhttp.responseText;
			}
		}

		xmlhttp.open("GET", 'tree.php', true);
		xmlhttp.send();
	}, 1000);
}

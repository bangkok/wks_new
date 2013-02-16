<html>
<head>
	<title>WKS</title>
	<link rel="icon" type="image/png" href="/img/favicon.png" />
	<meta http-equiv="refresh" content="5;http://<?=$_SERVER['HTTP_HOST']?>/home">
	<script language=javascript>
		function GoPage() {
			location.replace("http://<?=$_SERVER['HTTP_HOST']?>/home");
		}
	</script>
</head>

<body onload="setTimeout('GoPage()', 5000)" >
<center>
	<div style="margin-top:100px">
		<a href="http://<?=$_SERVER['HTTP_HOST']?>/home"><img src="/img/begin.jpg">
	</div>
</center>
</body>
</html>

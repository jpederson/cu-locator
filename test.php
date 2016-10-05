<?php $widget_url = "/api/?action=widget"; ?><!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Find A Credit Union</title>
	<meta name="description" content="Search 5095 Shared Credit Union Branches and 25,783 Co-op ATMs with no surcharges - all with the click of a button.">
	<meta name="author" content="James Pederson">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/css/main.css">
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<div class="bg-wood text-center">
		<h1>credit<strong>union</strong>.io test page</h1>
	</div>
	<div id="test" class="bg-wall text-center">
		<div class="grid-row">
			<div class="col4">
				<h3>Test: <strong>Mobile</strong></h3>
				<iframe src="<?php print $widget_url ?>" style="height:480px;width:320px;border:0;"></iframe>
			</div>
			<div class="col8">
				<h3>Test: <strong>Tablet</strong></h3>
				<iframe src="<?php print $widget_url ?>" style="height:500px;width:720px;border:0;"></iframe>
			</div>
		</div>
		<hr>
		<div class="grid-row">
			<div class="col12">
				<h3>Test: <strong>Desktop</strong></h3>
				<iframe src="<?php print $widget_url ?>" style="height:900px;width:1200px;border:0;"></iframe>
			</div>
		</div>
	</div>
	<div id="footer" class="bg-wood">
		<p>Copyright &copy; <?php print date( "Y" ); ?> <a href="http://jpederson.com/" target="_blank">James Pederson</a>. All Rights Reserved.</p>
		<p>CO-OP Network logo and name are property of their respective owners.</p>
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="/js/main.js"></script>
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-614793-7', 'creditunion.io');
	ga('send', 'pageview');
	</script>
</body>
</html>
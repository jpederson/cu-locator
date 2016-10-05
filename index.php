<?php
error_reporting('E_NOTICE');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Find A Credit Union</title>
	<meta name="description" content="Search 5095 Shared Credit Union Branches and 25,783 Co-op ATMs with no surcharges - all with the click of a button.">
	<meta name="author" content="James Pederson">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/asset/css/main.css">
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<div id="search" class="scroll-effect">
		<header>
			<img src="/asset/img/logo.png" id="logo">
		</header>
		<div id="tool">
			<iframe id="widget" src="/api/?action=widget"></iframe>
		</div>
		<div class="clear"></div>
	</div>
	<div id="integrate" class="bg-wall">
		<div class="widget">
			<div class="third">
				<h1>The <span>Concept</span></h1>
				<p>Most credit union websites lack dynamic and usable ATM and Branch search tools. Sure, they can
					link to a third party, or download one of the several databases that can be obtained, but 
					easily-embedded, pre-existing search tools are few and far between. With that in mind, 
					I created <strong>mycu.rocks</strong>. While users can come here directly to search, it's 
					really designed to be easy to build into your existing website using a small code snippet.</p>
				<p>We keep ATM and Branch lists up to date from the networks so you don't need to update your 
					database every time location updates occur. Continual improvements to the tool will add 
					new features without you needing to do anything.</p>
				<p>I hope your credit union can benefit from this tool. Please let me know how it works for you
					or if you have any suggestions - I'm always looking for ways to improve.</p>
				<p>Cheers,<br />
					<a href="http://www.jpederson.com/" target="_blank">James Pederson</a><br />
					Web Developer</p>
			</div>
			<div class="third">
				<h1>The <span>Tool</span></h1>
				<p><a href="http://co-opatm.org/" target="_blank" class="sprite right coop">CO-OP ATM Network</a>Currently, 
					the tool utilizes the database provided by the <strong>CO-OP Network</strong> - a vast, nation-wide
					group of credit unions and ATMs that join forces to make basic transactions simple for
					their members, even if they're in a state where their credit union doesn't have any branches.</p>
				<p class="quiet"><strong>Please note:</strong> I have no affiliation with the CO-OP Network or its creators. Their logo
					and name are their property and they aren't responsible for your experience on this site or
					while using the tool.</p>
				<hr />
				<h1>The <span>Future</span></h1>
				<p>I'd like to include more databases in this tool to increase the chances of results being shown
					no matter where a user searches from. I'll keep searching for more locations, but if you happen
					to know of a database I could use, drop me a line and tell me about it!</p>
				<p>Likewise, if you have feedback or would like help integrating the tool in your website, please 
					feel free to <a href="http://www.jpederson.com/" target="_blank">contact me</a> and I'll do everything 
					I can to help.</p>
			</div>
			<div class="third last">
				<h1><span>Embeds</span> Coming Soon!</h1>
				<p>As I finish developing the tool, I'll add a widget builder to this site so users can generate their
					own CU search tool right here.</p>
			</div>
			<div class="clear"></div>
			<hr>
			<div class="text-center">
				<a href="https://www.positivessl.com" style="border:0"><img src="https://www.positivessl.com/images-new/PositiveSSL_tl_trans2.gif" alt="SSL Certificate" title="SSL Certificate" border="0" /></a>
			</div>
		</div>
	</div>
	<div id="footer" class="bg-wood">
		<p>Copyright &copy; <?php print date( "Y" ); ?> <a href="http://jpederson.com/" target="_blank">James Pederson</a>. All Rights Reserved.</p>
		<p>CO-OP Network logo and name are property of their respective owners.</p>
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="/asset/js/main.js"></script>
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
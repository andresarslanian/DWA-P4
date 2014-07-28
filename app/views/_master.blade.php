<!doctype html>
<html>
<head>

	<title>@yield('title','Foobooks')</title>
	
	<!-- Bootstrap core CSS -->
	<link href="<?php echo URL::asset('/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::asset('/assets/css/custom.css') ?>">
	
	@yield('head')
	
</head>

<body>
	<nav class="navbar navbar-default p-navbar" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-philips">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="navbar-brand p-logo" >
					<a class="p-refresh " href="" >
                        
                    </a>
                    <a href="#" >
                        <span class="p-long"><br>&nbsp;&nbsp;&nbsp;Argentina</span>
                    </a>
				</div>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-philips">
				<ul class="nav navbar-nav p-nav">
					@if(Auth::check())
						<li class=""><a href="/list-users">Users</a></li>
						<li><a href="/list-incidents">Incidents</a></li>
						<li><a href="#">Replacements</a></li>
						<li><a href="#">Lamps</a></li>
					@endif
				</ul>
		
				<ul class="nav navbar-nav navbar-right">
					@if(Auth::check())
						<li><a href="/logout">Log out {{Auth::user()->name;}}</a></li>
					@else
						<li><a href="/login">Log In</a></li>
					@endif

				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>


	<div class="continer-fluid main-container">
		@yield('content')
	</div>

	<script type="text/javascript" src="<?php echo URL::asset('/assets/js/bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo URL::asset('/assets/js/custom.js') ?>"></script>
	@yield('body')
		
</body>

</html>


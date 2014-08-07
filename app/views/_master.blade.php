<!doctype html>
<html>
<head>

	<title>@yield('title','Philips')</title>
	
	<!-- Bootstrap core CSS -->
	<link href="<?php echo URL::asset('/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?php echo URL::asset('/assets/css/chosen.min.css') ?>" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo URL::asset('/assets/css/custom.css') ?>">
	
	@yield('head')
	
</head>

<body>
	<div id="p-header">
		<div id="p-header-wrapper" class="p-clearfix">
			<a href="http://www.philips.com/global/index.page" onclick="return _page.switchHandler('http://www.philips.com/global/index.page', '')">
				<img alt="Philips" src="http://www.crsc.philips.com/crsc/images/mainlogo.gif" id="p-mainlogo">
			</a>
			<div id="p-header-utils"></div>
		</div>
		<nav id="p-nav-site" class="navbar navbar-default p-navbar" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-philips">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="navbar-philips">
					<ul class="nav navbar-nav p-nav">
						@if(Auth::check())
						@if( Auth::user()->can('view_incidents') )
						<li><a href="/list-incidents">Incidents</a></li>
						@endif
						@if( Auth::user()->can('view_replacements') )						
						<li><a href="/list-replacements">Replacements</a></li>
						@endif
						@if( Auth::user()->can('upload_lamps') && Auth::user()->worksFor('Philips') )	
						<li><a href="/list-lamps">Lamps</a></li>
						@endif
						@if( Auth::user()->can('view_users_for_company'))
						<li class=""><a href="/list-users">Users</a></li>
						@endif
						@if( Auth::user()->can('view_companies'))
						<li class=""><a href="/list-companies">Companies</a></li>
						@endif

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

	</div>

	<div class="continer-fluid ">
		<div class="row">
			@yield('content')
		</div>
	</div>

	<script type="text/javascript" src="<?php echo URL::asset('/assets/js/bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo URL::asset('/assets/js/chosen.proto.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo URL::asset('/assets/js/chosen.jquery.js') ?>"></script>
	<script type="text/javascript" src="<?php echo URL::asset('/assets/js/custom.js') ?>"></script>

	@yield('body')

</body>

</html>


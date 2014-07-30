<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => array(
		'domain' => 'sandbox825e8a99f5094f93901193906f17ffb6.mailgun.org',
		'secret' => 'key-af9df62f7a2ec60d54d955a0f0f5bbf4',
		),

	'mandrill' => array(
		'secret' => '',
		),

	'stripe' => array(
		'model'  => 'User',
		'secret' => '',
		),

	);

<?php

// test | live

// $mode = 'test'
// if ($mode === 'test') {
	return [

		'stripe_key'	=>	env('STRIPE_KEY_TEST'),

		'stripe_pk_key'	=>	env('STRIPE_KEY_PK_TEST'),

		'stripe_connect'	=>	env('STRIPE_CONNECT_TEST'),

	];
// }
// else if($mode === 'live'){
// 	return [

// 		'stripe_key'	=>	env('STRIPE_KEY_LIVE'),

// 		'stripe_pk_key'	=>	env('STRIPE_KEY_PK_LIVE'),

// 		'stripe_connect'	=>	env('STRIPE_CONNECT_TEST'),

// 	];
// }
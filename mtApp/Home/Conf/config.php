<?php
return array(
	//'配置项'=>'配置值'
	'MODULE_ALLOW_LIST' => array('home'), 
    'URL_MODEL'=>2,
    // 开启路由
    'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES'=>array(
        'index' => 'Index/index',
        'websites'=>'Index/websites'
       //  '/^newsdetail\/(\d+)$/' => 'Index/newsDetail?id=:1',
       //  '/^tour\/(\d+)$/' => 'Index/getTour?id=:1',
       // // '/^tourdetail\/(\d+)\/(\d+)$/' => 'Index/tourDetail?id=:1&type=:1'
       //  '/^tourdetail\/(\d+)\/(\d)$/' => 'Index/tourDetail?id=:1&type=:2',
    ),
);
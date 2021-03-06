<?php

return [
	'_root_' => 'foolz/foolfuuka/chan/index',  // The default route
	'_/api/chan/(:any)' => 'foolz/foolfuuka/api/chan/$1',
	'_/advanced_search' => 'foolz/foolfuuka/chan/advanced_search',
	'_/theme/(:any)' => 'foolz/foolfuuka/chan/theme/$1',
	'_/language/(:any)' => 'foolz/foolfuuka/chan/language/$1',
	'_/opensearch' => 'foolz/foolfuuka/chan/opensearch/',
	'_/search' => 'foolz/foolfuuka/chan/search',
	'_/search/(:any)' => 'foolz/foolfuuka/chan/search',
	'search' => 'foolz/foolfuuka/chan/search',
	'search/(:any)' => 'foolz/foolfuuka/chan/search',
	'admin/boards' => 'foolz/foolfuuka/admin/boards/manage',
	'admin/boards/(:any)' => 'foolz/foolfuuka/admin/boards/$1',
	'admin/moderation' => 'foolz/foolfuuka/admin/moderation/reports',
	'admin/moderation/(:any)' => 'foolz/foolfuuka/admin/moderation/$1',
	'(?!(admin|_))(\w+)' => 'foolz/foolfuuka/chan/$2/page',
	'(?!(admin|_))(\w+)/(:any)' => 'foolz/foolfuuka/chan/$2/$3',
	'_/notfound/action404' => 'foolz/foolfuuka/chan/404', // we need to properly redirect the 404
	'_404_'=> '_/notfound/action404',    // The main 404 route
];
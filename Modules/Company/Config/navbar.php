<?php 
 return [
	'navbar' => [ 
 		[ 
			'label' => 'Companies',
			'icon' => 'business',
			'route' => 'company.companies',
			'permission' => '',
			'children' => [
			],
		],
		[ 
			'label' => 'Users',
			'icon' => 'person',
			'route' => 'company.users',
			'permission' => 'company.users',
			'children' => [
			],
		],
		[ 
			'label' => 'Department',
			'icon' => 'group',
			'route' => 'company.departments',
			'permission' => 'company.departments',
			'children' => [
			],
		],
		[ 
			'label' => 'Position',
			'icon' => 'check-list',
			'route' => 'company.positions',
			'permission' => 'company.positions',
			'children' => [
			],
		],

	]
];
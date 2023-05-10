<?php 
 return [
	'menu' => [ 
 		[ 
			'label' => 'Thông tin nhân viên',
			'icon' => 'account-line',
			'route' => 'company.staff-infomations',
			'permission' => 'company.staff-infomations',
			'children' => [
			],
		],
		[ 
			'label' => 'Công ty',
			'icon' => 'business',
			'route' => 'company.companies',
			'permission' => 'company.companies',
			'children' => [
			],
		],
		[ 
			'label' => 'Phòng ban',
			'icon' => 'account-manager',
			'route' => 'company.departments',
			'permission' => 'company.departments',
			'children' => [
			],
		],
		[ 
			'label' => 'Chức vụ',
			'icon' => 'account-manager',
			'route' => 'company.positions',
			'permission' => 'company.positions',
			'children' => [
			],
		],

	]
];
<?php 
 return [
	'menu' => [ 
 		[ 
			'label' => 'Chấm công',
			'icon' => 'edit',
			'route' => 'time-keep.timekeeps',
			'permission' => 'time-keep.timekeeps',
			'children' => [
			],
		],
		[ 
			'label' => 'Luật chấm công',
			'icon' => 'security',
			'route' => 'time-keep.timekeep-rules',
			'permission' => 'time-keep.timekeep-rules',
			'children' => [
			],
		],
		[ 
			'label' => 'Đơn',
			'icon' => 'contact-mail',
			'route' => 'time-keep.singles',
			'permission' => 'time-keep.singles',
			'children' => [
			],
		],
		[ 
			'label' => 'Loại nghỉ',
			'icon' => 'event',
			'route' => 'time-keep.applications',
			'permission' => 'time-keep.applications',
			'children' => [
			],
		],
		[ 
			'label' => 'Nghỉ lễ',
			'icon' => 'event',
			'route' => 'time-keep.holidays',
			'permission' => 'time-keep.holidays',
			'children' => [
			],
		],

	]
];
<?php namespace Model\Mobile;

use Model\Core\Module_Config;

class Config extends Module_Config {
	protected $name = 'Mobile';

	public function getRules(): array
	{
		return [
			'rules' => [
				'm' => 'm',
			],
			'controllers' => [],
		];
	}
}

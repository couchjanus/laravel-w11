<?php

namespace App\Widgets;

class Widget
{
    protected $widgets;

	public function __construct($widgets)
	{
		$this->widgets = $widgets;
    }
	
	// public function show()
	// {
	// 	return 'This is Show Method';
	// }

	// public function show()
	// {
	// 	$obj = new \App\Widgets\CategoriesWidget();
	// 	// $obj = new \App\Widgets\TagsWidget();
	// 	return $obj->execute();
	// }

	// public function show($obj)
	// {
	// 	if(isset($this->widgets[$obj])) {
	// 		$obj = new $this->widgets[$obj];
	// 		return $obj->execute();
	// 	}
	// }

	public function show($obj, $data =[])
	{
		if(isset($this->widgets[$obj])){
			$obj = new $this->widgets[$obj]($data);
			return $obj->execute();
		}
	}

}

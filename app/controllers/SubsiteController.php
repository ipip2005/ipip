<?php
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
class SubsiteController extends BaseController {
	/**
	 * generate subsite Page.
	 */
	public function getTools(){
		$this->layout->title = 'ipip Tools, ipip的工具箱';
		$this->layout->main = View::make('tools/tools');
	}
	public function getTool(){
		return $this->getTools();
	}
}

<?php
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
class ToolController extends BaseController {
	/**
	 * generate subsite Page.
	 */
	public function getIndex(){
		$this->layout->title = 'ipip Tools, ipip的工具箱';
		$this->layout->main = View::make('tools/tools');
	}
	
}
<?php
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
class AdminController extends BaseController {
	public function __construct() {
		// updated: prevents re-login.
		$this->beforeFilter ( 'auth');
	}
	
	/**
	 * get dashboard
	 */
	public function getDashBoard(){
		$layout = View::make('master');
		$layout->title = 'ipip - dashboard';
		$layout->main = View::make('admin/dash')->with('content', 'Control Board');
		return $layout;
	}
	public function getPost(){
		$this->layout->title = 'ipip - Post an article';
		$this->layout->main = View::make('admin/post');
	}
}

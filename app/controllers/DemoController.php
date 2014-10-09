<?php
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Response;
class DemoController extends BaseController {
	/**
	 * generate subsite Page.
	 */
	public function getIndex() {
		$this->layout->title = 'ipip Demos, ipip的Demo';
		$this->layout->main = View::make ( 'demos/demos' );
	}
	public function getBreakpointResume() {
		$this->layout->title = 'ipip demos-Breakpoint-Resume';
		$this->layout->main = View::make ( 'demos/BreakpointResume' );
	}
	public function missingMethod($parameters = array()){
		return Redirect::to('/');
	}
}

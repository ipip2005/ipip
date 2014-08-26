<?php

class LabelController extends BaseController
{
	public function getCreate(){
		$label = [
			'label_name' => Input::get('label_name'),
			'father_label_id' => Input::get('father_label_name')
		];
		$rules =[
			'label_name' => 'required'
		];
		$validator = Validator::make($label, $rules);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$have = Label::where('label_name', '=', $label['label_name'])->count();
		if ($have > 0){
			return Redirect::back()->withInput()->with(['error' => 'label_name already exists!']);
		}
		$label = new Label($label);
		$label->save();
		return Redirect::back()->withInput()->with(['success' => 'create label successfully!']);
	}
	public function getDelete(){
		$label = [
			'label_name' =>Input::get('label_name'),
		];
		$rules =[
			'label_name' => 'required'
		];
		$validator = Validator::make($label, $rules);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$label = Label::where('label_name', '=', $label['label_name']);
		$have = $label->count();
		if ($have == 0){
			return Redirect::back()->withInput()->with(['error'=>'name does not exist!']);
		}
		$label->delete();
		return Redirect::back()->withInput()->with(['success' => 'deleted']);
	}
}
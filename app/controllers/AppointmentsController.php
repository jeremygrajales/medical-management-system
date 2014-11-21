<?php

class AppointmentsController extends BaseController {

	public function create()
	{
		$reason = "";
		$constraints = "";
		
		return View::make('appointments/create', compact('reason', 'constraints'));
	}
	
	public function show() {
		return View::make('appointments/show', compact('reason', 'constraints'));
	}
	
	public function showAll() {
		return View::make('appointments/show-all', compact('reason', 'constraints'));
	}
	
	public function edit() {
		return View::make('appointments/edit', compact('reason', 'constraints'));
	}
	
	public function changeStatus() {
		return View::make('appointments/status/edit', compact('reason', 'constraints'));
	}
	

}

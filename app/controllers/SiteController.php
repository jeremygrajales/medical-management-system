<?php



/**
 * SiteController Class
 *
 */
class SiteController extends Controller
{

	public function getIndex() {
		
		return View::make('site.index');
		
	}
 
}

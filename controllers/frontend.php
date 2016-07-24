<?php
/**
 * Frontend Controller
 *
 * @package Education Express Plugin
 * 
 */
 
class FrontendController	{
	
	function __construct()	{
		
	}
	
	function add_javacript()	{
		FrontendView::load_javacript();
	}
}
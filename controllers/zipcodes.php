<?php 
/**
 * Zipcodes Controller
 *
 * @package Education Express Plugin
 * 
 */

class ZipcodesController	{
	
	function __construct()	{
		/* nothing */
	}
	
	function get_zipcodes()	{
		$count_trash = ZipcodesModel::get_count_by_status('trash');
		$count_all = ZipcodesModel::get_count_by_status('');
		$filterparam['pagination_type'] = '';
		$filterparam['paged'] = '';
		$filterparam['trashstatus'] = '';
		$filterparam['rows_per_page'] = 20;
		$filterparam['count_trash'] = $count_trash;
		$filterparam['count_all'] = $count_all;	
	
		$limits = ZipcodesController::pagination($filterparam);
		$filterparam = array_merge($filterparam,$limits);
		$data = ZipcodesModel::get_by_status('','','',$filterparam);
		ZipcodesView::load_zipcodes($data, $count_trash, $count_all, '', $filterparam);	
	}
	
	// use for ajax
	function loadzipcodes($trashstatus = null, $filterparam = null)	{
		$count_trash = ZipcodesModel::get_count_by_status('trash',$filterparam);
		$count_all = ZipcodesModel::get_count_by_status('',$filterparam);
		$filterparam['trashstatus'] = $trashstatus;
		$filterparam['count_trash'] = $count_trash;
		$filterparam['count_all'] = $count_all;	

		$limits = ZipcodesController::pagination($filterparam);
		$filterparam = array_merge($filterparam,$limits);
		$data = ZipcodesModel::get_by_status($trashstatus,'','',$filterparam);
		ZipcodesView::load_table($data, $count_trash, $count_all, $trashstatus, $filterparam);
	}
	
	function load_filtered_zipcode($trashstatus = null, $filterparam = null)	{
		$count_trash = ZipcodesModel::get_count_by_status('trash',$filterparam);
		$count_all = ZipcodesModel::get_count_by_status('',$filterparam);
		$filterparam['trashstatus'] = $trashstatus;
		$filterparam['count_trash'] = $count_trash;
		$filterparam['count_all'] = $count_all;		

		$limits = ZipcodesController::pagination($filterparam);
		$filterparam = array_merge($filterparam,$limits);
		$data = ZipcodesModel::get_by_status($trashstatus,'','',$filterparam);
		ZipcodesView::load_table($data, $count_trash, $count_all, $trashstatus, $filterparam);
	}
	
	function pagination($filterparam=null)	{
		
		if($filterparam['trashstatus'] == 'trash')	
			$total_items = (int) $filterparam['count_trash'];
		else
			$total_items = (int) $filterparam['count_all'];	
		
		$rows_per_page = 20;
		if($filterparam['rows_per_page'] != '')
			$rows_per_page = $filterparam['rows_per_page'];
		
		$max_paged = ceil($total_items / $rows_per_page);
		
		if($filterparam['pagination_type'] == 'next')
			$paged = ((int) $filterparam['paged']) + 1;
		elseif($filterparam['pagination_type'] == 'previous')
			$paged = ((int) $filterparam['paged']) - 1;
		elseif($filterparam['pagination_type'] == 'first')
			$paged = 1;
		elseif($filterparam['pagination_type'] == 'last')
			$paged = $max_paged;
		else
			$paged = ((int) $filterparam['paged']);

		if($paged < 1)
			$paged = 1;
		if($paged > $max_paged)
			$paged = $max_paged;
		
		$end = $rows_per_page;	
		$start = ($paged  * $rows_per_page) - $rows_per_page;
		if($start < 1)
			$start = 0;
		
			
		$limits['limit_start'] = $start;
		$limits['limit_end'] = $end;
		$limits['limit_paged'] = $paged;
		$limits['limit_max_paged'] = $max_paged;
		$limits['limit_total_items'] = $total_items;
		
		return $limits;
	}
	
}

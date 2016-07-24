<?php
/**
 * Frontend Model
 *
 * @package Education Express Plugin
 * 
 */

class FrontendModel {
	
	private $id;
	
	function __construct($data=null)	{
		//nothing
	}
	
	function refine_search($getdegree, $getstudies, $getschopt, $getzip)	{
		global $wpdb, $table_prefix,$current_user;

		$tbl_programs = ProgramsModel::get_table_name();
		$tbl_studies = StudiesModel::get_table_name();
		$tbl_degrees = DegreesModel::get_table_name();
		$tbl_schools = SchoolsModel::get_table_name();
		$tbl_zipcodes = ZipcodesModel::get_table_name();
		
		$query = "";
		$query .= "SELECT sch.id AS schoolID ,sch.name AS schoolname, sch.description AS schooldescription, sch.logo AS schoollogo,
						  pro.id AS programID, pro.name AS programname
				  FROM ".$tbl_programs." AS pro
				  LEFT JOIN ".$tbl_schools." AS sch ON (pro.school_id = sch.id) 
				  LEFT JOIN ".$tbl_degrees." AS deg ON (pro.degree_id = deg.id)
				  LEFT JOIN ".$tbl_studies." AS stu ON (pro.study_id = stu.id)
				  LEFT JOIN ".$tbl_zipcodes." AS zip ON (zip.school_id = sch.id)
				  WHERE pro.trashed = '0'
				 ";
		
		if($getdegree != '')
			$query .= "  AND pro.degree_id = '".$getdegree."'	";
			
		if($getstudies != '')
			$query .= "  AND pro.study_id = '".$getstudies."'	";
			
		if($getschopt != 'all')
			$query .= "  AND sch.stype = '".$getschopt."'	";

		if($getzip != '')	{
			//$query .= "  AND sch.zipcode = '".$getzip."'	";
			$query .= "  AND zip.name = '".$getzip."'	";
		}
		
		$rows = $wpdb->get_results( $query );
		return $rows;
	}

}
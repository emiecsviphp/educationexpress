<?php
/**
 * Programs Model
 *
 * @package Education Express Plugin
 * 
 */

class ProgramsModel	{
	
	private $id;
	private $school_id;
	private $degree_id;
	private $study_id;
	private $name;
	private $params;
	
	function __construct($data=null)	{
		global $wpdb;
		$this->id = $this->qoute($data['programid']);
		$this->params = $data;
		$this->name = $this->qoute($data['programname']);
		$this->school_id = $this->qoute($data['schools']);
		$this->degree_id = $this->qoute($data['degrees']);
		$this->study_id = $this->qoute($data['studies']);
	}
	
	function get_params()	{
		return $this->params;
	}
	
	function get_table_name()	{
		$eedatabase = new EEDatabase();
		$table_name = $eedatabase->ee_programs;
		return $table_name;
	}
	
	function get_other_table_name($param)	{
		$eedatabase = new EEDatabase();
		
		if($param == 'schools')
			$table_name = $eedatabase->ee_schools;
		if($param == 'degrees')
			$table_name = $eedatabase->ee_degrees;
		if($param == 'studies')
			$table_name = $eedatabase->ee_studies;

		return $table_name;
	}
	
	function save()	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ProgramsModel::get_table_name();
		
		if($this->id == '')	{		
			$wpdb->query("
				INSERT INTO ".$table_name." (name, school_id, degree_id, study_id)
				VALUES ('".$this->name."', '".$this->school_id."', '".$this->degree_id."', '".$this->study_id."')
			");
			$school_id = $wpdb->insert_id;
		}
		else	{
			$wpdb->query(" UPDATE ".$table_name." 
						   SET name = '".$this->name."',
						       school_id = '".$this->school_id."',
						       degree_id = '".$this->degree_id."',
						       study_id = '".$this->study_id."'
						   WHERE id = '".$this->id."' ");
			$school_id = $this->id;
		}
	
		return $school_id;
	}
	
	function trash($id)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ProgramsModel::get_table_name();
		
		if(!is_array($id))
			$wpdb->query(" UPDATE ".$table_name." SET trashed = '1' WHERE id = '".$id."' ");
			
		if(is_array($id))
			$wpdb->query(" UPDATE ".$table_name." SET trashed = '1' WHERE id IN (".implode(',',$id).") ");
	}
	
	function restore($id)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ProgramsModel::get_table_name();

		if(!is_array($id))
			$wpdb->query(" UPDATE ".$table_name." SET trashed = '0' WHERE id = '".$id."' ");
			
		if(is_array($id))
			$wpdb->query(" UPDATE ".$table_name." SET trashed = '0' WHERE id IN (".implode(',',$id).") ");
	}

	function remove($id)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ProgramsModel::get_table_name();

		if(!is_array($id))
			$wpdb->query(" DELETE FROM ".$table_name." WHERE id = '".$id."' ");
			
		if(is_array($id))
			$wpdb->query(" DELETE FROM ".$table_name." WHERE id IN (".implode(',',$id).") ");
	}
	
	function get_by_id($id)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ProgramsModel::get_table_name();
		$row = $wpdb->get_row( " SELECT * FROM ".$table_name." WHERE id = '".$id."' LIMIT 1" );
		return $row;	
	}
	
	function get_by_status($trashstatus = null, $filterparam=null)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ProgramsModel::get_table_name();
		
		if($trashstatus == 'trash')
			$tstatus = 1;
		else
			$tstatus = 0;
		
		$query = '';
		$query .= " SELECT * FROM ".$table_name." WHERE trashed = ".$tstatus." ";
		
		//textsearch
		if( isset($filterparam['textsearch']) && $filterparam['textsearch'] != '')	{
			$query .= " AND name LIKE '%".trim($filterparam['textsearch'])."%' ";
		}
		if( isset($filterparam['filter_school']) && $filterparam['filter_school'] != '')	{
			$query .= " AND school_id = '".$filterparam['filter_school']."' ";
		}
		if( isset($filterparam['filter_degree']) && $filterparam['filter_degree'] != '')	{
			$query .= " AND degree_id = '".$filterparam['filter_degree']."' ";
		}
		if( isset($filterparam['filter_study']) && $filterparam['filter_study'] != '')	{
			$query .= " AND study_id = '".$filterparam['filter_study']."' ";
		}
		$query .= " ORDER BY id DESC ";

		if( isset($filterparam['limit_start']) && isset($filterparam['limit_end']) )
			$query .= "  LIMIT ".$filterparam['limit_start'].", ".$filterparam['limit_end']."  ";

		$rows = $wpdb->get_results( $query );
		return $rows;
	}

	function get_count_by_status($trashstatus = null, $filterparam=null)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ProgramsModel::get_table_name();

		if($trashstatus == 'trash')
			$tstatus = 1;
		else
			$tstatus = 0;
		
		$query = '';
		$query .= " SELECT COUNT(id) FROM ".$table_name." WHERE trashed = ".$tstatus." ";
		//textsearch
		if( isset($filterparam['textsearch']) && $filterparam['textsearch'] != '')	{
			$query .= " AND name LIKE '%".trim($filterparam['textsearch'])."%' ";
		}
		if( isset($filterparam['filter_school']) && $filterparam['filter_school'] != '')	{
			$query .= " AND school_id = '".$filterparam['filter_school']."' ";
		}
		if( isset($filterparam['filter_degree']) && $filterparam['filter_degree'] != '')	{
			$query .= " AND degree_id = '".$filterparam['filter_degree']."' ";
		}
		if( isset($filterparam['filter_study']) && $filterparam['filter_study'] != '')	{
			$query .= " AND study_id = '".$filterparam['filter_study']."' ";
		}
		$query .= " ORDER BY id DESC ";
		
		$count = $wpdb->get_var( $query);
		return $count;
	}
	
	function qoute($str)	{
		return mysql_real_escape_string($str);
	}

}
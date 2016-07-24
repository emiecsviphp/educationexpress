<?php
/**
 * Studies Model
 *
 * @package Education Express Plugin
 * 
 */

class StudiesModel	{
	
	private $id;
	private $name;
	private $params;
	
	function __construct($data=null)	{
		global $wpdb;
		$this->id = $this->qoute($data['studyid']);
		$this->params = $data;
		$this->name = $this->qoute($data['studyname']);
	}
	
	function get_params()	{
		return $this->params;
	}
	
	function get_table_name()	{
		$eedatabase = new EEDatabase();
		$table_name = $eedatabase->ee_studies;
		return $table_name;
	}
	
	function save()	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = StudiesModel::get_table_name();
		
		if($this->id == '')	{		
			$wpdb->query("
				INSERT INTO ".$table_name." (name)
				VALUES ('".$this->name."')
			");
			$school_id = $wpdb->insert_id;
		}
		else	{
			$wpdb->query(" UPDATE ".$table_name." 
						   SET name = '".$this->name."'
						   WHERE id = '".$this->id."' ");
			$school_id = $this->id;
		}
	
		return $school_id;
	}
	
	function trash($id)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = StudiesModel::get_table_name();

		if(!is_array($id))
			$wpdb->query(" UPDATE ".$table_name." SET trashed = '1' WHERE id = '".$id."' ");
			
		if(is_array($id))
			$wpdb->query(" UPDATE ".$table_name." SET trashed = '1' WHERE id IN (".implode(',',$id).") ");
	}
	
	function restore($id)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = StudiesModel::get_table_name();
		
		if(!is_array($id))
			$wpdb->query(" UPDATE ".$table_name." SET trashed = '0' WHERE id = '".$id."' ");
			
		if(is_array($id))
			$wpdb->query(" UPDATE ".$table_name." SET trashed = '0' WHERE id IN (".implode(',',$id).") ");
	}

	function remove($id)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = StudiesModel::get_table_name();
		
		if(!is_array($id))
			$wpdb->query(" DELETE FROM ".$table_name." WHERE id = '".$id."' ");
			
		if(is_array($id))
			$wpdb->query(" DELETE FROM ".$table_name." WHERE id IN (".implode(',',$id).") ");
	}
	
	function get_by_id($id)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = StudiesModel::get_table_name();
		$row = $wpdb->get_row( " SELECT * FROM ".$table_name." WHERE id = '".$id."' LIMIT 1" );
		return $row;
	}
	
	function get_by_status($trashstatus = null, $orderbyfield=null, $asc=null,$filterparam=null)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = StudiesModel::get_table_name();

		$order_field = 'id';
		if($orderbyfield != '')	
			$order_field = $orderbyfield;

		if($asc)
			$order = 'ASC';
		else
			$order = 'DESC';
		
		//textsearch
		$textsearch_query = "";
		if( isset($filterparam['textsearch']) && $filterparam['textsearch'] != '' )	{
			$textsearch_query .= " AND name LIKE '%".trim($filterparam['textsearch'])."%' ";
		}
		
		if($trashstatus == 'trash')
			$query = " SELECT * FROM ".$table_name." WHERE trashed = 1 ".$textsearch_query." ORDER BY ".$order_field." ".$order."";
		else
			$query = " SELECT * FROM ".$table_name." WHERE trashed = 0 ".$textsearch_query." ORDER BY ".$order_field." ".$order."";
		
		if( isset($filterparam['limit_start']) && isset($filterparam['limit_end']) )
			$query .= "  LIMIT ".$filterparam['limit_start'].", ".$filterparam['limit_end']."  ";
		
		$rows = $wpdb->get_results( $query );
		return $rows;
	}


	function get_count_by_status($trashstatus = null, $filterparam=null)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = StudiesModel::get_table_name();

		//textsearch
		$textsearch_query = "";
		if($filterparam['textsearch'] != '')	{
			$textsearch_query .= " AND name LIKE '%".trim($filterparam['textsearch'])."%' ";
		}
		
		if($trashstatus == 'trash')
			$query = " SELECT COUNT(id) FROM ".$table_name." WHERE trashed = 1 ".$textsearch_query." ORDER BY id DESC ";
		else
			$query = " SELECT COUNT(id) FROM ".$table_name." WHERE trashed = 0 ".$textsearch_query." ORDER BY id DESC ";
		
		$count = $wpdb->get_var( $query);
		return $count;
	}
	
	function qoute($str)	{
		return mysql_real_escape_string($str);
	}

}
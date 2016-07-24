<?php
/**
 * Zipcodes Model
 *
 * @package Education Express Plugin
 * 
 */

class ZipcodesModel	{
	
	private $id;
	private $school_id;
	private $name;
	private $params;
	
	function __construct($data=null)	{
		global $wpdb;
		$this->id = $this->qoute($data['zipcodeid']);
		$this->school_id = $this->qoute($data['schools']);
		$this->name = $this->qoute($data['zipcodename']);
		$this->params = $data;
	}
	
	function get_params()	{
		return $this->params;
	}
	
	function get_table_name()	{
		$eedatabase = new EEDatabase();
		$table_name = $eedatabase->ee_zipcodes;
		return $table_name;
	}
	
	function save()	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ZipcodesModel::get_table_name();
		
		if($this->id == '')	{		
			$wpdb->query("
				INSERT INTO ".$table_name." (school_id,name)
				VALUES ('".$this->school_id."','".$this->name."')
			");
			$school_id = $wpdb->insert_id;
		}
		else	{
			$wpdb->query(" UPDATE ".$table_name." 
						   SET school_id = '".$this->school_id."',
							   name = '".$this->name."'
						   WHERE id = '".$this->id."' ");
			$school_id = $this->id;
		}
	
		return $school_id;
	}
	
	function trash($id)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ZipcodesModel::get_table_name();

		if(!is_array($id))
			$wpdb->query(" UPDATE ".$table_name." SET trashed = '1' WHERE id = '".$id."' ");
			
		if(is_array($id))
			$wpdb->query(" UPDATE ".$table_name." SET trashed = '1' WHERE id IN (".implode(',',$id).") ");
	}
	
	function restore($id)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ZipcodesModel::get_table_name();
		
		if(!is_array($id))
			$wpdb->query(" UPDATE ".$table_name." SET trashed = '0' WHERE id = '".$id."' ");
			
		if(is_array($id))
			$wpdb->query(" UPDATE ".$table_name." SET trashed = '0' WHERE id IN (".implode(',',$id).") ");
	}

	function remove($id)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ZipcodesModel::get_table_name();
		
		if(!is_array($id))
			$wpdb->query(" DELETE FROM ".$table_name." WHERE id = '".$id."' ");
			
		if(is_array($id))
			$wpdb->query(" DELETE FROM ".$table_name." WHERE id IN (".implode(',',$id).") ");
	}
	
	function get_by_id($id)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ZipcodesModel::get_table_name();
		$row = $wpdb->get_row( " SELECT * FROM ".$table_name." WHERE id = '".$id."' LIMIT 1" );
		return $row;
	}
	
	function get_by_status($trashstatus = null, $orderbyfield=null, $asc=null, $filterparam=null)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ZipcodesModel::get_table_name();

		$order_field = 'id';
		if($orderbyfield != '')	
			$order_field = $orderbyfield;

		if($asc)
			$order = 'ASC';
		else
			$order = 'DESC';
		
		$schquery = "";
		if( isset($filterparam['textsearch']) && $filterparam['textsearch'] != '' )
			$schquery .= " AND name LIKE '%".trim($filterparam['textsearch'])."%' ";
		if( isset($filterparam['zipcode_filter_school']) && $filterparam['zipcode_filter_school'] != '' )
			$schquery .= "AND school_id = '".trim($filterparam['zipcode_filter_school'])."'";

		if($trashstatus == 'trash')
			$query = " SELECT * FROM ".$table_name." WHERE trashed = 1 ".$schquery." ORDER BY ".$order_field." ".$order." ";
		else
			$query = " SELECT * FROM ".$table_name." WHERE trashed = 0 ".$schquery." ORDER BY ".$order_field." ".$order." ";
		
		if( isset($filterparam['limit_start']) && isset($filterparam['limit_end']) )
			$query .= "  LIMIT ".$filterparam['limit_start'].", ".$filterparam['limit_end']."  ";
			
			
		$rows = $wpdb->get_results( $query );
		return $rows;
	}


	function get_count_by_status($trashstatus = null, $filterparam=null)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ZipcodesModel::get_table_name();

		$schquery = "";
		if($filterparam['textsearch'] != '')
			$schquery .= " AND name LIKE '%".trim($filterparam['textsearch'])."%' ";
		if($filterparam['zipcode_filter_school'] != '')
			$schquery .= "AND school_id = '".trim($filterparam['zipcode_filter_school'])."'";
		
		if($trashstatus == 'trash')
			$query = " SELECT COUNT(id) FROM ".$table_name." WHERE trashed = 1 ".$schquery." ORDER BY id DESC ";
		else
			$query = " SELECT COUNT(id) FROM ".$table_name." WHERE trashed = 0 ".$schquery." ORDER BY id DESC ";
		
		$count = $wpdb->get_var( $query);
		return $count;
	}
	
	function qoute($str)	{
		return mysql_real_escape_string($str);
	}

	function get_count_by_name_and_school($name=null,$schoolid=null)	{
		global $wpdb, $table_prefix,$current_user;

		$table_name = ZipcodesModel::get_table_name();
		$count = $wpdb->get_var( " SELECT COUNT(id) FROM ".$table_name." WHERE name = '".$name."' AND school_id = '".$schoolid."' ORDER BY id DESC " );
		return $count;
	}	
	
	function insert_multiple_rows($data=null)	{
		global $wpdb, $table_prefix,$current_user;
		$table_name = ZipcodesModel::get_table_name();

		if(count($data) > 0)	{
			$query = "";
			$query .= "INSERT INTO ".$table_name." (name) VALUES ";
			$counter = 0;
			foreach($data as $zipcode)	{
				$counter++;
				$query .= "(".$zipcode.")";
				if( $counter != count($data) )	{
					$query .= ",";
				}
			}
			$query .= ";";
		
			$wpdb->query($query);
		}
	}

	function insert_multiple_rows_distinct($data=null)	{
		global $wpdb, $table_prefix,$current_user;
		$table_name = ZipcodesModel::get_table_name();

		if(count($data['zipcodename']) > 0)	{
			foreach($data['zipcodename'] as $zipcode)	{
				$counter = ZipcodesModel::get_count_by_name_and_school($zipcode, $data['zipcode_school']);
				if($counter < 1)	{
					$newdata['zipcodeid'] = $data['zipcodeid'];
					$newdata['zipcodename'] = $zipcode;
					$newdata['schools'] = $data['zipcode_school'];
					$eeszipcodes = new ZipcodesModel($newdata);
					$zip_new_id = $eeszipcodes->save();
				}
			}
		}
	}	
	
}
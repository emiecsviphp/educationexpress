<?php
/*
Plugin Name: Education Express
Plugin URI: 
Description: 
Version: 0.1
Author: James Bolongan
Author URI: 
*/

//error_reporting(0);


include_once dirname( __FILE__ ).'/helpers/form.php';

$modules = array('main' ,'schools','degrees','studies','programs','frontend', 'zipcodes');
foreach($modules as $module)	{
	include_once dirname( __FILE__ ).'/controllers/'.$module.'.php';
	include_once dirname( __FILE__ ).'/models/'.$module.'.php';
	include_once dirname( __FILE__ ).'/views/'.$module.'.php'; 
}

new EEDatabase();

class EEDatabase	{

	public $ee_schools;
	public $ee_degrees;
	public $ee_studies;
	public $ee_programs;
	public $ee_zipcodes;
	
	public function __construct()	{
		global $wpdb;
		$this->ee_schools = $wpdb->prefix . "ee_schools";
		$this->ee_degrees = $wpdb->prefix . "ee_degrees";
		$this->ee_studies = $wpdb->prefix . "ee_studies";
		$this->ee_programs = $wpdb->prefix . "ee_programs";
		$this->ee_zipcodes = $wpdb->prefix . "ee_zipcodes";
		
		register_activation_hook( __FILE__, array( $this, 'ee_install') );
		//register_activation_hook( __FILE__, array( $this, 'yahoo_answers_install_data') );
	}

	public function get_ee_schools() {
		return $this->ee_schools;
	}
	
	public function ee_install() {
	   global $ee_install;	   
	   $sql_schools = "CREATE TABLE $this->ee_schools (
						  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
						  name varchar(100) NOT NULL,
						  description longtext DEFAULT NULL,
						  logo varchar(100) DEFAULT NULL,
						  stype varchar(10) DEFAULT NULL,
						  zipcode varchar(20) DEFAULT NULL,
						  trashed tinyint(1) DEFAULT 0,
						  PRIMARY KEY (id)
					   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
					  ";
					  
	   $sql_zipcodes = "CREATE TABLE $this->ee_zipcodes (
						  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
						  name bigint(20) DEFAULT NULL,
						  school_id bigint(20) unsigned NOT NULL DEFAULT '0',
						  trashed tinyint(1) DEFAULT 0,
						  PRIMARY KEY (id),
						  KEY name (name),
						  KEY school_id (school_id)
					   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
					  ";
					  
	   $sql_degrees = "CREATE TABLE $this->ee_degrees (
						  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
						  name varchar(100) NOT NULL,
						  trashed tinyint(1) DEFAULT 0,
						  PRIMARY KEY (id)
					   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
					  ";
					  
	   $sql_studies = "CREATE TABLE $this->ee_studies (
						  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
						  name varchar(100) NOT NULL,
						  trashed tinyint(1) DEFAULT 0,
						  PRIMARY KEY (id)
					   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
					  ";
	   $sql_programs = "CREATE TABLE $this->ee_programs (
						  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
						  school_id bigint(20) unsigned NOT NULL DEFAULT '0',
						  degree_id bigint(20) unsigned NOT NULL DEFAULT '0',
						  study_id bigint(20) unsigned NOT NULL DEFAULT '0',
						  name varchar(100) DEFAULT NULL,
						  trashed tinyint(1) DEFAULT 0,
						  PRIMARY KEY (id),
						  KEY school_id (school_id),
						  KEY degree_id (degree_id),
						  KEY study_id (study_id)
					   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
					  ";
			
	   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	   dbDelta($sql_schools);
	   dbDelta($sql_zipcodes);
	   dbDelta($sql_degrees);
	   dbDelta($sql_studies);
	   dbDelta($sql_programs);
	 
	   add_option( "ee_install", $ee_install );
	}

	public function yahoo_answers_install_data() {
	   global $wpdb;
	   
	   $name = 'jamesttest';
	   $comment_ID = 1;
	   $author_avatar = 'http://l.yimg.com/sc/28194/answers1/images/a/i/identity/nopic_48.png';
	   $timeadded = current_time('mysql');
	   
	   $rows_affected = $wpdb->insert( $this->ee_schools, array( 
							'yahoo_id' => $yahoo_id, 
							'comment_ID' => $comment_ID, 
							'author_avatar' => $author_avatar, 
							'timeadded' => $timeadded 							
						));
	}
}


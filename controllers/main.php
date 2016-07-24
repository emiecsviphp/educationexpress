<?php
/**
 * Main Controller
 *
 * @package Education Express Plugin
 * 
 */
  
new MainController();

class MainController	{
	
	function __construct()	{
		add_action( 'admin_enqueue_scripts', array( $this, 'load_schools_js_css' ) );
		add_action( 'admin_menu', array( $this, 'add_ee_menu' ) );
		add_action( 'wp_ajax_zipcode_ajax', array( $this, 'zipcode_ajax' ) );
		add_action( 'wp_ajax_school_ajax', array( $this, 'school_ajax' ) );
		add_action( 'wp_ajax_degree_ajax', array( $this, 'degree_ajax' ) );
		add_action( 'wp_ajax_study_ajax', array( $this, 'study_ajax' ) );
		add_action( 'wp_ajax_program_ajax', array( $this, 'program_ajax' ) );
	}

	function add_ee_menu()	{
		add_menu_page('Education Express', 'Education Express', 'administrator', 'education-express', array( &$this, 'general_settings_ee'));
		add_submenu_page( 'education-express', 'General Settings', 'General Settings', 'administrator', 'education-express', array( &$this, 'general_settings_ee'));
		add_submenu_page( 'education-express', 'Schools', 'Schools', 'administrator', 'education-express-schools', array( 'SchoolsController', 'get_schools'));
		add_submenu_page( 'education-express', 'Zip Codes', 'Zip Codes', 'administrator', 'education-express-zipcodes', array( 'ZipcodesController', 'get_zipcodes'));
		add_submenu_page( 'education-express', 'Degrees', 'Degrees', 'administrator', 'education-express-degrees', array( 'DegreesController', 'get_degrees'));
		add_submenu_page( 'education-express', 'Studies', 'Studies', 'administrator', 'education-express-studies', array( 'StudiesController', 'get_studies'));
		add_submenu_page( 'education-express', 'Programs', 'Programs', 'administrator', 'education-express-programs', array( 'ProgramsController', 'get_programs'));
	}
	
	function general_settings_ee()	{
		new MainView();
	}
	
	function load_schools_js_css($hook)	{

		if($hook == 'education-express_page_education-express-schools')
			SchoolsView::add_javascript();
		if($hook == 'education-express_page_education-express-zipcodes')
			ZipcodesView::add_javascript();
		if($hook == 'education-express_page_education-express-degrees')
			DegreesView::add_javascript();
		if($hook == 'education-express_page_education-express-studies')
			StudiesView::add_javascript();
		if($hook == 'education-express_page_education-express-programs')
			ProgramsView::add_javascript();
	}
	
	function school_ajax()	{
		global $wpdb, $table_prefix,$current_user;

		if(isset($_POST['task']) && $_POST['task'] == 'saveschool')	{
			$eeschools = new SchoolsModel($_POST);
			$sch_new_id = $eeschools->save();
			$filterparam = $this->filter_post_school();
			SchoolsController::loadschools('', $filterparam);
		}

		if(isset($_POST['task']) && $_POST['task'] == 'editSchool')	{
			$data = SchoolsModel::get_by_id($_POST['schoolid']);
			echo json_encode($data);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'trashSchool')	{
			SchoolsModel::trash($_POST['schoolid']);
			$filterparam = $this->filter_post_school();
			SchoolsController::loadschools('', $filterparam);
		}

		if(isset($_POST['task']) && $_POST['task'] == 'restoreSchool')	{
			SchoolsModel::restore($_POST['schoolid']);
			$filterparam = $this->filter_post_school();
			SchoolsController::loadschools('trash', $filterparam);
		}

		if(isset($_POST['task']) && $_POST['task'] == 'removeSchool')	{
			SchoolsModel::remove($_POST['schoolid']);
			$filterparam = $this->filter_post_school();
			SchoolsController::loadschools('trash', $filterparam);
		}	

		if(isset($_POST['task']) && $_POST['task'] == 'get_school')	{
			$filterparam = $this->filter_post_school();
			SchoolsController::loadschools($_POST['trashstatus'], $filterparam);
		}	
		
		if(isset($_POST['task']) && $_POST['task'] == 'filter_by_type_school')	{
			$filterparam = $this->filter_post_school();
			SchoolsController::loadschools($_POST['status'], $filterparam);
		}
		
		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'trashSchool')	{
			SchoolsModel::trash($_POST['ids']);
			$filterparam = $this->filter_post_school();
			SchoolsController::loadschools('', $filterparam);
		}
		
		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'restoreSchool')	{
			SchoolsModel::restore($_POST['ids']);
			$filterparam = $this->filter_post_school();
			SchoolsController::loadschools('trash', $filterparam);
		}

		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'removeSchool')	{
			SchoolsModel::remove($_POST['ids']);
			$filterparam = $this->filter_post_school();
			SchoolsController::loadschools('trash', $filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'viewZipcode')	{
			$filterparam['textsearch'] = '';
			$filterparam['zipcode_filter_school'] = $_POST['schoolid'];
			SchoolsController::loadzipcodes_by_school('', $filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'school_addzipcode')	{
			$data['zipcodeid'] = '';
			$data['schools'] = $_POST['zipschoolid'];
			$data['zipcodename'] = $_POST['zipcodename'];
			$zipcode = new ZipcodesModel($data);
			$zipcode->save();
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'school_uploadcsv')	{
			$this->zip_code_upload_csv('education-express-schools');
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'pagination_school')	{
			$filterparam = $this->filter_post_school();
			SchoolsController::loadschools($_POST['trashstatus'], $filterparam);	
		}

		die();
	}
	
	function filter_post_school()	{
		$filterparam['textsearch'] = $_POST['textsearch'];
		$filterparam['filter_type_school'] = $_POST['filter_type_school'];
		$filterparam['paged'] = $_POST['paged'];
		$filterparam['pagination_type'] = $_POST['pagination_type'];
		$filterparam['rows_per_page'] = $_POST['rows_per_page'];
		return $filterparam;
	}	
	
	function degree_ajax()	{
		global $wpdb, $table_prefix,$current_user;

		if(isset($_POST['task']) && $_POST['task'] == 'savedegree')	{
			$eedegrees = new DegreesModel($_POST);
			$sch_new_id = $eedegrees->save();
			$filterparam = $this->filter_post_degree();
			DegreesController::loaddegrees('', $filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'editDegree')	{
			$data = DegreesModel::get_by_id($_POST['degreeid']);
			echo json_encode($data);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'trashDegree')	{
			DegreesModel::trash($_POST['degreeid']);
			$filterparam = $this->filter_post_degree();
			DegreesController::loaddegrees('', $filterparam);
		}

		if(isset($_POST['task']) && $_POST['task'] == 'get_degree')	{
			$filterparam = $this->filter_post_degree();
			DegreesController::loaddegrees($_POST['trashstatus'], $filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'restoreDegree')	{
			DegreesModel::restore($_POST['degreeid']);
			$filterparam = $this->filter_post_degree();
			DegreesController::loaddegrees('trash', $filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'removeDegree')	{
			DegreesModel::remove($_POST['degreeid']);
			$filterparam = $this->filter_post_degree();
			DegreesController::loaddegrees('trash', $filterparam);
		}
		
		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'trashDegree')	{
			DegreesModel::trash($_POST['ids']);
			$filterparam = $this->filter_post_degree();
			DegreesController::loaddegrees('', $filterparam);
		}
		
		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'restoreDegree')	{
			DegreesModel::restore($_POST['ids']);
			$filterparam = $this->filter_post_degree();
			DegreesController::loaddegrees('trash', $filterparam);
		}
		
		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'removeDegree')	{
			DegreesModel::remove($_POST['ids']);
			$filterparam = $this->filter_post_degree();
			DegreesController::loaddegrees('trash', $filterparam);
		}	
	
		if(isset($_POST['task']) && $_POST['task'] == 'filterDegrees')	{
			$filterparam = $this->filter_post_degree();
			DegreesController::loaddegrees($_POST['status'], $filterparam);			
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'pagination_degree')	{
			$filterparam = $this->filter_post_degree();
			DegreesController::loaddegrees($_POST['trashstatus'], $filterparam);	
		}
	
		die();
	}

	function filter_post_degree()	{
		$filterparam['textsearch'] = $_POST['textsearch'];
		$filterparam['paged'] = $_POST['paged'];
		$filterparam['pagination_type'] = $_POST['pagination_type'];
		$filterparam['rows_per_page'] = $_POST['rows_per_page'];
		return $filterparam;
	}	
	
	function study_ajax()	{
		global $wpdb, $table_prefix,$current_user;

		if(isset($_POST['task']) && $_POST['task'] == 'savestudy')	{
			$eestudies = new StudiesModel($_POST);
			$sch_new_id = $eestudies->save();
			$filterparam = $this->filter_post_study();
			StudiesController::loadstudies('',$filterparam);
		}

		if(isset($_POST['task']) && $_POST['task'] == 'editStudy')	{
			$data = StudiesModel::get_by_id($_POST['studyid']);
			echo json_encode($data);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'trashStudy')	{
			StudiesModel::trash($_POST['studyid']);
			$filterparam = $this->filter_post_study();
			StudiesController::loadstudies('', $filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'restoreStudy')	{
			StudiesModel::restore($_POST['studyid']);
			$filterparam = $this->filter_post_study();
			StudiesController::loadstudies('trash', $filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'removeStudy')	{
			StudiesModel::remove($_POST['studyid']);
			$filterparam = $this->filter_post_study();
			StudiesController::loadstudies('trash',$filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'get_study')	{
			$filterparam = $this->filter_post_study();
			StudiesController::loadstudies($_POST['trashstatus'],$filterparam);
		}
		
		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'trashStudies')	{
			StudiesModel::trash($_POST['ids']);
			$filterparam = $this->filter_post_study();
			StudiesController::loadstudies('',$filterparam);
		}

		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'restoreStudies')	{
			StudiesModel::restore($_POST['ids']);
			$filterparam = $this->filter_post_study();
			StudiesController::loadstudies('trash', $filterparam);
		}	
		
		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'removeStudies')	{
			StudiesModel::remove($_POST['ids']);
			$filterparam = $this->filter_post_study();
			StudiesController::loadstudies('trash',$filterparam);
		}

		if(isset($_POST['task']) && $_POST['task'] == 'filterStudies')	{
			$filterparam = $this->filter_post_study();
			StudiesController::loadstudies($_POST['textsearch'], $filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'pagination_study')	{
			$filterparam = $this->filter_post_study();
			StudiesController::loadstudies($_POST['trashstatus'],$filterparam);
		}
		
		die();
	}
	
	function filter_post_study()	{
		$filterparam['textsearch'] = $_POST['textsearch'];
		$filterparam['paged'] = $_POST['paged'];
		$filterparam['pagination_type'] = $_POST['pagination_type'];
		$filterparam['rows_per_page'] = $_POST['rows_per_page'];
		return $filterparam;
	}
	
	function program_ajax()	{
		global $wpdb, $table_prefix,$current_user;

		if(isset($_POST['task']) && $_POST['task'] == 'saveprogram')	{
			$eeprograms = new ProgramsModel($_POST);
			$pro_new_id = $eeprograms->save();
			$filterparam = $this->filter_post_program();
			ProgramsController::load_programs('',$filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'editProgram')	{
			$data = ProgramsModel::get_by_id($_POST['programid']);
			echo json_encode($data);
		}

		if(isset($_POST['task']) && $_POST['task'] == 'trashProgram')	{
			ProgramsModel::trash($_POST['programid']);
			$filterparam = $this->filter_post_program();
			ProgramsController::load_programs('',$filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'restoreProgram')	{
			ProgramsModel::restore($_POST['programid']);
			$filterparam = $this->filter_post_program();
			ProgramsController::load_programs('trash',$filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'removeProgram')	{
			ProgramsModel::remove($_POST['programid']);
			$filterparam = $this->filter_post_program();
			ProgramsController::load_programs('trash',$filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'get_program')	{
			$filterparam = $this->filter_post_program();
			ProgramsController::load_programs($_POST['trashstatus'],$filterparam);
		}
		
		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'trashPrograms')	{
			ProgramsModel::trash($_POST['ids']);
			$filterparam = $this->filter_post_program();
			ProgramsController::load_programs('',$filterparam);
		}
		
		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'restorePrograms')	{
			ProgramsModel::restore($_POST['ids']);
			$filterparam = $this->filter_post_program();
			ProgramsController::load_programs('trash',$filterparam);
		}
		
		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'removePrograms')	{
			ProgramsModel::remove($_POST['ids']);
			$filterparam = $this->filter_post_program();
			ProgramsController::load_programs('trash',$filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'filterProgam')	{
			$filterparam = $this->filter_post_program();
			ProgramsController::load_programs($_POST['status'], $filterparam);
		}

		if(isset($_POST['task']) && $_POST['task'] == 'searchProgram')	{
			$filterparam = $this->filter_post_program();
			ProgramsController::load_programs($_POST['status'], $filterparam);
		}

		if(isset($_POST['task']) && $_POST['task'] == 'pagination_program')	{
			$filterparam = $this->filter_post_program();
			ProgramsController::load_programs($_POST['trashstatus'],$filterparam);
		}		
		die();
	}

	function filter_post_program()	{
		$filterparam['textsearch'] = $_POST['textsearch'];
		$filterparam['filter_school'] = $_POST['filter_school'];
		$filterparam['filter_degree'] = $_POST['filter_degree'];
		$filterparam['filter_study'] = $_POST['filter_study'];
		$filterparam['paged'] = $_POST['paged'];
		$filterparam['pagination_type'] = $_POST['pagination_type'];
		$filterparam['rows_per_page'] = $_POST['rows_per_page'];
		return $filterparam;
	}	
	
	function zipcode_ajax()	{
		global $wpdb, $table_prefix,$current_user;
		
		// ---------- zipcodes start --------------
		if(isset($_POST['task']) && $_POST['task'] == 'savezipcode')	{
			$eeszipcodes = new ZipcodesModel($_POST);
			$zip_new_id = $eeszipcodes->save();
			$filterparam = $this->filter_post_zipcode();
			ZipcodesController::loadzipcodes('', $filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'editZipcode')	{
			$data = ZipcodesModel::get_by_id($_POST['zipcodeid']);
			echo json_encode($data);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'trashZipcode')	{
			ZipcodesModel::trash($_POST['zipcodeid']);
			$filterparam = $this->filter_post_zipcode();
			ZipcodesController::loadzipcodes('', $filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'restoreZipcode')	{
			ZipcodesModel::restore($_POST['zipcodeid']);
			$filterparam = $this->filter_post_zipcode();
			ZipcodesController::loadzipcodes('trash', $filterparam);
		}

		if(isset($_POST['task']) && $_POST['task'] == 'removeZipcode')	{
			ZipcodesModel::remove($_POST['zipcodeid']);
			$filterparam = $this->filter_post_zipcode();
			ZipcodesController::loadzipcodes('trash', $filterparam);
		}

		if(isset($_POST['task']) && $_POST['task'] == 'get_zipcode')	{
			//ZipcodesController::loadzipcodes($_POST['trashstatus']);
			$filterparam = $this->filter_post_zipcode();
			ZipcodesController::loadzipcodes($_POST['trashstatus'], $filterparam);
		}
		
		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'trashZipcodes')	{
			ZipcodesModel::trash($_POST['ids']);
			$filterparam = $this->filter_post_zipcode();
			ZipcodesController::loadzipcodes('', $filterparam);
		}
		
		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'restoreZipcodes')	{
			ZipcodesModel::restore($_POST['ids']);
			$filterparam = $this->filter_post_zipcode();
			ZipcodesController::loadzipcodes('trash', $filterparam);
		}
		
		if(isset($_POST['bulkaction']) && $_POST['bulkaction'] == 'removeZipcodes')	{
			ZipcodesModel::remove($_POST['ids']);
			$filterparam = $this->filter_post_zipcode();
			ZipcodesController::loadzipcodes('trash', $filterparam);
		}
	
		if(isset($_POST['task']) && $_POST['task'] == 'filter_zipcode')	{
			$filterparam = $this->filter_post_zipcode();
			ZipcodesController::load_filtered_zipcode($_POST['status'], $filterparam);
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'uploadcsv')	{
			$this->zip_code_upload_csv();
		}
		
		if(isset($_POST['task']) && $_POST['task'] == 'pagination_zipcode')	{
			$filterparam = $this->filter_post_zipcode();
			ZipcodesController::loadzipcodes($_POST['trashstatus'], $filterparam);	
		}	
		
		die();
	}
	
	function filter_post_zipcode()	{
		$filterparam['textsearch'] = $_POST['textsearch'];
		$filterparam['zipcode_filter_school'] = $_POST['zipcode_filter_school'];
		$filterparam['paged'] = $_POST['paged'];
		$filterparam['pagination_type'] = $_POST['pagination_type'];
		$filterparam['rows_per_page'] = $_POST['rows_per_page'];
		return $filterparam;
	}	
	
	function zip_code_upload_csv($redirect_page=null)	{		
		$allowedExts = array("csv");
		$extension = end(explode(".", $_FILES["file"]["name"]));
		if (in_array($extension, $allowedExts))	{
			if ($_FILES["file"]["error"] > 0)	{
				echo '<h2> Return Code: ' . $_FILES["file"]["error"] .' </h2> Click here to <a href="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=education-express-zipcodes">Manage Zip Codes</a>';
			}
			else	{
				$filename = dirname(dirname(__FILE__)).'/uploads/'. $_FILES["file"]["name"];
				move_uploaded_file($_FILES["file"]["tmp_name"], $filename);

				$zip_codes = array();
				$row = 1;
				if (($handle = fopen($filename, "r")) !== FALSE) {
					while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						$num = count($data);
						$row++;
						for ($c=0; $c < $num; $c++) {
							if( ((int) $data[$c]) > 0 )	{
								$zip_codes[] = $data[$c];
							}
						}
					}
					fclose($handle);
				}

				if(count($zip_codes) > 0)	{
					//ZipcodesModel::insert_multiple_rows($zip_codes);
					$data['zipcodeid'] = '';
					$data['zipcodename'] = $zip_codes;
					$data['zipcode_school'] = $_POST['zipcode_school'];
					ZipcodesModel::insert_multiple_rows_distinct($data);
					
					if($redirect_page != '')
						$redirect_url = get_bloginfo('wpurl').'/wp-admin/admin.php?page='.$redirect_page;
					else
						$redirect_url = get_bloginfo('wpurl').'/wp-admin/admin.php?page=education-express-zipcodes';
					
					wp_safe_redirect($redirect_url);
				}
			}
		}
		else	{
			echo '<h2>Error: Invalid file </h2> Click here to <a href="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=education-express-zipcodes">Manage Zip Codes</a>';
		}
		
	}
}
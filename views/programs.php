<?php
/**
 * Programs View
 *
 * @package Education Express Plugin
 * 
 */

class ProgramsView	{
	
	function __construct()	{
		/* nothing */
	}
	
	function add_javascript()	{	
		?>
		<script type="text/javascript">
			var plugins_url = '<?php echo plugins_url(); ?>';
			var wpurl = '<?php bloginfo('wpurl'); ?>';
		</script>
		<script type="text/javascript" src="<?php echo plugins_url(); ?>/educationexpress/js/fancybox/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="<?php echo plugins_url(); ?>/educationexpress/js/fancybox/jquery.fancybox.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/educationexpress/js/fancybox/jquery.fancybox.css" media="screen" />
		<script type="text/javascript">
			$(document).ready(function() {
				$('.fancybox').fancybox();
			});
		</script>
		<script type="text/javascript" src="<?php echo plugins_url(); ?>/educationexpress/js/jquery.tablesorter.js"></script>
		<script type="text/javascript">	
			// better to place this init above the table or within a page so that if ajax is used still it will work
			// $(function() {	$("table").tablesorter({debug: false})	});	
		</script>

		<link rel="stylesheet" href="<?php echo plugins_url(); ?>/educationexpress/js/themes/base/jquery.ui.all.css">
		<script type="text/javascript" src="<?php echo plugins_url(); ?>/educationexpress/js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="<?php echo plugins_url(); ?>/educationexpress/js/jquery.blockUI.js"></script>
		<?php
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('jquery-ui-dialog');
		?>
		
		<script type="text/javascript" >
		jQuery(function() {	
			jQuery( "#form-dialog-modal" ).dialog({
				autoOpen: false,
				height: 350,
				width: 550,
				modal: true
			});			
		});
		</script>

		<script type="text/javascript" src="<?php echo plugins_url(); ?>/educationexpress/js/jquery.blockUI.js"></script>
		<script type="text/javascript" src="<?php echo plugins_url(); ?>/educationexpress/js/jquery.validate.js"></script>
		<style type="text/css" media="screen">	.error { color: red; }	</style>		
		<script type="text/javascript" >
		var jjQuery = jQuery.noConflict();
		jjQuery(window).load(function(){
		jjQuery(document).ready(function(){
			jjQuery("#form_program").validate({
					ignore: [],
					rules: {
						programname: {
							required: true
						},
						schools: {
							required: true,
							min: 1
						}
					},
					messages: {
						schools: {
							min: "Please select a school."
						}
					},
					submitHandler: function(form) {						
						jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
						//jjQuery.post(wpurl+'/wp-admin/admin-ajax.php?action=program_ajax', jjQuery('#form_program').serialize(), function(responsedata,textStatus,jqXHR) {
						jjQuery.post(
							wpurl+'/wp-admin/admin-ajax.php?action=program_ajax', 
							jjQuery('#form_program').serialize() +'&'+ jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'pagination_type': '' }),
							function(responsedata,textStatus,jqXHR) {
								//console.log(responsedata);
								if(textStatus == 'success')	{
									jjQuery("#loadtable").html(responsedata);
									jjQuery.blockUI({ message: '<div style="font-weight:bold">Data successfully save.</div>' });
									setTimeout(jjQuery.unblockUI, 1000);
									jQuery("#form-dialog-modal").dialog("close");
								}
							}
						);
						
					}
			});
			
		})
		});

		// custom function
		jQuery(document).ready(function() {
			addForm = (function() {
				
				jQuery("#taskspan").html('Add');
				jQuery("#form-dialog-modal").dialog('option', 'title', 'Add Program ');
				jQuery("#form-dialog-modal").dialog("open");
				resetForm();
			});
			
			resetForm = (function() {
				jQuery("#programid").val('');
				jQuery("#programname").val('');
				jQuery("#schools").val('');
				jQuery("#degrees").val('');
				jQuery("#studies").val('');
			});
		
			editProgram = (function(id) {
				jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
				jQuery.post(wpurl+'/wp-admin/admin-ajax.php?action=program_ajax',{ programid: id, task: 'editProgram' },function(response) {
					var data = jQuery.parseJSON(response);
					jQuery("#programid").val(id);
					jQuery("#programname").val( stripslashes(data.name) );
					jQuery("#schools").val(data.school_id);
					jQuery("#degrees").val(data.degree_id);
					jQuery("#studies").val(data.study_id);
					
					jjQuery.unblockUI();
					
					jQuery("#taskspan").html('Edit');
					jQuery("#form-dialog-modal").dialog('option', 'title', 'Edit Program ');
					jQuery("#form-dialog-modal").dialog("open");
				});
			});
		
			
			
			trashProgram = (function(id) {
				set_subsub('');
				jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
				jQuery.post(
					wpurl+'/wp-admin/admin-ajax.php?action=program_ajax',
					jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'programid': id })+'&'+jjQuery.param({ 'task': 'trashProgram' })+'&'+jjQuery.param({ 'pagination_type': '' }),
					function(responsedata,textStatus,jqXHR) {
						if(textStatus == 'success')	{
							jQuery("#loadtable").html(responsedata);
							jjQuery.unblockUI();
						}
					}
				);
			});

			restoreProgram = (function(id) {
				set_subsub('trash');
				jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
				jQuery.post(
					wpurl+'/wp-admin/admin-ajax.php?action=program_ajax',
					jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'programid': id })+'&'+jjQuery.param({ 'task': 'restoreProgram' })+'&'+jjQuery.param({ 'pagination_type': '' }),
					function(responsedata,textStatus,jqXHR) {
						if(textStatus == 'success')	{
							jQuery("#loadtable").html(responsedata);
							jjQuery.unblockUI();
						}
					}
				);
			});
			
			removeProgram = (function(id) {
				if(confirm("Are you sure you want to delete this record?")){
					set_subsub('trash');
					jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
					jQuery.post(
						wpurl+'/wp-admin/admin-ajax.php?action=program_ajax',
						jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'programid': id })+'&'+jjQuery.param({ 'task': 'removeProgram' })+'&'+jjQuery.param({ 'pagination_type': '' }),
						function(responsedata,textStatus,jqXHR) {
							if(textStatus == 'success')	{
								jQuery("#loadtable").html(responsedata);
								//jjQuery.blockUI({ message: '<div style="font-weight:bold">Successfully trash.</div>' });
								jjQuery.unblockUI();
								//setTimeout(jjQuery.unblockUI, 1000);
							}
						}
					);
				}
			});
			
			get_program = (function(param) {
				set_subsub(param);
				jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
				jQuery.post(
					wpurl+'/wp-admin/admin-ajax.php?action=program_ajax',
					//{ trashstatus: param, task: 'get_program' },
					jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'trashstatus': param })+'&'+jjQuery.param({ 'task': 'get_program' })+'&'+jjQuery.param({ 'pagination_type': '' }),
					function(responsedata,textStatus,jqXHR) {
						if(textStatus == 'success')	{
							jQuery("#loadtable").html(responsedata);
							jjQuery.unblockUI();
						}
					}
				);
			});
			
			set_subsub = (function(param) {
				if(param == 'trash')	{
					jQuery("#tab_all").removeAttr('class');
					jQuery("#tab_trash").attr('class','current');
				}
				else	{
					jQuery("#tab_all").attr('class','current');
					jQuery("#tab_trash").removeAttr('class');
				}
			});
			
			bulkApply = (function() {
				var bulkaction = jQuery("#bulkaction").val();
				if(bulkaction == -1)	{
					alert('Please select a bulk action to apply.');
				}
				else	{
					var cntCheck = 0;
					jQuery('input.classcheckbox[type=checkbox]').each(function () {
						var sThisVal = (this.checked ? jQuery(this).val() : "");
						if(sThisVal != '')	{
							cntCheck++;
						}
					});

					if(cntCheck > 0)	{
						if(bulkaction == 'removePrograms')	{
							if(confirm("Are you sure you want to delete this record(s)?")){
								jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
								jjQuery.post(
									wpurl+'/wp-admin/admin-ajax.php?action=program_ajax', 
									jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'pagination_type': '' }),
									function(responsedata,textStatus,jqXHR) {
										//console.log(responsedata);
										if(textStatus == 'success')	{
											jjQuery("#loadtable").html(responsedata);
											jjQuery.unblockUI();
										}
									}
								);
							}
						}
						else	{
							jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
							jjQuery.post(
								wpurl+'/wp-admin/admin-ajax.php?action=program_ajax', 
								jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'pagination_type': '' }),
								function(responsedata,textStatus,jqXHR) {
									//console.log(responsedata);
									if(textStatus == 'success')	{
										jjQuery("#loadtable").html(responsedata);
										jjQuery.unblockUI();
									}
								}
							);
						}
					}
					else	{
						alert('Please select from the list.');
					}
				}
			});
			
			
			
			filterProgam = (function() {
				var status = 'trash';
				var tab_all = jQuery("#tab_all").attr('class');
				if(tab_all == 'current')	{
					status = 'all';
				};
				
				jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
				jQuery.post(
					wpurl+'/wp-admin/admin-ajax.php?action=program_ajax',
					jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'task': 'filterProgam' })+'&'+jjQuery.param({ 'status': status })+'&'+jjQuery.param({ 'pagination_type': '' }),
					function(responsedata,textStatus,jqXHR) {
						if(textStatus == 'success')	{
							jQuery("#loadtable").html(responsedata);
							jjQuery.unblockUI();
						}
					}
				);
			});
			
			pagination = (function(param) {
				var status = 'trash';
				var tab_all = jQuery("#tab_all").attr('class');
				if(tab_all == 'current')	{
					status = 'all';
				};			

				jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
				jQuery.post(
					wpurl+'/wp-admin/admin-ajax.php?action=program_ajax',
					jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'task': 'pagination_program' })+'&'+jjQuery.param({ 'trashstatus': status })+'&'+jjQuery.param({ 'pagination_type': param }),
					function(responsedata,textStatus,jqXHR) {
						if(textStatus == 'success')	{
							jQuery("#loadtable").html(responsedata);
							jjQuery.unblockUI();
						}
					}
				);
				return false;
			});
			
		});
		
		function paginate(event)	{
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == '13'){
				pagination('');
			}			
		}
		
		function checUncheckAll()	{
			var cnt = jQuery("#no_of_items").val();
			var checkbox_0 = jQuery("#checkbox_0").is(':checked');
			if(checkbox_0 == true)	{
				for(i=1;i<=cnt;i++)	{
					jQuery("#checkbox_"+i).attr('checked', 'checked');
				}
			}			
			if(checkbox_0 == false)	{
				for(i=1;i<=cnt;i++)	{
					jQuery("#checkbox_"+i).removeAttr('checked');
				}
			}
		}
		
		function stripslashes (str) {
		  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		  // +   improved by: Ates Goral (http://magnetiq.com)
		  // +      fixed by: Mick@el
		  // +   improved by: marrtins
		  // +   bugfixed by: Onno Marsman
		  // +   improved by: rezna
		  // +   input by: Rick Waldron
		  // +   reimplemented by: Brett Zamir (http://brett-zamir.me)
		  // +   input by: Brant Messenger (http://www.brantmessenger.com/)
		  // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
		  // *     example 1: stripslashes('Kevin\'s code');
		  // *     returns 1: "Kevin's code"
		  // *     example 2: stripslashes('Kevin\\\'s code');
		  // *     returns 2: "Kevin\'s code"
		  return (str + '').replace(/\\(.?)/g, function (s, n1) {
			switch (n1) {
			case '\\':
			  return '\\';
			case '0':
			  return '\u0000';
			case '':
			  return '';
			default:
			  return n1;
			}
		  });
		}
		</script>
		<?php
	}
	
	function table_header($param=null)	{
		?>
		<tr>
			<th scope="col" class="check-column" width="2%"><?php if($param) { ?><input type="checkbox" id="checkbox_0" name="checkbox_0" onclick="checUncheckAll()"><?php } ?></th>
			<th scope="col" width="38%" style="cursor:pointer;">Name</th>
			<th scope="col" width="20%" style="cursor:pointer;">School</th>
			<th scope="col" width="20%" style="cursor:pointer;">Degree</th>
			<th scope="col" width="20%" style="cursor:pointer;">Studies</th>
		</tr>
		<?php
	}
	
	function load_table($datas, $count_trash=null, $count_all=null, $currentselected=null, $filterparam=null)	{
		if($currentselected == 'trash')	{
			$trash_current = 'class="current"';
			$all_current = '';
			$no_of_items = $count_trash;
		}
		else	{
			$trash_current = '';
			$all_current = 'class="current"';
			$no_of_items = $count_all;
		}
		?>
		<form id="form_table" action="" method="post">
		<ul class="subsubsub">
			<li class="all"><a <?php echo $all_current; ?> style="cursor:pointer;" onclick="get_program('')" id="tab_all" >All <span class="count">(<?php echo $count_all; ?>)</span></a> |</li>
			<li class="trash"><a <?php echo $trash_current; ?> style="cursor:pointer;" onclick="get_program('trash')" id="tab_trash">Trash <span class="count">(<?php echo $count_trash; ?>)</span></a></li>
		</ul>
		
		<p class="search-box">
			<input type="search" value="<?php if(isset($_POST['textsearch']))	{	echo trim($_POST['textsearch']);	}	?>" name="textsearch" id="textsearch" />
			<input type="button" value="Search Progams" class="button" onclick="filterProgam()" />
		</p>
		
		<div class="tablenav top">
			<div class="alignleft actions">
				<select name="bulkaction" id="bulkaction">
					<option value="-1">Bulk Actions</option>
					<?php if($currentselected == 'trash')	{ ?>
						<option value="restorePrograms">Restore</option>
						<option value="removePrograms">Delete Permanently</option>
					<?php } else	{ ?>
						<option value="trashPrograms">Move to Trash</option>
					<?php } ?>
				</select>
				<input type="button" value="Apply" class="button action" id="doaction" name="doaction" onclick="bulkApply()" />
			</div>
			
			<div class="alignleft actions">
				<?php 
				if(isset($_POST['filter_school']))	
					$filter_school = $_POST['filter_school'];
				else
					$filter_school = '';
				FormHelper::dropDownObj('schools',1,'',$filter_school,'filter_school', 'View all schools'); 
				
				if(isset($_POST['filter_degree']))	
					$filter_degree = $_POST['filter_degree'];
				else
					$filter_degree = '';
				FormHelper::dropDownObj('degrees',1,'',$filter_degree,'filter_degree', 'View all degrees'); 
				
				if(isset($_POST['filter_study']))	
					$filter_study = $_POST['filter_study'];
				else
					$filter_study = '';
				FormHelper::dropDownObj('studies',1,'',$filter_study,'filter_study', 'View all studies'); 
				
				?>
				<input type="button" value="Filter" class="button action" id="doaction" name="doaction" onclick="filterProgam()" />
			</div>
			
			<div class="tablenav-pages one-page">
				<span style="margin-right:20px;"> Rows Per Page:
					<select id="rows_per_page" name="rows_per_page">
						<?php 
						for($i=1;$i<=10;$i++)	{
							$z = $i * 5;
							?> <option value="<?php echo $z; ?>" <?php if($filterparam['rows_per_page'] == $z) {	echo 'selected';	} ?> ><?php echo $z; ?></option> <?php 
						} 
						?>
					</select>
				</span>
				<span class="displaying-num"><?php echo $no_of_items; ?> items</span>
				<input type="hidden" value="<?php echo $no_of_items; ?>" id="no_of_items" name="no_of_items" />
				<span class="pagination-links1">
					<a href="#" title="Go to the first page" class="first-page" onclick="pagination('first')">&laquo;</a>
					<a href="#" title="Go to the previous page" class="prev-page" onclick="pagination('previous')">&lsaquo;</a>
					<span class="paging-input">
						<input onkeypress="paginate(event)" type="text" size="1" value="<?php echo $filterparam['limit_paged']; ?>" name="paged" title="Current page" class="current-page"> 
						of <span class="total-pages"><?php echo $filterparam['limit_max_paged']; ?></span>
					</span>
					<a href="#" title="Go to the next page" class="next-page" onclick="pagination('next')">&rsaquo;</a>
					<a href="#" title="Go to the last page" class="last-page" onclick="pagination('last')">&raquo;</a>
				</span>
			</div>
			<br class="clear">
		</div>
		<script type="text/javascript">	$(function() {	$("table").tablesorter({debug: false})	});	</script>
		<table cellspacing="0" class="widefat post fixed">
			<thead><?php ProgramsView::table_header(1); ?></thead>
			<tfoot><?php ProgramsView::table_header(); ?></tfoot>
			<tbody>
				<?php
				if(count($datas) > 0)	{
					$i=0;
					foreach($datas as $data)	{	
						$i++;
						?>
						<tr>
							<th class="check-column">
								<input type="checkbox" class="classcheckbox" value="<?php echo $data->id; ?>" id="checkbox_<?php echo $i; ?>" name="ids[]" />
							</th>
							<td>
							<?php if($data->trashed == 0)	{	?>
								<strong><?php echo stripslashes($data->name); ?></strong>
								<div class="row-actions-visible">
									<span><a style="cursor:pointer" onclick="editProgram('<?php echo $data->id; ?>')">Edit</a> | </span>
									<span><a style="cursor:pointer" onclick="trashProgram('<?php echo $data->id; ?>')" >Trash</a> </span>
								</div>
							<?php } else	{	?>	
								<strong><?php echo stripslashes($data->name); ?></strong>
								<div class="row-actions-visible">
									<span><a style="cursor:pointer" onclick="restoreProgram('<?php echo $data->id; ?>')">Restore</a> | </span>
									<span><a style="cursor:pointer" onclick="removeProgram('<?php echo $data->id; ?>')" >Delete Permanently </a></span>
								</div>
							<?php } 	?>	
							</td>
							<td><?php $sch = SchoolsModel::get_by_id($data->school_id); if($sch)	{	echo stripslashes($sch->name); 	} ?> </td>
							<td><?php $deg = DegreesModel::get_by_id($data->degree_id); if($deg)	{	echo stripslashes($deg->name); 	} ?> </td>
							<td><?php $stu = StudiesModel::get_by_id($data->study_id); if($stu)		{	echo stripslashes($stu->name); 	} ?> </td>
						</tr>
						<?php 
					}
				}
				else	{ ?> <tr class="no-items"><td colspan="4" class="colspanchange">No records found.</td></tr> <?php	} 	?>
			</tbody>
		</table>
		</form>
		<?php
	}
	
	function load_programs($datas, $count_trash=null, $count_all=null, $currentselected=null, $filterparam=null)	{
		?>
		<div class="wrap">
			<div class="icon32" id="icon-plugins"><br></div>
			<h2>Programs <a class="add-new-h2" onclick="addForm()" style="cursor:pointer;">Add New</a> </h2>

			<!--<div class="updated below-h2" id="message"><p>Item permanently deleted.</p></div>-->

			<div id="resultmessage"></div>
			<div id="loadtable"><?php ProgramsView::load_table($datas['table'], $count_trash, $count_all, $currentselected, $filterparam); ?></div>
			<br/>
			
			<div id="load_form">
				<?php ProgramsView::get_form($datas['form']); ?>
			</div>
			
		</div>
		<?php
	}

	function get_form($data=null)	{	
		?>
		<div id="form-dialog-modal" title="Add">
			<p> <span id="taskspan"> Add </span> the name, school, area of study and type of program of the program.</p>
			
			<form id="form_program" action="" method="post">
				<table><tbody>
				<tr>
					<td>Name</td>
					<td>
						<input type="hidden" value="" name="programid" id="programid"  />
						<input type="text" name="programname" id="programname" style="width:300px;" />
					</td>
				</tr>
				<tr>
					<td>School</td>
					<td><?php FormHelper::dropDownObj('schools',1); ?></td>
				</tr>
				<tr>
					<td>Degree</td>
					<td><?php FormHelper::dropDownObj('degrees',1); ?></td>
				</tr>
				<tr>
					<td>Studies</td>
					<td><?php FormHelper::dropDownObj('studies',1); ?></td>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="hidden" value="saveprogram" name="task" id="task" />
						<input type="submit" value="Save" class="button-primary" />
					</td>
				</tr>
				</tbody></table>
			</form>
		</div>
		<?php
	}
}
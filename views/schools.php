<?php
/**
 * Schools View
 *
 * @package Education Express Plugin
 * 
 */

class SchoolsView	{
	
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
		<?php
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('tiny_mce');
		?>
		
		<script type="text/javascript" >
		jQuery(function() {	
			jQuery( "#form-dialog-modal" ).dialog({
				autoOpen: false,
				height: 500,
				width: 610,
				modal: true
			});

			jQuery( "#form_viewzipcode-dialog-modal" ).dialog({
				autoOpen: false,
				height: 500,
				width: 610,
				modal: true
			});

			jQuery( "#form_zipcodeadd-dialog-modal" ).dialog({
				autoOpen: false,
				height: 200,
				width: 610,
				modal: true
			});

			jQuery( "#formcsv-dialog-modal" ).dialog({
				autoOpen: false,
				height: 200,
				width: 610,
				modal: true
			});

			jQuery('#schoollogobtn').click(function() {
				jQuery("#form-dialog-modal").dialog("close");
				tb_show('', 'media-upload.php?TB_iframe=true');
				window.send_to_editor = function(html) {
					url = jQuery(html).attr('href');
					jQuery('#schoollogo').val(url);
					jQuery("#form-dialog-modal").dialog("open");
					jQuery('#previewlogo').attr('href',url);
					tb_remove();
				};
				return false;
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
			jjQuery("#form_school").validate({
					ignore: [],
					rules: {
						schoolname: {
							required: true
						},
						schooltype: {
							required: true
						}
					},
					submitHandler: function(form) {
						
						jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
						jjQuery.post(
							wpurl+'/wp-admin/admin-ajax.php?action=school_ajax', 
							jjQuery('#form_school').serialize() +'&'+ jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'pagination_type': '' }),
							function(responsedata,textStatus,jqXHR) {
								//console.log(responsedata);
								if(textStatus == 'success')	{
									jjQuery("#loadtable").html(responsedata);
									jjQuery.blockUI({ message: '<div style="font-weight:bold">Data successfully save.</div>' });
									setTimeout(jjQuery.unblockUI, 1000);
									jQuery("#form-dialog-modal").dialog("close");
									gotomainschoolpage();
								}
							}
						);
						
					}
			});
			
			
			jjQuery("#form_zipcode").validate({
					ignore: [],
					rules: {
						zipcodename: {
							required: true,
							min: 1
						}
					},
					messages: {
						zipcodename: {
							min: "Invalid zip code."
						}
					},
					submitHandler: function(form) {
						jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
						jjQuery.post(
							wpurl+'/wp-admin/admin-ajax.php?action=school_ajax', 
							jjQuery('#form_zipcode').serialize()+'&'+jjQuery.param({ 'pagination_type': '' }),
							function(responsedata,textStatus,jqXHR) {
								if(textStatus == 'success')	{
									//jjQuery("#loadtable").html(responsedata);
									jjQuery.blockUI({ message: '<div style="font-weight:bold">Data successfully save.</div>' });
									setTimeout(jjQuery.unblockUI, 1000);
									jQuery("#form_zipcodeadd-dialog-modal").dialog("close");
								}
							}
						);
						
					}
			});
			
			
		})
		});

		function gotomainschoolpage()	{
			location.href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=education-express-schools";
		}
		
		// custom function
		jQuery(document).ready(function() {
			addSchool = (function() {
				
				jQuery("#taskspan").html('Add');
				jQuery("#form-dialog-modal").dialog('option', 'title', 'Add School ');
				jQuery("#form-dialog-modal").dialog("open");
				resetSchoolForm();
			});
			
			resetSchoolForm = (function() {
				jQuery("#schoolid").val('');
				jQuery("#schoolname").val('');
				jQuery("#schooldesc").val('');
				jQuery("#schoollogo").val('');
				jQuery("#schooltype").val('');
				jQuery("#schoolzipcode").val('');
				jQuery('#previewlogo').attr('href','');
			});
			
			editSchool = (function(id) {
				jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
				jQuery.post(wpurl+'/wp-admin/admin-ajax.php?action=school_ajax',{ schoolid: id, task: 'editSchool' },function(response) {
					var data = jQuery.parseJSON(response);
					jQuery("#schoolid").val(id);
					jQuery("#schoolname").val( stripslashes(data.name) );
					jQuery("#schooldesc").val( stripslashes(data.description)) ;
					jQuery("#schoollogo").val(data.logo);
					jQuery("#schooltype").val(data.stype);
					jQuery("#schoolzipcode").val(data.zipcode);
					jQuery('#previewlogo').attr('href',data.logo);
					
					jjQuery.unblockUI();
					
					jQuery("#taskspan").html('Edit');
					jQuery("#form-dialog-modal").dialog('option', 'title', 'Edit School ');
					jQuery("#form-dialog-modal").dialog("open");
				});
			});
		
			
			
			trashSchool = (function(id) {
				set_subsub('');
				jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
				jQuery.post(
					wpurl+'/wp-admin/admin-ajax.php?action=school_ajax',
					jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'task': 'trashSchool' })+'&'+jjQuery.param({ 'schoolid': id })+'&'+jjQuery.param({ 'pagination_type': '' }),
					function(responsedata,textStatus,jqXHR) {
						if(textStatus == 'success')	{
							jQuery("#loadtable").html(responsedata);
							jjQuery.unblockUI();
						}
					}
				);
			});

			restoreSchool = (function(id) {
				set_subsub('trash');
				jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
				jQuery.post(
					wpurl+'/wp-admin/admin-ajax.php?action=school_ajax',
					jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'task': 'restoreSchool' })+'&'+jjQuery.param({ 'schoolid': id })+'&'+jjQuery.param({ 'pagination_type': '' }),
					function(responsedata,textStatus,jqXHR) {
						if(textStatus == 'success')	{
							jQuery("#loadtable").html(responsedata);
							jjQuery.unblockUI();
						}
					}
				);
			});
			
			removeSchool = (function(id) {
				if(confirm("Are you sure you want to delete this record?")){
					set_subsub('trash');
					jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
					jQuery.post(
						wpurl+'/wp-admin/admin-ajax.php?action=school_ajax',
						jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'task': 'removeSchool' })+'&'+jjQuery.param({ 'schoolid': id })+'&'+jjQuery.param({ 'pagination_type': '' }),
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
			
			get_school = (function(param) {
				set_subsub(param);
				jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
				jQuery.post(
					wpurl+'/wp-admin/admin-ajax.php?action=school_ajax',
					jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'task': 'get_school' })+'&'+jjQuery.param({ 'trashstatus': param })+'&'+jjQuery.param({ 'pagination_type': '' }),
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
						if(bulkaction == 'removeSchool')	{
							if(confirm("Are you sure you want to delete this record(s)?")){
								jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
								jjQuery.post(
									wpurl+'/wp-admin/admin-ajax.php?action=school_ajax', 
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
								wpurl+'/wp-admin/admin-ajax.php?action=school_ajax', 
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
			
			get_wp_editor = (function() {
				jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
				jQuery.post(wpurl+'/wp-admin/admin-ajax.php?action=school_ajax',{ task: 'get_wp_editor' },function(responsedata,textStatus,jqXHR) {
					if(textStatus == 'success')	{
						jQuery("#get_wp_editor").html(responsedata);						
						jjQuery.unblockUI();
					}
				});
			});
			
			viewZipcode = (function(id) {
				jQuery("#zipcode_load_results").html('<img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>');
				jQuery.post(wpurl+'/wp-admin/admin-ajax.php?action=school_ajax',{ schoolid: id, task: 'viewZipcode' },function(responsedata,textStatus,jqXHR) {
					if(textStatus == 'success')	{
						jQuery("#zipcode_load_results").html(responsedata);
						
					}
				});
				jQuery("#form_viewzipcode-dialog-modal").dialog('option', 'title', 'View Zip Code ');
				jQuery("#form_viewzipcode-dialog-modal").dialog("open");
			});
			
			addZipcode = (function(id) {
				jQuery("#zipschoolid").val(id);
				jQuery("#zipcodename").val('');
				jQuery("#form_zipcodeadd-dialog-modal").dialog('option', 'title', 'Add Zip Code ');
				jQuery("#form_zipcodeadd-dialog-modal").dialog("open");
			});
			
			uploadCSVZipcode = (function(id) {
				jQuery("#zipcode_school").val(id);
				jQuery("#formcsv-dialog-modal").dialog('option', 'title', 'Upload CSV ');
				jQuery("#formcsv-dialog-modal").dialog("open");
			});			
			
			filter_by_type_school = (function() {
				var status = 'trash';
				var tab_all = jQuery("#tab_all").attr('class');
				if(tab_all == 'current')	{
					status = 'all';
				};
				
				jjQuery.blockUI({ message: '<div style="font-weight:bold" valign="top"><img src="'+plugins_url+'/educationexpress/images/loading.gif" /></div>' });
				jQuery.post(
					wpurl+'/wp-admin/admin-ajax.php?action=school_ajax',
					jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'task': 'filter_by_type_school' })+'&'+jjQuery.param({ 'status': status })+'&'+jjQuery.param({ 'pagination_type': '' }),
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
					wpurl+'/wp-admin/admin-ajax.php?action=school_ajax',
					jjQuery('#form_table').serialize()+'&'+jjQuery.param({ 'task': 'pagination_school' })+'&'+jjQuery.param({ 'trashstatus': status })+'&'+jjQuery.param({ 'pagination_type': param }),
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
			<th scope="col" width="20%" style="cursor:pointer;">Name</th>
			<th scope="col" width="20%" style="cursor:pointer;">Logo</th>
			<th scope="col" style="cursor:pointer;">Description</th>
			<th scope="col" width="5%" style="cursor:pointer;">Type</th>
			<th scope="col" width="20%" style="cursor:pointer;">Zip Code</th>
		</tr>
		<?php
	}
	
	function load_table($schools, $count_trash=null, $count_all=null, $currentselected=null, $filterparam=null)	{
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
			<li class="all"><a <?php echo $all_current; ?> style="cursor:pointer;" onclick="get_school('')" id="tab_all" >All <span class="count">(<?php echo $count_all; ?>)</span></a> |</li>
			<li class="trash"><a <?php echo $trash_current; ?> style="cursor:pointer;" onclick="get_school('trash')" id="tab_trash">Trash <span class="count">(<?php echo $count_trash; ?>)</span></a></li>
		</ul>
		
		<p class="search-box">
			<input type="search" value="<?php if(isset($_POST['textsearch']))	{	echo trim($_POST['textsearch']);	}	?>" name="textsearch" id="textsearch" />
			<input type="button" value="Search Studies" class="button" onclick="filter_by_type_school()" />
		</p>
		
		<div class="tablenav top">
			<div class="alignleft actions">
				<select name="bulkaction" id="bulkaction">
					<option value="-1">Bulk Actions</option>
					<?php if($currentselected == 'trash')	{ ?>
						<option value="restoreSchool">Restore</option>
						<option value="removeSchool">Delete Permanently</option>
					<?php } else	{ ?>
						<option value="trashSchool">Move to Trash</option>
					<?php } ?>
				</select>
				<input type="button" value="Apply" class="button action" id="doaction" name="doaction" onclick="bulkApply()" />
			</div>
			<div class="alignleft actions">
				<select name="filter_type_school" id="filter_type_school">
					<option value="">View all type</option>
					<option value="online" <?php if( isset($_POST['filter_type_school']) && $_POST['filter_type_school'] == 'online')	{	echo 'selected'; } ?> >Online</option>
					<option value="campus" <?php if( isset($_POST['filter_type_school']) && $_POST['filter_type_school'] == 'campus')	{	echo 'selected'; } ?> >Campus</option>
				</select>
				<input type="button" onclick="filter_by_type_school()" name="doaction" id="doaction" class="button action" value="Filter" />
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
		<table cellspacing="0" class="widefat post fixed" id="tabletest">
			<thead><?php SchoolsView::table_header(1); ?></thead>
			<tfoot><?php SchoolsView::table_header(); ?></tfoot>
			<tbody>
				<?php
				if(count($schools) > 0)	{
					$i=0;
					foreach($schools as $school)	{
						$i++;
						?>
						<tr>
							<th class="check-column">
								<input type="checkbox" class="classcheckbox" value="<?php echo $school->id; ?>" id="checkbox_<?php echo $i; ?>" name="ids[]" />
							</th>
							<td>
							<?php if($school->trashed == 0)	{	?>
								<strong><?php echo stripslashes($school->name); ?></strong>
								<div class="row-actions-visible">
									<!--<span><a style="cursor:pointer" onclick="editSchool('<?php echo $school->id; ?>')">Edit</a> | </span>-->
									<span><a style="cursor:pointer" href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=education-express-schools&task=addedit&id=<?php echo $school->id; ?>">Edit</a> | </span>
									
									<span><a style="cursor:pointer" onclick="trashSchool('<?php echo $school->id; ?>')" >Trash</a> | </span>
									<span><a class="fancybox" href="<?php echo $school->logo; ?>">View Logo</a></span>
								</div>
							<?php } else	{	?>	
								<strong><?php echo stripslashes($school->name); ?></strong>
								<div class="row-actions-visible">
									<span><a style="cursor:pointer" onclick="restoreSchool('<?php echo $school->id; ?>')">Restore</a> | </span>
									<span><a style="cursor:pointer" onclick="removeSchool('<?php echo $school->id; ?>')" >Delete Permanently </a></span>
								</div>
							<?php } 	?>	
							</td>
							<td>
								<a class="fancybox" href="<?php echo $school->logo; ?>"><img src="<?php echo $school->logo; ?>" width="198" height="91" /></a>
							</td>
							<td>
								<script type="text/javascript">
								jQuery().ready(function() {
									jQuery('#schooldesc_<?php echo $school->id; ?>').jTruncate({  
										length: 200,  
										minTrail: 0,  
										moreText: "[See more]",  
										lessText: "[See less]",  
										ellipsisText: "",
										moreAni: "fast",
										lessAni: 2000  
									});
								});
								</script>
								<div id="schooldesc_<?php echo $school->id; ?>">
									<?php echo stripslashes($school->description); ?>
								</div>
							</td>
							<td><?php echo ucfirst($school->stype); ?></td>
							<td>
								<?php //echo ($school->zipcode); ?>
								<div class="row-actions-visible">
									<span><a style="cursor:pointer" onclick="viewZipcode('<?php echo $school->id; ?>')">View</a> | </span>
									<span><a style="cursor:pointer" onclick="addZipcode('<?php echo $school->id; ?>')">Add</a> | </span>
									<span><a style="cursor:pointer" onclick="uploadCSVZipcode('<?php echo $school->id; ?>')" >Upload CSV</a></span>
									
								</div>
							</td>
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
	
	function load_schools($schools, $count_trash=null, $count_all=null, $currentselected=null, $filterparam=null)	{
		?>
		<div class="wrap">		
			<script type="text/javascript" src="<?php echo plugins_url(); ?>/educationexpress/js/jquery.jtruncate.pack.js"></script>
			<?php
			 if(isset($_GET['task']) && $_GET['task'] == 'addedit')
				SchoolsView::load_add_edit_form();
			else	{ 
				?>
				<div class="icon32" id="icon-plugins"><br></div>
				<!--<h2>Schools <a class="add-new-h2" onclick="addSchool()" style="cursor:pointer;">Add New</a> </h2>-->
				<h2>
					Schools <a class="add-new-h2" href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=education-express-schools&task=addedit" style="cursor:pointer;">Add New</a> 
				</h2>
				<div id="loadtable"><?php SchoolsView::load_table($schools, $count_trash, $count_all, $currentselected, $filterparam); ?></div><br/>
				<div id="load_form"><?php //SchoolsView::get_form(); ?></div>
				<?php 
				SchoolsView::view_zip_code();
				SchoolsView::zipcode_formadd();
				SchoolsView::zipcode_csv_form();
			}
			?>
		</div>
		<?php
	}

	function get_form()	{
		?>
		<div id="form-dialog-modal" title="Add">
			<p> <span id="taskspan"> Add </span> the name of the school, description and logo.</p>
			
			<form id="form_school" action="" method="post">
				<table><tbody>
				<tr>
					<td>Name</td>
					<td>
						<input type="hidden" value="" name="schoolid" id="schoolid"  />
						<input type="text" name="schoolname" id="schoolname" style="width:300px;" />
					</td>
				</tr>
				<tr>
					<td>Description</td>
					<td>
						<span onclick="get_wp_editor()" style="cursor:pointer;">load editor test</span>
						<span id="get_wp_editor">
						<!--<textarea name="schooldesc" id="schooldesc" style="width:300px;max-width:300px;height:120px;"></textarea>-->
						<?php wp_editor( '', 'schooldesc', $settings = array( 'media_buttons' => false, 'textarea_rows' => 20, 'teeny' => true, ) ); ?>
						</span>
					</td>
				</tr>
				<tr>
					<td>Zip Code</td>
					<td><input type="text" value="" name="schoolzipcode" id="schoolzipcode" style="width:300px;" /></td>
				</tr>
				<tr>
					<td>Type</td>
					<td>
						<select name="schooltype" id="schooltype">
							<option value="">Select Type</option>
							<option value="online">Online</option>
							<option value="campus">Campus</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Logo</td>
					<td>
						<input type="text" value="" name="schoollogo" id="schoollogo" style="width:300px;" />
						<input type="button" value="Upload Image" class="button" id="schoollogobtn" />
						<br><span style="font-size:11px">You can paste directly the url of the logo <a class="fancybox" id="previewlogo" href="#" style="color:#21759B;text-decoration:underline;">Preview Logo</a></span>
					</td>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="hidden" value="saveschool" name="task" id="task" />
						<input type="submit" value="Save" class="button-primary" />
					</td>
				</tr>
				</tbody></table>
			</form>
		</div>
		<?php
	}
	
	function load_add_edit_form()	{
		if(isset($_GET['id']) && $_GET['id'] != '')	{
			$title = 'Edit';
			$data = SchoolsModel::get_by_id($_GET['id']);
			$id = $data->id;
			$name = stripslashes($data->name);
			$description = stripslashes($data->description);
			$logo = $data->logo;
			$stype = $data->stype;
			$zipcode = $data->zipcode;
		}
		else	{
			$title = 'Add New';
			$id = '';
			$name = '';
			$description = '';
			$logo = '';
			$stype = '';
			$zipcode = '';
		}
		?>
		<style type="text/css" media="screen">	.form-table th { width:100px; }	.quicktags-toolbar input { width:30px; }</style>
		<div class="wrap">
			<div class="icon32" id="icon-plugins"><br></div>
			<h2><?php echo $title; ?> School</h2>
			
			<form id="form_school" action="" method="post">
				<table class="form-table" style="width:650px;">
					<tbody>
						<tr class="form-field">
							<th scope="row">Name</th>
							<td>
								<input type="hidden" value="<?php echo $id; ?>" name="schoolid" id="schoolid"  />
								<input type="text" value="<?php echo $name; ?>" name="schoolname" id="schoolname"/>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row">Description</th>
							<td>
								<?php 
									//wp_editor( $description, 'schooldesc', $settings = array( 'media_buttons' => false, 'tinymce' => true , 'wpautop' => false) ); 
									wp_editor( $description, 'schooldesc', $settings = array( 'media_buttons' => false, 'tinymce' => true ) ); 
									//wp_editor( $description, 'schooldesc', $settings = array() ); 
								?>
							</td>
						</tr>
						<tr class="form-field" style="display:none;">
							<th scope="row">Zip Code</th>
							<td><input type="text" value="<?php echo $zipcode; ?>" name="schoolzipcode" id="schoolzipcode"/></td>
						</tr>
						<tr class="form-field">
							<td scope="row">Type</td>
							<td>
								<select name="schooltype" id="schooltype">
									<option value="">Select Type</option>
									<option value="online" <?php if($stype == 'online')	{	echo 'selected'; } ?> >Online</option>
									<option value="campus" <?php if($stype == 'campus')	{	echo 'selected'; } ?> >Campus</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Logo</td>
							<td>
								<input type="text" value="<?php echo $logo; ?>" name="schoollogo" id="schoollogo" style="width:300px;" />
								<input type="button" value="Upload Image" class="button" id="schoollogobtn" />
								<br><span style="font-size:11px">You can paste directly the url of the logo <a class="fancybox" id="previewlogo" href="<?php echo $logo; ?>" style="color:#21759B;text-decoration:underline;">Preview Logo</a></span>
							</td>
						</tr>
					</tbody>
				</table>
				<p class="submit">						
					<input type="hidden" value="saveschool" name="task" id="task" />
					<input type="submit" value="Save" class="button-primary" />
					<input type="button" value="Cancel" class="button-primary" onclick="gotomainschoolpage()" />
				</p>
			</form>
		</div>
		<?php
	}
	
	function view_zip_code()	{
		?>
		<div id="form_viewzipcode-dialog-modal" title="Zip Code">
			<div id="zipcode_load_results">
			</div>
		</div>
		<?php
	}

	function zipcode_list($data,$schname=null)	{
		if($schname != '')
			$schoolname = $schname;
		else
			$schoolname = 'List';
		?>
		<p><b>School: </b> <?php echo $schoolname; ?></p>
		<table cellspacing="0" class="widefat post fixed">
			<thead><th scope="col" width="100%">Zip Code</th></thead>
			<tfoot><th scope="col" width="100%">Zip Code</th></tfoot>
			<tbody>
			<?php 
			if(count($data) > 0)	{	
				foreach($data as $row)	{
					?><tr><td><?php echo $row->name; ?></td></tr>	<?php
				}
			}
			else	{	?><tr><td>No records found.</td></tr>	<?php	}	?>
			</tbody>
		</table>
		<?php
	}
	
	function zipcode_formadd()	{
		?>
		<div id="form_zipcodeadd-dialog-modal" title="Add">
			<p> <span id="taskspan"> Add </span> the zipcode</p>
			
			<form id="form_zipcode" action="" method="post">
				<table><tbody>
				<tr>
					<td>Zipcode</td>
					<td>
						<input type="hidden" value="" name="zipschoolid" id="zipschoolid"  />
						<input type="text" name="zipcodename" id="zipcodename" style="width:300px;" />
					</td>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="hidden" value="school_addzipcode" name="task" id="task" />
						<input type="submit" value="Save" class="button-primary" />
					</td>
				</tr>
				</tbody></table>
			</form>
		</div>
		<?php
	}
	
	function zipcode_csv_form()	{
		?>
		<div id="formcsv-dialog-modal" title="Upload">
			<p> <span id="taskspan"> Upload </span> your csv</p>
			<form id="form_csv" action="<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php?action=school_ajax" method="post" enctype="multipart/form-data">
				<table><tbody>
				<tr>
					<td>CSV</td>
					<td>
						<input type="hidden" value="" name="zipcode_school" id="zipcode_school"  />
						<input type="file" name="file" id="file" style="width:300px;" />
					</td>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="hidden" value="school_uploadcsv" name="task" id="task" />
						<input type="submit" value="Save" class="button-primary" />
					</td>
				</tr>
				</tbody></table>
			</form>
		</div>
		<?php
	}

}
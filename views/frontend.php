<?php
/**
 * Frontend View
 *
 * @package Education Express Plugin
 * 
 */

class FrontendView	{
	
	function __construct()	{
	}

	function load_javacript()	{
		wp_enqueue_script('jquery');
		?>
		<script type="text/javascript" src="<?php echo plugins_url(); ?>/educationexpress/js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="<?php echo plugins_url(); ?>/educationexpress/js/jquery.blockUI.js"></script>
		<script type="text/javascript" src="<?php echo plugins_url(); ?>/educationexpress/js/jquery.validate.js"></script>
		<script type="text/javascript" src="<?php echo plugins_url(); ?>/educationexpress/js/jquery.jtruncate.pack.js"></script>
		<style type="text/css" media="screen">	.error { color: red; }	</style>		
		<script type="text/javascript" >
		
		jQuery.validator.addMethod("notEqualTo", function(value, element) {
			if(value == 'Enter ZIP....')
				return false;

			return true;
		}, "ZIP code is required.");
	
		var jjQuery = jQuery.noConflict();
		jjQuery(window).load(function(){
		jjQuery(document).ready(function(){
			jjQuery("#frm_refsearch").validate({
					ignore: [],
					rules: {
						zip: {
							//required: false,
							//notEqualTo: true
						}
					},
					messages: {              
						zip: {
							  //required: "Zip code is required."
						}
					},
					submitHandler: function(form) {
						form.submit();
					},
					showErrors: function(errorMap, errorList){
						if(errorList[0] !== undefined)	{
							alert(errorList[0].message);
						}
						//this.defaultShowErrors();
					}
			});
			
		})
		});
		
		// jquery custom function
		jQuery(document).ready(function() {
			get_degrees = (function(id) {
				jQuery("#degrees").val(id);
				jQuery("#frm_refsearch").submit();
			});
			
			get_studies = (function(id) {
				jQuery("#studies").val(id);
				jQuery("#frm_refsearch").submit();
			});
		});
		</script>
		<?php
	}
	
}
<?php
/**
 * Main View
 *
 * @package Education Express Plugin
 * 
 */

class MainView	{
	
	function __construct()	{
		?>
		<div class="wrap">
			<h2>Education Express</h2>
			<ul>
				<li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=education-express-schools">Manage Schools</a></li>
				<li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=education-express-zipcodes">Manage Zipcodes</a></li>
				<li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=education-express-degrees">Manage Degrees</a></li>
				<li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=education-express-studies">Manage Studies</a></li>
				<li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=education-express-programs">Manage Progams</a></li>
			</ul>
		</div>
		<?php
	}

}
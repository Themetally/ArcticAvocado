<button id="site-menu" class="menu-toggle button"><?php esc_html_e(
		'Menu',
		'unstyled'
	); ?></button>
<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
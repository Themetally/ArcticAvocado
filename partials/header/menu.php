<button id="site-menu" class="menu-toggle button"><?php esc_html_e(
		'Menu',
		'unstyled'
	); ?></button>

<div id="primary-menu" class="site-menu__inner">
	<button id="site-menu-close" class="menu-toggle menu-toggle--close button">Close Menu</button>
	<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
</div>

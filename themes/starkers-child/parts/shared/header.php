<header id="header" data-behavior="header_collapse">
	<div class="container">
	<h1 id="logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?>"/></a></h1>
	<!---	<?php bloginfo( 'description' ); ?> -->
	<!---	<?php get_search_form(); ?> -->
	<img id="header-image" src="<?php echo get_stylesheet_directory_uri() ?>/img/header-image.png" />
	</div>
	<div id="mobile-menu">
		<?php dropdown_menu(array(
		  'container'=> 'div',
		  'container_id' => '',
		  'menu_id' =>'mobile-menu-primary',
		  'menu_class' =>'',
		  'theme_location' => 'primary',
			));
		?>
	</div>

	<?php wp_nav_menu(array(
	  'container'=> 'nav',
	  'container_id' => 'menu-container',
	  'menu_id' =>'main-menu',
	  'menu_class' =>'menu-inline',
	  'theme_location' => 'primary',
	  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>'
	)); ?>



</header>
<div role="main" id="main">
	<div class="container">
		<div class="grid">
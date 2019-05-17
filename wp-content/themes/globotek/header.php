<!DOCTYPE html>
<!--[if IE 9]>
<html dir="ltr" lang="en-US" class="ie9 lt-ie10"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en-US"><!--<![endif]-->
<head>
	
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	
	<title><?php wp_title(); ?></title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	
	<?php wp_head(); ?>
	
	<!-- Google Tag Manager -->
	<!--<script>
		(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	                                                  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-W4QP6F9');
	</script>-->
	<!-- End Google Tag Manager -->

</head>


<body <?php body_class(); ?>>

<header class="site-head" role="banner" data-module="toggle,site-head">
	
	<div class="site-head__inner">
		
		<a href="<?php echo home_url(); ?>" class="site-head__logo">
			<img src="<?php header_image(); ?>" alt="GloboTek Logo in White"/>
		</a>
		
		<nav id="site-head__nav" class="site-head__nav js-toggle__target">
			
			<?php
			/**
			 * In this section, we're going to take the menus created in the admin area
			 * and feed each item into the markup. We need to process the menus as to split
			 * them into parent and child menu items so they can be arranged accordingly.
			 *
			 *
			 * First, we get all available menus based on what's stipulated in functions.php
			 * so that we're not reliant on what the menu has been called by the user in the
			 * admin area.
			 */
			$menu_locations = get_nav_menu_locations();
			
			/** Select the menu we want for current location, in this case, header so main.*/
			$menu_id = $menu_locations[ 'main' ];
			
			/** Get all the menu items for the chosen menu.*/
			$menu_items = wp_get_nav_menu_items( $menu_id );
			
			/** Apply WP classes to menu items.*/
			_wp_menu_item_classes_by_context( $menu_items );
			
			$parent_array     = array();
			$child_array      = array();
			$grandchild_array = array();
			
			/**
			 * We need to split the menu items into their respective parent and child denotions.
			 * To do this, we loop over all the menu item and take the ID and parent ID of the
			 * menu item. Parent's will always have parent ID of 0 so we use that to determine if
			 * it's a parent menu item and drop it into the parent array. If the parent ID is more
			 * than 0, it's a child item so it gets dropped in the child array. We use the child's
			 * parent ID as a key so we can group all child items together in one array which we can
			 * query easily using the parent ID, as the children are to be attached to the parent.
			 */
			foreach ( $menu_items as $link ) {
				
				$link_id   = $link->ID;
				$parent_id = intval( $link->menu_item_parent );
				
				if ( $parent_id == 0 ) {
					
					$parent_array[] = $link_id;
					
				}
				
				if ( $parent_id > 0 ) {
					
					if ( in_array( $parent_id, $parent_array ) ) {
						
						$child_array[ $parent_id ][] = $link_id;
						
					} else {
						
						$grandchild_array[ $parent_id ][] = $link_id;
						
					}
					
				}
				
			}
			
			/** Now we have separated parent items from child items, we can construct the markup.*/
			echo '<ol class="site-head__nav__inner">';
			
			/** Loop over all menu items again, as to build the lists.*/
			foreach ( $menu_items as $link ) {
				
				$link_id   = $link->ID;
				$parent_id = $link->menu_item_parent;
				
				/**
				 * We check if the menu item ID exists as a key in the child array. If it does, it has
				 * child items associated with it.
				 */
				if ( ! empty( $child_array ) && array_key_exists( $link_id, $child_array ) ) {
					
					/**
					 * As we've separated items with submenus from those that don't, we can now output
					 * the necessary submenu markup independently from those with no submenu.
					 */
					echo '<li class="site-head__nav__item menu-item-has-children js-toggle__target' . implode( ' ', $link->classes ) . '" data-elem-class="class-attribute">';
					echo '<a href="' . $link->url . '">' . $link->title . '<span class="site-head__nav__item__arrow js-toggle__trigger"><i class="fas fa-chevron-down"></i></span></a>';
					
					echo '<ul class="sub-menu">';
					
					/**
					 * We have the IDs of child items stored but no data so we need to loop over
					 * all the menu items again, in order to get the data for each menu item ID.
					 * Due to previously using the parent ID as the key for each set of child items
					 * we can easily pick the array of child item IDs we want to look at, thus linking
					 * them to the correct parent ID in the markup.
					 */
					foreach ( $child_array[ $link_id ] as $sub_link_id ) {
						
						/**
						 * Check to see if this 2nd tier menu item has children of its own and thus,
						 * needs to output a grandchildren menu. If it matches yes, run a sub-routine
						 * specific to 3 tier menu items.
						 */
						if ( array_key_exists( $sub_link_id, $grandchild_array ) ) {
							
							foreach ( $menu_items as $sub_link ) {
								
								if ( $sub_link->ID == $sub_link_id ) {
									
									echo '<li class="' . implode( ' ', $sub_link->classes ) . ' menu-item-has-children">';
									echo '<a href="' . $sub_link->url . '" class="title-menu-item">' . $sub_link->title . '</a>';
									
									echo '<ul class="sub-sub-menu">';
									
									foreach ( $grandchild_array[ $sub_link_id ] as $sub_sub_link_id ) {
										
										foreach ( $menu_items as $sub_sub_link ) {
											
											if ( $sub_sub_link->ID == $sub_sub_link_id ) {
												
												echo '<li class="' . implode( ' ', $sub_sub_link->classes ) . '">';
												echo '<a href="' . $sub_sub_link->url . '">' . $sub_sub_link->title . '</a>';
												echo '</li>';
												
											}
											
										}
										
									}
									
									echo '</ul>';
									
									echo '</li>';
								}
								
							}
							
						} else {
							
							/**
							 * Fail side of check simply outputs second tier menu items with no sub sub-menu.
							 */
							foreach ( $menu_items as $sub_link ) {
								
								/**
								 * As we iterate, we check to see if the child ID matches the menu item ID
								 * and if it does, we output a list item and feed in appropriate data.
								 */
								if ( $sub_link->ID == $sub_link_id ) {
									
									echo '<li class="' . implode( ' ', $sub_link->classes ) . '">';
									echo '<a href="' . $sub_link->url . '">' . $sub_link->title . '</a>';
									echo '</li>';
									
								}
								
							}
							
						}
						
					}
					
					echo '</ul>';
					echo '</li>';
					
				} elseif
				( $link->menu_item_parent == 0
				) {
					
					echo '<li class="site-head__nav__item ' . implode( ' ', $link->classes ) . '">';
					
					echo '<a href="' . $link->url . '">' . $link->title . '</a>';
					
					echo '</li>';
					
				}
			}
			
			echo '</ul>';
			/** End menu markup creation.*/
			?>
		
		</nav>
		
		<div class="search">
			<div class="search__icon">
				<i class="fas fa-search"></i>
			</div>
			
			<form class="search__form" action="<?php echo get_the_permalink( get_option( 'page_for_posts' ) ); ?>" method="post">
				<input type="search" class="form__field search__form__field" name="search_query" autocomplete="off" placeholder="Search blog articles"/>
			</form>
		</div>
		
		<a href="#site-head__nav" class="site-head__hamburger js-toggle__trigger">
			<i class="fas fa-bars"></i>
		</a>
	
	</div>


</header>
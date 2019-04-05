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

</head>


<body <?php body_class(); ?>>

<header class="site-head" role="banner" data-module="toggle,site-head">
	
	<div class="site-head__inner">
		
		<a href="<?php echo home_url(); ?>" class="site-head__logo">
			<img src="<?php echo get_template_directory_uri() . '/images/gtek.png'; ?>"/>
		</a>
		
		<nav id="site-head__nav" class="site-head__nav js-toggle__target">
			
<!--			<ol class="site-head__nav__inner">-->
<!--				-->
<!--				<li class="site-head__nav__item">Item 1</li>-->
<!--				<li class="site-head__nav__item">Item 2</li>-->
<!--				<li class="site-head__nav__item">Item 3</li>-->
<!--				<li class="site-head__nav__item">Item 4</li>-->
<!--				<li class="site-head__nav__item">Item 5</li>-->
<!--				<li class="site-head__nav__item">Item 6</li>-->
<!--				-->
<!--			</ol>-->
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
			//var_dump( $menu_items );
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
				$parent_id = $link->menu_item_parent;
				
				if ( $parent_id == 0 ) {
					$parent_array[] = $link_id;
				}
				
				if ( $parent_id > 0 ) {
					$child_array[ $parent_id ][] = $link_id;
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
					echo '<li class="site-head__nav__item menu-item-has-children' . implode(' ', $link->classes) . '">';
					echo '<a href="' . $link->url . '">' . $link->title . '</a>';
					
					echo '<ul class="sub-menu">';
					
					/**
					 * We have the IDs of child items stored but no data so we need to loop over
					 * all the menu items again, in order to get the data for each menu item ID.
					 * Due to previously using the parent ID as the key for each set of child items
					 * we can easily pick the array of child item IDs we want to look at, thus linking
					 * them to the correct parent ID in the markup.
					 */
					foreach ( $child_array[ $link_id ] as $sub_link_id ) {
						
						foreach ( $menu_items as $sub_link ) {
							
							/**
							 * As we iterate, we check to see if the child ID matches the menu item ID
							 * and if it does, we output a list item and feed in appropriate data.
							 */
							if ( $sub_link->ID == $sub_link_id ) {
								
								echo '<li class="' . implode(' ', $sub_link->classes) . '">';
								echo '<a href="' . $sub_link->url . '">' . $sub_link->title . '</a>';
								echo '</li>';
								
							}
							
						}
						
					}
					
					echo '</ul>';
					
					echo '</li>';
					
				} elseif ( $link->menu_item_parent == 0 ) {
					
					echo '<li class="site-head__nav__item ' . implode(' ', $link->classes) . '">';
					
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

            <form class="search__form">
                <input type="search" class="form__field search__form__field" name="q" autocomplete="off" placeholder="Search" />
            </form>  
        </div>
		
		<a href="#site-head__nav" class="site-head__hamburger js-toggle__trigger">
			<i class="fas fa-bars"></i>
		</a>
	
	</div>


</header>
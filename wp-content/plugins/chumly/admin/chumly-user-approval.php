<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 29/11/18
 * Time: 12:28 PM
 */
$screen     = get_current_screen();
$screen->id = NULL;

$list_table = new Chumly_User_List_Table( array( 'screen' => $screen ) );

$pagenum = $list_table->get_pagenum();

if ( ! empty( $_GET[ '_wp_http_referer' ] ) ) {
	wp_redirect( remove_query_arg( array( '_wp_http_referer', '_wpnonce' ), wp_unslash( $_SERVER[ 'REQUEST_URI' ] ) ) );
	exit;
}

if ( $list_table->current_action() && ! empty( $_REQUEST[ 'users' ] ) ) {
	$userids  = $_REQUEST[ 'users' ];
	$sendback = wp_get_referer();
	
	/** This action is documented in wp-admin/edit-comments.php */
	$sendback = apply_filters( 'handle_bulk_actions-' . get_current_screen()->id, $sendback, $list_table->current_action(), $userids );
	
	wp_safe_redirect( $sendback );
	exit;
}

if ( empty($_REQUEST) ) {
	$referer = '<input type="hidden" name="wp_http_referer" value="'. esc_attr( wp_unslash( $_SERVER['REQUEST_URI'] ) ) . '" />';
} elseif ( isset($_REQUEST['wp_http_referer']) ) {
	$redirect = remove_query_arg(array('wp_http_referer', 'updated', 'delete_count'), wp_unslash( $_REQUEST['wp_http_referer'] ) );
	$referer = '<input type="hidden" name="wp_http_referer" value="' . esc_attr($redirect) . '" />';
} else {
	$redirect = 'users.php';
	$referer = '';
}

$list_table->prepare_items();
$total_pages = $list_table->get_pagination_arg( 'total_pages' );

$title = 'New User Management';

if ( isset( $_GET[ 'user_approved' ] ) ) {
	
	$split_value   = explode( '_', $_GET[ 'user_approved' ] );
	$user_id       = $split_value[ 0 ];
	$user_approval = $split_value[ 1 ];
	
	var_dump( $user_id );
	var_dump( $user_approval );
	
	update_user_meta( $user_id, '_user_approved', $user_approval );
	
	if($user_approval == 1) {
		update_user_meta( $user_id, '_requires_activation', 0 );
	}
	
}
?>
	
	<div class="wrap chumly">
		
		<h1 class="wp-heading-inline">
			<?php echo esc_html( $title ); ?>
		</h1>
		
		<hr class="wp-header-end">
		
		<?php $list_table->views(); ?>
		
		<?php
		if ( $pagenum > $total_pages && $total_pages > 0 ) {
			wp_redirect( add_query_arg( 'paged', $total_pages ) );
			exit;
		}
		?>
		
		<form method="get">
			
			<?php $list_table->search_box( __( 'Search Users' ), 'user' ); ?>
			
			<?php $list_table->display(); ?>
			
			<input type="hidden" name="page" value="<?php echo $_REQUEST[ 'page' ] ?>"/>
		
		</form>
	
	</div>


<?php var_dump( $_GET ); ?>
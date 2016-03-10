<?php
/**
 * Plugin Name: GreekBank Functionality
 * Plugin URI: http://zao.is
 * Description: Adds all necessary functionality for GreekBank
 * Version: 1.0
 * Author: Justin Sainton
 * Author URI: http://zao.is
 */

/** Dependencies

This plugin depends on the following plugins:

- Gravity Forms (Including User Registration and Braintree Add-Ons)
- Posts 2 Posts
- WP User Groups
- WP Term Meta

It also depends on the user roles of "member" and "treasurer".
Both roles have read and "manage_membership" capabilities.
Treasurers have the additional capability of "manage_orgetganization"

*/
/**
 * Registers posts types (Organizations, Terms, Payments)
 * @return [type] [description]
 */
function gb_register_post_types() {

	$labels = array(
		'name'                => _x( 'Organizations', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Organization', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Organizations', 'text_domain' ),
		'name_admin_bar'      => __( 'Organizations', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Organization:', 'text_domain' ),
		'all_items'           => __( 'All Organizations', 'text_domain' ),
		'add_new_item'        => __( 'Add New Organization', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'new_item'            => __( 'New Organization', 'text_domain' ),
		'edit_item'           => __( 'Edit Organization', 'text_domain' ),
		'update_item'         => __( 'Update Organization', 'text_domain' ),
		'view_item'           => __( 'View Organization', 'text_domain' ),
		'search_items'        => __( 'Search Organizations', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'Organization', 'text_domain' ),
		'description'         => __( 'Organizations', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'comments', 'revisions', 'custom-fields' ),
		'taxonomies'          => array( 'fees', ' dues' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-groups',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => false,
		'capability_type'     => 'post',
	);

	register_post_type( 'organization', $args );

	$labels = array(
		'name'                => _x( 'Terms', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Term', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Terms', 'text_domain' ),
		'name_admin_bar'      => __( 'Terms', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Term:', 'text_domain' ),
		'all_items'           => __( 'All Terms', 'text_domain' ),
		'add_new_item'        => __( 'Add New Term', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'new_item'            => __( 'New Term', 'text_domain' ),
		'edit_item'           => __( 'Edit Term', 'text_domain' ),
		'update_item'         => __( 'Update Term', 'text_domain' ),
		'view_item'           => __( 'View Term', 'text_domain' ),
		'search_items'        => __( 'Search Terms', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);

	$args = array(
		'label'               => __( 'Term', 'text_domain' ),
		'description'         => __( 'Terms', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'comments', 'revisions', ),
		'taxonomies'          => array( 'fees', ' dues' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => false,
		'capability_type'     => 'post',
	);

	register_post_type( 'terms', $args );

	$labels = array(
		'name'                => _x( 'Payments', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Payment', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Payments', 'text_domain' ),
		'name_admin_bar'      => __( 'Payments', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Payment:', 'text_domain' ),
		'all_items'           => __( 'All Payments', 'text_domain' ),
		'add_new_item'        => __( 'Add New Payment', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'new_item'            => __( 'New Payment', 'text_domain' ),
		'edit_item'           => __( 'Edit Payment', 'text_domain' ),
		'update_item'         => __( 'Update Payment', 'text_domain' ),
		'view_item'           => __( 'View Payment', 'text_domain' ),
		'search_items'        => __( 'Search Payments', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);

	$args = array(
		'label'               => __( 'Payment', 'text_domain' ),
		'description'         => __( 'Payments', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'comments', 'revisions', ),
		'taxonomies'          => array( 'fees', ' dues' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-clipboard',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => false,
		'capability_type'     => 'post',
	);

	register_post_type( 'payment', $args );

}

add_action( 'init', 'gb_register_post_types' );

/**
 * Registers standard taxonomies (fees/dues).
 * @return [type] [description]
 */
function gb_register_taxonomies() {
	$labels = array(
		'name'                       => _x( 'Type', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Types', 'text_domain' ),
		'all_items'                  => __( 'All Types', 'text_domain' ),
		'parent_item'                => __( 'Parent Type', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Type:', 'text_domain' ),
		'new_item_name'              => __( 'New Type Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Type', 'text_domain' ),
		'edit_item'                  => __( 'Edit Type', 'text_domain' ),
		'update_item'                => __( 'Update Type', 'text_domain' ),
		'view_item'                  => __( 'View Type', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate types with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove types', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => false,
	);

	register_taxonomy( 'payment_type', array( 'payment' ), $args );
}

add_action( 'init', 'gb_register_taxonomies' );

function gb_register_default_user_taxonomies() {

	remove_action( 'init', 'wp_register_default_user_taxonomies' );

	new WP_User_Taxonomy( 'member_category', 'members/categories', array( 'public' => true, 'singular' => 'Category', 'plural' => 'Categories' ) );
}

add_action( 'init', 'gb_register_default_user_taxonomies', 8 );

/**
 * [gb_modify_payment_total description]
 *
 * @param  [type] $submission_data [description]
 * @param  [type] $feed            [description]
 * @param  [type] $form            [description]
 * @param  [type] $entry           [description]
 * @return [type]                  [description]
 */
function gb_modify_payment_total( $submission_data, $feed, $form, $entry ) {
	$surcharge = apply_filters( 'gb_surcharge_percentage', 1.0149 );

	$submission_data['payment_amount'] = round( rgar( $entry, '2' ) * $surcharge , 2 ) ;

	return $submission_data;
}

add_filter( 'gform_submission_data_pre_process_payment_7', 'gb_modify_payment_total', 10, 4 );

function gb_enqueue_scripts() {
	wp_enqueue_script( 'greek-bank', plugins_url( 'greek-bank.js', __FILE__ ), array( 'jquery' ), microtime() );
	wp_localize_script( 'greek-bank', 'greekBankGlobal', array(
		'logout_url' => wp_logout_url( home_url() )
	) );
	if ( is_page( 'treasurer-center' ) ) {
		wp_enqueue_script( 'greek-bank-tablesorter', plugins_url( 'tablesorter.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'greek-bank-chart'      , 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js', array( 'jquery' ) );
		wp_localize_script( 'greek-bank-chart', 'greekChartVars', array(
			'amount_paid'      => gb_current_month_amount_paid(),
			'amount_due'       => gb_current_term_amount_due(),
			'amount_past_due'  => gb_current_month_amount_past_due(),
			'amount_of_fees'   => gb_current_month_amount_paid( 'fees' ),
			'amount_of_dues'   => gb_term_total_dues(),
			'current_payments' => gb_members_by_status(),
			'thirty_days_late' => gb_members_by_status( 'thirty_days_late' ),
			'sixty_days_late'  => gb_members_by_status( 'sixty_days_late' ),
			'more_than_sixty'  => gb_members_by_status( 'more_than_sixty' ),
			'ajaxurl'          => admin_url( 'admin-ajax.php', 'relative' ),
		) );
	}
}

function gb_has_fees( $org_id = 0 ) {
	$semester = gb_get_current_semester( $org_id );

	if ( ! $semester ) {
		return false;
	}

	return 'No' !== -$semester->{'9'};
}

add_filter( 'if_menu_conditions', function( $conditions ) {
	$conditions[] = array(
		'name'		=>	__( 'User is Member', 'if-menu' ),
		'condition'	=>	'gb_is_user_member'
	);
	$conditions[] = array(
		'name'		=>	__( 'User is Treasurer', 'if-menu' ),
		'condition'	=>	'gb_is_user_treasurer'
	);

	return $conditions;

} );

function gb_is_user_member() {
	return current_user_can( 'manage_membership' ) && ! current_user_can( 'manage_organization' );
}

function gb_is_user_treasurer() {
	return current_user_can( 'manage_organization' );
}

add_action( 'wp_enqueue_scripts', 'gb_enqueue_scripts' );

function gb_treasurer_wrapper() {
	if ( ! current_user_can( 'manage_organization' ) && ! current_user_can( 'manage_options' ) ) {
	?><script>window.location = <?php echo wp_json_encode( home_url( 'member-profile' ) ); ?></script><?php
	die;
	}
	ob_start();

	get_template_part( 'treasurer-wrapper' );
	return ob_get_clean();
}

add_shortcode( 'member_cp', 'gb_treasurer_wrapper' );

function gb_member_profile() {
	ob_start();
	get_template_part( 'member-profile' );
	return ob_get_clean();
}

add_shortcode( 'member_profile', 'gb_member_profile' );

add_action( 'genesis_after_header', function() {
	if ( is_page( 'treasurer-center' ) ) {
		get_template_part( 'modals' );
		?>

		<script>

		jQuery(document).ready( function( $ ) {
			$.tablesorter.addParser({
				// set a unique id
				id: 'thousands',
				is: function(s) {
					// return false so this parser is not auto detected
					return false;
				},
				format: function(s) {
					// format your data for normalization
					return s.replace('$','').replace(/,/g,'');
				},
				// set type, either numeric or text
				type: 'numeric'
			});

			$( '.member-roster' ).tablesorter( {
				 headers: {
					0: { sorter: false },
					4: { sorter: 'thousands' },
				 }
			} );
		});
		</script>
<style type="text/css">
	th.header::-moz-selection { background:transparent; }
	th.header::selection      { background:transparent; }
	th.header { cursor:pointer; }
	table th.header:after {
	  content:'';
	  position: relative;
	  bottom: .9em;
	  left: .5em;
	  border-width:0 4px 4px;
	  border-style:solid;
	  border-color:#404040 transparent;
	  visibility:hidden;

	  }
	table th.header:hover:after {
	  visibility:visible;
	  }
	table th.headerSortUp:after,
	table th.headerSortDown:after,
	table th.headerSortDown:hover:after {
	  visibility:visible;
	  opacity:0.4;
	  }
	table th.headerSortUp:after {
	  border-bottom:none;
	  border-width:4px 4px 0;
	  bottom: 0;
	  top: .5em;
	}
</style>
		<?php
	} else if ( is_page( 'member-profile' ) ) {
		get_template_part( 'make-a-payment-modal' );
	}
} );

add_filter( 'body_class', function( $classes ) {

	if ( is_singular() ) {
		$classes[] = get_post()->post_name;
	}

	return $classes;

} );

/**
* Auto login to site after GF User Registration Form Submittal
* Also connects gb_get_member_organization()->post_title to organization
*/
function gb_autologin_gfregistration( $user_id, $config, $entry, $password ) {

	if ( '4' != $entry['form_id'] ) {
		return;
	}

	gb_connect_treasurer_to_organization( $user_id, $entry['post_id'] );
	gb_connect_member_to_organization( $user_id, $entry['post_id'] );

	wp_set_auth_cookie( $user_id, false, '' );
}

add_action( 'gform_user_registered','gb_autologin_gfregistration', 10, 4 );

/**
* Connect members to organizations on New Member Form submission.
*/
function gb_new_member_connection( $user_id, $config, $entry ) {

	if ( '12' != $entry['form_id'] ) {
		return;
	}

	$organization = gb_get_member_organization();

	gb_connect_member_to_organization( $user_id, $organization->ID );

	$category = rgar( $entry, '4' );

	$category =  get_term_by( 'id', $category, 'member_category' );

	wp_set_terms_for_user( $user_id, 'member_category', array( $category->slug ) );
}

add_action( 'gform_user_registered','gb_new_member_connection', 9, 3 );

/**
 * Returns total number of members per organization.
 *
 * @param  integer $org_id If no parameter passed, uses organization of logged in user.
 *
 * @return integer         Total number of members.
 */
function gb_total_members( $org_id = 0 ) {

	return count( _get_members( $org_id ) );
}

function gb_term_start_date() {
	return date( get_option( 'date_format' ), strtotime( gb_get_current_semester()->{'13'} ) );
}

function gb_first_payment_date() {
	return date( get_option( 'date_format' ), strtotime( gb_get_current_semester()->{'4'} ) );
}

function gb_last_payment_date() {
	return date( get_option( 'date_format' ), strtotime( gb_get_current_semester()->{'5'} ) );
}

function gb_late_fee() {
	 return gb_get_current_semester()->{'11'};
}

function gb_late_fee_days() {
	 return gb_get_current_semester()->{'10'};
}

function gb_bank_account_last_four( $organization_id = 0 ) {

	if ( ! $organization_id ) {
		$organization = gb_get_member_organization();
	}

	return substr( $organization->bank_account, -4, 4 );
}

function gb_routing_number_last_four( $organization_id = 0 ) {

	if ( ! $organization_id ) {
		$organization = gb_get_member_organization();
	}

	return substr( $organization->bank_routing, -4, 4 );
}

function gb_payment_plan_info() {
	$plans = gb_payment_plan_mapping();

	foreach ( $plans as $_plan => $dates ) :
?>
		<h4><?php echo esc_html( ucwords( $_plan ) ); ?> Due Dates</h4>
			<?php foreach ( $dates as $date ) : ?>
			<p><?php echo date( get_option( 'date_format' ), strtotime( $date ) ); ?></p>

	<?php endforeach;

	endforeach;
}

function gb_user_payment_plan( $user = false ) {

	if ( ! $user ) {
		$user = wp_get_current_user();
	}

	return $user->payment_plan;
}

function gb_user_email() {
	return wp_get_current_user()->user_email;
}

function gb_user_full_name() {
	return wp_get_current_user()->display_name;
}

function gb_user_phone_number() {
	return wp_get_current_user()->phone_number;
}

function gb_user_university( $user_id = 0 ) {
	$org = gb_get_member_organization( $user_id );

	if ( ! $org ) {
		return '';
	}

	return $org->university;
}

function gb_get_member_organization( $user_id = 0 ) {
	static $orgs;

	if ( ! $user_id ) {
		$user_id = get_current_user_id();
	}

	if ( ! empty( $orgs[ $user_id ] ) ) {
		return $orgs[ $user_id ];
	}

	$orgs[ $user_id ] = get_post( gb_get_organization_id( $user_id ) );

	return $orgs[ $user_id ];
}

function gb_connections() {

	// Connect Organizations to Members
	p2p_register_connection_type( array(
		'name'        => 'many_members',
		'from'        => 'organization',
		'to'          => 'user',
		'cardinality' => 'one-to-many',
		'title' => array(
			'from' => __( 'Organization to Member', 'my-textdomain' ),
			'to'   => __( 'Members', 'my-textdomain' )
		),
		'from_labels' => array(
			'singular_name' => __( 'Organization', 'my-textdomain' ),
			'search_items'  => __( 'Search organization', 'my-textdomain' ),
			'not_found'     => __( 'No organization found.', 'my-textdomain' ),
			'create'        => __( 'Connect Members', 'my-textdomain' ),
		),
		'to_labels' => array(
			'singular_name' => __( 'Member', 'my-textdomain' ),
			'search_items'  => __( 'Search members', 'my-textdomain' ),
			'not_found'     => __( 'No members found.', 'my-textdomain' ),
			'create'        => __( 'Connect members', 'my-textdomain' ),
		)
	) );

	// Connect Organizations to Treasurers
	p2p_register_connection_type( array(
		'name' => 'single_treasurer',
		'from' => 'organization',
		'to'   => 'user',
		'to_query_vars' => array( 'role' => 'treasurer' ),
		'title' => array(
			'from' => __( 'Organization to Treasurer', 'my-textdomain' ),
			'to'   => __( 'Treasurer', 'my-textdomain' )
		),
		'from_labels' => array(
			'singular_name' => __( 'Organization', 'my-textdomain' ),
			'search_items'  => __( 'Search organization', 'my-textdomain' ),
			'not_found'     => __( 'No organization found.', 'my-textdomain' ),
			'create'        => __( 'Create Connections', 'my-textdomain' ),
		),
		'to_labels' => array(
			'singular_name' => __( 'Treasurer', 'my-textdomain' ),
			'search_items'  => __( 'Search treasurer', 'my-textdomain' ),
			'not_found'     => __( 'No Treasurer found.', 'my-textdomain' ),
			'create'        => __( 'Connect treasurer', 'my-textdomain' ),
		)
	) );

	// Connect Many Payments to One User
	p2p_register_connection_type( array(
		'name' => 'payments_to_user',
		'from' => 'payment',
		'to'   => 'user',
		'cardinality' => 'many-to-one',
		'title' => array(
			'from' => __( 'Payment to User', 'my-textdomain' ),
			'to'   => __( 'User', 'my-textdomain' )
		)
	) );

	// Connect Many Semester to One User
	p2p_register_connection_type( array(
		'name' => 'semesters_to_user',
		'from' => 'terms',
		'to'   => 'user',
		'cardinality' => 'many-to-one',
		'title' => array(
			'from' => __( 'Semester to User', 'my-textdomain' ),
			'to'   => __( 'User', 'my-textdomain' )
		)
	) );

	// Connect Payment to Organization
	p2p_register_connection_type( array(
		'name' => 'payments_to_organization',
		'from' => 'payment',
		'to'   => 'organization',
		'title' => array(
			'from' => __( 'Payment to Organization', 'my-textdomain' ),
			'to'   => __( 'Organization', 'my-textdomain' )
		)
	) );

	// Connect Payments to Organization
	p2p_register_connection_type( array(
		'name' => 'payments_to_semester',
		'from' => 'payment',
		'to'   => 'terms',
		'cardinality' => 'many-to-one',
		'title' => array(
			'from' => __( 'Payment to Semester', 'my-textdomain' ),
			'to'   => __( 'Organization', 'my-textdomain' )
		)
	) );

	// Connect Semester to Organization
	p2p_register_connection_type( array(
		'name' => 'semester_to_organization',
		'from' => 'terms',
		'to'   => 'organization',
		'title' => array(
			'from' => __( 'Semester to Organization', 'my-textdomain' ),
			'to'   => __( 'Organization', 'my-textdomain' )
		)
	) );
}

add_action( 'p2p_init', 'gb_connections' );

/**
 * Connects treasurer to organization
 * Occurs on Sign-Up Form submission
 *
 * @return [type] [description]
 */
function gb_connect_treasurer_to_organization( $treasurer_id, $org_id ) {
	p2p_type( 'single_treasurer' )->connect( $org_id, $treasurer_id, array( 'date' => current_time( 'mysql' ) ) );
}

/**
 * Connects member to organization
 * Occurs anytime a member is added.
 *
 * @return [type] [description]
 */
function gb_connect_member_to_organization( $member_id, $org_id ) {
	p2p_type( 'many_members' )->connect( $org_id, $member_id, array( 'date' => current_time( 'mysql' ) ) );
}

/**
 * Connects payment to member (or treasurer) who makes the payment
 * Occurs anytime a successful payment occurs.
 *
 * @return [type] [description]
 */
function gb_connect_payment_to_member( $payment_id, $member_id ) {
	p2p_type( 'payments_to_user' )->connect( $payment_id, $member_id, array( 'date' => current_time( 'mysql' ) ) );
}

/**
 * Connects semester to member (or treasurer).
 * Occurs anytime a semester is created or a member is added.
 *
 * @return [type] [description]
 */
function gb_connect_semester_to_member( $semester_id, $member_id ) {
	p2p_type( 'semesters_to_user' )->connect( $semester_id, $member_id, array( 'date' => current_time( 'mysql' ) ) );
}

/**
 * Connects payment to organization that receives the payment
 * Occurs anytime a successful payment occurs.
 *
 * @return [type] [description]
 */

function gb_connect_payment_to_organization( $payment_id, $org_id ) {
	p2p_type( 'payments_to_organization' )->connect( $payment_id, $org_id, array( 'date' => current_time( 'mysql' ) ) );
}

/**
 * Connects payment to semester that the payment is received in.
 * Occurs anytime a successful payment occurs.
 *
 * @return [type] [description]
 */
function gb_connect_payment_to_semester( $payment_id, $semester_id ) {
	p2p_type( 'payments_to_semester' )->connect( $payment_id, $semester_id, array( 'date' => current_time( 'mysql' ) ) );
}

/**
 * Connects semester to organization.
 * Occurs, generally, when treasurer settings form is filled out.
 *
 * @return [type] [description]
 */
function gb_connect_semester_to_organization( $semester_id, $organization_id ) {
	p2p_type( 'semester_to_organization' )->connect( $semester_id, $organization_id, array( 'date' => current_time( 'mysql' ) ) );
}

function gb_get_member_payments( $member = false, $args = array() ) {

	if ( ! $member ) {
		$member = get_current_user_id();
	}

	if ( is_a( $member, 'WP_User' ) ) {
		$member = $member->ID;
	}

	$args = wp_parse_args( $args, array(
		'connected_type'  => 'payments_to_user',
		'connected_items' => $member,
		'nopaging'        => true,
	) );

	$payments = new WP_Query( $args );

	return $payments->have_posts() ? $payments->posts : array();
}

function gb_delete_member( $id ) {

	if ( ! current_user_can( 'manage_organization' ) && ! current_user_can( 'delete_users' ) ) {
		return false;
	}

	if ( $id == get_current_user_id() ) {
		return false;
	}

	if ( user_can( $id, 'manage_membership' ) ) {
		return wp_delete_user( $id );
	}

	return false;
}

function gb_ajax_delete_member() {

	if ( ! isset( $_POST['bulk'] ) ) {
		$members = array( absint( $_POST['id'] ) );
	} else {
		parse_str( $_REQUEST['id'], $params );
		$members  = $params['member'];
	}

	foreach ( $members as $member ) {
		$delete = gb_delete_member( $member );
		if ( ! $delete ) {
			wp_send_json_error( $members );
		}
	}

	wp_send_json_success( $members );

}

add_action( 'wp_ajax_delete_members', 'gb_ajax_delete_member' );

function gb_ajax_bulk_edit_member_categories() {
	$params = array();

	parse_str( $_REQUEST['ids'], $params );

	$members  = $params['member'];
	$category = $_REQUEST['category'];
	$category = get_term_by( 'id', $category, 'member_category' );

	foreach ( $members as $member ) {
		wp_set_terms_for_user( $member, 'member_category', array( $category->slug ) );
	}

	wp_send_json_success( $members );

}

add_action( 'wp_ajax_bulk_edit_member_categories', 'gb_ajax_bulk_edit_member_categories' );

function gb_get_terms_for_user( $user, $taxonomy = 'member_category', $args = array() ) {

	if ( is_numeric( $user ) ) {
		$user = new WP_User( $user );
	}

	$defaults = array(
		'fields'     => 'all_with_object_id',
		'meta_query' => array(
			array(
				'key'   => 'organization_id',
				'value' => gb_get_organization_id( get_current_user_id() )
			)
		)
	);

	$args = wp_parse_args( $args, $defaults );

	return wp_get_object_terms( $user->ID, $taxonomy, $args );

}
function gb_ajax_get_member() {

	$id = $_REQUEST['id'];

	$user = get_user_by( 'id', $id );

	if ( ! $user ) {
		wp_send_json_error();
	}

	$payments    = gb_get_member_payments( $id );
	$terms       = gb_get_terms_for_user( $user, 'member_category' );
	$total_paid  = get_member_amount_paid( $user );
	$balance_due = get_member_remaining_balance( $user );

	ob_start();
	get_recent_payments_view( $user );

	$recent = ob_get_clean();

	ob_start();

	gb_member_details_transaction_summary( $user );
	$summary = ob_get_clean();

	$object = array(
		'user'       => array(
			'first' => $user->first_name,
			'last'  => $user->last_name,
			'email' => $user->user_email,
		),
		'categories'   => $terms,
		'payment_plan' => $user->payment_plan,
		'financial'  => array(
			'payments'    => $payments,
			'total_paid'  => $total_paid,
			'balance_due' => $balance_due,
			'recent_view' => $recent,
			'summary'     => $summary

		)
	);

	wp_send_json_success( $object );
}

add_action( 'wp_ajax_get_member', 'gb_ajax_get_member' );

function gb_member_details_transaction_summary( $member = false ) {

	foreach ( gb_get_member_payments( $member, array( 'posts_per_page' => 3, 'nopaging' => false ) ) as $payment ) :
			$due_date = $payment->due_date;

			if ( ! empty( $due_date ) ) {
				$due_date = date( 'M j', $due_date );
			} else {
				$due_date = '--';
			}

			$minus = 'paid' == $payment->post_status ? '- ' : '';
	?>
	<tr>
		<td><?php echo date( 'M j', strtotime( $payment->post_date ) ); ?></td>
		<td><?php echo esc_html( $due_date ); ?></td>
		<td><?php echo esc_html( $payment->post_title ); ?></td>
		<td class="<?php echo esc_html( $payment->post_status ); ?>">
			<?php echo $minus; ?>$<?php echo number_format( floatval( $payment->total_amount ), 2, '.', '' ); ?></td>
	</tr>
	<?php endforeach;

}

function gb_ajax_update_member() {

	$id = $_REQUEST['id'];

	$user = get_user_by( 'id', $id );

	if ( ! $user ) {
		wp_send_json_error();
	}

	$category = get_term_by( 'id', $_POST['term'], 'member_category' );

	$terms = wp_set_terms_for_user( $user->ID, 'member_category', array( $category->slug ) );

	$first = sanitize_text_field( $_POST['first'] );
	$last  = sanitize_text_field( $_POST['last'] );

	$plan  =  strtolower( $_POST['plan'] );

	if ( ! empty( $plan ) && in_array( $plan, array_keys( gb_payment_plan_mapping( $user ) ) ) ) {
		update_user_meta( $user->ID, 'payment_plan', $plan );
	}

	$update = wp_update_user( array(
		'ID'         => $user->ID,
		'first_name' => $first,
		'last_name'  => $last,
		'user_email' => sanitize_email( $_POST['email'] ),
		'display_name' => $first . ' ' . $last
	 ) );

	if ( is_wp_error( $update ) ) {
		wp_send_json_error( $update );
	}

	wp_send_json_success(
		array(
			'balance_due' => '$' . get_member_remaining_balance( $user ),
			'terms'       => gb_get_terms_for_user( $user )
		)
	);
}

add_action( 'wp_ajax_update_member', 'gb_ajax_update_member' );

function gb_get_members( $args = array() ) {

	$organization_id = gb_get_organization_id( get_current_user_id() );

	$members = _get_members( $organization_id );

	foreach ( $members as $member ) :
?>
		<tr id="member-<?php echo $member->ID; ?>" data-member-id="<?php echo $member->ID; ?>">
			<td class="select">
				<input id="select-<?php echo $member->ID; ?>" type="checkbox" name="member[]" value="<?php echo $member->ID; ?>" />
			</td>
			<td>
				<span class="display-name"><?php echo esc_html( $member->display_name ); ?></span>
				<div class="row-actions">
					<span class="add-transaction">
						<a href="#">Add Transaction</a> |
					</span>
					<span class="details">
						<a href="#">Details</a> |
					</span>
					<span class="delete">
						<a href="#" data-delete-nonce="<?php echo wp_create_nonce( 'delete-member-' . $member->ID ); ?>">Delete</a>
					</span>
				</div>
			</td>
			<td><?php echo get_member_due_date( $member );?></td>
			<td><?php echo '$' . get_member_current_balance( $member ); ?></td>
			<td><?php echo gb_get_member_category( $member->ID ); ?></td>
			<td class="total-paid">$<?php echo get_member_amount_paid( $member ); ?></td>
			<td class="remaining-balance">$<?php echo get_member_remaining_balance( $member ); ?></td>
		</tr>
<?php
	endforeach;
}

function gb_get_member_category( $member ) {
	$categories = gb_get_terms_for_user( $member );

	if ( empty( $categories ) ) {
		return '';
	} else {
		return $categories[0]->name;
	}
}

/**
 * Gets the amount a member has paid in the current semester.
 *
 * @param  [type] $member [description]
 * @return [type]         [description]
 */
function get_member_amount_paid( $member = false, $format = true, $args = array() ) {

	if ( ! $member ) {
		$member = wp_get_current_user();
	}

	$payments = new WP_Query( wp_parse_args( $args, array(
		'connected_type'  => 'payments_to_user',
		'connected_items' => $member->ID,
		'nopaging'        => true,
		'payment_type'    => 'payment'
	) ) );

	$total       = 0;
	$org_id      = gb_get_organization_id( $member->ID );
	$semester    = gb_get_current_semester( $org_id );

	if ( ! $semester ) {
		return 0.00;
	}

	$semester_id = $semester->ID;

	if ( ! $payments->have_posts() ) {
		return $total;
	}

	foreach ( $payments->posts as $payment ) {
		$current = p2p_type( 'payments_to_semester' )->get_p2p_id( $payment->ID, $semester_id );

		if ( $current ) {
			$total += $payment->total_amount;
		}
	}

	if ( $format ) {
		return number_format( $total, 2, '.', '' );
	} else {
		return $total;
	}
}

function gb_get_member_dues( $member = false ) {

	if ( ! $member ) {
		$member = wp_get_current_user();
	}

	$categories = gb_get_terms_for_user( $member );

	if ( empty( $categories ) ) {
		return false;
	}

	$member_category = $categories[0];

	return get_term_meta( $member_category->term_id, 'due_amount', true );
}

/**
 * Gets member's remaining balance
 * @param  [type] $member [description]
 * @return [type]         [description]
 */
function get_member_remaining_balance( $member = false, $format = true ) {

	if ( ! $member ) {
		$member = wp_get_current_user();
	}

	// Get initial amount due from Member Category
	$amount = gb_get_member_dues( $member );

	// Add all unpaid fees
	$amount += get_member_amount_paid( $member, false, array(
			'payment_type' => 'fees',
			'post_status'  => 'unpaid'
		)
	);

	// Add all unpaid dues
	$amount += get_member_amount_paid( $member, false, array( 'payment_type' => 'dues', 'post_status' => 'unpaid' ) );

	// Subtract all payments made
	$amount -= get_member_amount_paid( $member, false );

	if ( $format ) {
		return number_format( $amount, 2, '.', '' );
	} else {
		return $amount;
	}

}

/**
 * Handles redirect scenarios on login.
 *
 * First scenario: Logging in as a member.  Should redirect to member profile.
 * Second scenario: Logging in as a treasurer who _has_ filled out all settings info.
 * Third scenario: Loggig in as a treasurer who _has not_ filled out all settings info.
 *
 * @param  string           $redirect           The redirect destination URL.
 * @param  string           $requested_redirect The requested redirect destination URL passed as a parameter.
 * @param  WP_User|WP_error $user               WP_User object if login was successful, WP_Error object otherwise.
 *
 * @return string           $redirect           The redirect destination URL.
 */
function gb_handle_login_redirect( $redirect, $requested_redirect, $user ) {

	if ( is_wp_error( $user ) ) {
		return $redirect;
	}

	if ( user_can( $user, 'manage_organization' ) ) {
		if ( ! gb_completed_treasurer_settings( $user->ID ) ) {
			$redirect = home_url( 'treasurer-center/treasurer-settings-form' );
		}
	} else if ( user_can( $user, 'manage_membership' ) ) {
		$redirect = home_url( 'member-profile' );
	}

	return $redirect;

}

add_filter( 'login_redirect', 'gb_handle_login_redirect', 10, 3 );

/**
 * When saving the treasurer form, we create a semester if we're able to, which means all fields are submitted
 * Upon creating the semester, we connect it to the organization.
 * Therefore, if a semester exists, then the form has been completed.
 *
 * @return boolean Whether or not the treasurer settings have been completed.
 */
function gb_completed_treasurer_settings( $treasurer_id = 0 ) {

	if ( ! $treasurer_id && current_user_can( 'manage_organization' ) ) {
		$treasurer_id = get_current_user_id();
	}

	// Get Organization ID from Treasurer
	$organization_id = gb_get_organization_id( $treasurer_id );

	$semester = new WP_Query( array(
		'connected_type'  => 'semester_to_organization',
		'connected_items' => $organization_id,
		'nopaging'        => true,
	) );

	return $semester->have_posts();
}

/**
 * Get organization ID from Member (Treasurer or Member)
 *
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function gb_get_organization_id( $id ) {

	static $org_ids;

	if ( ! empty( $org_ids[ $id ] ) ) {
		return $org_ids[ $id ];
	}

	$connected_type = current_user_can( 'manage_organization' ) ? 'single_treasurer' : 'many_members';

	$organization = new WP_Query( array(
		'connected_type'  => $connected_type,
		'connected_items' => $id,
		'nopaging'        => true,
	) );

	$org_ids[ $id ] = $organization->have_posts() ? $organization->posts[0]->ID : 0;

	return apply_filters( 'gb_get_organization_id', $org_ids[ $id ], $organization, $id );
}

function gb_get_current_semester( $organization_id = 0 ) {
	static $semesters;

	if ( ! $organization_id ) {
		$org = gb_get_member_organization();

		if ( ! $org ) {
			return null;
		}

		$organization_id = $org->ID;
	}

	if ( ! empty( $semesters[ $organization_id ] ) ) {
		return $semesters[ $organization_id ];
	}

	$semester = new WP_Query( array(
		'connected_type'  => 'semester_to_organization',
		'connected_items' => $organization_id,
		'nopaging'        => true,
	) );

	$semesters[ $organization_id ] = $semester->have_posts() ? $semester->posts[0] : null;
	return $semesters[ $organization_id ];
}

/**
 * When treasurer settings are submitted, attach each field as meta to appropriate object.
 * Most meta goes to semester. Late fees and bank info go to organization.
 *
 * Since the lion's share of the meta is for the semester, and we're saving it primarily for
 * the purpose of re-displaying in this form, we actually save the keys as the form field IDs.
 *
 * @return [type] [description]
 */
function gb_create_treasurer_settings_meta( $entry, $form ) {

	// Get Organization ID
	$treasurer_id    = get_current_user_id();
	$organization_id = gb_get_organization_id( $treasurer_id );

	if ( gb_completed_treasurer_settings() ) {
		$semester_id = gb_get_current_semester()->ID;
	} else {
		// Create Semester, if there isn't one active
		$semester_id = gb_create_semester_for_organization( $organization_id );
	}

	// Organization meta
	update_post_meta( $organization_id, 'bank_routing', rgar( $entry, '2' ) );
	update_post_meta( $organization_id, 'bank_account', rgar( $entry, '3' ) );

	// Semester meta
	update_post_meta( $semester_id, 'entry_id', $entry['id'] );

	foreach ( $entry as $form_field_id => $value ) {
		if ( is_numeric( $form_field_id ) ) {
			update_post_meta( $semester_id, $form_field_id, $value );
		}
	}
}

add_action( 'gform_after_submission_6', 'gb_create_treasurer_settings_meta', 10, 2 );

/**
 * Creates a new semester and attaches it to the provided organization ID.
 *
 * @param  int $id Organization ID.
 * @return int     Semester ID.
 */
function gb_create_semester_for_organization( $id ) {

	$semester_id = wp_insert_post( apply_filters( 'semester_post_args', array(
		'post_type'    => 'terms',
		'post_title'   => 'Semester for Organization ID#: ' . $id,
		'post_content' => 'Semester created at ' . current_time( 'mysql' ),
		'post_status'  => 'publish'

	), get_current_user_id(), $id ) );

	// Connect Semester to Organization
	gb_connect_semester_to_organization( $semester_id, $id );

	return $semester_id;
}

function gb_generate_transaction( $entry ) {

	if ( is_numeric( $_POST['member_id'] ) ) {
		$members = array( $_POST['member_id'] );
	} else {
		parse_str( $_POST['member_id'], $params );
		$members  = $params['member'];
	}

	$due_date = rgar( $entry, '5' );

	$args = array(
		'ID'          => $entry['post_id'],
		'amount'      => rgar( $entry, '4' ),
		'description' => rgar( $entry, '6' ),
		'type'        => intval( rgar( $entry, '1' ) )
	);

	foreach ( (array) $members as $member_id ) {
		$args['member_id'] = $member_id;

		if ( $args['type'] != 11 ) {
			$args['status'] = 'unpaid';
		}

		if ( ! empty( $due_date ) ) {
			$args['due_date'] = $due_date;
		} else  {
			$args['due_date'] = false;
		}

		$payment_id = gb_insert_transaction( $args );

		if ( $payment_id && $args['due_date'] ) {
			gb_send_email( 'new-fee', $member_id, 'A New Fee Has Been Assessed to Your Account.' );
		}
	}
}

add_action( 'gform_after_submission_10', 'gb_generate_transaction', 10 );

/**
 * Creates new member categories
 *
 * @todo  Tie member categories to specific organizations
 *
 * @param  [type] $entry [description]
 * @param  [type] $form  [description]
 * @return [type]        [description]
 */
function gb_create_new_category( $entry, $form ) {

	$categories = maybe_unserialize( rgar( $entry, '1' ) );

	foreach ( $categories as $cat ) {
		$category = $cat['Member Category'];
		$dues     = $cat['Due Amount'];

		$term = wp_insert_term( $category, 'member_category', array( 'slug' => $category . '_'  . gb_get_organization_id( get_current_user_id() ) ) );

		if ( ! is_wp_error( $term ) ) {
			update_term_meta( $term['term_id'], 'due_amount'     , $dues );
			update_term_meta( $term['term_id'], 'organization_id',  gb_get_organization_id( get_current_user_id() ) );
		}
	}

}

add_action( 'gform_after_submission_9', 'gb_create_new_category', 10, 2 );

function gb_member_categories_dropdown() {
	echo '<select class="member_category_dropdown medium gfield_select">option value="">Select a Category</option>';

	foreach ( get_terms( 'member_category', array(
		'hide_empty' => 0,
		'meta_query' => array(
			array(
				'key' => 'organization_id',
				'value' => gb_get_organization_id( get_current_user_id() )
				)
			)
		) ) as $term ) {
	?>
		<option value="<?php echo $term->term_id; ?>"><?php echo esc_html( $term->name ); ?></option>
	<?php
	}

	echo '</select>';
}

/**
 * Sends email, based on template, with placeholders replaced with dynamic data.
 *
 * @param  string $template  Filename of template in /emails folder in plugin
 * @param  string $user      User message is being sent to.
 * @param  string $subject   Subject
 *
 * @return boolean           True if successfully sent, false if not.
 */
function gb_send_email( $template, $user, $subject, $extra = '' ) {

	add_filter( 'wp_mail_content_type', function() {
		return 'text/html';
	} );

	$template_file = plugin_dir_path( __FILE__ )  . 'emails/' . $template . '.php';

	if ( ! file_exists( $template_file ) ) {
		return false;
	}

	if ( is_numeric( $user ) ) {
		$user = new WP_User( $user );
	}

	ob_start();

	include $template_file;

	$text = ob_get_clean();

	$text = gb_merge_email_tags( $text, $user );

	$text .= var_export( $user, 1 );

	// $email = // 'missed-payment' == $template ? 'justinsainton@gmail.com' : $user->user_email;

	return wp_mail( 'justinsainton@gmail.com', $subject, $text );
}

/**
 * [gb_merge_email_tags description]
 *
 * @param  [type] $text [description]
 * @param  [type] $user [description]
 * @return [type]       [description]
 */
function gb_merge_email_tags( $text, $user ) {

	$amount_due 	= get_member_current_balance( $user );
	$missed_payment = get_member_overdue_balance( $user );
	$org      	    = gb_get_member_organization( $user->ID );
	$last_fees 	 	= gb_get_member_payments( $user,
					 array(
						'payment_type'   => 'fees',
						'post_status'    => 'unpaid',
						'posts_per_page' => 1,
						'nopaging'       => false,
					)
				);
	$last_fee = array_pop( $last_fees );

	$args = array(
		'{amount_due}' 			 => $amount_due,
		'{missed_payment}'		 => $missed_payment,
		'{due_date}'       		 => get_member_due_date( $user ),
		'{past_due_date}'		 => get_member_recent_past_due_date( $user ),
		'{days_overdue}'   		 => get_member_days_over_due( $user ),
		'{current_year}'  		 => date( 'Y' ),
		'{organization}'    	 => $org->post_title,
		'{member_name}'     	 => $user->display_name,
		'{treasurer_name}'  	 => gb_get_treasurer( $user )->display_name,
		'{treasurer_email}'  	 => gb_get_treasurer( $user )->user_email,
		'{payment_url}'     	 => gb_get_payment_url( $amount_due, $user ),
		'{total_dues}'      	 => gb_current_month_amount_paid( 'all', $org ),
		'{total_past_dues}' 	 => gb_current_month_amount_past_due( 'all', $org ),
		'{university}'      	 => gb_user_university( $user->ID ),
		'{members_paid}'    	 => gb_members_by_status( 'current', $org ),
		'{members_late}'    	 => gb_members_by_status( 'late', $org ),
		'{fee_description}' 	 => $last_fee->post_title,
		'{fee_amount}'      	 => '$' . number_format( $last_fee->total_amount, 2, '.', '' ),
		'{fee_due_date}'    	 => date( 'F j, Y', $last_fee->due_date ),
	);

	return str_replace( array_keys( $args ), $args, $text );
}

function gb_get_payment_url( $amount, $user ) {

	if ( user_can( $user, 'manage_organization' ) ) {
		$url = home_url( 'treasurer-center' );
	} else {
		$url = home_url( 'member-profile' );
	}

	$url = add_query_arg( array( 'amount' => str_replace( ',', '', $amount ), 'payment_hash' => gb_generate_payment_hash( $user, $amount ) ), $url ) . '#profile-panel-payment';

	return $url;
}

function gb_generate_payment_hash( $user, $amount ) {

	$hash = get_user_meta( $user->ID, '_make_a_payment_hash', true );

	if ( empty( $hash ) ) {
		$hash = hash_hmac( 'sha256', $amount, 'greek-bank-super-secret' );
		update_user_meta( $user->ID, '_make_a_payment_hash', $hash );
	}

	return $hash;
}

function gb_check_payment_hash() {

	if ( ! isset( $_REQUEST['amount'] ) || ! isset( $_REQUEST['payment_hash'] ) ) {
		return;
	}

	$amount = $_REQUEST['amount'];
	$hash   = $_REQUEST['payment_hash'];

	$check = hash_hmac( 'sha256', $amount, 'greek-bank-super-secret' );

	if ( $check !== $hash ) {
		return;
	}

	global $wpdb;

	$user_id = $wpdb->get_var( $wpdb->prepare( 'SELECT user_id FROM ' . $wpdb->usermeta . ' WHERE meta_key = "_make_a_payment_hash" AND meta_value = %s', $hash ) );

	if ( ! $user_id ) {
		return;
	}

	delete_user_meta( $user_id, '_make_a_payment_hash' );

	wp_clear_auth_cookie();
	wp_set_auth_cookie( $user_id, false, '' );
	wp_set_current_user( $user_id );
}

add_action( 'init', 'gb_check_payment_hash' );

/**
 * Gets next due date.
 *
 * @param  boolean $user [description]
 * @return [type]        [description]
 */
function get_member_due_date( $user = false ) {
	$due_date = false;

	foreach ( gb_due_dates( $user ) as $date ) {
		if ( current_time( 'timestamp' ) < strtotime( $date['date'] ) ) {
			$due_date = $date['date'];
			break;
		}
	}

	return $due_date ? date( 'M jS', strtotime( $due_date ) ) : false;
}

/**
 * Gets the most recent due date in the past.
 *
 * @param  boolean $user [description]
 * @return [type]        [description]
 */

function get_member_recent_past_due_date( $user = false ) {
	$due_date = false;
	$dates = ( gb_due_dates( $user ) );

	foreach ( $dates as $index => $date ) {
		if ( current_time( 'timestamp' ) < strtotime( $date['date'] ) ) {
			unset( $dates[ $index ] );
		}
	}
	
	$due_date = array_pop($dates);
	return $due_date ? date( 'M j, Y', strtotime( $due_date['date'] ) ) : false;
}

/**
 * Returns due dates for a specific user.
 *
 * Date objects have the following format:
 *
 * array(
 * 		array(
 *   		'date'       => 'September 1st',
 *     		'amount_due' => '1500', // Amount due. Balance, including fees due on or before due date.
 *       	'status'     => 'Paid'  // Returns "Paid" if paid in full, or remaining balance if not.
 * 		)
 * )
 *
 * @param  WP_User $user [description]
 * @return [type]        [description]
 */
function gb_due_dates( $user = false ) {

	$plan  = strtolower( gb_user_payment_plan( $user ) );
	$plans = gb_payment_plan_mapping( $user );
	$dates = gb_get_member_payment_plans( $user );

	$fees = gb_get_member_payments( $user, array(
			'payment_type' => 'fees',
			'post_status'  => 'unpaid'
		)
	);

	$due_dates = array();

	$term = 1;

	foreach ( (array) $dates as $date ) {
		$amount_due = gb_get_amount_due_by_date( $user, $date, $term );

		$due_dates[] = array(
			'date'       => date( 'F jS, Y', strtotime( $date ) ),
			'amount_due' => $amount_due,
			'paid'       => $amount_due <= 0 ? 'Paid' : '$' . number_format( $amount_due, 2, '.', '' ),
		);

		$term++;
	}

	return $due_dates;
}

function gb_get_member_payment_plans( $user = false ) {

	$plan  = strtolower( gb_user_payment_plan( $user ) );
	$plans = gb_payment_plan_mapping( $user );

	if ( isset( $plans[ $plan ] ) && is_array( $plans[ $plan ] ) ) {
		return $plans[ $plan ];
	}

	$semester = gb_get_current_semester();

	if ( ! $semester ) {
		return array();
	}

	$payment_date = strtotime( gb_get_current_semester()->{'4'} );

	// If we're closer than 24 hours to the due date, set a fallback.
	$set_plan_by = date( 'm-d-Y', strtotime( '-1 day', $payment_date ) );

	if ( current_time( 'timestamp' ) > $set_plan_by ) {
		return array_pop( $plans );
	}

	return array();
}

/**
 * Returns amount owed by a member, on (or before) a specific date.
 *
 * Inclusive of fees and dues.
 *
 * @param  [type] $user [description]
 * @param  [type] $date [description]
 * @return [type]       [description]
 */
function gb_get_amount_due_by_date( $user, $date, $payment_plan = 1 ) {
	static $amount_paid     = null;
	static $initial_dues    = null;

	if ( is_null( $amount_paid ) ) {
		 $amount_paid = get_member_amount_paid( $user, false );
	}

	if ( is_null( $initial_dues ) ) {
		 $initial_dues = gb_get_member_dues( $user ) + get_member_amount_paid( $user, false, array(
				'payment_type' => 'dues',
				'post_status'  => 'unpaid'
			)
		);
	}

	$plans = gb_get_member_payment_plans( $user );
	$dues  = $initial_dues / count( $plans );

	if ( $amount_paid > $dues ) {
		$amount_paid -= $initial_dues / count( $plans );
	} else {
		$amount_paid = 0;
	}

	$dues -= $amount_paid;

	return $dues;
}

function gb_get_treasurer( $user ) {

	if ( user_can( $user, 'manage_organization' ) ) {
		return $user;
	}

	$treasurer = get_users( array(
		'connected_type'  => 'single_treasurer',
		'connected_items' => gb_get_organization_id( $user->ID ),
		'fields'          => 'id'
	) );

	if ( empty( $treasurer ) ) {
		return false;
	} else {
		return new WP_User( $treasurer[0] );
	}
}


/**
 * Add Sign-Up URL query string URL as a merge tag
 * @param [type] $form [description]
 */
function gb_add_merge_tags( $form ) {
	?>
	<script type="text/javascript">
		gform.addFilter('gform_merge_tags', 'add_merge_tags');
		function add_merge_tags(mergeTags, elementId, hideAllFields, excludeFieldTypes, isPrepop, option){

			if (elementId == "gform_notification_message"){
				//add merge tag only to the confirmation message field on the confirmation page
				mergeTags["custom"].tags.push({ tag: '{sign_up_url}', label: 'Sign-Up URL' });
				mergeTags["custom"].tags.push({ tag: '{current_year}', label: 'Current Year' });
				mergeTags["custom"].tags.push({ tag: '{organization}', label: 'Organization' });
				mergeTags["custom"].tags.push({ tag: '{university}', label: 'University' });
			}
			return mergeTags;
		}
	</script>
	<?php

	return $form;
}

add_action( 'gform_admin_pre_render', 'gb_add_merge_tags' );

/**
 * [replace_download_link description]
 *
 * @param  [type] $text       [description]
 * @param  [type] $form       [description]
 * @param  [type] $entry      [description]
 *
 * @return [type]             [description]
 */
function gb_replace_signup_merge_tag( $text, $form, $entry ) {

	$custom_merge_tag = '{sign_up_url}';

	if ( strpos( $text, $custom_merge_tag ) === false ) {
		return $text;
	}

	$first        = rgar( $entry, '1.3' );
	$last         = rgar( $entry, '1.6' );
	$email        = rgar( $entry, '2' );
	$phone        = rgar( $entry, '3' );
	$organization = rgar( $entry, '4' );

	$args = array(
		'first_name' => $first,
		'last_name'  => $last,
		'email'      => urlencode( $email ),
		'phone'      => $phone,
		'org'        => $organization,
	);

	$sign_up_url = add_query_arg( $args, home_url( 'treasurer-sign-up' ) );

	$text = str_replace( $custom_merge_tag, $sign_up_url, $text );

	return $text;
}

add_filter( 'gform_replace_merge_tags', 'gb_replace_signup_merge_tag', 10, 3 );

function gb_payment_confirmation_tags( $text, $form, $entry ) {
	$amount = floatval( rgar( $entry, 'payment_amount' ) );
	$org    = gb_get_member_organization();
	$title  = $org ? $org->post_title : '';

	$args = array(
		'{term_balance}'        => '$' . get_member_remaining_balance( wp_get_current_user() ),
		'{payment_amount}'      => '$' . number_format( $amount , 2, '.', '' ),
		'{organization}'        => $title,
		'{university}'          => gb_user_university(),
		'{confirmation_number}' => rgar( $entry, 'transaction_id' ),
	);

	$text = str_replace( array_keys( $args ), $args, $text );

	return $text;

}
add_filter( 'gform_replace_merge_tags', 'gb_payment_confirmation_tags', 10, 3 );

/**
 * [replace_download_link description]
 *
 * @param  [type] $text       [description]
 * @param  [type] $form       [description]
 * @param  [type] $entry      [description]
 *
 * @return [type]             [description]
 */
function gb_replace_current_year_merge_tag( $text, $form, $entry ) {

	$custom_merge_tag = '{current_year}';

	if ( strpos( $text, $custom_merge_tag ) === false ) {
		return $text;
	}

	$text = str_replace( $custom_merge_tag, date( 'Y' ), $text );

	return $text;
}

add_filter( 'gform_replace_merge_tags', 'gb_replace_current_year_merge_tag', 10, 3 );

/**
 *
 * Pre-fills treasurer form with meta.
 *
 * To note: on new terms, where the new-term query string is set, we check if the
 * field is a date field, and if it is, we set it to empty.
 *
 * @param  [type] $form [description]
 * @return [type]       [description]
 */
function gb_prepopulate_treasurer_settings( $form ) {

	if ( ! gb_completed_treasurer_settings() || '6' != $form['id'] ) {
		return $form;
	}

	$organization = gb_get_member_organization();
	$semester     = gb_get_current_semester();

	// Organization meta

	$routing = $organization->bank_routing;
	$account = $organization->bank_account;

	// Semester meta
	$semester_meta = get_post_custom( $semester->ID );

	if ( ! is_array( $semester_meta ) ) {
		return $form;
	}

	$mapped_fields = array();

	foreach ( $semester_meta as $key => $value ) {
		if ( is_numeric( $key ) && ! empty( $value[0] ) ) {
			$mapped_fields[ $key ] = $value[0];
		}
	}

	$mapped_field_ids = array_map( 'intval', array_keys( $mapped_fields ) );

	$is_new_term = isset( $_GET['new-term'] ) && 'true' == $_GET['new-term'];

	$term_start_date = GFCommon::date_display( rgar( $mapped_fields, 13 ) , '', false );
	$datepicker_ids  = array();

	foreach ( $form['fields'] as &$field ) {

			if ( ! in_array( $field['id'], $mapped_field_ids ) ) {
				continue;
			}

			switch( RGFormsModel::get_input_type( $field ) ) {

			case 'fileupload':

				$value = rgar($mapped_fields, $field['id']);
				$path_info = pathinfo($value);

				// check if file has been "deleted" via form UI
				$upload_files = json_decode( rgpost('gform_uploaded_files'), ARRAY_A );
				$input_name = "input_{$field['id']}";
				if( is_array( $upload_files ) && array_key_exists( $input_name, $upload_files ) && !$upload_files[$input_name] )
					continue;

				// if $uploaded_files array is not set for this form at all, init as array
				if( !isset( RGFormsModel::$uploaded_files[$form['id']] ) )
					RGFormsModel::$uploaded_files[$form['id']] = array();

				// check if this field's key has been set in the $uploaded_files array, if not add this file (otherwise, a new image may have been uploaded so don't overwrite)
				if( !isset( RGFormsModel::$uploaded_files[$form['id']]["input_{$field['id']}"] ) )
					RGFormsModel::$uploaded_files[$form['id']]["input_{$field['id']}"] = $path_info['basename'];

				break;

			case 'checkbox':

				$value = rgar($mapped_fields, $field['id']);

				$cb_values = array();

				if(is_array($value)) {
					$cb_values = $value;
				} else {
					$inputs = $field['inputs'];
					foreach($inputs as &$input) {
						$cb_values[] = rgar($mapped_fields, (string)$input['id']);
					}
					$field['inputs'] = $inputs;
				}

				$value = implode(',', $cb_values );

				break;

			case 'list':

				$value = maybe_unserialize(rgar($mapped_fields, $field['id']));
				$list_values = array();

				if(is_array($value)) {
					foreach($value as $vals) {
						if( ! is_array( $vals ) )
							$vals = array( $vals );
						$list_values = array_merge($list_values, array_values($vals));
					}
					$value = $list_values;
				}

				break;

			case 'date':
				$value = GFCommon::date_display( rgar($mapped_fields, $field['id']) , $field['dateFormat'], false);
				break;

			default:

				// handle complex fields
				$inputs = $field instanceof GF_Field ? $field->get_entry_inputs() : rgar( $field, 'inputs' );

				if(is_array($inputs)) {
				   foreach($inputs as &$input) {
						$filter_name = GFUser::prepopulate_input( $input['id'], rgar($mapped_fields, (string)$input['id']));
						$field['allowsPrepopulate'] = true;
						$input['name'] = $filter_name;
					}
					$field['inputs'] = $inputs;
				} else {

					$value = is_array(rgar($mapped_fields, $field['id'])) ? implode(',', rgar($mapped_fields, $field['id'])) : rgar($mapped_fields, $field['id']);

				}

			}

			if ( 'date' == $field['type'] && $is_new_term ) {
				$value = false;
			}

			if (rgblank($value)){
				continue;
			}

			// If the term date has already passed, no date fields should be changeable.
			/* if ( 'date' == $field->type && strtotime( $term_start_date ) < current_time( 'timestamp' ) ) {
				if ( is_numeric( strtotime( $term_start_date ) ) ) {
					$datepicker_ids[] = $field->id;
					$field->isRequired = false;
				}
			} else
			*/

			if ( 'date' == $field->type && strtotime( $value ) < current_time( 'timestamp' ) ) {
				if ( is_numeric( strtotime( $value ) ) ) {
					// If the term date has not passI ed, but the specific payment plan date has, it should not be changeable.
					$datepicker_ids[] = $field->id;
					$field->isRequired = false;
				}
			} else if ( strtotime( $term_start_date ) < current_time( 'timestamp' ) && 12 == $field->id ) {
				if ( is_numeric( strtotime( $term_start_date ) ) ) {
					$datepicker_ids[] = $field->id;
					$field->isRequired = false;
				}
			}

			$value                    = GFUser::maybe_get_category_id($field, $value);
			$filter_name              = GFUser::prepopulate_input($field['id'], $value);
			$field->allowsPrepopulate = true;
			$field->inputName         = $filter_name;

	}

	if ( ! empty( $datepicker_ids ) && ! $is_new_term ) {
		add_action( 'wp_footer', function () use ( $datepicker_ids ) {
		?>
		<script>
		jQuery( document ).ready( function( $ ) {
			var ids = <?php echo wp_json_encode( $datepicker_ids ); ?>;

			$( ids ).each( function( i,v ) {
				if ( 12 == v ) {
					$( 'input', '#input_6_12' ).attr( 'disabled', true );
				} else {
					$( 'input[name="input_' + v +'"]' ).datepicker( "option", { disabled: true } );
				}

			} );

			$( '#ui-datepicker-div:visible' ).hide();

			$( 'form#gform_6' ).submit( function() {
				$( 'input' ).attr( 'disabled', false );
			} );
		} );
		</script>
		<?php
		}, 999 );
	}

	return $form;
}

add_action( 'gform_pre_render', 'gb_prepopulate_treasurer_settings' );

function gb_set_email_to_address( $notification ) {

	if ( $notification['name'] == 'Confirmation of Payment' ) {
		$notification['to'] = wp_get_current_user()->user_email;
	}

	return $notification;
}

add_filter( 'gform_notification_7', 'gb_set_email_to_address', 10 );


function gb_send_attachment_to_admin( $notification, $form, $entry ) {
	$file = $entry[28];

	// Send a notification every time a file is uploaded, but never otherwise.
	if ( empty( $file ) ) {
		$notification['isActive'] = false;
		$notification['to'] = false;
	}

	$fileupload_fields = GFCommon::get_fields_by_type( $form, array( 'fileupload' ) );

	if ( ! is_array( $fileupload_fields ) ) {
		return $notification;
	}

	$attachments = array();
	$upload_root = RGFormsModel::get_upload_root();

	foreach( $fileupload_fields as $field ) {

		$url        = $entry[ $field['id'] ];
		$attachment = preg_replace( '|^(.*?)/gravity_forms/|', $upload_root, $url );

		if ( $attachment ) {
			$attachments[] = $attachment;
		}

	}

	$notification['attachments'] = $attachments;

	return $notification;
}

add_filter( 'gform_notification_6', 'gb_send_attachment_to_admin', 10, 3 );
add_filter( 'gform_notification_12', function( $n, $f, $l ) {
	return $n;
}, 10, 3 );

function gb_redirect_profile_updates( $confirmation ) {

	if ( gb_is_user_treasurer() ) {
		$confirmation = array( 'redirect' => home_url( 'treasurer-center/?#profile-panel' ) );
	}

	return $confirmation;
}

add_filter( 'gform_confirmation_5', 'gb_redirect_profile_updates', 10 );
add_filter( 'gform_confirmation_7', 'gb_redirect_profile_updates', 10 );

function gb_payment_plan_mapping( $user = false ) {
	$plan_map = array(
		'12.1' => array(
			'18'
		),
		'12.2' => array(
			'19', '17'
		),
		'12.3' => array(
			'16', '15', '24'
		),
		'12.4' => array(
			'23', '22', '21', '20'
		),
	);

	if ( $user ) {
		$semester = gb_get_current_semester( gb_get_organization_id( $user->ID ) );
	} else {
		$semester = gb_get_current_semester();
	}

	$plans = array();

	foreach ( $plan_map as $plan_option_key => $date_keys ) {

		if ( ! empty( $semester->{ $plan_option_key } ) ) {
			$plan = strtolower( $semester->{ $plan_option_key } );
			$plans[ $plan ] = array();

			foreach ( $date_keys as $key ) {
				$plans[ $plan ][] = $semester->{$key};
			}
		}
	}

	return $plans;
}

function gb_map_meta( $caps, $cap, $user_id ) {

	if ( ! did_action( 'init' ) ) {
		return $caps;
	}

	$tax = get_taxonomy( 'member_category' );

	if ( $cap !== 'edit_user' && $cap !== $tax->cap->assign_terms ) {
		return $caps;
	}

	remove_filter( 'map_meta_cap', 'gb_map_meta', 10 );

	$organization_id = gb_get_organization_id( get_current_user_id() );

	$members = get_users( array(
		'connected_type'  => 'many_members',
		'connected_items' => $organization_id,
		'fields'          => 'id'
	) );

	add_filter( 'map_meta_cap', 'gb_map_meta', 10, 3 );

	if ( in_array( $user_id, $members ) ) {
		$caps[] = 'edit_user';
		$caps[] = $tax->cap->assign_terms;
	}

	return $caps;

}

add_filter( 'map_meta_cap', 'gb_map_meta', 10, 3 );

/**
 * Removes payment plan from member profile once it's set for a member.
 *
 * @param [type] $form [description]
 */
function gb_member_profile_payment_plan_removal( $form ) {

	$plan  = gb_user_payment_plan();
	$plans = array_map( function( $var ) {
		return array( 'value' => ucwords( $var ), 'text' => ucwords( $var ) );
	}, array_keys( gb_payment_plan_mapping() ) );

	foreach ( $form['fields'] as &$field ) {

		if ( ( $field->id == 5 || $field->id == 8 ) && ! empty( $plan ) ) {
			$field->adminOnly = true;
		} else if ( $field->id == 8 ) {
			array_unshift( $plans, array( 'value' => 'Choose a Payment Plan', 'text' => 'Choose a Payment Plan' ) );
			$field->choices = $plans;
		}
	}

	return $form;
}

add_action( 'gform_pre_render_5', 'gb_member_profile_payment_plan_removal' );

function gb_filter_member_categories( $form ) {

	foreach ( $form['fields'] as &$field ) {
		if ( 'Member Category' === $field->label ) {
			foreach ( $field->choices as $index => $choice ) {
				if ( is_numeric( $choice['value'] ) ) {
					$org_id = get_term_meta( $choice['value'], 'organization_id', true );
					if ( $org_id != gb_get_member_organization()->ID ) {
						unset( $field->choices[ $index ] );
					}
				}
			}
		}
	}

	return $form;
}

add_action( 'gform_pre_render_8' , 'gb_filter_member_categories' );
add_action( 'gform_pre_render_12', 'gb_filter_member_categories' );

function gb_filter_member_payment_plans( $form ) {
	foreach ( $form['fields'] as &$field ) {
		if ( 'Payment Plan' === $field->label ) {
			foreach ( $field->choices as $index => $choice ) {

				if ( empty( $choice['value'] ) ) {
					continue;
				}

				$plans = array_map( 'strtolower', array_keys( gb_payment_plan_mapping() ) );

				if ( ! in_array( strtolower( $choice['value'] ), $plans ) ) {
					unset( $field->choices[ $index ] );
				}
			}
		}
	}
	return $form;
}

add_action( 'gform_pre_render_8' , 'gb_filter_member_payment_plans' );

function gb_payments_post_status(){

	register_post_status( 'paid', array(
		'label'                     => _x( 'Paid', 'post' ),
		'public'                    => true,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Paid <span class="count">(%s)</span>', 'Paid <span class="count">(%s)</span>' ),
	) );

	register_post_status( 'unpaid', array(
		'label'                     => _x( 'Unpaid', 'post' ),
		'public'                    => true,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Unpaid <span class="count">(%s)</span>', 'Unpaid <span class="count">(%s)</span>' ),
	) );
}

add_action( 'init', 'gb_payments_post_status' );

/**
 * Inserts payment entry, connecting them to semesters/members/organizations, after a payment is made.
 *
 * Payments have a payment_type taxonomy. Terms are either payment (a credit) or fees/dues (debits).
 *  - This API specifically handles payments, so the selected term will always be payment.
 *
 * Payments have statuses of unpaid/paid.
 *  - This API handles payments, so the specific status will always be paid.
 *  - For fees and dues, they are entered as unpaid. When a payment against them is made, they are marked paid.
 *
 * In addition, payments have metadata of when it was added, when it was paid, how much was paid in fees and when it is due.
 * - Date added        - post_date
 * - When it was paid  - 'paid_date' - in this case, same as above
 * - Due Date          - 'due_date'  - in this case, empty
 * - Total amount      - 'total_amount'
 * - Fees amount       - 'fees_amount'
 *
 * With all of this relational data, we have enough information to build the rest of our financial panel
 * showing the status of payments paid, membership health, etc.
 *
 * @param array $entry The Entry Object
 * @param array $action The Action Object
 *
 * $action = array(
 *     'type' => 'complete_payment',
 *     'transaction_id' => '',              // What is the ID of the transaction made?
 *     'amount' => '0.00',                  // Amount to charge?
 *     'entry_id' => 1,                     // What entry to check?
 *     'transaction_type' => '',
 *     'payment_status' => '',
 *     'note' => ''
 * );
 *
 * @return boolean True if payment insertion was successful, false if not.
 */

function gb_insert_payment( $entry, $action ) {

	$total_amount = rgar( $entry, '2' );
	$processed    = rgar( $entry, 'payment_amount' );
	$total_fees   = $processed - $total_amount;

	$payment_id   = gb_insert_transaction(
		array(
			'description' => 'Payment ID: ' . $action['transaction_id'],
			'amount'      => $total_amount,
			'due_date'    => false,
			'paid_date'   => current_time( 'mysql' )
		)
	);

	return $payment_id;
}

/**
 * Inserts payment entry, connecting them to semesters/members/organizations, after a payment is made.
 *
 * Payments have a payment_type taxonomy. Terms are either payment (a credit) or fees/dues (debits).
 *
 * Payments have statuses of unpaid/paid.
 *  - For fees and dues, they are entered as unpaid. When a payment against them is made, they are marked paid.
 *
 * In addition, payments have metadata of when it was added, when it was paid, how much was paid in fees and when it is due.
 * - Date added        - post_date
 * - When it was paid  - 'paid_date'
 * - Due Date          - 'due_date'
 * - Total amount      - 'total_amount'
 * - Fees amount       - 'fees_amount'
 *
 * With all of this relational data, we have enough information to build the rest of our financial panel
 * showing the status of payments paid, membership health, etc.
 *
 * @param array $args Arguments passed
 *
 * @return boolean True if payment insertion was successful, false if not.
 */
function gb_insert_transaction( $args ) {

	$args = wp_parse_args( $args, array(
		'type'        => 'payment',
		'status'      => 'paid',
		'description' => 'Payment',
		'amount'      => 0,
		'due_date'    => date( 'Y-m-d H:i:s' ),
		'paid_date'   => false,
		'member_id'   => get_current_user_id(),
		'org_id'      => false,
		'semester_id' => false,
	) );
	trigger_error( __FUNCTION__ . ' : ' . var_export($args, 1 ) );

	if ( ! $args['org_id'] ) {
		$args['org_id'] = gb_get_organization_id( $args['member_id'] );
	}

	if ( ! $args['semester_id'] ) {
		$args['semester_id'] = gb_get_current_semester( $args['org_id'] )->ID;
	}

	$payment_id = wp_insert_post( array(
		'post_status' => $args['status'],
		'post_title'  => $args['description'],
		'post_type'   => 'payment'
	) );

	wp_set_object_terms( $payment_id, $args['type'], 'payment_type' );

	update_post_meta( $payment_id, 'paid_date'   , strtotime( $args['paid_date'] ) );
	update_post_meta( $payment_id, 'due_date'    , strtotime( $args['due_date']  ) );
	update_post_meta( $payment_id, 'total_amount', $args['amount']    );

	gb_connect_payment_to_member(       $payment_id , $args['member_id']   );
	gb_connect_payment_to_semester(     $payment_id , $args['semester_id'] );
	gb_connect_payment_to_organization( $payment_id , $args['org_id']      );

	return $payment_id;
}

add_action( 'gform_post_payment_completed', 'gb_insert_payment', 10, 2 );

function gb_set_up_cron() {

	if ( ! wp_next_scheduled( 'gb_upcoming_payment_due' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), 'twicedaily', 'gb_upcoming_payment_due' );
	}

	if ( ! wp_next_scheduled( 'gb_missed_payment' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), 'twicedaily', 'gb_missed_payment' );
	}

	if ( ! wp_next_scheduled( 'gb_monthly_summary' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), 'twicedaily', 'gb_monthly_summary' );
	}

	if ( ! wp_next_scheduled( 'gb_late_fees' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), 'twicedaily', 'gb_late_fees' );
	}
}

add_action( 'wp', 'gb_set_up_cron' );

function get_member_overdue_balance( $member = false, $format = true, $fees = true ) {

	if ( ! $member ) {
		$member = wp_get_current_user();
	}


	$date  = date( 'Y-m-d', strtotime( get_member_due_date( $member ) ) );
	$dates = gb_get_member_payment_plans( $member );
	$last_due_date = end( $dates );

	if( current_time( 'timestamp' ) > strtotime( $last_due_date) ){
	    $date = $last_due_date;
	}

	if ( is_null( $dates ) ) {
		return 0.00;
	}

	$due = array_search( $date, $dates );

	if( current_time( 'timestamp' ) > strtotime( $last_due_date) ){
		$due = $due + 1;
	}

	$plans = gb_get_member_payment_plans( $member );

    if ( ! count( $plans ) ) {
        return false;
    }

    $percent_due  = $due / count( $plans );

    // Get initial amount due from Member Category (divided by amount currently due)
	$amount = gb_get_member_dues( $member ) * $percent_due;

	/* In some cases, we don't want to get the fees - we only want the past dues. */
	if ( $fees ) {
		// Add all unpaid fees that are due by yesterday
		$amount += get_member_amount_paid( $member, false, array(
				'payment_type' => 'fees',
				'post_status'  => 'unpaid',
				'meta_compare' => '<=',
				'meta_key'    => 'due_date',
				'meta_value'  => strtotime( '23:59:59 -1 day', current_time( 'timestamp' ) )
			)
		);
	}
	// Add all unpaid dues (after dividing)
	$amount += ( get_member_amount_paid( $member, false, array(
		'payment_type' => 'dues',
		'post_status' => 'unpaid'
		)
	) * $percent_due );

	// Subtract all payments made
	$amount -= get_member_amount_paid( $member, false );

	$amount = $amount < 0 ? 0.00 : $amount;

	if ( $format ) {
			return number_format( $amount, 2, '.', '' );
		} else {
			return $amount;
		}

}

/**
 * Slightly different than get_member_remaining_balance
 * While the former gets the remaining balance for the semester, this function gets
 * only the overdue balance
 *
 * @param  [type] $member [description]
 * @return [type]         [description]
 */
function get_member_overdue_balance_disabled( $member = false, $format = true, $fees = true ) {

	if ( ! $member ) {
		$member = wp_get_current_user();
	}

	$date  = date( 'Y-m-d', strtotime( get_member_due_date() ) );
	$dates = gb_get_member_payment_plans();

	if ( is_null( $dates ) ) {
		return 0.00;
	}

	$due = array_search( $date, $dates ) + 1;

	if ( ! ( $count = count( $dates ) ) ) {
		return 0.00;
	}

	$percent_due = $due / count( $count );

	// Get initial amount due from Member Category (divided by amount currently due)
	$amount = gb_get_member_dues( $member ) * $percent_due;

	/* In some cases, we don't want to get the fees - we only want the past dues. */
	if ( $fees ) {
		// Add all unpaid fees that are due by yesterday
		$amount += get_member_amount_paid( $member, false, array(
				'payment_type' => 'fees',
				'post_status'  => 'unpaid',
				'meta_query'   => array(
					array(
						'meta_key'   => 'due_date',
						'meta_value' => strtotime( '23:59:59 -1 day', current_time( 'timestamp' ) ),
						'compare'    => '<=',
						'type'    => 'NUMERIC',
				 	)
				)
			)
		);
	}

	// Add all unpaid dues (after dividing)
	$amount += ( get_member_amount_paid( $member, false, array(
		'payment_type' => 'dues',
		'post_status' => 'unpaid'
		)
	) * $percent_due );

	// Subtract all payments made
	$amount -= get_member_amount_paid( $member, false );

	$amount = $amount < 0 ? 0.00 : $amount;

	if ( $format ) {
		return number_format( $amount, 2, '.', '' );
	} else {
		return $amount;
	}

}

/**
 * Slightly different than get_member_remaining_balance
 * While the former gets the remaining balance for the semester, this function gets
 * the current balance due, which only includes the amount due through the next payment date.
 *
 * @param  [type] $member [description]
 * @return [type]         [description]
 */
function get_member_current_balance_disabled( $member = false, $format = true ) {

	if ( ! $member ) {
		$member = wp_get_current_user();
	}


	$date  = date( 'Y-m-d', strtotime( get_member_due_date() ) );
	$dates = gb_get_member_payment_plans();

	if ( is_null( $dates ) ) {
		return 0.00;
	}

	$due = array_search( $date, $dates );

	$plans = gb_get_member_payment_plans( $member );

    if ( ! count( $plans ) ) {
        return false;
    }

    $percent_due  = $due / count( $plans );

	// Get initial amount due from Member Category (divided by amount currently due)
	$amount = gb_get_member_dues( $member ) * $percent_due;

	// Add all unpaid fees that are due by yesterday
	$amount += get_member_amount_paid( $member, false, array(
			'payment_type' => 'fees',
			'post_status'  => 'unpaid',
			'meta_query'   => array(
				array(
					'meta_key'   => 'due_date',
					'meta_value' => strtotime( $date ),
					'compare'    => '<=',
			 	)
			)
		)
	);

	// Add all unpaid dues (after dividing)
	$amount += ( get_member_amount_paid( $member, false, array(
		'payment_type' => 'dues',
		'post_status' => 'unpaid'
		)
	) * $percent_due );

	// Subtract all payments made
	$amount -= get_member_amount_paid( $member, false );

	$amount = $amount < 0 ? 0.00 : $amount;

	if ( $format ) {
		return number_format( $amount, 2, '.', '' );
	} else {
		return $amount;
	}
}

function gb_get_next_payment_amount( $member = false ) {

	if ( ! $member ) {
		$member = wp_get_current_user();
	}

	$paid         = get_member_amount_paid( $member, false );
	$initial_dues = gb_get_member_dues( $member );
	$dates = gb_get_member_payment_plans( $member );
	$last_due_date = end( $dates );

	if ( $initial_dues <= $paid ) {
		return false;
	}

	$plans = gb_get_member_payment_plans( $member );

	if ( ! count( $plans ) ) {
		return false;
	}

	if( current_time( 'timestamp' ) > strtotime( $last_due_date) ) {
		return 0.00;
	}

	$dues  = $initial_dues / count( $plans );

	return $dues;
}

function get_member_current_balance( $member = false, $format = true ) {

	if ( ! $member ) {
		$member = wp_get_current_user();
	}

	$date  = date( 'Y-m-d', strtotime( get_member_due_date( $member) ) );

	if ( get_member_overdue_balance( $member ) > 0.01 ) {

		$amount = gb_get_next_payment_amount( $member );

		// Add all unpaid fees that are due by yesterday
		$amount += get_member_amount_paid( $member, false, array(
				'payment_type' => 'fees',
				'post_status'  => 'unpaid',
				'meta_query'   => array(
					array(
						'meta_key'   => 'due_date',
						'meta_value' => strtotime( $date ),
						'compare'    => '<='
				 	)
				)
			)
		);

		$amount = $amount < 0 ? 0.00 : $amount;

	} else {

		$amount = gb_get_next_payment_amount( $member );

		// Add all unpaid fees that are due by yesterday
		$amount += get_member_amount_paid( $member, false, array(
				'payment_type' => 'fees',
				'post_status'  => 'unpaid',
				'meta_query'   => array(
					array(
						'meta_key'   => 'due_date',
						'meta_value' => strtotime( $date ),
						'compare'    => '<='
				 	)
				)
			)
		);

		// Add all unpaid dues (after dividing)
		$amount += ( get_member_amount_paid( $member, false, array(
			'payment_type' => 'dues',
			'post_status' => 'unpaid'
			)
		) );

		// Subtract all payments made
		$amount -= get_member_amount_paid( $member, false );

		$amount = $amount < 0 ? 0.00 : $amount;

	}

	if ( $format ) {
		return number_format( $amount, 2, '.', '' );
	} else {
		return $amount;
	}
}

function get_recent_payments_view( $member = false ) {

	if ( ! $member ) {
		$member = wp_get_current_user();
	}

	$dues = gb_get_next_payment_amount( $member );

	if ( ! $dues ) {
		return;
	}

	$payments = gb_get_member_payments( $member->ID, array( 'nopaging' => false, 'posts_per_page' => 1, 'payment_type' => 'payment', 'post_status' => 'paid' ) );

	$payment = array_pop( $payments );

		if ( $payment ) :
?>
		<p>Previous payment was on <span class=""><?php echo date( 'M j', strtotime( $payment->post_date ) ); ?></span> for <span>$<?php echo number_format( $payment->total_amount, 2, '.', '' ); ?></span>.</p>
		<?php endif; ?>
		<p>Next payment is on <span><?php echo get_member_due_date( $member ); ?></span> for <span>$<?php echo number_format( $dues, 2, '.', '' ); ?></span>.</p>
	<?php
}

function gb_download_payments_csv() {
	if ( isset( $_GET['generate_payments'] ) && $_GET['generate_payments'] == 'true' && current_user_can( 'manage_organization' ) ) {

		gb_download_send_headers( 'payment_export_' . date( 'Y-m-d' ) . '.csv' );

		echo gb_export_payments( gb_get_organization_payments() );
		die();
	}
}

add_action( 'template_redirect', 'gb_download_payments_csv', 50 );

function gb_export_payments( array $payments ) {

	if ( count( $payments ) == 0 ) {
		return null;
	}

	ob_start();

	$df = fopen( "php://output", 'w' );

	fputcsv( $df, array_keys( reset( $payments ) ) );

	foreach ( $payments as $row ) {
		fputcsv( $df, $row );
	}

	fclose( $df );

	return ob_get_clean();
}

function gb_download_send_headers( $filename ) {
	// disable caching
	$now = gmdate("D, d M Y H:i:s");
	header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
	header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
	header("Last-Modified: {$now} GMT");

	// force download
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");

	// disposition / encoding on response body
	header("Content-Disposition: attachment;filename={$filename}");
	header("Content-Transfer-Encoding: binary");
}

function gb_get_organization_payments( $org_id = false ) {

	if ( ! $org_id ) {
		$org_id = gb_get_organization_id( get_current_user_id() );
	}

	$args = array(
		'connected_type'  => 'payments_to_organization',
		'connected_items' => $org_id,
		'nopaging'        => true,
	);

	$payments = new WP_Query( $args );

	$payment_objects = $payments->have_posts() ? $payments->posts : array();

	$payments = array();

	foreach ( $payment_objects as $payment ) {

		$payer = get_users( array(
			'connected_type'  => 'payments_to_user',
			'connected_items' => $payment->ID,
			'fields'          => 'id'
		) );

		$payer = array_pop( $payer );
		$payer = new WP_User( $payer );

		$payments[] = array(
			'Member Name'  => $payer->display_name,
			'Payment Date' => $payment->post_date,
			'Amount'       => $payment->total_amount,
			'Description'  => $payment->post_title
		);
	}

	return $payments;
}

/**
 * Sends upcoming payment emails to all users who have payments due in the near future
 *
 * @return [type] [description]
 */
function gb_send_upcoming_payment_due_email() {

	// Loop through all members
	$members   = get_users( array( 'role' => 'Member' ) );
	$five_days = strtotime( '+5 days', current_time( 'timestamp') );

	// Determine if next due date is within the next five days AND if an email has been sent for that date.
	foreach ( $members as $member ) {

		// If the member is paid up, early exit.
		$balance = get_member_current_balance( $member, false );

		if ( ! $balance ) {
			continue;
		}

		$next_due_date = get_member_due_date( $member );
		$due_date = strtotime( $next_due_date );

		// If there is no upcoming due date - either all in the past, or more than five days out.
		if ( ! $next_due_date || ( $due_date > $five_days ) ) {
			continue;
		}

		// send email if w/in 5 days

		if ( ! $member->{"upcoming_reminder_for_{$due_date}_sent"} ) {
			$mail = gb_send_email( 'upcoming-payment', $member, 'Upcoming Payment Information' );

			if ( $mail ) {
				update_user_meta( $member->ID, "upcoming_reminder_for_{$due_date}_sent", 'sent' );
			}
		}
	}
}

add_action( 'gb_upcoming_payment_due', 'gb_send_upcoming_payment_due_email' );

/**
 * Sends missed payment emails the day after they're missed.
 * @return [type] [description]
 */
function gb_send_missed_payment_email() {

	// Loop through all members
	$members   = get_users( array( 'role' => 'Member' ) );

	// Determine if next due date is within the next five days AND if an email has been sent for that date.
	foreach ( $members as $member ) {

		// If the member is paid up, early exit.
		$balance = get_member_overdue_balance( $member, false );

		if ( ! $balance ) {
			continue;
		}

		$recently_sent = $member->recently_sent_missed_payment_email;

		if ( $recently_sent && current_time( 'timestamp' ) < strtotime( '+3 days', $recently_sent ) ) {
			continue;
		}

		$append = var_export( array(
			'balance'       => $balance,
			'recently_sent' => $recently_sent,
			'current_time'  => current_time( 'timestamp' ),
			'three_days'    => strtotime( '+3 days', $recently_sent )
		), 1 );

		$mail = gb_send_email( 'missed-payment', $member, 'Missed Payment', $append );

		if ( $mail ) {
			update_user_meta( $member->ID, 'recently_sent_missed_payment_email', current_time( 'timestamp' ) );
		}
	}

}

add_action( 'gb_missed_payment', 'gb_send_missed_payment_email' );

function gb_send_monthly_summary_email() {

	$treasurers     = get_users( array( 'role' => 'Treasurer' ) );
	$after_the_25th = date( 'j' ) >= 25;

	if ( ! $after_the_25th ) {
		return false;
	}

	$this_month = date( 'MY' );

	foreach ( $treasurers as $member ) {

		$sent_this_month = get_user_meta( $member->ID, "summary_email_for_{$this_month}", true );

		if ( $sent_this_month ) {
			continue;
		}

		$mail = gb_send_email( 'monthly-summary', $member, 'Monthly Payment Report' );

		if ( $mail ) {
			update_user_meta( $member->ID, "summary_email_for_{$this_month}", current_time( 'timestamp' ) );
		}
	}
}

add_action( 'gb_monthly_summary', 'gb_send_monthly_summary_email' );

function gb_email_new_member( $args )  {
	$form         = GFAPI::get_form( 12 );
	$notification = end( $form['notifications'] );
	$lead         = array(
		'id'         => wp_generate_password( 64, true, true ),
		'form_id'    => '12',
		'source_url' => 'https://greekbank.org/treasurer-center/',
		'status'     => 'active',
		'1.3'        => $args['first_name'],
		'1.6'        => $args['last_name'],
		'2'          => $args['user_email'],
		'4'          => $args['term_id'],
		'5'          => $args['user_pass'],
		'1.2'        => '',
		'1.4'        => '',
		'1.8'        => ''
	);

	GFCommon::send_notification( $notification, $form, $lead );
}

/**
 * Adds member to organization
 * Called via AJAX and via CSV import
 *
 * @return [type] [description]
 */
function gb_add_member( $member ) {
	$has_dues = count( $member ) > 3;

	$first_name = $member[0];
	$last_name  = $member[1];
	$email      = $member[2];

	if ( $has_dues ) {
		$category = sanitize_title( $member[3] );
		$dues     = floatval( $member[4] );
	}
	$args = array(
			'user_login' => sanitize_email( $email ),
			'user_email' => sanitize_email( $email ),
			'user_pass'  => wp_generate_password( 32, true, true ),
			'role'       => 'member',
			'first_name' => sanitize_text_field( $first_name ),
			'last_name'  => sanitize_text_field( $last_name ),
	);

	$user_id = wp_insert_user( $args );

	if ( is_wp_error( $user_id ) ) {
		return;
	}

	$organization = gb_get_member_organization();

	gb_connect_member_to_organization( $user_id, $organization->ID );

	gb_email_new_member( $args );

	if ( $has_dues ) {

		$_category = get_term_by( 'slug', sanitize_title( $member[3] ) . '_' . $organization->ID, 'member_category' );

		if ( ! $_category ) {
			$_category = wp_insert_term( $member[3], 'member_category', array( 'slug' => $member[3] . '_' . $organization->ID ) );

			if ( ! is_wp_error( $_category ) ) {
				update_term_meta( $_category['term_id'], 'due_amount', $dues );
				update_term_meta( $_category['term_id'], 'organization_id', $organization->ID );
			} else {
				return;
			}

			$_category = get_term_by( 'id', $_category['term_id'], 'member_category' );
		}
		$args['term_id'] = $_category->term_id;

		wp_set_terms_for_user( $user_id, 'member_category', array( $_category->slug ) );
	}
}

function gb_import_members( $form ) {

	$upload = new GF_Field_FileUpload();
	$file_info = $upload->get_single_file_value( '6', 'input_28' );

	$value = str_replace( home_url(), untrailingslashit( ABSPATH ), set_url_scheme( $file_info, 'https' ) );

	if ( empty( $value ) ) {
		return;
	}

	if ( 'csv' !== pathinfo( $value, PATHINFO_EXTENSION ) ) {
		return;
	}

	$members = gb_csv_to_array( $value );

	// necessary if a large csv file
	set_time_limit( 0 );

	foreach ( $members as $member ) {

		$member = array_values( $member );

		if ( 'first name' == strtolower( $member[0] ) ) {
			continue;
		}

		$member = array_filter( $member );

		gb_add_member( $member );

	}
}

function gb_csv_to_array($filename='', $delimiter=',') {

    ini_set('auto_detect_line_endings',true );
    if(!file_exists($filename) || !is_readable($filename))
        return $filename . ' is not readable';

    $header = null ;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false )
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false )
        {
            if (!$header) {
                $header = $row;
            }
            else {
                if (count($header) > count($row)) {
                    $difference = count($header) - count($row);
                    for ($i = 1; $i <= $difference; $i++) {
                        $row[count($row) + 1] = $delimiter;
                    }
                }
                $data[] = array_combine($header, $row);
            }
        }
        fclose($handle);
    }
    return $data;
}

add_action( 'gform_after_submission_6', 'gb_import_members', 99 );

/**
 * When new semester is created via new_term qv, do the following:
 * - connect new semester to existing semester's organization and all members/treasurer
 * - confirm all meta is pre-set, except for dates.
 * - confirm that all existing unpaid fees are migrated and past due
 * - generate new dues.
 *
 * @return [type] [description]
 */
function gb_create_new_semseter( $entry, $form ) {

	if ( ! ( isset( $_GET['new-term'] ) && 'true' == $_GET['new-term'] ) ) {
		return;
	}

	// Create new semester and connect new semester to existing organization
	$treasurer_id    = get_current_user_id();
	$organization_id = gb_get_organization_id( $treasurer_id );
	$semester_id     = gb_create_semester_for_organization( $organization_id );

	// Generate new dues
	$members = get_users( array(
		'connected_type'  => 'many_members',
		'connected_items' => $organization_id,
	) );

	$args = array(
		'status'      => 'unpaid',
		'description' => 'New Semester Dues',
		'type'        => 'dues',
		'due_date'    => strtotime( $_POST['input_4'] )
	);

	foreach ( $members as $member ) {
		gb_connect_semester_to_member( $semester_id, $member->ID );

		$args['member_id'] = $member->ID;
		$args['amount']    = gb_get_member_dues( $member );

		$dues = gb_insert_transaction( $args );

		$overdue = get_member_overdue_balance( $member, false, false );

		if ( $overdue > 0 ) {
			$new_args = $args;

			$new_args['amount']      = get_member_overdue_balance( $member, false, false );
			$new_args['description'] = 'Past Dues from Previous Semester';
			$new_args['due_date']    = $five_days = strtotime( '-2 days', current_time( 'timestamp' ) );

			$dues_id = gb_insert_transaction( $new_args );
		}
	}
}

add_action( 'gform_after_submission_6', 'gb_create_new_semseter', 8, 2 );

function gb_remove_admin_bar() {
	if ( ! current_user_can( 'manage_options' ) ) {
		show_admin_bar( false );
	}
}

add_action( 'after_setup_theme', 'gb_remove_admin_bar' );

/**
 * Applies late fees
 *
 * @return [type] [description]
 */
function gb_apply_late_fees() {

	// Loop through all members
	$members   = get_users( array( 'role' => 'Member' ) );

	foreach ( $members as $member ) {
		trigger_error( __FUNCTION__ . ' : ' . var_export($member, 1 ) );

		$org_id = gb_get_member_organization( $member->ID )->ID;

		$fees = gb_has_fees( $org_id );
		trigger_error( __FUNCTION__ . ' : ' . var_export($fees, 1 ) );

		if ( ! $fees ) {
			trigger_error( 'organization apparently has no fees in their settings' );
			continue;
		}

		// If the member is paid up, early exit.
		$balance = get_member_overdue_balance( $member, false );

		trigger_error( __FUNCTION__ . ' : ' . var_export($balance, 1 ) );

		if ( $balance > 0 ) {
			continue;
		}

		$days_late = gb_get_current_semester( $org_id )->{'10'};
		trigger_error( __FUNCTION__ . ' : ' . var_export($days_late, 1 ) );
		$due_date  = get_member_recent_past_due_date( $member );
		trigger_error( __FUNCTION__ . ' : ' . var_export($due_date, 1 ) );

		//If a due date has not come and gone, exit
		if( $due_date == false ) {
			exit;
		}

		// If we're not currently outside of the "Days Late" threshold, continue
		if ( current_time( 'timestamp' ) < strtotime( '+ ' . $days_late . ' days', strtotime( $due_date ) ) ) {
			continue;
		}

		$fee = gb_get_current_semester( $org_id )->{'11'};

		$sanitized_due_date = sanitize_title( $due_date );

		trigger_error( __FUNCTION__ . ' : ' . var_export($sanitized_due_date, 1 ) );

		// If we've already charged a late fee for this date, continue.
		if ( $member->{"charged_late_fee_for_$sanitized_due_date"} ) {
			continue;
		}

		$args = array(
			'type'        => 'fees',
			'status'      => 'unpaid',
			'description' => 'Late Fee',
			'amount'      => $fee,
			'member_id'   => $member->ID,
		);

		// Now, we're safely able to charge a late fee
		$fees_id = gb_insert_transaction( $args );

		trigger_error( __FUNCTION__ . ' : ' . var_export($fees_id, 1 ) );

		if ( $fees_id ) {
			update_user_meta( $member->ID, "charged_late_fee_for_$sanitized_due_date", current_time( 'timestamp' ) );
		}
	}
}

add_action( 'gb_late_fees', 'gb_apply_late_fees' );


function _get_members( $org ) {
	static $members = array();

	if ( ! $org ) {
		$organization_id = gb_get_organization_id( get_current_user_id() );
	} else {
		if ( is_object ( $org ) ) {
			$organization_id = $org->ID;
		} else {
			$organization_id = $org;
		}
	}

	if ( empty( $members[ $organization_id ] ) ) {

		$members[ $organization_id ] = get_users( array(
			'connected_type'  => 'many_members',
			'connected_items' => $organization_id,
		) );

	}

	return $members[ $organization_id ];
}
/**
 * Total amount due this month that is not currently paid.
 * @return [type] [description]
 */
function gb_current_month_amount_due( $org = false ) {

	$members = _get_members( $org );

	$current_due = 0;

	$formatter = new NumberFormatter( 'en_US', NumberFormatter::DECIMAL );
	$currency = 'USD';

	foreach ( $members as $member ) {
		$current_due += $formatter->parseCurrency( get_member_current_balance( $member ), $currency );
	}

	return $current_due;
}

/**
 * Total amount due this term that is not currently paid.
 * @return [type] [description]
 */
function gb_current_term_amount_due( $organization = false  ) {

	$members = _get_members( $organization );

	$current_due = 0;

	$formatter = new NumberFormatter( 'en_US', NumberFormatter::DECIMAL );
	$currency = 'USD';

	foreach ( $members as $member ) {
		$current_due += $formatter->parseCurrency( get_member_remaining_balance( $member ), $currency );
	}

	return $current_due;
}

/**
 * The total amount currently past due, as of this month.
 *
 * @return [type] [description]
 */
function gb_current_month_amount_past_due( $type = 'all', $org = false ) {

	$members = _get_members( $org );

	$past_due = 0;

	$formatter = new NumberFormatter( 'en_US', NumberFormatter::DECIMAL );
	$currency = 'USD';

	foreach ( $members as $member ) {
		$past_due += $formatter->parseCurrency( get_member_overdue_balance( $member ), $currency );
	}

	return $past_due;
}

/**
 * The total amount of payments received in the current month.
 * Defaults to all payments, but can be limited to just fees, or just dues.
 *
 * @param  string $payment_type [description]
 * @return [type]               [description]
 */
function gb_current_month_amount_paid( $payment_type = 'all', $organization = false ) {

	$members = _get_members( $organization );

	$paid = 0;

	$formatter = new NumberFormatter( 'en_US', NumberFormatter::DECIMAL );
	$currency = 'USD';

	// Potential todo: add meta_query boundary for semester start date
	$payment_args = array();

	if ( 'fees' == $payment_type ) {
		$payment_args['payment_type'] = 'fees';
	} else if ( 'dues' == $payment_type ) {
		$payment_args['payment_type'] = 'dues';
	}

	foreach ( $members as $member ) {
		$paid += $formatter->parseCurrency( get_member_amount_paid( $member, false, $payment_args ), $currency );
	}

	return $paid;
}

/**
 * Total amount of dues this term.
 * @return [type] [description]
 */
function gb_term_total_dues( $organization = false  ) {

	$members = _get_members( $organization );

	$total_dues = 0;

	$formatter = new NumberFormatter( 'en_US', NumberFormatter::DECIMAL );
	$currency = 'USD';

	foreach ( $members as $member ) {
		$total_dues += $formatter->parseCurrency( gb_get_member_dues( $member ), $currency );
	}

	return $total_dues;
}


function gb_payment_modal_payment_options() {
	$today     = date( 'm/d/Y' );

	$due_dates = gb_due_dates();
	$due_date  = array_pop( $due_dates );

	$last_date = date( 'm/d/Y', strtotime( $due_date['date'] ) );
?>
	<?php if ( 0.00 != get_member_overdue_balance() ) : ?>
	<label class="payment-plan-option">
		<input type="radio" name="_amount" data-amount="<?php echo get_member_overdue_balance( false, false ); ?>" /> Past Due: <strong>$<?php echo get_member_overdue_balance(); ?></strong>
	</label>
	<?php endif; ?>
	<label class="payment-plan-option">
		<input type="radio" name="_amount" data-amount="<?php echo get_member_current_balance( false, false ); ?>" /> Current Due as of <?php echo $today; ?>: <strong>$<?php echo get_member_current_balance(); ?></strong>
	</label>
	<label class="payment-plan-option">
		<input type="radio" name="_amount" data-amount="<?php echo get_member_remaining_balance( false, false ); ?>" /> Total Due <?php echo $last_date; ?>: <strong>$<?php echo get_member_remaining_balance(); ?></strong>
	</label>
	<label class="payment-plan-option custom-amount">
		<input type="radio" name="_amount" /> Other Amount
	</label>

	<div id="surcharge" style="display: none; padding-bottom: 20px">
		  Total Charge:<br />
		  <em class="base-amount"></em> + <em class="surcharge"></em> surcharge = <strong class="total-charge"></strong>
	</div>
<?php
}

class GWRequireListColumns {

    private $field_ids;

    public static $fields_with_req_cols = array();

    function __construct($form_id = '', $field_ids = array(), $required_cols = array()) {

        $this->field_ids = ! is_array( $field_ids ) ? array( $field_ids ) : $field_ids;
        $this->required_cols = ! is_array( $required_cols ) ? array( $required_cols ) : $required_cols;

        if( ! empty( $this->required_cols ) ) {

            // convert values from 1-based index to 0-based index, allows users to enter "1" for column "0"
            $this->required_cols = array_map( create_function( '$val', 'return $val - 1;' ), $this->required_cols );

            if( ! isset( self::$fields_with_req_cols[$form_id] ) )
                self::$fields_with_req_cols[$form_id] = array();

            // keep track of which forms/fields have special require columns so we can still apply GWRequireListColumns
            // to all list fields and then override with require columns for specific fields as well
            self::$fields_with_req_cols[$form_id] = array_merge( self::$fields_with_req_cols[$form_id], $this->field_ids );

        }

        $form_filter = $form_id ? "_{$form_id}" : $form_id;
        add_filter("gform_validation{$form_filter}", array(&$this, 'require_list_columns'));

    }

    function require_list_columns($validation_result) {

        $form = $validation_result['form'];
        $new_validation_error = false;

        foreach($form['fields'] as &$field) {

            if(!$this->is_applicable_field($field, $form))
                continue;

            $values = rgpost("input_{$field['id']}");

            // If we got specific fields, loop through those only
            if( count( $this->required_cols ) ) {

                $rows = $this->convert_values_to_rows( $values, $field );

                foreach( $rows as $row ) {
                    foreach($this->required_cols as $required_col) {
                        if(empty($row[$required_col])) {
                            $new_validation_error = true;
                            $field['failed_validation'] = true;
                            $field['validation_message'] = $field['errorMessage'] ? $field['errorMessage'] : 'All inputs must be filled out.';
                        }
                    }
                }

            } else {

                // skip fields that have req cols specified by another GWRequireListColumns instance
                $fields_with_req_cols = rgar( self::$fields_with_req_cols, $form['id'] );
                if( is_array( $fields_with_req_cols ) && in_array( $field['id'], $fields_with_req_cols ) )
                    continue;

                foreach($values as $value) {
                    if(empty($value)) {
                        $new_validation_error = true;
                        $field['failed_validation'] = true;
                        $field['validation_message'] = $field['errorMessage'] ? $field['errorMessage'] : 'All inputs must be filled out.';
                    }
                }

            }
        }

        $validation_result['form'] = $form;
        $validation_result['is_valid'] = $new_validation_error ? false : $validation_result['is_valid'];

        return $validation_result;
    }

    function is_applicable_field($field, $form) {

        if($field['pageNumber'] != GFFormDisplay::get_source_page($form['id']))
            return false;

        if( GFFormsModel::get_input_type( $field ) != 'list' || RGFormsModel::is_field_hidden($form, $field, array()))
            return false;

        // if the field has already failed validation, we don't need to fail it again
        if(!$field['isRequired'] || $field['failed_validation'])
            return false;

        if(empty($this->field_ids))
            return true;

        return in_array($field['id'], $this->field_ids);
    }

    function convert_values_to_rows( $values, $field ) {

        $column_count = count( $field['choices'] );
        $rows         = array();

        while( count( $values ) > 0 ) {
            $rows[] = array_splice( $values, 0, $column_count );
        }

        return $rows;
    }

}

new GWRequireListColumns(9);

function gb_prevent_add_term( $term, $taxonomy ) {

	if ( $term === 'dues' && 'payment_type' == $taxonomy ) {
		$term = new WP_Error( 'invalid_term', 'You are attempting to insert "dues" as a payment type. No bueno.' );
	}

	return $term;
}
add_filter( 'pre_insert_term', 'gb_prevent_add_term', 20, 2 );


////////  DONE
////////  DONE
////////  DONE

/**
 * Gets number of members who have payments that are in specific stages of delinquency.
 *
 * @param  string $delinquency [description]
 * @return [type]              [description]
 */
function gb_members_by_status( $delinquency = 'current', $org = false ) {
	if ( 'current' == $delinquency ) {
		return 50;
	} else if ( 'thirty_days_late' == $delinquency ) {
		return 100;
	} else if ( 'sixty_days_late' == $delinquency ) {
		return 300;
	} else {
		return 10; //more_than_sixty
	}
}

function get_member_days_over_due( $user ) {
	$past_due_date = strtotime( get_member_recent_past_due_date( $user ) );
	$today = current_time('timestamp');

	$diff = $today - $past_due_date;

	$days = floor($diff / (60*60*24));

	if( $days > 700 ){
		echo 'There is a problem with your account.';
	} else {
		return $days;
	}
}

function __old_csv_upload_description() {
	?>
CSV files are automatically uploaded in the member roster.  For it to work right, please submit either of these two formats with the following Headers: <br>
- First name, Last Name, Email<br>
- First name, Last Name, Email, Member Category, Due Amount for Term<br>
<strong>Do NOT submit a member category without a due amount</strong>
	<?php
}

if ( !function_exists('set_magic_quotes_runtime') ) {
	function set_magic_quotes_runtime($value) { return true;}
}

function gb_force_ssl_in_treasurer_center() {
	$secure_pages = is_page( 'member-profile' ) || is_page( 'treasurer-center' );

        if ( $secure_pages && ! is_ssl() ) {

            if ( 0 === strpos($_SERVER['REQUEST_URI'], 'http') ) {
                wp_safe_redirect(preg_replace('|^http://|', 'https://', $_SERVER['REQUEST_URI']), 301 );
                exit();
            } else {
                wp_safe_redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 301 );
                exit();
            }
        }
}

add_action( 'template_redirect', 'gb_force_ssl_in_treasurer_center', 1 );

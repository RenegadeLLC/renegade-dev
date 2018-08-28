<?php
/*
Plugin Name: Remove Old Slugs
Plugin URI: https://wpcodefactory.com/item/remove-old-slugs-wordpress-plugin/
Description: Plugin removes old slugs (permalinks) from database.
Version: 2.2.0
Author: Algoritmika Ltd
Author URI: http://www.algoritmika.com
Text Domain: remove-old-slugspermalinks
Domain Path: /langs
Copyright: © 2018 Algoritmika Ltd.
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( 'remove-old-slugs.php' === basename( __FILE__ ) ) {
	// Check if Pro is active, if so then return
	$plugin = 'remove-old-slugs-pro/remove-old-slugs-pro.php';
	if (
		in_array( $plugin, apply_filters( 'active_plugins', get_option( 'active_plugins', array() ) ) ) ||
		( is_multisite() && array_key_exists( $plugin, get_site_option( 'active_sitewide_plugins', array() ) ) )
	) {
		return;
	}
}

if ( ! class_exists( 'Alg_ROS' ) ) {

	/*
	 * Alg_ROS.
	 *
	 * @version 2.2.0
	 */
	class Alg_ROS {

		/*
		 * Constructor.
		 *
		 * @version 2.2.0
		 */
		function __construct() {
			// Admin
			if ( is_admin() ) {
				// Set up localisation
				load_plugin_textdomain( 'remove-old-slugspermalinks', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );
				// Options
				add_action( 'admin_menu', array( $this, 'add_plugin_options_page' ) );
				// Action links
				add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links' ) );
				// Save post
				add_action( 'admin_init', array( $this, 'save_remove_old_slugs_on_save_post_option' ) );
				if ( 'yes' === apply_filters( 'alg_ros_option', 'no', 'on_save_post' ) ) {
					add_action( 'save_post', array( $this, 'remove_slugs_on_save_post' ) );
				}
			}
			// Crons
			add_action( 'admin_init',                array( $this, 'cron_save_interval' ) );
			add_action( 'alg_remove_old_slugs_cron', array( $this, 'cron_alg_remove_old_slugs' ) );
			add_filter( 'cron_schedules',            array( $this, 'cron_add_custom_intervals' ) );
			register_activation_hook(   __FILE__,    array( $this, 'cron_schedule_the_event' ) );
			register_deactivation_hook( __FILE__,    array( $this, 'cron_unschedule_the_event' ) );
		}

		/**
		 * save_remove_old_slugs_on_save_post_option.
		 *
		 * @version 2.2.0
		 * @since   2.2.0
		 */
		function save_remove_old_slugs_on_save_post_option() {
			if ( isset( $_POST['alg_remove_old_slugs_on_save_post'] ) ) {
				update_option( 'alg_remove_old_slugs_on_save_post_enabled', $_POST['alg_remove_old_slugs_on_save_post_enabled'] );
			}
		}

		/**
		 * remove_slugs_on_save_post.
		 *
		 * @version 2.2.0
		 * @since   2.2.0
		 */
		function remove_slugs_on_save_post( $post_id ) {
			$this->delete_old_slugs( $post_id );
		}

		/**
		 * cron_save_interval.
		 *
		 * @version 2.2.0
		 * @since   2.2.0
		 */
		function cron_save_interval() {
			if ( isset( $_POST['alg_remove_old_slugs_crons'] ) ) {
				update_option( 'alg_remove_old_slugs_cron_interval', $_POST['alg_remove_old_slugs_crons_interval'] );
				$this->cron_unschedule_the_event();
				$this->cron_schedule_the_event();
			}
		}

		/**
		 * cron_unschedule_the_event.
		 *
		 * @version 2.2.0
		 * @since   2.2.0
		 */
		function cron_unschedule_the_event() {
			wp_clear_scheduled_hook( 'alg_remove_old_slugs_cron' );
		}

		/**
		 * cron_schedule_the_event.
		 *
		 * @version 2.2.0
		 * @since   2.2.0
		 */
		function cron_schedule_the_event() {
			if ( 'disabled' != ( $interval = apply_filters( 'alg_ros_option', 'disabled', 'cron' ) ) && ! wp_next_scheduled( 'alg_remove_old_slugs_cron' ) ) {
				wp_schedule_event( time(), $interval, 'alg_remove_old_slugs_cron' );
			}
		}

		/**
		 * cron_alg_remove_old_slugs.
		 *
		 * @version 2.2.0
		 * @since   2.2.0
		 */
		function cron_alg_remove_old_slugs() {
			$this->delete_old_slugs();
		}

		/**
		 * cron_add_custom_intervals.
		 *
		 * @version 2.2.0
		 * @since   2.2.0
		 */
		function cron_add_custom_intervals( $schedules ) {
			$schedules['weekly'] = array(
				'interval' => 604800,
				'display'  => __( 'Once Weekly', 'remove-old-slugspermalinks' ),
			);
			$schedules['minutely'] = array(
				'interval' => 60,
				'display'  => __( 'Once a Minute', 'remove-old-slugspermalinks' ),
			);
			return $schedules;
		}

		/**
		 * Show action links on the plugin screen
		 *
		 * @version 2.2.0
		 * @since   2.0.0
		 * @param   mixed $links
		 * @return  array
		 */
		function action_links( $links ) {
			$custom_links = array( '<a href="' . admin_url( 'tools.php?page=alg-remove-old-slugs' ) . '">' . __( 'Settings', 'remove-old-slugspermalinks' ) . '</a>' );
			if ( 'remove-old-slugs.php' === basename( __FILE__ ) ) {
				$custom_links[] = '<a target="_blank" href="https://wpcodefactory.com/item/remove-old-slugs-wordpress-plugin/">' .
					__( 'Unlock All', 'remove-old-slugspermalinks' ) . '</a>';
			}
			return array_merge( $custom_links, $links );
		}

		/*
		 * add_plugin_options_page.
		 *
		 * @version 2.2.0
		 */
		function add_plugin_options_page() {
			add_submenu_page(
				'tools.php',
				__( 'Old Slugs', 'remove-old-slugspermalinks' ),
				__( 'Old Slugs', 'remove-old-slugspermalinks' ),
				'manage_options',
				'alg-remove-old-slugs',
				array( $this, 'create_admin_page' )
			);
		}

		/**
		 * get_table_html.
		 *
		 * @version 2.0.0
		 * @since   2.0.0
		 */
		function get_table_html( $data, $args = array() ) {
			$defaults = array(
				'table_class'        => '',
				'table_style'        => '',
				'table_heading_type' => 'horizontal',
				'columns_classes'    => array(),
				'columns_styles'     => array(),
			);
			$args = array_merge( $defaults, $args );
			extract( $args );
			$table_class = ( '' == $table_class ) ? '' : ' class="' . $table_class . '"';
			$table_style = ( '' == $table_style ) ? '' : ' style="' . $table_style . '"';
			$html = '';
			$html .= '<table' . $table_class . $table_style . '>';
			$html .= '<tbody>';
			foreach( $data as $row_number => $row ) {
				$html .= '<tr>';
				foreach( $row as $column_number => $value ) {
					$th_or_td = ( ( 0 === $row_number && 'horizontal' === $table_heading_type ) || ( 0 === $column_number && 'vertical' === $table_heading_type ) ) ? 'th' : 'td';
					$column_class = ( ! empty( $columns_classes ) && isset( $columns_classes[ $column_number ] ) ) ? ' class="' . $columns_classes[ $column_number ] . '"' : '';
					$column_style = ( ! empty( $columns_styles ) && isset( $columns_styles[ $column_number ] ) ) ? ' style="' . $columns_styles[ $column_number ] . '"' : '';

					$html .= '<' . $th_or_td . $column_class . $column_style . '>';
					$html .= $value;
					$html .= '</' . $th_or_td . '>';
				}
				$html .= '</tr>';
			}
			$html .= '</tbody>';
			$html .= '</table>';
			return $html;
		}

		/*
		 * delete_old_slugs.
		 *
		 * @version 2.2.0
		 * @since   2.2.0
		 */
		function delete_old_slugs( $post_ids = false ) {
			global $wpdb;
			$wp_postmeta_table = $wpdb->prefix . 'postmeta';
			if ( ! $post_ids ) {
				$wpdb->get_results( "DELETE FROM $wp_postmeta_table WHERE meta_key = '_wp_old_slug'" );
				$db_results = $wpdb->get_results( "SELECT * FROM $wp_postmeta_table WHERE meta_key = '_wp_old_slug'" );
			} else {
				$wpdb->get_results( "DELETE FROM $wp_postmeta_table WHERE meta_key = '_wp_old_slug' AND post_id = $post_ids" );
				$db_results = $wpdb->get_results( "SELECT * FROM $wp_postmeta_table WHERE meta_key = '_wp_old_slug' AND post_id = $post_ids" );
			}
			$num_old_slugs_after_delete = count( $db_results );
			return $num_old_slugs_after_delete;
		}

		/*
		 * manage_old_slugs.
		 *
		 * @version 2.2.0
		 * @since   2.0.0
		 */
		function manage_old_slugs( $post_ids = false ) {
			$html = '';
			$html .= '<p>';
			global $wpdb;
			$wp_postmeta_table = $wpdb->prefix . 'postmeta';
			$db_results = ( ! $post_ids ?
				$wpdb->get_results( "SELECT * FROM $wp_postmeta_table WHERE meta_key = '_wp_old_slug' ORDER BY post_id" ) :
				$wpdb->get_results( "SELECT * FROM $wp_postmeta_table WHERE meta_key = '_wp_old_slug' AND post_id = $post_ids" )
			);
			$num_old_slugs = count( $db_results );
			if ( $num_old_slugs > 0 ) {
				// Old slugs found
				if ( isset( $_POST['alg_remove_old_slugs'] ) ) {
					// Remove old slugs
					$num_old_slugs_after_delete = $this->delete_old_slugs( $post_ids );
					$html .= '<p>';
					$html .= '<strong>';
					$html .= sprintf(
						__( 'Removing old slugs from database finished! %d old slug(s) deleted.', 'remove-old-slugspermalinks' ),
						( $num_old_slugs - $num_old_slugs_after_delete )
					);
					$html .= '</strong>';
					$html .= '</p>';
				} else {
					// Display old slugs
					$table_data = array();
					$table_data[] = array(
						'#',
						__( 'Old Slug', 'remove-old-slugspermalinks' ),
						__( 'Post ID', 'remove-old-slugspermalinks' ),
						__( 'Post Title', 'remove-old-slugspermalinks' ),
						__( 'Post Type', 'remove-old-slugspermalinks' ),
						__( 'Current Slug', 'remove-old-slugspermalinks' ),
					);
					$i = 0;
					foreach ( $db_results as $db_result ) {
						$i++;
						$post_type    = get_post_type( $db_result->post_id );
						$post_title   = get_the_title( $db_result->post_id );
						$current_slug = get_post( $db_result->post_id );
						$current_slug = $current_slug->post_name;
						$table_data[] = array(
							$i,
							$db_result->meta_value,
							$db_result->post_id,
							$post_title,
							$post_type,
							$current_slug,
						);
					}
					$html .= sprintf( __( '<p><strong>%d</strong> old slug(s) found:<p>', '' ), $num_old_slugs );
					$html .= $this->get_table_html( $table_data, array( 'table_class' => 'widefat striped' ) );
					$html .= '<p>';
					$html .= '<form method="post" action="">';
					$html .= '<input class="button-primary" type="submit" name="alg_remove_old_slugs" onclick="return confirm(\'' .
						__( 'Are you sure?', 'remove-old-slugspermalinks' ) . '\')" value="' . __( 'Remove old slugs', 'remove-old-slugspermalinks' ) . '"/>';
					$html .= '</form>';
					$html .= '</p>';
				}

			} else {
				// None old slugs found
				$html .= '<em>' . __( 'No old slugs found in database.', 'remove-old-slugspermalinks' ) . '</em>';
			}
			$html .= '</p>';
			return $html;
		}

		/*
		 * create_admin_page.
		 *
		 * @version 2.2.0
		 * @todo    [later] (feature) delete selected slugs only (instead of deleting all at once) (will need multiple `$post_ids` in (`delete_old_slugs()`))
		 */
		function create_admin_page() {
			$html = '';

			// Header
			$html .= '<div class="wrap">';
			$html .= '<h1>' . __( 'Old Slugs', 'remove-old-slugspermalinks' ) . '</h1>';
			$html .= '<p>' . __( 'This tool removes old slugs (permalinks) from database.', 'remove-old-slugspermalinks' ) . '</p>';

			// Manage old slugs
			$html .= $this->manage_old_slugs();

			// Refresh link
			$html .= '<p><a href="' . admin_url( 'tools.php?page=alg-remove-old-slugs' ) . '">' .
				__( 'Refresh list', 'remove-old-slugspermalinks' ) . '</a></p>';

			// Automatic clean ups
			$html .= '<hr>';
			$html .= '<h2>' . __( 'Automatic Clean Ups', 'remove-old-slugspermalinks' ) . '</h2>';
			$html .= apply_filters( 'alg_ros_option', '<h4 style="padding: 20px; background-color: #e9eaaa;">' . sprintf(
				__( 'You will need %s plugin to enable automatic old slugs clean ups.', 'remove-old-slugspermalinks' ),
					'<a href="https://wpcodefactory.com/item/remove-old-slugs-wordpress-plugin/" target="_blank">' .
						__( 'Remove Old Slugs Pro', 'remove-old-slugspermalinks' ) . '</a>' ) . '</h4>', 'settings' );
			if ( isset( $_GET['alg_debug'] ) && defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
				$html .= '<h4 style="padding: 20px; background-color: #dddddd;">' .
					__( '<code>DISABLE_WP_CRON</code> is set to <code>true</code> in your <code>wp-config.php</code> file - "Scheduled Clean Ups" won\'t work.', 'remove-old-slugspermalinks' ) .
				'</h4>';
			}
			$form_crons  = '';
			$form_crons .= '<form method="post" action="">';
			$intervals   = array(
				'disabled'   => __( 'Disabled', 'remove-old-slugspermalinks' ),
				'minutely'   => __( 'Every minute', 'remove-old-slugspermalinks' ),
				'hourly'     => __( 'Hourly', 'remove-old-slugspermalinks' ),
				'twicedaily' => __( 'Twice daily', 'remove-old-slugspermalinks' ),
				'daily'      => __( 'Daily', 'remove-old-slugspermalinks' ),
				'weekly'     => __( 'Weekly', 'remove-old-slugspermalinks' ),
			);
			$form_crons .= '<select  style="width:150px;" name="alg_remove_old_slugs_crons_interval" id="alg_remove_old_slugs_crons_interval"' .
				apply_filters( 'alg_ros_option', 'disabled', 'settings' ). '>';
			$selected = get_option( 'alg_remove_old_slugs_cron_interval', 'disabled' );
			foreach ( $intervals as $interval_id => $interval_desc ) {
				$form_crons .= '<option value="' . $interval_id . '" ' . selected( $selected, $interval_id, false ) . '>' . $interval_desc . '</option>';
			}
			$form_crons .= '</select>' . ' ';
			$form_crons .= '<input class="button-primary" type="submit" name="alg_remove_old_slugs_crons" value="' . __( 'Save', 'remove-old-slugspermalinks' ) . '"' .
				apply_filters( 'alg_ros_option', 'disabled', 'settings' ). '/>';
			$form_crons .= '</form>';
			$cron_info = '';
			if ( wp_next_scheduled( 'alg_remove_old_slugs_cron' ) ) {
				$cron_info .= '<br><em>' . sprintf( __( 'Next old slugs clean up is scheduled on %s. Current time is %s.', 'remove-old-slugspermalinks' ),
					'<code>' . date_i18n( 'Y-m-d H:i:s', wp_next_scheduled( 'alg_remove_old_slugs_cron' ) ) . '</code>',
					'<code>' . date_i18n( 'Y-m-d H:i:s', time() ) . '</code>' ) . '</em>';
			}
			$form_on_save_post  = '';
			$form_on_save_post .= '<form method="post" action="">';
			$form_on_save_post .= '<select style="width:150px;" name="alg_remove_old_slugs_on_save_post_enabled" id="alg_remove_old_slugs_on_save_post_enabled"' .
				apply_filters( 'alg_ros_option', 'disabled', 'settings' ). '>';
			$selected = get_option( 'alg_remove_old_slugs_on_save_post_enabled', 'no' );
			$form_on_save_post .= '<option value="no" '  . selected( $selected, 'no',  false ) . '>' . __( 'No', 'remove-old-slugspermalinks' )  . '</option>';
			$form_on_save_post .= '<option value="yes" ' . selected( $selected, 'yes', false ) . '>' . __( 'Yes', 'remove-old-slugspermalinks' ) . '</option>';
			$form_on_save_post .= '</select>' . ' ';
			$form_on_save_post .= '<input class="button-primary" type="submit" name="alg_remove_old_slugs_on_save_post" value="' . __( 'Save', 'remove-old-slugspermalinks' ) . '"' .
				apply_filters( 'alg_ros_option', 'disabled', 'settings' ). '/>';
			$form_on_save_post .= '</form>';

			$table_data = array(
				array(
					'<strong>' . __( 'Scheduled Clean Ups', 'remove-old-slugspermalinks' ) . '</strong>',
					'<em>' . sprintf( __( 'Set old slugs to be cleared periodically (%s).', 'remove-old-slugspermalinks' ), implode( ', ', $intervals ) ) . '</em>' .
						$cron_info,
					$form_crons,
				),
				array(
					'<strong>' . __( 'Clean Up on Save Post', 'remove-old-slugspermalinks' ) . '</strong>',
					'<em>' . __( 'Set old slugs to be cleared automatically, when post is saved.', 'remove-old-slugspermalinks' ) . '</em>',
					$form_on_save_post,
				),
			);
			$html .= $this->get_table_html( $table_data, array( 'table_class' => 'widefat striped', 'table_heading_type' => 'none' ) );

			// The end
			$html .= '</div>';

			echo $html;
		}
	}
}

$alg_remove_old_slugs = new Alg_ROS();

<?php

	/**
	* Plugin Name: PRO Drag and Drop Multiple File Upload - WooCommerce
	* Plugin URI: https://profiles.wordpress.org/glenwpcoder
	* Description: This plugin enable user to upload using "Drag & Drop" or "Browse Multiple" file uploads in your WooCommerce Product details page.
	* Text Domain: dnd-file-upload-wc
	* Domain Path: /languages
	* Version: 1.6.1
	* Author: Glen Mongaya
	* Author URI: http://codedropz.com
	* WC requires at least: 3.5.0
	* WC tested up to: 5.2.0
	* License: GPL2
	**/

	/**  This protect the plugin file from direct access */
	if ( ! defined( 'WPINC' ) ) {
		die;
	}

	/** Set plugin constant to true **/
	define( 'DNDMFU_WC_PRO', true );

	/**  Define plugin Version */
	define( 'DNDMFU_WC_PRO_VERSION', '1.6.1' );

	/**  Define constant Plugin Directories  */
	define( 'DNDMFU_WC_PRO_DIR', wp_normalize_path( untrailingslashit( dirname( __FILE__ ) ) ) );

	/**  Define constant Plugin Path  */
	if( ! defined('DNDMFU_WC_PRO_PATH') ) {
		define( 'DNDMFU_WC_PRO_PATH', 'wc_drag-n-drop_uploads' );
	}

	// require plugin core file
	require_once( DNDMFU_WC_PRO_DIR .'/inc/class-dnd-upload-wc-main.php' );

	// include plugin update checker
	require_once( DNDMFU_WC_PRO_DIR .'/inc/admin/updates.php' );

	// Plugin activate & deactivate hooks
	register_activation_hook( __FILE__, 'dndmfu_wc_pro_activate' );

	/* When plugin activated*/
	function dndmfu_wc_pro_activate() {
        global $wpdb;

		// Schedule Cron
		if ( ! wp_next_scheduled ( 'wp_dnd_wc_daily_cron') ) {
			wp_schedule_event( time(), 'hourly', 'wp_dnd_wc_daily_cron' );
		}

		// Deactivate Free version
		$plugin = 'drag-and-drop-multiple-file-upload-for-woocommerce/drag-and-drop-file-uploads-wc.php';

		if( is_plugin_active( $plugin ) ) {
			deactivate_plugins( $plugin );
		}

        // Create table if not exist.
        $dndmfu_table = $wpdb->prefix .'wc_dndmfu';
        $charset_collate = $wpdb->get_charset_collate();

        #Check to see if the table exists already, if not, then create it

        if( $wpdb->get_var( "show tables like '$dndmfu_table'" ) != $dndmfu_table ){
            $sql = "CREATE TABLE `". $dndmfu_table . "` ( ";
            $sql .= "  `ID`  bigint(20)   NOT NULL AUTO_INCREMENT PRIMARY KEY, ";
            $sql .= "  `product_id`  bigint(20)   NOT NULL, ";
            $sql .= "  `details`  varchar(250)   NOT NULL, ";
            $sql .= "  `file_index`  varchar(200)   NOT NULL, ";
            $sql .= "  `status`  char(100)   NOT NULL ";
            $sql .= ") $charset_collate; ";
            require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
            dbDelta($sql);
        }

	}

	// Deactivation
	register_deactivation_hook( __FILE__, 'dndmfu_wc_pro_deactivate' );

	/* When plugin deactivated */
	function dndmfu_wc_pro_deactivate() {
		wp_clear_scheduled_hook( 'wp_dnd_wc_daily_cron' );
	}
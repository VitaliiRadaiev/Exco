<?php
/*
Plugin Name:    Menu Items Visibility Control
Description:    Control the display logic of individual menu items.
Author:         Hassan Derakhshandeh
Version:        0.3.9
Text Domain:    menu-items-visibility-control
Domain Path:    /languages
*/

class Menu_Items_Visibility_Control {

	private static $instance = null;

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @return	A single instance of this class.
	 */
	public static function get_instance() {
		return null == self::$instance ? self::$instance = new self : self::$instance;
	}

	private function __construct() {
		if ( is_admin() ) {
			add_action( 'init', array( $this, 'i18n' ) );
			add_action( 'wp_update_nav_menu_item', array( $this, 'update_option' ), 10, 3 );
			add_action( 'delete_post', array( $this, 'remove_visibility_meta' ), 1, 3 );
			add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'wp_nav_menu_item_custom_fields' ) );
		} else {
			add_filter( 'wp_get_nav_menu_items', array( $this, 'visibility_check' ), 10, 3 );
		}
	}

	function i18n() {
		load_plugin_textdomain( 'menu-items-visibility-control', false, '/languages' );
	}

	/**
	 * Displays the field
	 *
	 * @since 0.3.8
	 */
	function wp_nav_menu_item_custom_fields( $item_id ) {
		$value = get_post_meta( $item_id, '_menu_item_visibility', true );
		?>
		<p class="field-visibility description description-wide">
			<label for="edit-menu-item-visibility-<?php echo $item_id; ?>">
				<?php printf( __( 'Visibility logic (<a href="%s">?</a>)', 'menu-items-visibility-control' ), 'https://codex.wordpress.org/Conditional_Tags' ); ?><br>
				<input type="text" class="widefat code" id="edit-menu-item-visibility-<?php echo $item_id; ?>" name="menu-item-visibility[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $value ); ?>" />
			</label>
		</p>
		<?php
	}

	function update_option( $menu_id, $menu_item_db_id, $args ) {
		if ( isset( $_POST['menu-item-visibility'][ $menu_item_db_id ] ) ) {
			$meta_value = get_post_meta( $menu_item_db_id, '_menu_item_visibility', true );
			$new_meta_value = stripcslashes( $_POST['menu-item-visibility'][ $menu_item_db_id ] );

			if ( '' == $new_meta_value ) {
				delete_post_meta( $menu_item_db_id, '_menu_item_visibility', $meta_value );
			} elseif ( $meta_value !== $new_meta_value ) {
				update_post_meta( $menu_item_db_id, '_menu_item_visibility', $new_meta_value );
			}
		}
	}

	/**
	 * Checks the menu items for their visibility options and
	 * removes menu items that are not visible.
	 *
	 * @return array
	 * @since 0.1
	 */
	function visibility_check( $items, $menu, $args ) {
		$hidden_items = array();
		foreach ( $items as $key => $item ) {
			$item_parent = get_post_meta( $item->ID, '_menu_item_menu_item_parent', true );
			if ( $logic = get_post_meta( $item->ID, '_menu_item_visibility', true ) ) {
				eval( '$visible = ' . $logic . ';' );
			} else {
				$visible = true;
			}
			if ( ! $visible
				|| isset( $hidden_items[ $item_parent ] ) // also hide the children of invisible items
			) {
				unset( $items[ $key ] );
				$hidden_items[ $item->ID ] = '1';
			}
		}

		return $items;
	}

	/**
	 * Remove the _menu_item_visibility meta when the menu item is removed
	 *
	 * @since 0.2.2
	 */
	function remove_visibility_meta( $post_id ) {
		if ( is_nav_menu_item( $post_id ) ) {
			delete_post_meta( $post_id, '_menu_item_visibility' );
		}
	}
}
Menu_Items_Visibility_Control::get_instance();
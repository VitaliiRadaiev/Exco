<?php

	/**
	* @Description : Custom Functions
	* @Package : PRO Drag & Drop Multiple File Upload - WooCommerce
	* @Author : CodeDropz
	*/

	if ( ! defined( 'ABSPATH' ) || ! defined('DNDMFU_WC_PRO') ) {
		exit;
	}

	class DNDMFU_WC_PRO_HOOKS {

		private static $instance = null;

		// Custom functions
		private $fn = '';

		/**
		* Creates or returns an instance of this class.
		*
		* @return  Init A single instance of this class.
		*/

		public static function get_instance() {
			if( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		* Load and initialize plugin
		*/

		private function __construct() {

			// Basic filter & action hooks
			add_filter( 'woocommerce_get_settings_pages',array( $this, 'dndmfu_wc_settings_tabs' ) );
			add_action( 'admin_head', array( $this, 'dndmfu_wc_product_tabs_icon' ) );
			add_action( 'wp_footer', array( $this, 'dndmfu_footer' ) );

			// Get custom function instance
			$this->fn = DNDMFU_WC_PRO_FUNCTIONS::get_instance();
		}

		/**
		* Add custom style in footer.
		*/

		public function dndmfu_footer() {
			echo '<style id="dndmfu-custom-css">';
				$thumbnail_column = get_option('drag_n_drop_upload_thumbnail_column' );

				// Dynamic columns css
				if( $thumbnail_column ) {
					echo '.codedropz--preview .dnd-upload-status { width: calc( '. ( 100 - ( $thumbnail_column * 2 ) ) .'% / '.$thumbnail_column.' ); }';
				}

				// Product variation reset style for uploads only.
				echo 'dl.variation dd.variation-' . sanitize_html_class( $this->fn->order_item_title() ) .'{ clear:both; display:block; }';

                // Progress bar
                if( $progress_color = get_option('wc_drag_n_drop_style_progress') ) {
                    echo '.dnd-upload-status .dnd-upload-details .dnd-progress-bar span { background-color:'.$progress_color.'; }';
                }

                // Filename
                if( $filename = get_option('wc_drag_n_drop_style_filename') ) {
                    echo '.dnd-upload-status .dnd-upload-details .name { color:'.$filename.'; }';
                }

                // Delete icon
                if( $icon = get_option('wc_drag_n_drop_style_delete') ) {
                    echo '.codedropz--preview .dnd-upload-status .dnd-upload-details .remove-file span { background-color:'.$icon.'; }';
                }

                // Delete icon
                if( $file_size = get_option('wc_drag_n_drop_style_filesize') ) {
                    echo '.dnd-upload-status .dnd-upload-details .name em { color:'.$file_size.'; }';
                }

                // Upload border
                if( $border = get_option('wc_drag_n_drop_style_border') ) {
                    echo '.codedropz-upload-handler { border-color:'.$border.'; }';
                }

                // Upload button Text
                if( $button_text = get_option('wc_drag_n_drop_style_btn_color') ) {
                    echo '.codedropz-upload-inner a.cd-upload-btn { color:'.$button_text.'; }';
                }

                // Upload button background
                if( $button_bg = get_option('wc_drag_n_drop_style_btn_bg') ) {
                    echo '.codedropz-upload-inner a.cd-upload-btn { background-color:'.$button_bg.'; }';
                }

                // Uploader text color
                if( $uploader_text = get_option('wc_drag_n_drop_style_text_color') ) {
                    echo '.codedropz-upload-inner .codedropz-label .text { color:'.$uploader_text.'; }';
                }

			echo '</style>';
		}

		/**
		* Change icon on File Uploads - tab
		*/

		public function dndmfu_wc_product_tabs_icon() {
		?>
			<style type="text/css">
				.dndmfu_wc_panel a:before { content: "\f317"!important; }
				.woocommerce_order_items_wrapper table.display_meta .dndmfu_wc_files a { display:inline-block; }
				.woocommerce_order_items_wrapper table.display_meta .dndmfu_wc_files img { max-width:40px;}
			</style>
		<?php
		}

		// Product Tabs
		public function dndmfu_wc_product_tabs( $tabs ) {
			$tabs['dndmfu_file_uploads'] = array(
				'label'		=> __( 'File Uploads', 'dnd-file-upload-wc' ),
				'target'	=> 'dndmfu_wc_panel',
				'class'		=> array( 'dndmfu_wc_panel' ),
				'priority'	=> 80,
			);
			return $tabs;
		}

		/**
		* Product panels
		*/

		public function dndmfu_wc_product_panels( $tabs ) {
			echo '<div id="dndmfu_wc_panel" class="panel woocommerce_options_panel">';
				echo '<div class="options_group">';
					woocommerce_wp_checkbox(
						array(
							'id'		=>	'disable_dnd_file_upload_wc',
							'label'     => __( 'Disable File Upload?', 'dnd-file-upload-wc' )
						)
					);

					woocommerce_wp_text_input(
						array(
							'id'        	=> 'label_dnd_file_upload_wc',
							'placeholder'	=>	'Multiple File Uploads',
							'label'     	=> __( 'Label', 'dnd-file-upload-wc' ),
							'type'      	=> 'text',

						)
					);

				echo '</div>';

                echo '<div class="options_group">';
                    woocommerce_wp_text_input(
						array(
							'id'        	=> 'min_dnd_fupload_wc',
							'label'     	=> __( 'Min File Upload', 'dnd-file-upload-wc' ),
							'type'      	=> 'text',

						)
					);
                    woocommerce_wp_text_input(
						array(
							'id'        	=> 'max_dnd_fupload_wc',
							'placeholder'	=>	'10',
							'label'     	=> __( 'Max File Upload', 'dnd-file-upload-wc' ),
							'type'      	=> 'text',

						)
					);
                echo '</div>';
                echo '<div class="options_group">';
                    woocommerce_wp_text_input(
						array(
							'id'        	=> 'types_dnd_fupload_wc',
							'placeholder'	=>	'jpg, png, gif, pdf, mp3, mp4',
							'label'     	=> __( 'Supported File Types', 'dnd-file-upload-wc' ),
							'type'      	=> 'text',

						)
					);
                    woocommerce_wp_text_input(
						array(
							'id'        	=> 'max_file_size_dnd_fupload_wc',
							'placeholder'	=>	'10485760',
							'label'     	=> __( 'Max File Size (Bytes)', 'dnd-file-upload-wc' ),
							'type'      	=> 'text',

						)
					);
                echo '</div>';
			echo '</div>';
		}

		/**
		* Save custom fields individual product.
		*/

		public function dndmfu_wc_save_fields( $post_id ) {

			$custom_fields = array(
				'disable_dnd_file_upload_wc',
				'label_dnd_file_upload_wc',
                'min_dnd_fupload_wc',
                'max_dnd_fupload_wc',
                'types_dnd_fupload_wc',
                'max_file_size_dnd_fupload_wc'
			);

			foreach( $custom_fields as $field ) {
				$new_val = ( isset( $_POST[ $field ] ) ? sanitize_text_field( $_POST[ $field ] ) : '' );
				update_post_meta( $post_id, $field, $new_val );
			}
		}

		/**
		* Custom WC Admin Settings
		*/

		public function dndmfu_wc_settings_tabs( $settings ) {
			$dnd_settings = DNDMFU_WC_PRO_DIR .'/inc/admin/dnd-wc-admin-settings.php';
			if( file_exists( $dnd_settings ) ) {
				$settings[] = include $dnd_settings;
			}
			return $settings;
		}

		/**
		* Get file upload name
		*/

		public function dndmfu_wc_get_filename() {
			return get_option('drag_n_drop_field_name') ? get_option('drag_n_drop_field_name') : 'wc-upload-file';
		}

		/**
		* Display - File Upload Template
		*/

		public function dndmfu_wc_display_file_upload() {

			$html_attr = array();
			$product_id = get_the_ID();
            $show_uploader = get_option('show_in_dnd_file_uploader_in', true);

			// Get upload label - single product override
			$label = get_post_meta( $product_id, 'label_dnd_file_upload_wc', true );

			// Disable File Upload
			if( get_post_meta( $product_id, 'disable_dnd_file_upload_wc', true ) !== '' ) {
				return false;
			}

			// Hide uploader - Show only on specific (tags, categories, products & attributes) selected in the Admin.
			if( ! $this->show_uploader( $product_id ) && $show_uploader != 'checkout') {
				return false;
			}

            // If it's on Checkout page
            if( get_option('show_in_dnd_file_uploader_in', true) == 'checkout' ) {
                $found_product = array();
                
                // Extract products from cart & find if there's any category matched in condition "Show If" field.
                foreach( WC()->cart->get_cart() as $item => $cart_item ) {
                    if( ! $this->show_uploader( $cart_item['product_id'] ) ) {
                        continue;
                    }
                    $found_product[] = $cart_item['product_id'];
                }

                // If there's no match return & hide uploader
                if( ! $found_product ) {
                    return false;
                }
            }

			// Get supported file types
			$types = ( get_option('drag_n_drop_support_file_upload') ? explode( ',', get_option('drag_n_drop_support_file_upload') ) : null );

            // If types on individual products is set
            if( get_post_meta( $product_id, 'types_dnd_fupload_wc', true ) ) {
                $types = explode( ',', get_post_meta( $product_id, 'types_dnd_fupload_wc', true ) );
            }

			// Get file upload name
			$name = $this->dndmfu_wc_get_filename();

            // Override settings on individual products
            $min = get_post_meta( $product_id, 'min_dnd_fupload_wc', true ) ? get_post_meta( $product_id, 'min_dnd_fupload_wc', true ) : get_option('drag_n_drop_min_file_upload');
            $max = get_post_meta( $product_id, 'max_dnd_fupload_wc', true ) ? get_post_meta( $product_id, 'max_dnd_fupload_wc', true ) : get_option('drag_n_drop_max_file_upload');
            $size_limit = get_post_meta( $product_id, 'max_file_size_dnd_fupload_wc', true ) ? get_post_meta( $product_id, 'max_file_size_dnd_fupload_wc', true ) : get_option('drag_n_drop_file_size_limit');

			// Custom data attributes
			$attributes['data-name'] 	= $name;
			$attributes['data-type'] 	= ( is_array( $types ) ? implode( '|', array_map('trim', $types) ) : 'jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx|stl|mp4|mp3|zip' );
			$attributes['data-limit'] 	= $size_limit ? $size_limit : 10485760;
			$attributes['data-max'] 	= $max ? (int)$max : 10;
			$attributes['data-min'] 	= $min ? (int)$min : 0;
			$attributes['data-id']   	= $product_id;
			$attributes['multiple'] 	= 'multiple';

            // Allow other plugin to filter file typesdndmfu_wc_cart_items
            $accept_all = apply_filters('dndmfu_wc_all_types', false );

            // Add accept file types attributes
            if( ! $accept_all ) {
                $types = explode('|', $attributes['data-type'] );
                $attributes['accept'] = '.' . implode(', .', array_map( 'trim', $types ) );
            }

			foreach( $attributes as $name => $attr ) {
				$html_attr[] = $name .'="'. esc_attr( trim( $attr ) ) .'"';
			}
			?>
				<div class="wc-dnd-file-upload">
					<?php echo ( $label ? esc_html( $label ) : '<label>'. esc_html( get_option('drag_n_drop_default_label') ) .'</label>' ); ?>
					<input type="file" class="wc-drag-n-drop-file d-none" <?php echo implode(' ', $html_attr ); ?>>
				</div>
			<?php
		}

		/**
		* Show on specific ( categories, tag, attributes )
		*/

		public function show_uploader( $product_id ) {

			// Get show uploader condition
			$show_uploader = get_option('show_in_dnd_file_uploader_if');
			$show = false;

			if( ! $product_id ) {
				return;
			}

            // Show to all product
            if( $show_uploader == 'all' ) {
                return true;
            }

			//Get an instance of the WC_Product Object from the product ID
			$product = wc_get_product( $product_id );

			if( $show_uploader ) {
				switch( $show_uploader ) {
					case 'category':
						$categories = get_option('show_in_dnd_file_uploader_option_category');
						if( $categories ) {
							$show = ( has_term( $categories, 'product_cat', $product_id ) ? true : false );
						}
						break;
					case 'products':
						$products = get_option('show_in_dnd_file_uploader_option_products');
						if( $products ) {
							$show = ( in_array( $product_id, $products ) ? true : false );
						}
						break;
					case 'tags':
						$tags = get_option('show_in_dnd_file_uploader_option_tags');
						if( $tags ) {
							$show = ( has_term( $tags, 'product_tag', $product_id ) ? true : false );
						}
						break;
					case 'attributes':
						$attributes = get_option('show_in_dnd_file_uploader_option_attributes');
						if( $attributes ) {
							foreach( $attributes as $single_attribute ) {
								if( ! $product->get_attribute( $single_attribute ) ) {
									continue;
								}
								$show = true;
							}
						}
						break;
					default:
						$show = true;
						break;
				}
			}

			return $show;
		}

		/**
		* Cart Validation
		*/

		public function dndmfu_wc_cart_validation( $passed, $product_id, $quantity, $variation_id=null ) {

            $files = null;

			// There's no need to validate if the uploader is not showing
			if( ! $this->show_uploader( $product_id ) || get_option('show_in_dnd_file_uploader_in') == 'checkout' ) {
				return $passed;
			}

			// Check only if file upload is required & not disabled ( edit product page )
			if( get_option('drag_n_drop_required') == 'yes' && ! get_post_meta( $product_id, 'disable_dnd_file_upload_wc', true ) ) {

				// Get file upload name
				$file_upload = $this->dndmfu_wc_get_filename();

				// Get files
				$files = ( isset( $_POST[ $file_upload ] ) ? array_map( 'sanitize_text_field', $_POST[ $file_upload ] ) : null );

				// Validate file upload - required
				if( is_null( $files ) ) {
					$passed = false;
					wc_add_notice( __( 'File upload is required.', 'dnd-file-upload-wc' ), 'error' );
				}
			}

            // Minimum - Validation
            $minimum_file = ( get_option('drag_n_drop_min_file_upload') ? get_option('drag_n_drop_min_file_upload') : 0 );

            // Override in single product data option
            if( get_post_meta( $product_id, 'min_dnd_fupload_wc' ) ) {
                $minimum_file = get_post_meta( $product_id, 'min_dnd_fupload_wc' );
            }

            if( $files && count( $files ) < (int)$minimum_file ) {
                $passed = false;
                $error = sprintf( __( 'Please upload atleast %d file(s).', 'dnd-file-upload-wc' ), (int)$minimum_file );
                if( get_option('wc_drag_n_drop_error_min_file') ) {
                    $error = get_option('wc_drag_n_drop_error_min_file');
                }
                wc_add_notice( $error, 'error' );
            }

			return $passed;
		}

		/**
		* Add item to cart
		*/

		public function dndmfu_wc_add_cart_data( $cart_item_data, $product_id, $variation_id ) {

			$dir = $this->fn->dndmfu_wc_dir();
			$name = $this->dndmfu_wc_get_filename();
			$post_files = ( isset( $_POST[ $name ] ) ? array_map('sanitize_text_field', $_POST[ $name ] ) : null );

			$files = array();

			if( $post_files ) {

				// Loop files
				foreach( $post_files as $index_name => $file ) {

					// Get and sanitize file url
					$tmp_file = $dir . wc_clean( wp_unslash( $file ) );

					// Make sure it exists
					if( file_exists( $tmp_file ) ) {

						// Get only the filename
						$files[ $index_name ] = wp_basename( $file );
					}

				}

				// Add files to cart items
				$cart_item_data['dnd-wc-file-upload'] = $files;

			}

			return $cart_item_data;
		}

		/**
		* Display thumbnails on cart items..
		*/

		public function dndmfu_wc_get_cart_item( $item_data, $cart_item_data ) {
            global $wpdb;

			if( isset( $cart_item_data[ 'dnd-wc-file-upload' ] ) ) {

				// Get files - return an array
				$files_upload = $this->fn->dndmfu_wc_get_files( $cart_item_data['dnd-wc-file-upload'] );

                // Get prod id
                $product_id = $cart_item_data['product_id'];

				// setup item data
				if( $files_upload ) {
					$item_data[] = array(
						'key' 	=> $this->fn->order_item_title(),
						'value' => apply_filters( 'dndmfu_wc_cart_items', '<div class="dndmfu_wc_files">' . implode(" ", $files_upload ) . '</div>' )
					);
				}

                // For pdf files only
                if( get_option('drag_n_drop_count_pdf') == 'yes' ) {
                    $details = array();
                    $display_text = get_option('wc_drag_n_drop_pdf_display_text') ? get_option('wc_drag_n_drop_pdf_display_text') : '%filename (Total Pages: %pagecount)';
                    
                    // Get unique key/index/progressbar id
                    foreach( $cart_item_data[ 'dnd-wc-file-upload' ] as $key => $file ) {
                        $type = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );
                        if( $type !== 'pdf' ) {
                            continue;
                        }
                        $data = $this->fn->dndmfu_get_details( $key, $product_id, 'details' ); // get file details query
                        $details[] = str_replace( array('%filename','%pagecount'), array( wp_basename( $data['file'] ), $data['total_pages'] ), $display_text );
                    }

                    if( count( $details ) > 0 ) {
                        $item_data[]  = array(
                            'key'   =>  apply_filters('dndmfu_wc_pdf_label', 'PDF Details'),
                            'value' =>  implode('<br>', $details )
                        );
                    }
                }
			}

			return $item_data;
		}

		/**
		* Add custom meta to order - after payment
		*/

		public function dndmfu_wc_order_line_item( $item, $cart_item_key, $values, $order ) {
			if( isset( $values['dnd-wc-file-upload'] ) ) {

				//Get all files
				$files_upload = $this->fn->dndmfu_wc_get_files( $values['dnd-wc-file-upload'] );

				//Add order custom meta data
				if( $files_upload ) {
					$item->add_meta_data('_dndmfu_key', $values['key']);
                    $item->add_meta_data('_dndmfu_pdf_details', $values['dnd-wc-file-upload'] );
				}
			}
		}

        /**
		* Add custom order iterm - if uploader in checkout
		*/

        public function dndmfu_wc_add_order_item( $order_id, $data ) {
            if( ! $order_id ) {
                return;
            }

            $file_upload = $this->dndmfu_wc_get_filename();
            $files = ( isset( $_POST[ $file_upload ] ) ? array_map( 'sanitize_text_field', $_POST[ $file_upload ] ) : null );
            $new_files = array();

            if( $files ) {
                $order_path = $this->order_dir( $order_id );
                $files_data = $this->fn->dndmfu_wc_get_files( $files, true );
                foreach( $files_data as $file ) {
                    $file_path = $this->fn->convert_url( $file );
                    if( file_exists( $file_path ) ) {
                        $new_files[] = $this->move_files( $file_path, $order_path . wp_basename( $file ) );
                    }
                }
            }

            if( $new_files ) {

                // If zip files is enable
                if( get_option('drag_n_drop_zip_files') == 'yes' ) {
                    $for_zip = wp_list_pluck( $new_files, 'url' );
                    $new_files = array();
                    if( $for_zip ) {
                        $zip = $this->fn->zip_files( $for_zip ); // zip files
                        $new_files[] = array(
                            'url'   =>  $zip,
                            'path'  =>  $this->fn->convert_url( $zip ) // convert url to path
                        );
                    }
                }
                
                // Save post meta
                update_post_meta( $order_id, '_dndmfu_order_files', $new_files );    
            }
        }

         /**
		* Checkout Validation
		*/

        public function dndmfu_wc_checkout_process() {

            // If no upload fields in checkout then return
            if( get_option('show_in_dnd_file_uploader_in') != 'checkout' ){
                return;
            }

            // Get file upload name
            $file_upload = $this->dndmfu_wc_get_filename();

            // Get files
            $files = ( isset( $_POST[ $file_upload ] ) ? array_map( 'sanitize_text_field', $_POST[ $file_upload ] ) : null );

            // Validate file upload - required
            if( is_null( $files ) && get_option('drag_n_drop_required') == 'yes' ) {
                wc_add_notice( __( 'File upload is required.', 'dnd-file-upload-wc' ), 'error' );
            }

            // Minimum - Validation
            $minimum_file = ( get_option('drag_n_drop_min_file_upload') ? get_option('drag_n_drop_min_file_upload') : 0 );

            if( $files && count( $files ) < (int)$minimum_file ) {
                $error = sprintf( __( 'Please upload atleast %d file(s).', 'dnd-file-upload-wc' ), (int)$minimum_file );
                if( get_option('wc_drag_n_drop_error_min_file') ){
                    $error = sprintf( get_option('wc_drag_n_drop_error_min_file'), (int)$minimum_file );
                }
                wc_add_notice( $error, 'error' );
            }
        }

        /**
		* Add details on   you page
		*/

        public function dndmfu_wc_thank_you( $order ) {
            
            if( ! $order ) {
                return;
            }

            if( get_option('show_in_dnd_file_uploader_in') == 'checkout' ) {
                $order_id = $order->get_order_number();
                $fn = DNDMFU_WC_PRO_FUNCTIONS::get_instance();
                $files = get_post_meta( $order_id, '_dndmfu_order_files', true );
                if( ! $files ) {
                    return;
                }
            ?>
                <h2 class="woocommerce-column__title"><?php echo $this->fn->order_item_title(); ?></h2>
                <table cellspacing="0" cellpadding="0" border="0" class="woocommerce-table woocommerce-table--order-details shop_table order_details">
                    <tbody>
                        <tr>
                            <td style="padding:0">
                                <table cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                        <tr valign="top">
                                            <td style="padding:0;">
                                                <ul class="dndmfu_wc_file_list">
                                                    <?php foreach( $files as $index => $file ) : ?>
                                                        <?php
                                                            $file_type =  wp_check_filetype( $file['path'] );
                                                            $image = ( $fn->dndmfu_wc_is_image( 'image', $file['path'] ) ? $file['url'] : wp_mime_type_icon( $file_type['type'] ) );
                                                        ?>
                                                        <li class="file-type-<?php echo ( $fn->dndmfu_wc_is_image( 'image', $file['path'] ) ? 'image': 'not-image' ); ?>">
                                                            <a href="<?php echo $file['url']; ?>" title="<?php echo wp_basename( $file['url'] ); ?>">
                                                                <img src="<?php echo $image ?>" style="height:64px;" />
                                                                <div><?php echo wp_basename( $file['url'] ); ?></div>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php
            }
        }

		/**
		* Update meta data & move files to /Order directory.
		*/

		public function dndmfu_wc_checkout_update_order_meta( $order_id, $data ) {
            global $wpdb;

			// Get products
			$cart_items = WC()->cart->get_cart();

			// cart item data
			$files_upload = array();

			// Get only uploaded files.
			if( $cart_items ) {
				foreach( $cart_items as $hash => $cart ) {
					if( isset( $cart['dnd-wc-file-upload'] ) ) {
						$product_id = $cart['product_id'];
						$files_upload[$hash] = array( 'id' => $product_id , 'files' => $this->fn->dndmfu_wc_get_files( $cart['dnd-wc-file-upload'], true ) );
					}
				}
			}
			
			// Get newly created folder order
			$order_path = $this->order_dir( $order_id );

			// hold the final files of meta data
			$order_files = array();
			$raw_files = array();
			
			// Move files
			if( count( $files_upload ) > 0 && false !== $order_path ) {
				
				// Assign new item files
				$file_items = array();
				$raw_items = array();
				
				// Loop files
				foreach( $files_upload as $hash => $files ) {
					
					// Product ID
					$id = (int)$files['id'];
					
					// Make sure we have files
					if( isset( $files['files'] ) && count( $files['files'] ) > 0 ) {
						foreach( $files['files'] as $index => $file ) {

							// Convert url format to DIR
							$file_path = $this->fn->convert_url( $file );

							// Begin to move files
							$new_file = $this->move_files( $file_path, $order_path . wp_basename( $file ) );

							if( $new_file && count( $new_file ) > 0 && isset( $new_file['url'] ) ) {

								// Extract file info
								$thumbnail = pathinfo( $new_file['url'] );

								// get the name & extension
								$name = $thumbnail['filename'].'-100x100.';
								$ext = strtolower( $thumbnail['extension'] );

								// default url - file (mime type used by wordpress)
                                $file_type = wp_check_filetype( $new_file['url'] );
                                $thumbnail_url = '<img title"'. wp_basename( $new_file ) .'" src="'. wp_mime_type_icon( $file_type['type'] ) .'" width="40" height="40" style="margin:0; padding:0;">';

								// If there's a thumbnail
								if( file_exists( dirname($order_path) .'/thumbnails/'. $name . $ext ) ) {
									$thumbnail = $this->fn->convert_url( dirname( $order_path ) .'/thumbnails/'. $name . $ext, true );
									$thumbnail_url = sprintf('<img width="40" title="'.wp_basename( $new_file ).'" height="40" style="margin:0; padding:0;" src="%s"/>', $thumbnail );
								}

								// Get thumbnail & file URL
								$file_items[ $id ][ $hash ][] = sprintf('<a href="%s">%s</a>', esc_url( $new_file['url'] ) , $thumbnail_url );

								// Raw files
								$raw_items[ $id ][ $hash ][] = esc_url( $new_file['url'] );
							}

						}
					}

					// Combine files & wrap with html tags
					if( isset( $file_items[ $id ] ) ) {
						$order_files[ $id ][ $hash]  = sprintf( '<p class="dndmfu_wc_files order-dndmfu-wc-items" style="clear:both;">%s</p>', implode(' ', $file_items[ $id ][ $hash ] ) );
						$raw_files[ $id ][ $hash ] = $raw_items[ $id ][ $hash ];
					}
				}
			}

			// Update order meta data
			if( $order_files && count( $order_files ) > 0 ) {
				$order = wc_get_order( $order_id );
				foreach( $order->get_items() as $item_id => $item ){

					// Get product id
					$product_id = $item->get_product_id();
					
					// Get hash key
					$hash = $item->get_meta( '_dndmfu_key' );

					// Add item data
					if( $hash && isset( $order_files[ $product_id ] ) ) {

						// Add meta data
						if( isset( $order_files[ $product_id ][ $hash ] ) ) {

                            // Get files
                            $files = $order_files[ $product_id ][ $hash ];
                            
                            // If zip file option
                            if( get_option('drag_n_drop_zip_files') == 'yes' && isset( $raw_files[ $product_id ][ $hash ] ) ) {
                                if( count( $raw_files[ $product_id ][ $hash ] ) > 0 ) {
                                    if( $zip = $this->fn->zip_files( $raw_files[ $product_id ][ $hash ] ) ) {
                                        $files = sprintf('<a href="%s">%s</a>', $zip , wp_basename( $zip ) );
                                    }
                                }
                            }

                            // Save meta data
							$item->add_meta_data(
								$this->fn->order_item_title(),
								$files
							);
						}

                        // For PDF (Count Total Page)
                        if( get_option('drag_n_drop_count_pdf') == 'yes' ) {
                            
                            $details = array();
                            $display_text = get_option('wc_drag_n_drop_pdf_display_text') ? get_option('wc_drag_n_drop_pdf_display_text') : '%filename (Total Pages: %pagecount)';
                            
                            // Get meta keys
                            if( get_option('drag_n_drop_count_pdf') == 'yes' ) {
                                $data_file = $item->get_meta('_dndmfu_pdf_details');

                                if( $data_file ) {
                                    // Get unique key/index/progressbar id
                                    foreach( $data_file as $key => $file ) {
                                        $type = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );
                                        if( $type !== 'pdf' ) {
                                            continue;
                                        }
                                        $data = $this->fn->dndmfu_get_details( $key, $product_id, 'details' ); // get file details query
                                        $details[] = str_replace( array('%filename','%pagecount'), array( wp_basename( $data['file'] ), $data['total_pages'] ), $display_text );
                                    }
                                }

                                if( count( $details ) > 0 ) {
                                    $item->add_meta_data(
                                        apply_filters('dndmfu_wc_pdf_label', 'PDF Details'),
                                        '<p style="clear:both; display: block;" class="dndmfu-wc-pdf-details">'. implode('<br>', $details ) .'</p>'
                                    );
                                }
                            }
                        }

						//Add file counter
						if( isset( $raw_files[ $product_id ][ $hash ] ) ) {
							$item->add_meta_data(
								'_dndmfu_wc_files',
								maybe_serialize( array( 'total' => count( $raw_files[ $product_id ][ $hash ] ), 'files' => $raw_files[ $product_id ][ $hash ] ) ),
								true
							);
						}

						//Save new meta
						$item->save();
					}
				}
			}
		}

		/**
		* Add meta data after creating an order.
		*/

		public function order_dir( $order_id ) {

			// get upload folder option
			$order_path = trim( get_option('drag_n_drop_upload_folder' ) );
			$order = wc_get_order( $order_id );
			$new_name = '';
			$wc_files = array();

			// get parent dir
			$order_path_dir = trailingslashit( $this->fn->dndmfu_wc_dir('basedir') );

			if( $order_path ) {

				// extract tags
				preg_match_all( '/\{(.*?)\}/', $order_path, $matches ); // $matches[0] = {file_name}, $matches[1] = field_name

				// Get matches
				$matches_1 = $matches[1];
				$matches_0 = $matches[0];

				if( count( $matches_1 ) > 0 ) {

					// Loop & extract filename pattern.
					foreach( $matches_1 as $index => $name ) {
						$pattern = $matches_0[ $index ];
						if( $name == 'order_no' ) {
							$new_name = $order->get_order_number();
						}elseif( $name == 'name' ) {
							$new_name = $order->get_billing_first_name();
						}elseif( $name == 'customer_id' ) {
							$new_name = $order->get_user_id();
						}else {
							$new_name = $this->fn->tags( $name );
						}
						// Replace {pattern} to actual values
						$order_path = str_replace( $pattern, $new_name, $order_path );
					}

				}

			}

			// Clean path
			preg_replace('/[^A-Za-z0-9\-]/', '', $order_path );

			// Default order DIR
			if( empty( $new_name ) ) {
				$order_path = 'Order-' . $order_id;
			}

			// Concat base_dir + new order dir
			$order_path_dir = $order_path_dir . $order_path;

			// Finally create the new DIR
			$order_dir = $this->fn->dndmfu_wc_dir_setup( $order_path_dir, true );

			if( $order_dir ) {
				return trailingslashit( $order_dir );
			}

			return false;
		}

		/**
		* Move files to a new directory
		*/

		public function move_files( $from_dir, $to_dir ) {

			if( ! $to_dir || ! $from_dir ) {
				return;
			}

			$new_dir = null;

			// move files from /tmp folder
			if( rename( $from_dir, $to_dir ) ) {
				// Get only the filename
				$new_dir = array(
					'path'	=>	$to_dir,
					'url'	=>	$this->fn->convert_url( $to_dir, true )
				);
			}

			return $new_dir;
		}

		/**
		* Hide item meta data
		*/

		public function dndmfu_wc_hidden_order_itemmeta( $fields ) {
			$fields[] = '_dndmfu_wc_files';
			$fields[] = '_dndmfu_key';
            $fields[] = '_dndmfu_pdf_details';
			return $fields;
		}

        /**
		* Add email order meta
		*/

        public function dndmfu_wc_add_email_order_meta( $order, $sent_to_admin, $plain_text, $email ) {
            $order_id = $order->get_order_number();
            $fn = DNDMFU_WC_PRO_FUNCTIONS::get_instance();
            $files = get_post_meta( $order_id, '_dndmfu_order_files', true );
            if( ! $files ) {
                return;
            }
        ?>
            <h2><?php echo $this->fn->order_item_title(); ?></h2>
            <table cellspacing="0" cellpadding="0" border="0" style="width:100%;vertical-align:top;margin-bottom:40px;padding:0">
                <tbody>
                    <tr>
                        <td class="td" style="vertical-align:middle;">
                            <table cellspacing="0" cellpadding="0" border="0" style="width:100%; vertical-align:top; padding:0;">
                                <tbody>
                                    <tr valign="top">
                                        <?php foreach( $files as $index => $file ) : ?>
                                            <?php
                                                $file_type =  wp_check_filetype( $file['path'] );
                                                $image = ( $fn->dndmfu_wc_is_image( 'image', $file['path'] ) ? $file['url'] : wp_mime_type_icon( $file_type['type'] ) );
                                                echo ( $index > 1 && $index % 4 == 0 ? '</tr><tr valign="top">' : '' );
                                            ?>
                                            <td class="td" width="25%" style="width:25%; vertical-align:middle;">
                                                <a href="<?php echo $file['url']; ?>" title="<?php echo wp_basename( $file['url'] ); ?>">
                                                    <?php if( $plain_text === false  ) : ?>
                                                        <img src="<?php echo $image ?>" width="48" stlye="width:48px;" />
                                                        <div style="font-size:10px;"><?php echo substr( wp_basename( $file['url'] ), 0, 20 ); ?></div>
                                                    <?php else : ?>
                                                        <span><?php echo wp_basename( $file['url'] ); ?></span>
                                                    <?php endif; ?>
                                                </a>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php
        }

		/**
		* Calculate Fees
		*/

		public function dndmfu_wc_calculate_fees() {

			if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
				return;
			}

            // If uploader in checkout page.
            if( get_option('show_in_dnd_file_uploader_in', true) == 'checkout' ) {
                
                // Get upload field name
                $file_upload = $this->dndmfu_wc_get_filename();
                
                // Option Charge Label
                $cart_fee_label = ( get_option( 'drag_n_drop_cart_fee_label' ) ? get_option( 'drag_n_drop_cart_fee_label' ) : 'Upload Charges' );

                // Get fees
                $fees = WC()->session->get( 'wcdnd-mdu-'. $file_upload );

                // Is taxable
                $is_taxable = ( get_option('drag_n_drop_is_fee_taxable') ? true : false );

                // Add aditional cost
                if( $fees ) {
                    WC()->cart->add_fee( $cart_fee_label, $fees, $is_taxable , '' );
                }

                return;
            }

			// Get products
			$products = WC()->cart->get_cart_contents();

             // PDF name
            $pdf_name = array();

			// Counter
			$amount = array();

			if( $products ) {
				foreach( $products as $index => $product ) {
                     
                    // Get product id
                    $product_id = $product['product_id'];

                    // Product Quantity
                    $quantity = $product['quantity'];

                    // PDF total page
                    $pdf_total_pages = 0;

					// Calculate fees ( If there's file upload )
					if( isset( $product['dnd-wc-file-upload'] ) && count( $product['dnd-wc-file-upload'] ) > 0 ) {
                        
                        // Count all files
                        $total_files = count( $product['dnd-wc-file-upload'] );

                        // Get files data - from cart product
                        $pdf_details = $product['dnd-wc-file-upload'];

                        // PDF details
                        $pdf_info = array();

                        // For PDF only
                        foreach( $pdf_details as $index_key => $pdf_file ) {
                            if( strtolower( pathinfo( $pdf_file, PATHINFO_EXTENSION ) ) == 'pdf' ) {
                                if( get_option('drag_n_drop_count_pdf') == 'yes' ) {
                                    $details = $this->fn->dndmfu_get_details( $index_key, $product_id, 'details' );
                                    $pdf_info[$product_id][$index][] = ( isset( $details['file'] ) ? esc_html( $details['file'] ) : '' );
                                    $pdf_total_pages += (int)$details['total_pages'];
                                }
                            }
                        }

                        // Get PDF name
                        if( isset( $pdf_info[$product_id][$index] ) ) {
                            $pdf_name[$product_id][] = $pdf_info[$product_id][$index];
                        }

                        // Get the fees of pdf file based on pdf_total_pages
                        if( $pdf_total_pages > 0){
                            $total_amount_fee = $this->add_fees( $pdf_total_pages, $product_id, true );
                        }else{
                            $total_amount_fee = $this->add_fees( $total_files, $product_id );
                        }

                        // Multiply if quantiy is more than 1
                        $total_amount_fee = ( $quantity > 1 ? ( $total_amount_fee * $quantity ) : $total_amount_fee );

                        // Get the amount and assign to product id
                        if( $total_amount_fee > 0 ) {
                            
                            // Use pdf total pages or else default total files upload
                           // $total_files = ( $pdf_total_pages > 0 ? $quantity : $total_files );
                            
                            // Default fees & file count
                            $args = array(
                                'fee'   =>  $total_amount_fee,
                                'count' =>  $total_files,
                                'qty'   =>  $quantity
                            );

                            // For pdf only
                            if( $pdf_total_pages > 0 ) {
                                $args['total_pages'] = $pdf_total_pages;
                            }
                            
                            // Sett the amount & fees
						    $amount[$product_id][] = $args;
						}
						
					}else{
                        if( ! get_post_meta( $product_id, 'disable_dnd_file_upload_wc', true ) && $this->show_uploader( $product_id ) ) {
                            $amount[$product_id][] = array( 'fee' => $this->add_fees( 0, $product_id ), 'count' => 0 );    
                        }
                    }
				}
			}

			// Add custom fees
			if( $amount && $amount > 0 ) {
				foreach( $amount as $id => $data ) {
					$amount = 0;
					$count = 0;
					if( count( $data ) > 1 ) {
						$counter = 1;
						foreach( $data as $index => $fees ) {
                            $data['qty'] = ( isset( $fees['qty'] ) ? $fees['qty'] : '' );
                            $data['total_pages'] = ( isset( $fees['total_pages'] ) ? $fees['total_pages'] : '' );
                            $data['file_name'] = ( isset( $pdf_name[ $id ][ $index ] ) && count( $pdf_name[ $id ][ $index ] ) > 1 ? implode( ', ', $pdf_name[ $id ][ $index ] ) : $pdf_name[ $id ][$index][0] );
							if( isset( $fees['fee'] ) ) {
								if( get_option('drag_n_drop_combine_product_fees' ) ) {
									$amount += $fees['fee'];
									$count += $fees['count'];
								}else{
									self::display_fee( $fees['fee'], $fees['count'], $id, $counter++, $data );
								}
							}
						}
						if( $amount && get_option('drag_n_drop_combine_product_fees' ) ) {
							self::display_fee( $amount, $count, $id, '', $data );
						}
					}else {
                        $data['qty'] = ( isset( $data[0]['qty'] ) ? $data[0]['qty'] : '' );
                        $data['total_pages'] = ( isset( $data[0]['total_pages'] ) ? $data[0]['total_pages'] : '' );
                        $data['file_name'] = ( isset( $pdf_name[ $id ][0] ) ? current( $pdf_name[ $id ][0] ) : '' );
						self::display_fee( $data[0]['fee'], $data[0]['count'], $id, '', $data );
					}
				}
			}


		}

		/**
		* Display Fees
		*/

		public static function display_fee( $amount, $count, $id, $counter = false, $data = array() ) {

			if( ! $amount ) {
				return;
			}

			// Get product object
			$product = wc_get_product( $id );
            
			// is fee is taxable or not?
			$is_taxable = ( get_option('drag_n_drop_is_fee_taxable') ? true : false );

            // Filename of PDF
            $file_name = $data['file_name'];

            // Pdf total pages
            $total_pages = $data['total_pages'];

            // Pdf total pages
            $quantity = $data['qty'];

			// Cart fee label
			$cart_fee_label = ( get_option( 'drag_n_drop_cart_fee_label' ) ? get_option( 'drag_n_drop_cart_fee_label' ) : __('[%count files] Upload Fee for %product_title','dnd-file-upload-wc') );

			// replace tags with dynamic values
			$label = str_replace( array('%product_title','%quantity','%count','%pagecount','%filename'), array( $product->get_name(),$quantity, $count, $total_pages, $file_name ), $cart_fee_label );

            //if( ! )

			// Add aditional cost
			WC()->cart->add_fee( ( $counter ? $label .' ('. $counter .')' : $label ), $amount, $is_taxable , '' );
		}

		/**
		* Add custom fees
		*/

		public function add_fees( $file_count, $product_id = null, $count_pdf = false) {
			
            // Get option fees
            $fees = (array)get_option( 'drag_n_drop_additional_fees' );
			$amount = 0;
            
			if( $fees && count( $fees ) > 0 ) {
				foreach( $fees as $key => $fee ) {
                    
                    // Skip total page count
                    if( ! $count_pdf && $fee['files'] != 'total_files' ) {
                        continue;
                    }
                    
                    // Count pdf pages
                    if( $count_pdf && $fee['files'] != 'total_page' ){
                        continue;
                    }

                    // Apply to specific products
                    if( isset( $fee['apply_to'] ) && $fee['apply_to'] != '' ) {
                        $apply_to = preg_replace('/ /','', $fee['apply_to']);
                        $conditions = strpos( $apply_to, ',') === false ? (array)$apply_to : explode( ',', $apply_to );
                        if( ! $this->check_exists( $conditions, $product_id ) ) {
                            continue;
                        }
                    }

                    //$condition = $this->fn->condition( $file_count, $fee['operator'], $fee['number'] );
                    //echo $fee['amount'] .' = ('. $file_count.' '. $fee['operator'] . ' '. $fee['number'] .' ) = '. $product_id.' '. var_dump($condition) .'<br>';

                    // Check condition true / false
                    if( ! $this->fn->condition( $file_count, $fee['operator'], $fee['number'] ) ) {
                        continue;
                    }

                    // Get & set the amount (multiply or addition)
                    if(  isset( $fee['operations'] ) && $fee['operations'] == '*') {
                        $amount = (double)$fee['amount'] * $file_count;
                    }else {
                        $amount = (double)$fee['amount'];
                    }
				}
			}

			return $amount;
		}

        /**
		* Check if there's match for product or category terms
		*/

        public function check_exists( $conditions, $product_id ) {
           
            $match = false;
            $terms = null;

            // Bail early
            if( ! $conditions ) {
                return false;
            }

            // Get terms
            foreach( $conditions as $term ) {
                if( ! is_numeric( $term ) ) {
                    $terms[] = preg_replace('/[0-9]+/', '', $term);
                }
            }

            // Check for product id & category
            if( in_array( $product_id, $conditions ) || ( $terms && has_term( $terms, 'product_cat', $product_id ) ) ) {
                $match = true;
            }

            return $match;
        }

		/**
		* Add custom cart item data - Email
		*/

		// public function dndmfu_wc_order_item_name( $product_name, $item ) {
			// if( isset( $item['dnd-wc-file-upload'] ) ) {
				// $product_name .= sprintf( '<span>%s</span><br><div style="clear:both; display:block;">%s</div>', $this->fn->order_item_title(), '<p class="dndmfu_wc_files">'. implode( " ", $item['dnd-wc-file-upload'] ) . '</p>' );
			// }
			// return $product_name;
		// }

		/**
		* Cart Quantity Update - When reaches 0 ( Delete also the files )
		*/

		public function dndmfu_wc_update_cart_validation( $passed, $cart_key, $cart_item, $quantity ) {

			if( $quantity === 0 && isset( $cart_item['dnd-wc-file-upload'] ) ) {
				$dir = $this->fn->dndmfu_wc_dir(false);
				$tmp_folder = trailingslashit( $dir->_options['tmp_folder'] );
				$cart_files = $cart_item['dnd-wc-file-upload'];
				if( $cart_files ) {
					foreach( $cart_files as $index_name => $file ) {
						$file = realpath( trailingslashit( $dir->wp_upload_dir['basedir'] ) . $tmp_folder . wp_basename( $file ) );
						if( file_exists( $file ) && ! is_dir( $file ) ) {
							$this->fn->dndmfu_wc_delete_file( $file ); // Delete files from directory
                            $this->fn->dndmfu_delete_details( $index_name ); // Delete file details from db (if pdf settings)
						}
					}
				}
			}

			return $passed;
		}

		/**
		* Remove files - from remove cart contents ( only items - deleted from the cart ) - template_redirect
		*/

		public function dndmfu_wc_remove_files_from_contents() {
			if ( is_admin() || 'GET' != $_SERVER['REQUEST_METHOD'] || is_robots() || is_feed() || is_trackback() ) {
				return;
			}

			// Get remove items from cart
			$items = WC()->cart->get_removed_cart_contents();
			$dir = $this->fn->dndmfu_wc_dir(false);

			// Get tmp folder & base dir path
			$base_dir = trailingslashit( $dir->wp_upload_dir['basedir'] );
			$tmp_folder = trailingslashit( $dir->_options['tmp_folder'] );

			// Get files upload only.
			if( $items ) {
				foreach( $items as $item ) {
                    $product_id = $item['product_id'];
					if( isset( $item['dnd-wc-file-upload'] ) && count( $item['dnd-wc-file-upload'] ) > 0 ) {
						foreach( $item['dnd-wc-file-upload'] as $index_name => $_file ) {
							$cart_files = realpath( $base_dir . $tmp_folder . $_file );
							if( file_exists( $cart_files ) && ! is_dir( $cart_files )) {
								$seconds = apply_filters('dndmfu_wc_time_before_cart_deletion', 1200 ); // 20 minutes
								$uploaded_time = @filemtime( $cart_files );
								if( $uploaded_time && time() < $uploaded_time + absint( $seconds ) ) { //modified > current_time
									continue;
								}
								$this->fn->dndmfu_wc_delete_file( $cart_files ); // Delete files from directory
                                $this->fn->dndmfu_delete_details( $index_name ); // Delete file details from db (if pdf settings)
							}
						}
					}
				}
			}
		}

        /**
		* Custom Fee if uploader is checkout
		*/

        public function dndmfu_wc_order_review( $posted_data ) {
            if( get_option('show_in_dnd_file_uploader_in', true) == 'checkout' ) {
                
                // Default fee
                $fees = 0;
                
                // Parse string
                wp_parse_str( $posted_data, $post );

                // Get uploader name
                $file_upload = $this->dndmfu_wc_get_filename();
                
                // Get upload post data
                $files = ( isset( $post[ $file_upload ] ) ? array_map( 'sanitize_text_field', $post[ $file_upload ] ) : null );
                
                // Compute Fees
                if( ! is_null( $files ) ) {
                    if( $this->add_fees( count( $files ) ) > 0 ) {
                        $fees = $this->add_fees( count( $files ) );
                    }
                }else {
                    $fees = $this->add_fees( 0 );
                }

                // Set fees in session
                if( $fees ) {
                    WC()->session->set( 'wcdnd-mdu-'. $file_upload, $fees );
                }else {
                    WC()->session->__unset( 'wcdnd-mdu-'. $file_upload );
                }
            }
        }
        
        /**
		* Clear session after thank you page
		*/

        public function dndmfu_wc_order_thank_you( $order_id ) {
           
            if ( ! $order_id ) {
                return;
            }

            $order = wc_get_order( $order_id );

			foreach( $order->get_items() as $item_id => $item ){
                $file_index = $item->get_meta('_dndmfu_pdf_details');
                if( $file_index ) {
                    foreach( $file_index as $file_key => $file ) {
                        $this->fn->dndmfu_delete_details( $file_key );
                    }
                }
            }
        }
       
	}
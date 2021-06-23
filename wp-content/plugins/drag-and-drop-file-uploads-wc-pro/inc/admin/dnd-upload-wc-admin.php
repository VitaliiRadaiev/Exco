<?php

	/**
	* @Description : Custom admin hooks
	* @Package : PRO Drag & Drop Multiple File Upload - WooCommerce
	* @Author : CodeDropz
	*/

    add_action( 'admin_enqueue_scripts', 'dndmfu_wc_enque_admin_scripts' );

    function dndmfu_wc_enque_admin_scripts() {
        if( get_option('show_in_dnd_file_uploader_in') == 'checkout' ) {
            wp_enqueue_style('media-views');
        }
    }

	// Delete files when order is completely deleted from trash.
	add_action('woocommerce_delete_order_items', 'dndmfu_delete_order');

	function dndmfu_delete_order( $order_id ) {
		$fn = DNDMFU_WC_PRO_FUNCTIONS::get_instance();

        // Delete files from order (Post Meta) - uploader in checkout
        if( get_option('show_in_dnd_file_uploader_in') == 'checkout' ) {
            $order_files = get_post_meta( $order_id, '_dndmfu_order_files', true );
            if( $order_files ) {
                foreach( $order_files as $file ) {
                    $fn->dndmfu_wc_delete_file( $file['path'] );
                }
                delete_post_meta( $order_id, '_dndmfu_order_files' );
            }
        }

        // Remove files from order item meta - uploader in product single page
		$order = wc_get_order( $order_id );
		foreach( $order->get_items() as $item_id => $item ){
			$files = ( $item->get_meta('_dndmfu_wc_files') ? maybe_unserialize( $item->get_meta('_dndmfu_wc_files') ) : null );
			if( $files && isset( $files['files'] ) ) {
				foreach( $files['files'] as $file ) {
					$fn->dndmfu_wc_delete_file( $fn::convert_url( $file ) ); // convert url to dir & remove file
				}
				rmdir( $fn->dndmfu_wc_dir() .'/'. wp_basename( dirname( $files['files'][0] ) ) ); // remove empty dir
			}
		}
	}

	// Add new column on order
	add_filter('manage_shop_order_posts_columns','dndmfu_post_type_column', 100, 2);

	function dndmfu_post_type_column( $columns ) {
		$columns['dndmfu-files'] = __('Total Files','dnd-file-upload-wc');
		return $columns;
	}

	// Add value to custom column
	add_action( 'manage_shop_order_posts_custom_column', 'dndmfu_fill_post_type_column', 10, 2 );

	function dndmfu_fill_post_type_column( $column, $order_id ) {
		if( $column == 'dndmfu-files' ){
			
            // Get order data structure
            $order = wc_get_order( $order_id );
			$total_files = 0;
            
            // If uploader in checkout (get only the post meta files)
            if( get_option('show_in_dnd_file_uploader_in') == 'checkout' ) {
                $order_files = get_post_meta( $order_id, '_dndmfu_order_files', true );
                if( $order_files ) {
                    echo count( $order_files );
                }
                return;
            }

            // If uploader in single product page (get order meta items)
			foreach( $order->get_items() as  $item ) {
				if( $files_meta = $item->get_meta( '_dndmfu_wc_files' ) ) {
					$files = maybe_unserialize( $files_meta );
					if( $files && isset( $files['total'] ) ) {
						$total_files += $files['total'];
					}
				}
			}

			if( $total_files > 0 ) {
				echo $total_files;
			}
		}
	}
	// Add bulk action
	add_filter( 'bulk_actions-edit-shop_order', 'dndmfu_bulk_actions_wc_order', 20, 1 );

	function dndmfu_bulk_actions_wc_order( $actions ) {
		if( get_option('drag_n_drop_file_rejection') == '' ) {
			return $actions;
		}
		$actions['dndmfu-delete-files'] = __( 'Remove / Reject Files', 'dnd-file-upload-wc' );
		return $actions;
	}

	// process action from selected orders
	add_filter( 'handle_bulk_actions-edit-shop_order', 'dndmfu_process_shop_order', 10, 3 );

	function dndmfu_process_shop_order( $redirect_to, $action, $post_ids ) {
		
        if ( $action !== 'dndmfu-delete-files' ) {
			return $redirect_to; // Exit
		}

		// url of files will be store here
		$wc_files = array();
		$processed_ids =  0;

        // Get custom function object
        $fn = DNDMFU_WC_PRO_FUNCTIONS::get_instance();

		// Extract meta_data - get only the files
		foreach ( $post_ids as $order_id ) {
			// Get order Data Object
			$order = wc_get_order( $order_id );

            // Delete post meta if file upload in checkout
            if( get_option('show_in_dnd_file_uploader_in') == 'checkout' ) {
                $order_files = get_post_meta( $order_id, '_dndmfu_order_files', true );
                if( $order_files ) {
                    foreach( $order_files as $file ) {
                        $fn->dndmfu_wc_delete_file( $file['path'] );
                        $processed_ids++;
                    }
                    delete_post_meta( $order_id, '_dndmfu_order_files' );
                }
            }

            // Delete order item meta - if uploader in single product page.
			foreach( $order->get_items() as $item_id => $item ) {
				if( $files_meta = $item->get_meta( '_dndmfu_wc_files' ) ) {
					$files = maybe_unserialize( $files_meta );
					if( $files && isset( $files['files'] ) ) {
						$wc_files[ $item_id ] = $files['files'];
					}
				}
			}
		}

		// Remove files
		if( $wc_files && count( $wc_files ) > 0 ){
			foreach( $wc_files as $item_id => $files ) {

				// Remove files
				foreach( $files as $file ) {
					$file_path = $fn::convert_url( $file );
					$fn->dndmfu_wc_delete_file( $file_path );
					$processed_ids++;
				}

				// Delete item meta
				wc_delete_order_item_meta( $item_id , '_dndmfu_wc_files');
				wc_update_order_item_meta( $item_id , $fn->order_item_title(), 'Removed / Rejected' );

				// remove empty dir
				rmdir( $fn->dndmfu_wc_dir() .'/'. wp_basename( dirname( reset($files) ) ) );
			}
		}

		return $redirect_to = add_query_arg( array(
			'dndmfu-delete-files' 	=> '1',
			'files_deleted' 		=> $processed_ids
		), $redirect_to );
	}

	// Display notice
	add_action( 'admin_notices', 'dndmfu_bulk_action_admin_notice' );

	function dndmfu_bulk_action_admin_notice() {
		if ( empty( $_REQUEST['dndmfu-delete-files'] ) ) return; // Exit
		$count = intval( $_REQUEST['files_deleted'] );
		printf( '<div id="message" class="updated fade"><p>' .
			_n( '%s has been deleted.',
			'%s has been deleted.',
			$count,
			'dndmfu-delete-files'
		) . '</p></div>', $count );
	}

    // Add custom metabox on order details
    add_action( 'add_meta_boxes', 'dndmfu_wc_meta_box' );

    function dndmfu_wc_meta_box() {
        $show_uploader_in = get_option('show_in_dnd_file_uploader_in');
        if( $show_uploader_in == 'checkout' ) {
            add_meta_box( 'dndmfu-wc-files-upload', 'Files Upload', 'dndmfu_wc_admin_order_upload_box', 'shop_order','side','low' );
        }
    }

    // Metabox callback
    function dndmfu_wc_admin_order_upload_box( $order, $meta_box ) {
        $order_files = get_post_meta( $order->ID, '_dndmfu_order_files', true );
        $fn = DNDMFU_WC_PRO_FUNCTIONS::get_instance();
    ?>
        <div class="media-frame mode-grid">
            <div class="media-frame-content" data-columns="2">
                <div class="attachments-browser">
                    <?php if( $order_files ) : ?>
                        <ul class="attachments">
                            <?php foreach( $order_files as $file ) : ?>
                                <?php
                                    $file_type =  wp_check_filetype( $file['path'] );
                                    $image = ( $fn->dndmfu_wc_is_image( 'image', $file['path'] ) ? $file['url'] : wp_mime_type_icon( $file_type['type'] ) );
                                ?>
                                <li class="attachment">
                                    <div class="attachment-preview landscape">
                                        <div title="<?php echo wp_basename( $file['url'] ); ?>" class="thumbnail" onclick="location.href = '<?php echo $file['url']; ?>';">
                                            <div class="centered">
                                                <img src="<?php echo $image; ?>">
                                            </div>
                                            <?php if( false == $fn->dndmfu_wc_is_image( 'image', $file['path'] ) ) : ?>
                                                <div class="filename">
                                                    <div style="font-size:10px;"><?php echo substr( wp_basename( $file['url'] ), 0, 19 ).'...(.'. $file_type['ext'] .')'; ?></div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p>No files</p>
                    <?php endif; ?>
            </div>
            </div>
        </div>
    <?php
    }
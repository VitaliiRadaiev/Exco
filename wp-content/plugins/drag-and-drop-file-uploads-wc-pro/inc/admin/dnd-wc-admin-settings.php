<?php

	/**
	* @Description : WC Settings Hooks
	* @Package : PRO Drag & Drop Multiple File Upload - WooCommerce
	* @Author : CodeDropz
	*/

	if ( ! defined( 'ABSPATH' ) || ! defined('DNDMFU_WC_PRO') ) {
		exit;
	}

	class DNDMFU_WC_Settings extends WC_Settings_Page {

		public function __construct() {

			$this->id    = 'dnd-wc-file-uploads';
			$this->label = __( 'File Uploads', 'dnd-file-upload-wc' );

			add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
			add_action( 'woocommerce_settings_' . $this->id, array( $this, 'output' ) );
			add_action( 'woocommerce_settings_save_' . $this->id, array( $this, 'save' ) );
			add_action( 'woocommerce_sections_' . $this->id, array( $this, 'output_sections' ) );

			add_action('admin_footer', array( $this, 'admin_footer' ));

		}

		/**
		* Add Sections
		*/

		public function get_sections() {
			$sections = array(
				''         			=> __( 'Upload Settings', 'dnd-file-upload-wc' ),
                'style'             => __( 'Text & Style','dnd-file-upload-wc' ),
				'error-message' 	=> __( 'Error Message', 'dnd-file-upload-wc' ),
				'add-fees' 		    => __( 'Additional Fees', 'dnd-file-upload-wc' ),
                'pdf-settings'      => __( 'PDF','dnd-file-upload-wc' )
			);
			return $sections;
		}

		/**
		* Output Sections
		*/

		public function output_sections() {
			global $current_section;

			$sections = $this->get_sections();

			if ( empty( $sections ) || 1 === sizeof( $sections ) ) {
				return;
			}

			echo '<ul class="subsubsub">';

			$array_keys = array_keys( $sections );

			foreach ( $sections as $id => $label ) {
				echo '<li><a href="' . admin_url( 'admin.php?page=wc-settings&tab=' . $this->id . '&section=' . sanitize_title( $id ) ) . '" class="' . ( $current_section == $id ? 'current' : '' ) . '">' . $label . '</a> ' . ( end( $array_keys ) == $id ? '' : '|' ) . ' </li>';
			}

			echo '</ul><br class="clear" />';
		}

		/**
		* Display - Custom Select Field
		*/

		public function admin_footer( $options ) {
			?>
			<script type="text/javascript">
				jQuery(document).ready(function($){

					// Hide & Show - Fields
					var dndmfu_wc_option = $('#show_in_dnd_file_uploader_if').val();
                    var dndmfu_wc_uploader_show = $('#show_in_dnd_file_uploader_in').val();

                    // Hide hidden row
					$('.dndmfu_wc_hidden').parents('tr').hide();
					
                    // Show uplaoder If
                    if( dndmfu_wc_option ) {
						$('[data-show-if="'+ dndmfu_wc_option +'"]').parents('tr').show();
					}

                    // Show uploader In
                    if( dndmfu_wc_uploader_show ) {
                        $('[data-table-show-if="'+ dndmfu_wc_uploader_show +'"]').parents('tr').show();
                    }

					// Repeater - Add Fees
					$(document).on("click", ".dndmfu-add-fees", function(e){
						e.preventDefault();
						var $row = $(this).parents('tr');
						var $row_item = $('#dndmfu-repeater-row-table').html().replace(/\{row\}/gi, $.now() );
						$($row_item).insertAfter( $row );
					});

					// Remove - Row item
					$(document).on("click", ".dndmfu-remove-row", function(e){
						e.preventDefault();
						if( $('tr[data-row]').length != 1 ) {
							$(this).parents('tr').remove();
						}
					});

				});

                // Show row conditional fields
                function dndcf7_wc_show_if( val , elem) {
                    jQuery('.dndmfu_wc_hidden['+ elem +']').parents('tr').hide();
					jQuery('['+ elem +'="'+ val +'"]').parents('tr').show();
                }
			</script>
			<style>
				.dndmfu-table-fees a { display:inline-block; margin:0 3px; outline:none; }
				.dndmfu-table-fees .dashicons {
					border-radius: 100%;
					width: 25px;
					height: 25px;
					line-height: 25px;
					color: #fff;
					font-size:16px;
				}
				.dndmfu-table-fees .dashicons.dashicons-plus-alt2 { background-color:#007cba; }
				.dndmfu-table-fees .dashicons.dashicons-minus { background-color:#656565; }
			</style>
			<?php
		}

		/**
		* Display - Create Fields
		*/

		public function get_settings( $current_section = '' ) {
			$upload_dir = wp_upload_dir();
			if( '' == $current_section ) {
				$settings = apply_filters(
					'dnd_wc_upload_settings',
						array(

							// Title - Heading
							array(
								'title' => 	__( 'Drag & Drop Uploader - Settings', 'dnd-file-upload-wc' ),
								'type'  => 	'title'
							),

							// Heading - 1
							array(
								'title' => 	__( 'Uploader Info', 'dnd-file-upload-wc' ),
								'type'  => 	'title',
								'id'	=>	'dnd_uploader_info'
							),

							array(
								'title'    		=> 	__( 'Drag & Drop Text', 'dnd-file-upload-wc' ),
								'id'       		=> 	'wc_drag_n_drop_text',
								'placeholder'	=>	'Drag & Drop Files Here',
								'type'     		=> 	'text'
							),

							array(
								'id'       		=> 	'wc_drag_n_drop_separator',
								'placeholder'	=>	'|',
								'type'     		=> 	'text'
							),

							array(
								'title'    		=> 	__( 'Browse Text', 'dnd-file-upload-wc' ),
								'id'       		=> 	'wc_drag_n_drop_browse_text',
								'placeholder'	=>	'Browse Text',
								'type'     		=> 	'text'
							),

							array(
								'title'    		=> 	__( 'File Upload Label', 'dnd-file-upload-wc' ),
								'id'       		=> 	'drag_n_drop_default_label',
								'desc'			=>	__('Display title/heading before file upload area.'),
								'placeholder'	=>	'Multiple File Uploads',
								'type'     		=> 	'text',
								'desc_tip'		=>	true
							),

							// End Heading - 1
							array(
								'type' => 'sectionend',
								'id'   => 'dnd_uploader_info',
							),

							// Heading - 3
							array(
								'title' => __( 'Upload Restriction - Options', 'dnd-file-upload-wc' ),
								'type'  => 'title',
								'id'	=>	'dnd_heading_3'
							),

							/* Required */
							array(
								'title'    => __( 'Required?', 'dnd-file-upload-wc' ),
								'desc'     => __( 'Yes, file upload is required.', 'dnd-file-upload-wc' ),
								'id'       => 'drag_n_drop_required',
								'default'  => 'no',
								'type'     => 'checkbox',
								'desc_tip' => false
							),

							/* Name */
							array(
								'title'    		=> 	__( 'Name', 'dnd-file-upload-wc' ),
								'id'       		=> 	'drag_n_drop_field_name',
								'placeholder'	=>	'upload-file-352',
								'desc'			=>	__( 'Change the name of file upload.' ),
								'type'     		=> 	'text',
								'desc_tip' 		=> true
							),

							/* Max File Size*/
							array(
								'title'    		=> 	__( 'Max File Size (Bytes)', 'dnd-file-upload-wc' ),
								'id'       		=> 	'drag_n_drop_file_size_limit',
								'placeholder'	=>	'10485760',
								'desc'			=>	__( 'Set file size limit for each file (default: 10MB)' ),
								'type'     		=> 	'text',
								'desc_tip' 		=> true
							),

							/* Max File Limit */
							array(
								'title'    		=> 	__( 'Max File Upload', 'dnd-file-upload-wc' ),
								'id'       		=> 	'drag_n_drop_max_file_upload',
								'placeholder'	=>	'10',
								'desc'			=>	__( 'Set maximum file upload limit. (default: 10)' ),
								'type'     		=> 	'text',
								'desc_tip' 		=> true
							),

							/* Min File Upload */
							array(
								'title'    		=> 	__( 'Min File Upload', 'dnd-file-upload-wc' ),
								'id'       		=> 	'drag_n_drop_min_file_upload',
								'desc'			=>	__( 'Set minimum file upload.' ),
								'type'     		=> 	'text',
								'desc_tip' 		=> true
							),

							/* Supported Types */
							array(
								'title'    		=> 	__( 'Supported File Types', 'dnd-file-upload-wc' ),
								'id'       		=> 	'drag_n_drop_support_file_upload',
								'placeholder'	=>	'jpg, jpeg, png, gif, svg',
								'desc'			=>	__( 'Enter supported File Types separated by comma.' ),
								'type'     		=> 	'text',
								'desc_tip' 		=> true
							),

                            /* Add To Cart Button */
                            array(
								'title'    		=> 	__( 'Cart Button', 'dnd-file-upload-wc' ),
								'id'       		=> 	'drag_n_drop_cart_btn',
								'placeholder'	=>	'.class, #id, button',
								'desc'			=>	__( 'Enter name, id, class of cart button' ),
								'type'     		=> 	'text',
								'desc_tip' 		=> true
							),

							// End Heading - 3
							array(
								'type' => 'sectionend',
								'id'   => 'dnd_heading_3',
							),

							// Heading - 4
							array(
								'title' => __( 'WooCommerce Options', 'dnd-file-upload-wc' ),
								'type'  => 'title',
								'id'	=>	'dnd_heading_4'
							),

							/* Show Uploader In */
							array(
								'title'   		=> __( 'Show Uploader In', 'dnd-file-upload-wc' ),
								'id'      		=> 'show_in_dnd_file_uploader_in',
								'type'			=> 'select',
								'class'    		=> 'wc-enhanced-select',
								'desc'			=> __( 'Select which page you want to show the uploader.','dnd-file-upload-wc' ),
								'options' 		=> array(
									'single-page'	=>	'Single - Product Page',
                                    'checkout'      =>  'Check Out - Page'
								),
                                'custom_attributes' => array(
									'onchange' 			=>	"dndcf7_wc_show_if(this.value, 'data-table-show-if')"
								),
								'default'   	=> 'single-page',
								'desc_tip'		=> true
							),

							array(
								'title'   		=> __( 'Show If', 'dnd-file-upload-wc' ),
								'id'      		=> 'show_in_dnd_file_uploader_if',
								'type'			=> 'select',
								'class'    		=> 'wc-enhanced-select',
								'custom_attributes' => array(
									'data-placeholder' 	=>	"Select",
									'onchange' 			=>	"dndcf7_wc_show_if(this.value, 'data-show-if')"
								),
								'options' 		=> array(
									'all'			=>	'All',
									'category'	=>	'Categories',
									'products'	=>	'Products',
									'tags'		=>	'Tags',
									'attributes'=>  'Attributes'
								)
							),

							// Categories
							array(
								'title'   		=> '',
								'id'      		=> 'show_in_dnd_file_uploader_option_category',
								'type'			=> 'multiselect',
								'custom_attributes' => array(
									'data-show-if'	 	=>	'category',
									'data-placeholder'	=>	'Select Category'
								),
								'class'    		=> 'wc-enhanced-select dndmfu_wc_hidden',
								'options' 		=> $this->get_options('category')
							),

							// Products
							array(
								'title'   		=> '',
								'id'      		=> 'show_in_dnd_file_uploader_option_products',
								'type'			=> 'multiselect',
								'custom_attributes' => array(
									'data-show-if'	 	=>	'products',
									'data-placeholder'	=>	'Select Products'
								),
								'class'    		=> 'wc-enhanced-select dndmfu_wc_hidden',
								'options' 		=> $this->get_options('products')
							),

							// Tags
							array(
								'title'   		=> '',
								'id'      		=> 'show_in_dnd_file_uploader_option_tags',
								'type'			=> 'multiselect',
								'custom_attributes' => array(
									'data-show-if'	 	=>	'tags',
									'data-placeholder'	=>	'Select Tags'
								),
								'class'    		=> 'wc-enhanced-select dndmfu_wc_hidden',
								'options' 		=> $this->get_options('tags')
							),

							// Attributes
							array(
								'title'   		=> '',
								'id'      		=> 'show_in_dnd_file_uploader_option_attributes',
								'type'			=> 'multiselect',
								'custom_attributes' => array(
									'data-show-if'	 	=>	'attributes',
									'data-placeholder'	=>	'Select Attributes'
								),
								'class'    		=> 'wc-enhanced-select dndmfu_wc_hidden',
								'options' 		=> $this->get_options('attributes')
							),


							/* Show Before */

                            /* On Single Page */
							array(
								'title'   		=> __( 'Show Before', 'dnd-file-upload-wc' ),
								'id'      		=> 'show_in_dnd_file_upload_after',
								'type'			=> 'select',
								'class'    		=> 'wc-enhanced-select dndmfu_wc_hidden',
								'desc'			=> __( 'Select which section to <br>display the uploader <br>(default: Add To Cart)','dnd-file-upload-wc' ),
								'options' 		=> array(
									'woocommerce_before_add_to_cart_form'	=>	'Add to Cart Form',
									'woocommerce_before_variations_form'	=>	'Variations Form',
									'woocommerce_before_add_to_cart_button'	=>	'Add to Cart Button',
									'woocommerce_before_single_variation'	=>	'Single Variation'
								),
                                'custom_attributes' => array(
									'data-table-show-if'    =>	'single-page'
								),
								'default'   	=> 'woocommerce_before_add_to_cart_button',
								'desc_tip'		=> true
							),

                            /* On Checkout */
                            array(
								'title'   		=> __( 'Show', 'dnd-file-upload-wc' ),
								'id'      		=> 'show_in_dnd_file_upload_checkout',
								'type'			=> 'select',
								'class'    		=> 'wc-enhanced-select dndmfu_wc_hidden',
								'desc'			=> __( 'Select which section to <br>display the uploader','dnd-file-upload-wc' ),
								'options' 		=> array(
									'woocommerce_after_checkout_shipping_form'	    =>	'After Checkout Shipping Form',
									'woocommerce_before_order_notes'	            =>	'Before Order Notes',
									'woocommerce_after_order_notes'	                =>	'After Order Notes',
									'woocommerce_checkout_after_customer_details'	=>	'After Customer Details',
                                    'woocommerce_checkout_before_order_review'	    =>	'Before Order Review',
                                    'woocommerce_review_order_before_cart_contents'	=>	'Before Cart Contents',
                                    'woocommerce_review_order_after_cart_contents'	=>	'After Cart Contents',
                                    'woocommerce_review_order_before_shipping'	    =>	'Before Shipping',
                                    'woocommerce_review_order_after_shipping'	    =>	'After Shipping',
                                    'woocommerce_review_order_before_order_total'	=>	'Before Order Total',
                                    'woocommerce_review_order_after_order_total'	=>	'After Order Total',
                                    'woocommerce_review_order_before_payment'	    =>	'Before Payment',
                                    'woocommerce_review_order_before_submit'	    =>	'Before Submit',
                                    'woocommerce_review_order_after_submit'	        =>	'After Submit',
                                    'woocommerce_review_order_after_payment'	    =>	'After Payment',
                                    'woocommerce_checkout_after_order_review'	    =>	'After Order Review',
                                    'woocommerce_after_checkout_form'	            =>	'After Checkout Form',
								),
                                'custom_attributes' => array(
									'data-table-show-if'    =>	'checkout'
								),
								'default'   	=> 'woocommerce_before_add_to_cart_button',
								'desc_tip'		=> true
							),

							// End Heading - 4
							array(
								'type' => 'sectionend',
								'id'   => 'dnd_heading_4',
							),

							// Heading - 5
							array(
								'title' => __( 'Pro - Additional Features', 'dnd-file-upload-wc' ),
								'type'  => 'title',
								'id'	=>	'dnd_heading_5'
							),

							/* Parallel Sequential */
							array(
								'title'    		=> 	__( 'Parallel / Sequential Upload', 'dnd-file-upload-wc' ),
								'id'       		=> 	'drag_n_drop_parallel_uploads',
								'placeholder'	=>	'2',
								'desc'			=>	__( 'Number of Files Simultaneously Upload. (default: 2)' ),
								'type'     		=> 	'text',
								'desc_tip' 		=> true
							),

							/* Chunks Upload */
							array(
								'title'    => __( 'Enable Chunks Upload', 'dnd-file-upload-wc' ),
								'desc'	   => __( 'Yes, Break large files into smaller Chunks.','dnd-file-upload-wc' ),
								'id'       => 'drag_n_drop_chunks_upload',
								'default'  => 'no',
								'type'     => 'checkbox'
							),

							/* Chunk Size */
							array(
								'title'    		=> 	__( 'Chunks Size (KB)', 'dnd-file-upload-wc' ),
								'id'       		=> 	'drag_n_drop_chunk_size',
								'placeholder'	=>	'10000',
								'desc'			=>	__( 'Define chunk size in KB. (default: 10000) equal to 10MB', 'dnd-file-upload-wc' ),
								'type'     		=> 	'text',
								'desc_tip' 		=> true
							),

							/* Max Total Size */
							array(
								'title'    		=> 	__( 'Max Total Size (MB)', 'dnd-file-upload-wc' ),
								'id'       		=> 	'drag_n_drop_max_total_size',
								'placeholder'	=>	'100MB',
								'desc'			=>	__( 'Set Total Max Size of all uploaded files. (default: 100MB)', 'dnd-file-upload-wc' ),
								'type'     		=> 	'text',
								'desc_tip' 		=> true
							),

							/* ZIP Files */
							array(
								'title'    => __( 'Zip Files', 'dnd-file-upload-wc' ),
								'id'       => 'drag_n_drop_zip_files',
								'default'  => 'no',
								'type'     => 'checkbox',
								'desc'	   => __( 'Yes', 'dnd-file-upload-wc' )
							),

							// End Heading - 5
							array(
								'type' => 'sectionend',
								'id'   => 'dnd_heading_5',
							),

							// Heading - 6
							array(
								'title' => __( 'Pro - Upload Directory & Filename', 'dnd-file-upload-wc' ),
								'type'  => 'title',
								'id'	=>	'dnd_heading_6'
							),

							// Change FileName
							array(
								'title'    			=> 	__( 'Change Filename', 'dnd-file-upload-wc' ),
								'id'       			=> 	'drag_n_drop_file_amend',
								'placeholder'		=>	'{filename} - {ip-address}',
								'desc'				=>	'Use ( - ) or ( _ ) separator',
								'type'     			=> 	'text',
								'desc_tip' 			=> 'Tags: {filename}, {username}, {user_id}, {ip_address}, {random}, {date}, {time}, {product_id}, {product_slug}, {sku}'
							),

							// Upload Folder
							array(
								'title'    			=> 	__( 'Upload Folder', 'dnd-file-upload-wc' ),
								'id'       			=> 	'drag_n_drop_upload_folder',
								'placeholder'		=>	'order-{order_no}',
								'type'     			=> 	'text',
								'desc_tip' 			=> 'Tags: {order_no}, {random}, {date}, {time}, {name}, {customer_id}' //@todo : {name}
							),

							// Upload Directory
							array(
								'title'    			=> 	__( 'Upload Directory', 'dnd-file-upload-wc' ),
								'id'       			=> 	'drag_n_drop_upload_dir',
								'placeholder'		=>	wp_normalize_path( $upload_dir['basedir'] ),
								'type'     			=> 	'text',
								'desc_tip' 			=> 'Change the default WordPress media uploads folder'
							),


							// End Heading - 6
							array(
								'type' => 'sectionend',
								'id'   => 'dnd_heading_6',
							),

							// Begin Heading - 7
							array(
								'title' => __( 'Preview Images', 'dnd-file-upload-wc' ),
								'type'  => 'title',
								'id'	=>	'dnd_heading_7'
							),

							// Thumbnail Column
							array(
								'title'    			=> 	__( 'Thumbnail Column', 'dnd-file-upload-wc' ),
								'id'       			=> 	'drag_n_drop_upload_thumbnail_column',
								'placeholder'		=>	'4',
								'type'     			=> 	'text',
								'desc_tip' 			=> 'Set how many thumbnails will show per row.'
							),

							// End Heading - 6
							array(
								'type' => 'sectionend',
								'id'   => 'dnd_heading_7',
							),

							// End Heading - 7
							array(
								'type' => 'sectionend',
								'id'   => 'dnd_heading_8',
							),

							// Begin Heading - 7
							array(
								'title' => __( 'Auto Delete Files', 'dnd-file-upload-wc' ),
								'type'  => 'title',
								'id'	=>	'dnd_heading_7'
							),

							// Auto Delete
							array(
								'title'    			=> 	__( 'Time Before Deletion.', 'dnd-file-upload-wc' ),
								'id'       			=> 	'drag_n_drop_upload_auto_delete',
								'placeholder'		=>	'24',
								'type'     			=> 	'text',
								'desc_tip' 			=> 'Time before file deletion (default: 24 Hours)'
							),

							// End Heading - 6
							array(
								'type' => 'sectionend',
								'id'   => 'dnd_heading_8',
							),

						)
					);
            }elseif( 'style' == $current_section ) {

                $settings = array(
					array(
						'title' => __( 'Color Options', 'dnd-file-upload-wc' ),
						'type'  => 'title',
						'id'	=>	'style_heading'
					),

                    array(
						'title'    		=> 	__( 'Text Color', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_style_text_color',
                        'desc'	        =>	'Change the text color of "Drag & Drop Files Here" ',
                        'desc_tip'      =>  true,
						'type'     		=> 	'color',
                        'css'           =>  'width:80px',
                        'placeholder'   =>  '#6d6d6d'
					),

					array(
						'title'    		=> 	__( 'ProgressBar', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_style_progress',
						'desc'	        =>	'Change the color of loading progress...',
                        'desc_tip'      =>  true,
						'type'     		=> 	'color',
                        'css'           =>  'width:80px',
                        'placeholder'   =>  '#4CAF50'
					),

                    array(
						'title'    		=> 	__( 'Filename', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_style_filename',
						'desc'	        =>	'ie: sample-file.jpg',
                        'desc_tip'      =>  true,
						'type'     		=> 	'color',
                        'css'           =>  'width:80px',
                        'placeholder'   =>  '#016d98'
					),

                    array(
						'title'    		=> 	__( 'Delete/Remove', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_style_delete',
						'desc'	        =>	'Change the color of (x) icon on top right.',
                        'desc_tip'      =>  true,
						'type'     		=> 	'color',
                        'css'           =>  'width:80px',
                        'placeholder'   =>  '#2b2828'
					),

                    array(
						'title'    		=> 	__( 'File Size', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_style_filesize',
						'desc'	        =>	'ie: (169.71KB)',
                        'desc_tip'      =>  true,
						'type'     		=> 	'color',
                        'css'           =>  'width:80px',
                        'placeholder'   =>  '#444242'
					),
                    
                    // End style heading
                    array(
                        'type' => 'sectionend',
                        'id'   => 'style_heading',
                    ),

                    array(
						'title' => __( 'Border Color', 'dnd-file-upload-wc' ),
						'type'  => 'title',
						'id'	=>	'style_border_bg'
					),

                    array(
						'title'    		=> 	__( 'Color', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_style_border',
						'type'     		=> 	'color',
                        'css'           =>  'width:80px',
                        'placeholder'   =>  '#c5c5c5'
					),

                    // End border bg
                    array(
                        'type' => 'sectionend',
                        'id'   => 'style_border_bg',
                    ),

                    array(
						'title' => __( 'Uploader Icon', 'dnd-file-upload-wc' ),
						'type'  => 'title',
						'id'	=>	'style_upload_icon'
					),

                    array(
						'title'    		=> 	__( 'Icon URL', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_style_icon',
                        'placeholder'   =>  'http://example.com/wp-content/uploads/2021/icon.svg',
						'type'     		=> 	'url'
					),

                    // end icon heading
                    array(
                        'type' => 'sectionend',
                        'id'   => 'style_upload_icon',
                    ),

                    array(
						'title' => __( 'Uploader Button', 'dnd-file-upload-wc' ),
						'type'  => 'title',
						'id'	=>	'style_button'
					),

                    array(
						'title'    		=> 	__( 'Buton Text Color', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_style_btn_color',
						'type'     		=> 	'color',
                        'css'           =>  'width:80px',
                        'placeholder'   =>  '#fff'
					),

                    array(
						'title'    		=> 	__( 'Button Background Color', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_style_btn_bg',
						'type'     		=> 	'color',
                        'css'           =>  'width:80px',
                        'placeholder'   =>  '#6d6d6d'
					),

                    // end button
                    array(
                        'type' => 'sectionend',
                        'id'   => 'style_button',
                    ),

                    array(
						'title' => __( 'Other Text', 'dnd-file-upload-wc' ),
						'type'  => 'title',
						'id'	=>	'style_other_text'
					),

                    array(
                        'title'    			=> 	__( 'Of Text', 'dnd-file-upload-wc' ),
                        'id'       			=> 	'drag_n_drop_upload_text_of',
                        'placeholder'		=>	'0 of 10',
                        'type'     			=> 	'text'
                    ),

                    array(
                        'title'    			=> 	__( 'Deleting File', 'dnd-file-upload-wc' ),
                        'id'       			=> 	'drag_n_drop_upload_text_delete_file',
                        'placeholder'		=>	'Deleting...',
                        'type'     			=> 	'text'
                    ),

                    array(
                        'title'    			=> 	__( 'Remove Title', 'dnd-file-upload-wc' ),
                        'id'       			=> 	'drag_n_drop_upload_text_remove_title',
                        'placeholder'		=>	'Remove',
                        'type'     			=> 	'text'
                    ),

                    // end other text heading
                    array(
                        'type' => 'sectionend',
                        'id'   => 'style_other_text',
                    ),

                   
                );

			}elseif( 'error-message' == $current_section ) {
				$settings = array(
					array(
						'title' => __( 'Error Message', 'dnd-file-upload-wc' ),
						'type'  => 'title',
						'id'	=>	'dnd_heading_2'
					),

					array(
						'title'    		=> 	__( 'File exceeds server limit', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_error_server_limit',
						'placeholder'	=>	'The uploaded file exceeds the maximum upload size of your server.',
						'type'     		=> 	'text'
					),

					array(
						'title'    		=> 	__( 'Failed to Upload', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_error_failed_to_upload',
						'placeholder'	=>	'Uploading a file fails for any reason',
						'type'     		=> 	'text'
					),

					array(
						'title'    		=> 	__( 'Files too large', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_error_files_too_large',
						'placeholder'	=>	'Uploaded file is too large',
						'type'     		=> 	'text'
					),

					array(
						'title'    		=> 	__( 'Invalid file Type', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_error_invalid_file',
						'placeholder'	=>	'Uploaded file is not allowed for file type',
						'type'     		=> 	'text'
					),

                    array(
						'title'    		=> 	__( 'Invalid file size', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_error_invalid_file_size',
						'placeholder'	=>	'File size is not valid',
						'type'     		=> 	'text'
					),

					array(
						'title'    		=> 	__( 'Mininimum File', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_error_min_file',
						'placeholder'   =>  'Please upload atleast %s files.',
						'desc'			=>	__('Display an error if total file upload less than minimum specified.','dnd-file-upload-wc'),
						'type'     		=> 	'text',
						'desc_tip'		=>	true
					),

					array(
						'title'    		=> 	__( 'Max Upload Limit', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_error_max_upload_limit',
						'placeholder'   =>  'Enter error message',
						'desc'			=>	__('Note : Some of the files could not be uploaded ( Only %s files allowed )', 'dnd-file-upload-wc' ),
						'type'     		=> 	'text',
						'desc_tip'		=>	true
					),

					array(
						'title'    		=> 	__( 'Max File Limit', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_error_max_files',
						'placeholder'   =>  'Enter error message',
						'desc'			=>	__('Error: You have reached the maximum number of files ( Only %s files allowed )', 'dnd-file-upload-wc' ),
						'type'     		=> 	'text',
						'desc_tip'		=>	true
					),

					array(
						'title'    		=> 	__( 'Total Size Limit', 'dnd-file-upload-wc' ),
						'placeholder'   =>  'Enter error message',
						'id'       		=> 	'wc_drag_n_drop_error_size_limit',
						'desc'			=>	__('Error: The total file(s) size exceeding the max size limit of %s.', 'dnd-file-upload-wc' ),
						'type'     		=> 	'text',
						'desc_tip'		=>	true
					),

					// End Heading
					array(
						'type' => 'sectionend',
						'id'   => 'dnd_heading_2',
					)
				);
			}elseif( 'pdf-settings' == $current_section ) {
                $settings = array(
					array(
						'title' => __( 'PDF Details', 'dnd-file-upload-wc' ),
						'type'  => 'title',
						'id'	=>	'dnd_pdf_heading'
					),

                    array(
                        'title'    => __( 'Count no. of pages?', 'dnd-file-upload-wc' ),
                        'id'       => 'drag_n_drop_count_pdf',
                        'default'  => 'no',
                        'type'     => 'checkbox',
                        'desc_tip' => false
                    ),

					array(
						'title'    		=> 	__( 'Append Details To', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_pdf_append_to',
						'placeholder'	=>	'.woocommerce-product-details__short-description',
                        'desc'			=>	__('Enter class name or id where you want to show pdf info.','dnd-file-upload-wc'),
						'type'     		=> 	'text',
                        'desc_tip'		=>	true
					),

                    array(
						'title'    		=> 	__( 'Display Text', 'dnd-file-upload-wc' ),
						'id'       		=> 	'wc_drag_n_drop_pdf_display_text',
						'placeholder'	=>	'%filename (Total Pages: %pagecount)',
                        'desc'			=>	__('<br>%pagecount - display the total no. of pages.<br>%filename - display the name of the PDF.','dnd-file-upload-wc'),
						'type'     		=> 	'text',
					),

                    // End Heading
					array(
						'type' => 'sectionend',
						'id'   => 'dnd_heading_2',
					)
                );
            }

			return apply_filters( 'woocommerce_get_settings_' . $this->id, $settings );
		}

		/**
		* Get categories, taxonomies and products
		*/

		public function get_options( $type ) {
			if( ! $type ) {
				return array();
			}

			$data = array();
			$choices = array();

			switch( $type ) {
				case 'category':
					$data['terms'] = get_terms( array('taxonomy' => 'product_cat', 'hide_empty' => false ) );
					break;
				case 'tags':
					$data['terms'] = get_terms( array('taxonomy' => 'product_tag', 'hide_empty' => false ) );
					break;
				case 'attributes':
					$attributes = wc_get_attribute_taxonomies();
					if( ! empty( $attributes ) ) {
						foreach( $attributes as $tax ) {
							$tax_name = wc_attribute_taxonomy_name( $tax->attribute_name );
							$term[] = (object)array( 'name' => $tax->attribute_label, 'slug' => $tax_name );
							$data['terms'] = $term;
						}
					}
					break;
				case 'products':
					$data['products'] = wc_get_products( array('status' => 'publish', 'limit' => -1 ) );
					break;
			}

			if( $data ) {
				foreach( $data as $tax => $values ) {

					foreach( $values as $term ) {
						if( $tax == 'products' ) {
							$choices[ $term->get_id() ] = $term->get_name();
						}else {
							$choices[ $term->slug ] = $term->name;
						}
					}
				}
			}

			return $choices;
		}

		/**
		* Display - Custom Add Fess
		*/

		public function output_add_fees() {
			$fees_option = get_option('drag_n_drop_additional_fees');
            $hide_td = get_option('show_in_dnd_file_uploader_in') == 'checkout' ? 'style="display:none;"' : '';
		?>
			<h2><?php esc_html_e( 'Add Custom Fees','dnd-file-upload-wc'); ?></h2>

			<table class="form-table">
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label><?php _e('Cart Totals Label','dnd-file-upload-wc'); ?></label>
					</th>
					<td class="forminp forminp-text">
						<input name="drag_n_drop_cart_fee_label" type="text" style="height:30px;" value="<?php echo get_option('drag_n_drop_cart_fee_label'); ?>" placeholder="[%count files] Upload Fee for %product_title">
						<p class="description">Available tags:</p>
						<p>
                            <strong>%product_title</strong> - display product title<br>
                            <strong>%count</strong> - count total files<br>
                            <strong>%pagecount</strong> - display total no. of pages. (for PDF)<br>
                            <strong>%filename</strong> - display the filename of the PDF.
                        </p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label><?php _e('Combine Products Fees','dnd-file-upload-wc'); ?></label>
					</th>
					<td class="forminp forminp-text">
						<input type="checkbox" value="1" name="drag_n_drop_combine_product_fees" <?php checked( get_option('drag_n_drop_combine_product_fees'), 1 ); ?>/> Yes
						<p class="description"><?php esc_html_e("Combine total fees if it's the same product.",'dnd-file-upload-wc'); ?></strong></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label><?php _e('Is amount Taxable?','dnd-file-upload-wc'); ?></label>
					</th>
					<td class="forminp forminp-text">
						<input type="checkbox" value="1" name="drag_n_drop_is_fee_taxable" <?php checked( get_option('drag_n_drop_is_fee_taxable'), 1 ); ?>/> Yes
					</td>
				</tr>
			</table>

			<h2><?php esc_html_e( 'Files Approval','dnd-file-upload-wc'); ?></h2>

			<table class="form-table">
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label><?php _e('Enable Remove/Reject Files','dnd-file-upload-wc'); ?></label>
					</th>
					<td class="forminp forminp-text">
						<input type="checkbox" value="1" name="drag_n_drop_file_rejection" <?php checked( get_option('drag_n_drop_file_rejection',1), 1 ); ?>/> Yes
						<p class="description">Go to "WooCommerce -> Order -> Bulk Action" then select "Remove / Reject Files". </p>
					</td>
				</tr>
			</table>

			<h2><?php esc_html_e( 'Conditions','dnd-file-upload-wc'); ?></h2>

            <p class="description" <?php echo $hide_td; ?>><span style="padding:10px 0; display:block;"><strong>Apply To</strong> - Enter "Product ID" or "Category Slug" separated by comma. (example: 233,421 or category-1, category-2)</span></p>

			<table class="shipping-classes dndmfu-table-fees widefat">
				<thead>
					<tr>
						<td><?php esc_html_e('Fields','dnd-file-upload-wc'); ?></td>
						<td><?php esc_html_e('Operator','dnd-file-upload-wc'); ?></td>
						<td><?php esc_html_e('Count','dnd-file-upload-wc'); ?></td>
                        <td><?php esc_html_e('Operations','dnd-file-upload-wc'); ?></td>
                        <td <?php echo $hide_td; ?>><?php esc_html_e('Apply To (ID, Category)','dnd-file-upload-wc'); ?></td>
						<td><?php esc_html_e('Extra Fee\'s','dnd-file-upload-wc'); ?></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php if( $fees_option ) : ?>
						<?php foreach( $fees_option as $index => $fee ) : ?>
							<?php
								$operator = ( isset( $fee['operator'] ) ? wp_specialchars_decode( $fee['operator'] ) : '===' );
                                $operations = ( isset( $fee['operations'] ) ? wp_specialchars_decode( $fee['operations'] ) : '+' );
							?>
							<tr data-row="<?php echo esc_attr( $index ); ?>">
								<td>
									If <select name="drag_n_drop_additional_fees[<?php echo $index;?>][files]">
										<option value="total_files" <?php selected( $fee['files'], 'total_files' ); ?>><?php esc_html_e('Total Files','dnd-file-upload-wc'); ?></option>
                                        <option value="total_page" <?php selected( $fee['files'], 'total_page' ); ?>><?php esc_html_e('Total Pages(pdf)','dnd-file-upload-wc'); ?></option>
									</select>
								</td>
								<td>
									Is <select name="drag_n_drop_additional_fees[<?php echo $index;?>][operator]">
										<option value="===" <?php selected( $operator, '===' ); ?>><?php esc_html_e('Equal to','dnd-file-upload-wc'); ?></option>
										<option value=">" <?php selected( $operator, '>' ); ?>><?php esc_html_e('Greater than','dnd-file-upload-wc'); ?></option>
										<option value="<" <?php selected( $operator, '<' ); ?>><?php esc_html_e('Less than','dnd-file-upload-wc'); ?></option>
									</select>
								</td>
								<td><input type="text" name="drag_n_drop_additional_fees[<?php echo $index;?>][number]" value="<?php echo $fee['number']; ?>" placeholder="Enter Number"></td>
								<td>
                                    <select name="drag_n_drop_additional_fees[<?php echo $index;?>][operations]">
										<option value="+" <?php selected( $operations, '+' ); ?>><?php esc_html_e('(+) Add','dnd-file-upload-wc'); ?></option>
										<option value="*" <?php selected( $operations, '*' ); ?>><?php esc_html_e('(*) Multiply','dnd-file-upload-wc'); ?></option>
									</select>
                                </td>
                               <td <?php echo $hide_td; ?>><input type="text" name="drag_n_drop_additional_fees[<?php echo $index;?>][apply_to]" value="<?php echo ( isset($fee['apply_to'] ) ? $fee['apply_to'] : ''); ?>"></td>
                                <td><?php echo get_woocommerce_currency_symbol(); ?> <input type="text" value="<?php echo $fee['amount']; ?>" name="drag_n_drop_additional_fees[<?php echo $index;?>][amount]" placeholder="Enter Amount"></td>
								<td><a href="#" title="Add More" class="dndmfu-add-fees"><span class="dashicons dashicons-plus-alt2"></span></a> <a href="#" title="Remove" class="dndmfu-remove-row"><span class="dashicons dashicons-minus"></span></a></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr data-row="<?php echo time(); ?>">
							<td>
								If <select name="drag_n_drop_additional_fees[0][files]">
									<option value="total_files"><?php esc_html_e('Total Files','dnd-file-upload-wc'); ?></option>
                                    <option value="total_page"><?php esc_html_e('Total Pages(pdf)','dnd-file-upload-wc'); ?></option>
								</select>
							</td>
							<td>
								Is <select name="drag_n_drop_additional_fees[0][operator]">
									<option value="==="><?php esc_html_e('Equal to','dnd-file-upload-wc'); ?></option>
									<option value=">"><?php esc_html_e('Greater than','dnd-file-upload-wc'); ?></option>
									<option value="<"><?php esc_html_e('Less than','dnd-file-upload-wc'); ?></option>
								</select>
							</td>
							<td><input type="text" name="drag_n_drop_additional_fees[0][number]" value="" placeholder="Enter Number"></td>
                            <td><select name="drag_n_drop_additional_fees[0][operations]">
                                <option value="+"><?php esc_html_e('(+) Add','dnd-file-upload-wc'); ?></option>
                                <option value="*"><?php esc_html_e('(*) Multiply','dnd-file-upload-wc'); ?></option>
                            </select>
                            </td>
                            <td <?php echo $hide_td; ?>><input type="text" name="drag_n_drop_additional_fees[0][apply_to]" value="" placeholder="12,18 / cat-1, cat-2"></td>
							<td><?php echo get_woocommerce_currency_symbol(); ?> <input type="text" value="" name="drag_n_drop_additional_fees[0][amount]" placeholder="Enter Amount"></td>
							<td><a href="#" title="Add More" class="dndmfu-add-fees"><span class="dashicons dashicons-plus-alt2"></span></a> </td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>

			<!-- Custom Reapeter data -->
			<script type="text/html" id="dndmfu-repeater-row-table">
				<tr data-row="{row}">
					<td>
						If <select name="drag_n_drop_additional_fees[{row}][files]">
							<option value="total_files"><?php esc_html_e('Total Files','dnd-file-upload-wc'); ?></option>
                            <option value="total_page"><?php esc_html_e('Total Pages(pdf)','dnd-file-upload-wc'); ?></option>
						</select>
					</td>
					<td>
						Is <select name="drag_n_drop_additional_fees[{row}][operator]">
							<option value="==="><?php esc_html_e('Equal to','dnd-file-upload-wc'); ?></option>
							<option value=">"><?php esc_html_e('Greater than','dnd-file-upload-wc'); ?></option>
							<option value="<"><?php esc_html_e('Less than','dnd-file-upload-wc'); ?></option>
						</select>
					</td>
					<td><input type="text" name="drag_n_drop_additional_fees[{row}][number]" value="" placeholder="Enter Number"></td>
                    <td>
                        <select name="drag_n_drop_additional_fees[{row}][operations]">
                            <option value="+"><?php esc_html_e('(+) Add','dnd-file-upload-wc'); ?></option>
                            <option value="*"><?php esc_html_e('(*) Multiply','dnd-file-upload-wc'); ?></option>
                        </select>
                    </td>
                    <td <?php echo $hide_td; ?>><input type="text" name="drag_n_drop_additional_fees[{row}][apply_to]" placeholder="12,18 / cat-1, cat-2"></td>
					<td><?php echo get_woocommerce_currency_symbol(); ?> <input type="text" value="" name="drag_n_drop_additional_fees[{row}][amount]" placeholder="Enter Amount"></td>
					<td><a href="#" title="Add More" class="dndmfu-add-fees"><span class="dashicons dashicons-plus-alt2"></span></a> <a href="#" title="Remove" class="dndmfu-remove-row"><span class="dashicons dashicons-minus"></span></a></td>
				</tr>
			</script>

		<?php
		}

		/**
		* Display - Output Fields
		*/

		public function output() {
			global $current_section;

			if( 'add-fees' == $current_section ) {
				$this->output_add_fees();
			}else {
				$settings = $this->get_settings( $current_section );
				WC_Admin_Settings::output_fields( $settings );
			}
		}

		/**
		* Save Options
		*/

		public function save() {
			global $current_section;

			if( 'add-fees' == $current_section ) {

				$meta_key = array(
					'drag_n_drop_combine_product_fees',
					'drag_n_drop_cart_fee_label',
					'drag_n_drop_is_fee_taxable',
					'drag_n_drop_additional_fees',
					'drag_n_drop_file_rejection'
				);

				foreach( $meta_key as $single_meta_value ) {
					$meta_value = ( isset( $_POST[ $single_meta_value ] ) ? wc_clean( wp_unslash( $_POST[ $single_meta_value ] ) ) : '' );
					update_option( $single_meta_value, $meta_value );
				}

			}else {
				$settings = $this->get_settings( $current_section );
				WC_Admin_Settings::save_fields( $settings );
			}
		}
	}

	new DNDMFU_WC_Settings();


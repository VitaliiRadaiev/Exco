<?php

	/**
	* @Description : Custom Ajax Functions
	* @Package : PRO Drag & Drop Multiple File Upload - WooCommerce
	* @Author : CodeDropz
	*/

	if ( ! defined( 'ABSPATH' ) || ! defined('DNDMFU_WC_PRO') ) {
		exit;
	}

	/**
	* Custom Functions
	*/

	class DNDMFU_WC_PRO_FUNCTIONS {

		private static $instance = null;

		// array - user information
		public $user = array();

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

			// Get user information - for loggedin user
			$this->user = ( is_user_logged_in() ? wp_get_current_user() : null );

            // Upload is complete hooks
            add_action('dndmfu_wc_pro_upload_complete', array( $this, 'dndmfu_wc_upload_hook' ), 10, 2 );
            add_action('dndmfu_wc_pro_after_deleted', array( $this, 'dndmfu_wc_hook_after_deleted' ), 10, 2);
		}

		/**
		* Get Directory
		* @return : array
		*/

		public function dndmfu_wc_dir( $dir = 'basedir' ) {
			$instance = DNDMFU_WC_PRO_INIT();
			if( isset( $instance->wp_upload_dir[ $dir ] ) ) {
				return $instance->wp_upload_dir[ $dir ];
			}
			return $instance;
		}

		/**
		* Get dir setup
		*/

		public function dndmfu_wc_dir_setup( $directory = null, $create = false ) {

			// Create dir
			if( $create ) {
				if( ! is_dir( $directory ) ) {
					wp_mkdir_p( $directory );
				}
				if( file_exists( $directory ) ) {
					return $directory;
				}
			}

			// Get current IDR
			return $directory;
		}

		/**
		* Setup file type pattern for validation
		*/

		public function dndmfu_wc_filetypes( $types ) {
			$file_type_pattern = '';

			$allowed_file_types = array();
			$file_types = explode( ',', $types );

			foreach ( $file_types as $file_type ) {
				$file_type = trim( $file_type, '.' );
				$file_type = str_replace( array( '.', '+', '*', '?' ), array( '\.', '\+', '\*', '\?' ), $file_type );
				$allowed_file_types[] = $file_type;
			}

			$allowed_file_types = array_unique( $allowed_file_types );
			$file_type_pattern = implode( '|', $allowed_file_types );

			$file_type_pattern = trim( $file_type_pattern, '|' );
			$file_type_pattern = '(' . $file_type_pattern . ')';
			$file_type_pattern = '/\.' . $file_type_pattern . '$/i';

			return $file_type_pattern;
		}

		/**
		* Check and remove script file
		*/

		public function dndmfu_wc_antiscript_file_name( $filename ) {
			$filename = wp_basename( $filename );
			$parts = explode( '.', $filename );

			if ( count( $parts ) < 2 ) {
				return $filename;
			}

			$script_pattern = '/^(php|phtml|pl|py|rb|cgi|asp|aspx)\d?$/i';

			$filename = array_shift( $parts );
			$extension = array_pop( $parts );

			foreach ( (array) $parts as $part ) {
				if ( preg_match( $script_pattern, $part ) ) {
					$filename .= '.' . $part . '_';
				} else {
					$filename .= '.' . $part;
				}
			}

			if ( preg_match( $script_pattern, $extension ) ) {
				$filename .= '.' . $extension . '_.txt';
			} else {
				$filename .= '.' . $extension;
			}

			return $filename;
		}

		/**
		* Filter - Add more validation for file extension
		*/

		public function dndmfu_wc_validate_type( $extension, $supported_types = '' ) {

			if( ! $extension ) {
				return;
			}

			$valid = true;
			$extension = preg_replace( '/[^A-Za-z0-9,|]/', '', $extension );

			// not allowed file types
			$not_allowed = array( 'php', 'php3','php4','phtml','exe','script', 'app', 'asp', 'bas', 'bat', 'cer', 'cgi', 'chm', 'cmd', 'com', 'cpl', 'crt', 'csh', 'csr', 'dll', 'drv', 'fxp', 'flv', 'hlp', 'hta', 'htaccess', 'htm', 'htpasswd', 'inf', 'ins', 'isp', 'jar', 'js', 'jse', 'jsp', 'ksh', 'lnk', 'mdb', 'mde', 'mdt', 'mdw', 'msc', 'msi', 'msp', 'mst', 'ops', 'pcd', 'php', 'pif', 'pl', 'prg', 'ps1', 'ps2', 'py', 'rb', 'reg', 'scr', 'sct', 'sh', 'shb', 'shs', 'sys', 'swf', 'tmp', 'torrent', 'url', 'vb', 'vbe', 'vbs', 'vbscript', 'wsc', 'wsf', 'wsf', 'wsh' );

			// Search in $not_allowed extension and match
			foreach( $not_allowed as $single_ext ) {
				if ( strpos( $single_ext, $extension ) !== false ) {
					$valid = false;
					break;
				}
			}

			// If pass on first validation - check extension if exists in allowed types
			if( $valid === true && $supported_types) {
				$allowed_ext = explode(',', strtolower( $supported_types ) );
				if( ! in_array( $extension, $allowed_ext ) ) {
					$valid = false;
				}
			}

			return $valid;
		}

		/**
		* Get allowed extension
		* @return : bolean
		*/

		public function get_allowed_types() {

			// Get white listed extensions from the admin option
			$file_types = get_option( 'drag_n_drop_support_file_upload' );

			// Assign default extension if file types option is not set.
			$extensions = ( $file_types ? $file_types : 'jpg,jpeg,JPG,png,gif,pdf,doc,docx,ppt,pptx,odt,avi,ogg,m4a,mov,mp3,mp4,mpg,wav,wmv,xls' );

			// Return file types
			return $extensions;
		}

		/**
		* Get Files
		* @return : array / html
		*/

		public function dndmfu_wc_get_files( $files, $raw = false, $tmp_dir = true ) {

			if( ! $files )
				return;

			// Get options from main class
			$base_url = trailingslashit( $this->dndmfu_wc_dir('baseurl') );
			$base_dir = trailingslashit( $this->dndmfu_wc_dir('basedir') );

			$tmp_dir = ( $tmp_dir ? trailingslashit( 'tmp_uploads' ) : '' );
			$files_upload = array();

			if( is_array( $files ) ) {
				foreach( $files as $file ) {
					if( $raw === false ) {

						$thumb = pathinfo( $file );
						$thumb_name = $thumb['filename'] . '-100x100.'. $thumb['extension'];
						$file_url = esc_url( $base_url . $tmp_dir . wp_basename( $file ) );

						$thumbnail_url =  esc_url( $base_url . 'thumbnails/' . $thumb_name  );
                        
                        // Get mime type
                        $file_type = wp_check_filetype( $file_url );

                        // Display thumbnail
						$thumb_file = ( file_exists( $base_dir . 'thumbnails/' . $thumb_name ) ? '<img title="'.wp_basename($file).'" src="'. $thumbnail_url .'"/>' : '<img title="'.wp_basename($file).'" src="'. wp_mime_type_icon( $file_type['type'] ) .'">' );

						$files_upload[] = sprintf('<a href="%s">%s </a>', $file_url , $thumb_file );
					}else {
						$files_upload[] = $base_url . $tmp_dir . wp_basename( $file );
					}
				}
			}

			return $files_upload;
		}

		/**
		* Delete Files
		* @param : $file_path - basedir
		*/

		public function dndmfu_wc_delete_file( $file_path ) {

			// There's no reason to proceed if - null
			if( ! $file_path ) {
				return;
			}

			// Get file info
			$file = pathinfo( $file_path );
			$ext = strtolower( $file['extension'] );

			$dir_name = wp_normalize_path( $this->dndmfu_wc_dir() );

			// Check and validate file type if it's safe to delete...
			$safe_to_delete = $this->dndmfu_wc_validate_type( $file['extension'] );

			// @bolean - true if validated
			if( $safe_to_delete ) {

				// Delete parent file
				wp_delete_file( $file_path );

				// Delete if there's a thumbnail
				$thumbnail = $dir_name .'/thumbnails/'. $file['filename'] ."-100x100.$ext";

				if( file_exists( $thumbnail ) ) {
					wp_delete_file( $thumbnail );
				}

			}
		}

		/**
		* Schedule Delete Files - from /tmp_uploads (Daily Cron) (Files >= 24 hours)
		*/

		public function dndmfu_wc_auto_remove_files( $dir_path = null, $seconds = 86400, $max = 60 ) {
			if ( is_admin() || 'POST' != $_SERVER['REQUEST_METHOD'] || is_robots() || is_feed() || is_trackback() ) {
				return;
			}

			// Setup dirctory path
			$path = $this->dndmfu_wc_dir( false );

			$base_dir = trailingslashit( $path->wp_upload_dir['basedir'] );
			$tmp_folder = trailingslashit( $path->_options['tmp_folder'] );

			// Get directory
			$dir = ( ! $dir_path ? $base_dir . $tmp_folder : trailingslashit( $dir_path ) );

			// Make sure dir is readable or writable
			if ( ! is_dir( $dir ) || ! is_readable( $dir ) || ! wp_is_writable( $dir ) ) {
				return;
			}

			// Get time option
			if( get_option('drag_n_drop_upload_auto_delete') ) {
				$seconds = ( get_option('drag_n_drop_upload_auto_delete') * 60 * 60 );
			}

			// allow theme/plugins to change time before deletion... ( default : 24 hours )
			$seconds = apply_filters( 'dndmfu_wc_time_before_auto_deletion', absint( $seconds ) );

			$max = absint( $max );
			$count = 0;

			if ( $handle = @opendir( $dir ) ) {
				while ( false !== ( $file = readdir( $handle ) ) ) {
					if ( $file == "." || $file == ".." ) {
						continue;
					}

					// Setup dir and filename
					$file_path = $dir . $file;

					// Check if current path is directory (recursive)
					if( is_dir( $file_path ) ) {
						$this->dndmfu_wc_auto_remove_files( $file_path );
						continue;
					}

					// Get file time of files OLD files.
					$mtime = @filemtime( $file_path );
					if ( $mtime && time() < $mtime + $seconds ) { // less than $seconds old (if time >= modified = then_delete_files) (past)
						continue;
					}

					// @desscription : Make sure it's inside our upload basedir (directory)
					// @example : "c:/xampp/htdocs/wp/wp-content/uploads/wc_drag-n-drop_uploads/file.jpg", "c:/xampp/htdocs/wp/wp-content/uploads/wc_drag-n-drop_uploads/"
					$is_path_in_content_dir = strpos( $file_path, wp_normalize_path( realpath( $path->wp_upload_dir['basedir'] ) ) );

					// Delete files from dir ( don't delete .htaccess file )
					if( 0 === $is_path_in_content_dir ) {
						$this->dndmfu_wc_delete_file( $file_path );
					}

					$count += 1;

					if ( $max <= $count ) {
						break;
					}
				}
				@closedir( $handle );
			}

			// Remove empty dir except - /tmp_uploads
			if( false === strpos( $dir, $path->_options['tmp_folder'] ) ) {
				@rmdir( $dir );
			}
		}

		/**
		* Setup media file on json response after the successfull upload.
		*/

		public function dndmfu_wc_media_json_response( $path, $file_name ) {

			$preview = plugins_url('drag-and-drop-file-uploads-wc-pro/assets/images/file-type.svg');

			if( $this->is_image( $file_name ) ) {

				// Create /thumbnails dir
				$thumb_path = $this->dndmfu_wc_dir('basedir') . '/thumbnails';
				$thumbnail_dir = $this->dndmfu_wc_dir_setup( $thumb_path, true );

				// Extract file information
				$file = pathinfo($file_name);

				// Initialize wp image editor
				$image = wp_get_image_editor( untrailingslashit( $this->dndmfu_wc_dir('basedir') ) . $path . $file_name );

				// Begin to resize image @todo - create an option to display image or now
				if( ! is_wp_error($image) ) {
					$image->resize(100,100,true);
					$image = $image->save( trailingslashit( $thumbnail_dir ) . $file['filename'] .'-100x100.'. $file['extension'] );
					if( ! is_wp_error($image) ) {
						$preview = $this->dndmfu_wc_dir('baseurl') .'/thumbnails/'. $image['file'];
					}
				}

			}

			$media_files = array(
				'path'		=>	$path,
				'file'		=>	$file_name,
				'preview'	=>	$preview,
				'is_image'	=>  ( $this->is_image( $file_name ) ? true : false ),
				'ext'		=>	pathinfo( $file_name, PATHINFO_EXTENSION  )
			);

			return $media_files;
		}

		/**
		* Check wheater files is image or not
		*/

		public function is_image( $file ) {
			if( ! $file ) {
				return;
			}

			// Match file name extension
			if ( preg_match( '/\.(jpg|jpeg|png|gif|tiff|svg|heif )$/i', $file ) ) {
				return true;
			}

			return false;
		}

		/**
		* Get users IP Address
		*/

		public function get_the_user_ip(){
			if( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			return apply_filters('wpb_get_ip', $ip);
		}

		/**
		* Setup Sepcial Tags
		*/

		public function tags( $name = null ) {

			// List of all special tags
			$tags = array(
				'username'		=>	$this->user ? sanitize_title( $this->user->user_login ) : null,
				'name'			=>	$this->user ? sanitize_title( $this->user->display_name ) : null,
				'user_id'		=>	$this->user ? $this->user->ID : null,
				'ip_address'	=>	$this->get_the_user_ip(),
				'random'		=>	mt_rand(1000,9999),
				'date'			=>	$this->get_date('m-d-y'),
				'time'			=>	time(),
				'filename'		=>	null,
				'product_id'	=>	'',
				'product_slug'	=>	'',
				'sku'			=>	''
			);

			// Allow other plugin,user to add or modify tags
			$tags = apply_filters('dndmfu_wc_pro_special_tags', $tags );

			// Get and return specific tag
			if( $name && isset( $tags[ $name ] ) ) {
				return $tags[ $name ];
			}

			return $tags;
		}

		/**
		* Convert URL to DIR or DIR to URL
		*/

		public static function convert_url( $string, $dir = false ) {
			$blog_id = get_current_blog_id();
            $abs_path = ( defined('WP_CONTENT_DIR') ? dirname( WP_CONTENT_DIR ) . '/' : ABSPATH );
			if( false === $dir && $string ) {
				return str_replace( trailingslashit( get_site_url( $blog_id ) ), wp_normalize_path( $abs_path ), $string );
			}else {
				return str_replace( wp_normalize_path( $abs_path ), trailingslashit( get_site_url( $blog_id ) ), $string );
			}
		}

		/**
		* Setup and Zip Attachment
		* @param : files - baseurl
		*/

		public function zip_files( $files, $name = null ) {

			// Make sure we have files
			if( empty( $files ) ) {
				return false;
			}

			// Concat base and default dir
			$get_dir = current( $files );
			if( $get_dir ) {
				$dir_path = dirname( self::convert_url( $get_dir ) );
			}

			// Setup dir and begin to create .zip file
			$zip = new ZipArchive;

			// Setup zip name combine ( date + unique_id + file-name )
			$_generated_name = $this->get_date('m-d-y') . '-'. uniqid();

			// Special custom tags ( user information, random, ip-address, time )
			$tags = $this->tags();

			// Allow user to modify name ( original filename, tags )
			$archive_name =  apply_filters( 'dndmfu_wc_pro_archive_name', substr( $_generated_name .'-'. md5( $name ), 0, 20 ), $tags, $name );

			// Create unique name
			$generated_name = wp_unique_filename( trailingslashit( $dir_path ), $archive_name .'.zip' );

			// new zip name
			$zip_name = trailingslashit( $dir_path ) . $generated_name;

			// check if zip files already created.
			$exists = ( file_exists( $zip_name ) ? ZipArchive::OVERWRITE : ZipArchive::CREATE );

			// Open zip file
			if ( $zip_open = $zip->open( $zip_name , $exists ) === TRUE ) {
				foreach( $files as $file ) {
					// zip only the files that are exists.
					$for_zip_file = self::convert_url( $file );

					if( file_exists( $for_zip_file ) ) {
						$zip->addFile( $for_zip_file , wp_basename( $for_zip_file ) );
					}
				}
			}

			// Closing zip
			$zip->close();

			// Return whole path of zip
			if( $zip_open && file_exists( $zip_name ) ) {

				// Delete temporary files
				foreach( $files as $file ) {
					$this->dndmfu_wc_delete_file( self::convert_url( $file ) );
				}

				// Convert basedir to baseurl
				$zip_file[ $name ] = self::convert_url( $zip_name, true );

				// Return zip url
				return $zip_file[ $name ];

			}else {
				return false;
			}
		}

		/**
		* Custom File Renaming
		*/

		public function rename_file( $filename, $original_name, $id ) {

			// filename & id should present
			if( '' == $filename || '' == $id ) {
				return;
			}

			// Get ammend name pattern
			$ammend_name = trim( get_option('drag_n_drop_file_amend') );

			// Extract Name
			$file = pathinfo( $filename );
			$ext = strtolower( $file['extension'] );

			// Get product by id
			$product = get_post( $id );

			// If original file name no need to proceed.
			if( '{filename}' == $ammend_name || '' == $ammend_name ) {
				return $filename;
			}

			// Match {field_name} or {fields:your-name} patterns : /{fields[s+:|:](.*?)}|{.*?}/ = {fields:name}
			preg_match_all( '/\{(.*?)\}/', $ammend_name, $matches ); // $matches[0] = {file_name}, $matches[1] = field_name

			// Get all matches
			$matches_1 = $matches[1];
			$matches_0 = $matches[0];

			if( count( $matches_1 ) > 0 ) {

				// Loop & extract filename pattern.
				foreach( $matches_1 as $index => $name ) {
					$pattern = $matches_0[ $index ];

					if( $name == 'product_id' ) {
						$new_name = (int)$id;
					}elseif( $name == 'product_slug' ) {
						$new_name = ( $product ? $product->post_name : '' );
					}elseif( $name == 'filename' ) {
						$new_name = $file['filename'];
					}elseif( $name == 'sku' ) {
						$new_name = get_post_meta( $id, '_sku', true );
					}else {
						$new_name = $this->tags( $name );
					}

					// Replace {pattern} to actual values
					$ammend_name = str_replace( $pattern, $new_name, $ammend_name );

				}

				// Remove special characters
				if( function_exists('mb_check_encoding') ) {

					// Check if filename is ASCII
					if ( mb_check_encoding( $ammend_name, 'ASCII' ) ) {
						$filename = preg_replace('/[^A-Za-z0-9-_.]/','', $ammend_name);
					}else {
						$filename = $ammend_name;
					}

				}

				// Combine name & extension (ie: filename.jpg)
				$filename = $filename .'.'. $ext;
			}

			return $filename;

		}

		/**
		* PHP operator
		*/

		public function condition( $val, $operator, $compare ){
			$operator = wp_specialchars_decode( $operator );
			switch ($operator) {
				case '<':
					return $val < $compare;
					break;
				case '>':
					return $val > $compare;
					break;
				case '===':
					return $val == $compare;
					break;
				default:
					return false;
			}
			return false;
		}

		/**
		* Get current time based on GMT selected
		*/

		public function get_date( $format ) {
			$string = date( 'Y-m-d H:i:s' );
			return get_date_from_gmt( $string, $format );
		}

		/**
		* Line Items - Upload Label ( Order Items, Email )
		*/

		public function order_item_title() {
			return apply_filters('dndmfu_wc_order_item_title', __( 'File Uploads', 'dnd-file-upload-wc' ) );
		}

        /**
		* Check Image Type
		*/

        public function dndmfu_wc_is_image( $type, $file ) {
            $check = wp_check_filetype( $file );
            if ( empty( $check['ext'] ) ) {
                return false;
            }
            $ext = $check['ext'];
            switch ( $type ) {
                case 'image':
                    $image_exts = array( 'jpg', 'jpeg', 'jpe', 'gif', 'png','bmp' );
                    return in_array( $ext, $image_exts, true );
        
                case 'audio':
                    return in_array( $ext, wp_get_audio_extensions(), true );
        
                case 'video':
                    return in_array( $ext, wp_get_video_extensions(), true );
        
                default:
                    return $type === $ext;
            }
        }

		/**
		* Logs File
		*/

		public function wc_logs( $message, $email = false ) {
			$upload_dir = wp_upload_dir();
			$file = fopen( $upload_dir['basedir'].'/'. DNDMFU_WC_PRO_PATH ."/logs.txt", "a") or die("Unable to open file!");
			fwrite( $file, "\n". ( is_array( $message ) ? print_r( $message, true ) : $message ) );
			fclose( $file );
		}

        /**
		* Hook after files upload is complete
		*/

        public function dndmfu_wc_upload_hook( $files, $id ) {
            global $wpdb;

            $data = array();

            // Check table if exist
            if( ! $this->dndmfu_check_table() ) {
                dndmfu_wc_pro_activate();
            }
    
            $extensions = array('pdf','doc','docx');
            if( isset( $files['ext'] ) ) {
                if( in_array( $files['ext'], $extensions ) && get_option('drag_n_drop_count_pdf') == 'yes' ) {

                    // Setup for session data
                    $table_data = array(
                        'product_id'    =>  (int)$id,
                        'details'       =>  maybe_serialize( array('total_pages' => $files['total_pages'], 'file' => $files['file'] ) ),
                        'file_index'    =>  $files['index'],
                        'status'        =>  0
                    );

                    // Insert file details
                    $file_id = $wpdb->insert( $wpdb->prefix.'wc_dndmfu', $table_data );

                }
            }

            return false;
        }
        
        /**
		* Count Total Files of PDF
		*/

        public function dndmfu_wc_extract_files( $file_name ) {
            
            // Return file not exists
            if( ! $file_name && ! file_exists( $file_name ) ) {
                return false;
            }

            // Declare total page variable
            $total_pages = 0;

            // Check if imagemagic is loaded or not
            if (extension_loaded('imagick') ) {
                $im = new Imagick();
                $im->pingImage( $file_name );
                $total_pages = $im->getNumberImages();
            }else {
                $pdftext = file_get_contents( $file_name );
                $total_pages = preg_match_all("/\/Page\W/", $pdftext );
            }

            // Return total number of files
            return $total_pages;
        }

        /**
		* Hook after file deletion ( Remove file index from session data )
		*/

        public function dndmfu_wc_hook_after_deleted( $data, $file_index ) {
            global $wpdb;

            // Check table if exist
            if( ! $this->dndmfu_check_table() ) {
                return false;
            }
            
            // Bail early
            if( ! $data || empty( $file_index ) ) {
                return;
            }
            
            // Delete file data from db
            $wpdb->delete( $wpdb->prefix.'wc_dndmfu', array( 'file_index' => $file_index ) );
        }


        /**
		* Get file details information
        * @param: $key dnd-file-xxd3-ffff, $field_name details
		*/

        public function dndmfu_get_details( $keys, $product_id, $field_name = null ) {
            global $wpdb;

            // Check table if exist
            if( ! $this->dndmfu_check_table() ) {
                return false;
            }

            if( $keys ) {
                $data = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}wc_dndmfu WHERE `product_id` = $product_id AND file_index='".$keys."'", ARRAY_A );
            }
            
            if( $data ) {
                if( isset( $data[ $field_name ] ) ) {
                    return ( $field_name == 'details') ? maybe_unserialize( $data[ 'details' ] ) :  $data[ $field_name ];
                }
                return $data;
            }
        }

        /**
		* Delete file details from database
		*/

        public function dndmfu_delete_details( $key ) {
            global $wpdb;

            // Check table if exist
            if( ! $this->dndmfu_check_table() ) {
                return false;
            }

            // Delete data from db
            if( $key ) {
                $wpdb->delete( $wpdb->prefix.'wc_dndmfu', array('file_index' => $key ) );
            }
        }

        /**
		* Check if table exist
		*/

        public function dndmfu_check_table() {
            global $wpdb;
            $table = $wpdb->get_var( $wpdb->prepare("SHOW TABLES LIKE %s", $wpdb->prefix.'wc_dndmfu' ) );
            return $table;
        }

	}
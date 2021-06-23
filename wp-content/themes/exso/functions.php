<?

if ( function_exists('add_theme_support') ) {
	add_theme_support('post-thumbnails');
	add_theme_support('menus');
}
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'minicart', 70, 85, array( 'center', 'top' ) );
	add_image_size( 'products', 205, 260, array( 'center', 'top' ) );
	add_image_size( 'big', 570, 725, array( 'center', 'top' ) );
	add_image_size( 'min', 110, 140, array( 'center', 'top' ) );
	add_image_size( 'gal', 284, 284, array( 'center', 'top' ) );
	add_image_size( 'blog', 370, 370, array( 'center', 'top' ) );
}

// Size img in loop

function woocommerce_archive_gallery() {

	global $product;
	global $post;
	$post_ids = $product->get_id();

	$attachment_ids = $product->get_gallery_image_ids();
	if(get_the_post_thumbnail($post->ID)){
		echo '<div class="loop-img"><!--product_in_listingEX-->';
		echo get_the_post_thumbnail( $post->ID, 'products', array('height' => '','class'=>'', 'alt' => esc_html ( get_the_title() )) );
	}else{
		echo '<img src="'.get_stylesheet_directory_uri().'/noimg.svg">';
	}

	//array_pop($attachment_ids);

	foreach( $attachment_ids as $attachment_id ) 
		{
			//print_r($attachment_ids);
		// Display Image instead of URL
		echo wp_get_attachment_image($attachment_id, 'products');

	}
	echo '</div>';

}

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_archive_gallery', 10 );

// Size img in loop

add_filter('woocommerce_gallery_image_size', 'bigSingleImg');

function bigSingleImg()
{
	return 'big';
}


// Size img in product page gallery

add_filter('woocommerce_gallery_thumbnail_size', 'minSingleImg');

function minSingleImg()
{
	return 'min';
}
add_action('init', function() {
	pll_register_string('mytheme-hello', 'Главная');
	pll_register_string('mytheme-hello', 'Компьютерная вышивка');
	pll_register_string('mytheme-hello', 'Термопечать');
	pll_register_string('mytheme-hello', 'Одежда');
	pll_register_string('mytheme-hello', 'Перейти в портфолио');
	pll_register_string('mytheme-hello', 'Почему нас выбирают');
	pll_register_string('mytheme-hello', 'Наши работы');
	pll_register_string('mytheme-hello', 'Как мы работаем');
	pll_register_string('mytheme-hello', 'Наши клиенты');
	pll_register_string('mytheme-hello', 'Написать нам');
	pll_register_string('mytheme-hello', 'Форма обратной связи');
	pll_register_string('mytheme-hello', 'Оставьте свои контактные данные
				и мы свяжемся с вами');  
});

function exso_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'exso' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'exso' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'exso_widgets_init' );


add_action('wp_enqueue_scripts', 'override_woo_frontend_scripts');
function override_woo_frontend_scripts() {
	wp_deregister_script('wc-cart');
	wp_enqueue_script('wc-cart', get_template_directory_uri() . '/js/cart.js', array('jquery', 'woocommerce', 'wc-country-select', 'wc-address-i18n'), null, true);

}


function my_scripts(){
	
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper-bundle.min.css', false, null );
	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/jquery.fancybox.min.css', false, null );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', false, null );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', false, null );
		wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css', false, null );
	wp_enqueue_style( 'icomoon', get_template_directory_uri() . '/icomoon/style.css', false, null );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css', false, time() );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', false, null );
	
	//wp_enqueue_script( 'wc-cart', get_template_directory_uri() . '/js/cart.js', array('jquery'), true );
	wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/js/jquery.lazyload.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'PageScroll2id', get_template_directory_uri() . '/js/jquery.malihu.PageScroll2id.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'viewportchecker', get_template_directory_uri() . '/js/jquery.viewportchecker.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'script-js', get_template_directory_uri() . '/js/script.js', array('jquery'), null, true );
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), null, time() );

}

add_action( 'wp_enqueue_scripts', 'action_function_name_7714', 99 );
function action_function_name_7714(){
	wp_localize_script( 'jquery', 'mytheme', array( 
		'template_url' => get_template_directory_uri(), 
	) );
}

add_action('wp_enqueue_scripts', 'my_scripts');

if(function_exists('register_nav_menus')){
	register_nav_menus(
		array( // создаём любое количество областей
			'section-nav' => 'Меню навигации', // 'имя' => 'описание'
			'nav' => 'Главное меню',
			'footer-nav' => 'Нижнее меню',
			'footer-nav2' => 'Нижнее меню 2',
			'footer-nav3' => 'Нижнее меню 3',
			'woo-menu' => 'Категории магазин'
		)  
	);
}


//разрешаем все элементы тега img start
function wph_add_all_elements($init) {
		if(current_user_can('unfiltered_html')) {
				$init['extended_valid_elements'] = 'span[*]';
		}
		return $init;
}
add_filter('tiny_mce_before_init', 'wph_add_all_elements', 20);
//разрешаем все элементы тега img end



// Колонка ID

if (is_admin()) {

	// колонка "ID" для таксономий (рубрик, меток и т.д.) в админке

	foreach (get_taxonomies() as $taxonomy){

		add_action("manage_edit-${taxonomy}_columns", 'tax_add_col');

		add_filter("manage_edit-${taxonomy}_sortable_columns", 'tax_add_col');

		add_filter("manage_${taxonomy}_custom_column", 'tax_show_id', 10, 3);

	}

	add_action('admin_print_styles-edit-tags.php', 'tax_id_style');

	function tax_add_col($columns) {return $columns + array ('tax_id' => 'ID');}

	function tax_show_id($v, $name, $id) {return 'tax_id' === $name ? $id : $v;}

	function tax_id_style() {print '<style>#tax_id{width:4em}</style>';}



	// колонка "ID" для постов и страниц в админке

	add_filter('manage_posts_columns', 'posts_add_col', 5);

	add_action('manage_posts_custom_column', 'posts_show_id', 5, 2);

	add_filter('manage_pages_columns', 'posts_add_col', 5);

	add_action('manage_pages_custom_column', 'posts_show_id', 5, 2);

	add_action('admin_print_styles-edit.php', 'posts_id_style');

	function posts_add_col($defaults) {$defaults['wps_post_id'] = __('ID'); return $defaults;}

	function posts_show_id($column_name, $id) {if ($column_name === 'wps_post_id') echo $id;}

	function posts_id_style() {print '<style>#wps_post_id{width:4em}</style>';}

}



// Type inf

add_action('init', 'exso_inf_init');

function exso_inf_init()

{

	$labels = array(

		'name' => 'inf',

		'singular_name' => 'inf',

		'add_new' => 'Add inf',

		'add_new_item' => 'Add New inf',

		'edit_item' => 'Edit inf',

		'new_item' => 'New inf',

		'view_item' => 'View inf',

		'search_items' => 'Search infs',

		'not_found' =>  'infs not found',

		'not_found_in_trash' => 'In cart infs not found',

		'parent_item_colon' => '',

		'menu_name' => 'Почему нас выбирают'

	);

	$args = array(

		'labels' => $labels,

		'public' => true,

		'publicly_queryable' => true,

		'show_ui' => true,

		'show_in_menu' => true,

		'query_var' => true,

		'rewrite' => true,

		'taxonomies' => array(),

		'menu_icon' => 'dashicons-format-gallery',

		'capability_type' => 'post',

		'has_archive' => true,

		'hierarchical' => false,

		'menu_position' => null,

		'supports' => array('title','editor','thumbnail')

	);

	register_post_type('inf',$args);

}



add_filter('post_updated_messages', 'exso_inf_updated_messages');

function exso_inf_updated_messages($messages){

	global $post, $post_ID;



	$messages['inf'] = array(

		0 => '',

		1 => sprintf('infs updated. <a href="%s">Vew inf</a>', esc_url(get_permalink($post_ID))),

		2 => 'Custom field updated.',

		3 => 'Custom field removed.',

		4 => 'infs updated.',

		5 => isset($_GET['revision']) ? sprintf('inf restored from revision %s', wp_post_revision_title((int) $_GET['revision'], false)) : false,

		6 => sprintf('inf posted. <a href="%s">Go to inf</a>', esc_url(get_permalink($post_ID))),

		7 => 'inf saved.',

		8 => sprintf('inf saved. <a target="_blank" href="%s">Preview inf</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),

		9 => sprintf('inf is scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview inf</a>',

			date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),

		10 => sprintf('inf draft updated. <a target="_blank" href="%s">Preview inf</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),

	);



	return $messages;

}



// Type step

add_action('init', 'exso_step_init');

function exso_step_init()

{

	$labels = array(

		'name' => 'step',

		'singular_name' => 'step',

		'add_new' => 'Add step',

		'add_new_item' => 'Add New step',

		'edit_item' => 'Edit step',

		'new_item' => 'New step',

		'view_item' => 'View step',

		'search_items' => 'Search steps',

		'not_found' =>  'steps not found',

		'not_found_in_trash' => 'In cart steps not found',

		'parent_item_colon' => '',

		'menu_name' => 'Как мы работаем'

	);

	$args = array(

		'labels' => $labels,

		'public' => true,

		'publicly_queryable' => true,

		'show_ui' => true,

		'show_in_menu' => true,

		'query_var' => true,

		'rewrite' => true,

		'taxonomies' => array(),

		'menu_icon' => 'dashicons-products',

		'capability_type' => 'post',

		'has_archive' => true,

		'hierarchical' => false,

		'menu_position' => null,

		'supports' => array('title','editor','thumbnail')

	);

	register_post_type('step',$args);

}



add_filter('post_updated_messages', 'exso_step_updated_messages');

function exso_step_updated_messages($messages){

	global $post, $post_ID;



	$messages['step'] = array(

		0 => '',

		1 => sprintf('steps updated. <a href="%s">Vew step</a>', esc_url(get_permalink($post_ID))),

		2 => 'Custom field updated.',

		3 => 'Custom field removed.',

		4 => 'steps updated.',

		5 => isset($_GET['revision']) ? sprintf('step restored from revision %s', wp_post_revision_title((int) $_GET['revision'], false)) : false,

		6 => sprintf('step posted. <a href="%s">Go to step</a>', esc_url(get_permalink($post_ID))),

		7 => 'step saved.',

		8 => sprintf('step saved. <a target="_blank" href="%s">Preview step</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),

		9 => sprintf('step is scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview step</a>',

			date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),

		10 => sprintf('step draft updated. <a target="_blank" href="%s">Preview step</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),

	);



	return $messages;

}


// Type partners

add_action('init', 'exso_partners_init');

function exso_partners_init()

{

	$labels = array(

		'name' => 'partners',

		'singular_name' => 'partners',

		'add_new' => 'Add partners',

		'add_new_item' => 'Add New partners',

		'edit_item' => 'Edit partners',

		'new_item' => 'New partners',

		'view_item' => 'View partners',

		'search_items' => 'Search partnerss',

		'not_found' =>  'partnerss not found',

		'not_found_in_trash' => 'In cart partnerss not found',

		'parent_item_colon' => '',

		'menu_name' => 'Наши клиенты'

	);

	$args = array(

		'labels' => $labels,

		'public' => true,

		'publicly_queryable' => true,

		'show_ui' => true,

		'show_in_menu' => true,

		'query_var' => true,

		'rewrite' => true,

		'taxonomies' => array(),

		'menu_icon' => 'dashicons-products',

		'capability_type' => 'post',

		'has_archive' => true,

		'hierarchical' => false,

		'menu_position' => null,

		'supports' => array('title','editor','thumbnail')

	);

	register_post_type('partners',$args);

}



add_filter('post_updated_messages', 'exso_partners_updated_messages');

function exso_partners_updated_messages($messages){

	global $post, $post_ID;



	$messages['partners'] = array(

		0 => '',

		1 => sprintf('partnerss updated. <a href="%s">Vew partners</a>', esc_url(get_permalink($post_ID))),

		2 => 'Custom field updated.',

		3 => 'Custom field removed.',

		4 => 'partnerss updated.',

		5 => isset($_GET['revision']) ? sprintf('partners restored from revision %s', wp_post_revision_title((int) $_GET['revision'], false)) : false,

		6 => sprintf('partners posted. <a href="%s">Go to partners</a>', esc_url(get_permalink($post_ID))),

		7 => 'partners saved.',

		8 => sprintf('partners saved. <a target="_blank" href="%s">Preview partners</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),

		9 => sprintf('partners is scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview partners</a>',

			date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),

		10 => sprintf('partners draft updated. <a target="_blank" href="%s">Preview partners</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),

	);



	return $messages;

}



// Type reviews

add_action('init', 'exso_reviews_init');

function exso_reviews_init()

{

	$labels = array(

		'name' => 'reviews',

		'singular_name' => 'reviews',

		'add_new' => 'Add reviews',

		'add_new_item' => 'Add New reviews',

		'edit_item' => 'Edit reviews',

		'new_item' => 'New reviews',

		'view_item' => 'View reviews',

		'search_items' => 'Search reviewss',

		'not_found' =>  'reviewss not found',

		'not_found_in_trash' => 'In cart reviewss not found',

		'parent_item_colon' => '',

		'menu_name' => 'Отзывы'

	);

	$args = array(

		'labels' => $labels,

		'public' => true,

		'publicly_queryable' => true,

		'show_ui' => true,

		'show_in_menu' => true,

		'query_var' => true,

		'rewrite' => true,

		'taxonomies' => array(),

		'menu_icon' => 'dashicons-products',

		'capability_type' => 'post',

		'has_archive' => true,

		'hierarchical' => false,

		'menu_position' => null,

		'supports' => array('title','editor','thumbnail')

	);

	register_post_type('reviews',$args);

}



add_filter('post_updated_messages', 'exso_reviews_updated_messages');

function exso_reviews_updated_messages($messages){

	global $post, $post_ID;



	$messages['reviews'] = array(

		0 => '',

		1 => sprintf('reviewss updated. <a href="%s">Vew reviews</a>', esc_url(get_permalink($post_ID))),

		2 => 'Custom field updated.',

		3 => 'Custom field removed.',

		4 => 'reviewss updated.',

		5 => isset($_GET['revision']) ? sprintf('reviews restored from revision %s', wp_post_revision_title((int) $_GET['revision'], false)) : false,

		6 => sprintf('reviews posted. <a href="%s">Go to reviews</a>', esc_url(get_permalink($post_ID))),

		7 => 'reviews saved.',

		8 => sprintf('reviews saved. <a target="_blank" href="%s">Preview reviews</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),

		9 => sprintf('reviews is scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview reviews</a>',

			date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),

		10 => sprintf('reviews draft updated. <a target="_blank" href="%s">Preview reviews</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),

	);



	return $messages;

}


// Type sewing

add_action('init', 'exso_sewing_init');

function exso_sewing_init()

{

	$labels = array(

		'name' => 'sewing',

		'singular_name' => 'sewing',

		'add_new' => 'Add sewing',

		'add_new_item' => 'Add New sewing',

		'edit_item' => 'Edit sewing',

		'new_item' => 'New sewing',

		'view_item' => 'View sewing',

		'search_items' => 'Search sewing',

		'not_found' =>  'sewing not found',

		'not_found_in_trash' => 'In cart sewings not found',

		'parent_item_colon' => '',

		'menu_name' => 'Пошив одежды'

	);

	$args = array(

		'labels' => $labels,

		'public' => true,

		'publicly_queryable' => true,

		'show_ui' => true,

		'show_in_menu' => true,

		'query_var' => true,

		'rewrite' => true,

		'taxonomies' => array(),

		'menu_icon' => 'dashicons-products',

		'capability_type' => 'post',

		'has_archive' => true,

		'hierarchical' => false,

		'menu_position' => null,

		'supports' => array('title','editor','thumbnail')

	);

	register_post_type('sewing',$args);

}



add_filter('post_updated_messages', 'exso_sewing_updated_messages');

function exso_sewing_updated_messages($messages){

	global $post, $post_ID;



	$messages['sewing'] = array(

		0 => '',

		1 => sprintf('sewings updated. <a href="%s">Vew sewing</a>', esc_url(get_permalink($post_ID))),

		2 => 'Custom field updated.',

		3 => 'Custom field removed.',

		4 => 'sewings updated.',

		5 => isset($_GET['revision']) ? sprintf('sewing restored from revision %s', wp_post_revision_title((int) $_GET['revision'], false)) : false,

		6 => sprintf('sewing posted. <a href="%s">Go to sewing</a>', esc_url(get_permalink($post_ID))),

		7 => 'sewing saved.',

		8 => sprintf('sewing saved. <a target="_blank" href="%s">Preview sewing</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),

		9 => sprintf('sewing is scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview sewing</a>',

			date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),

		10 => sprintf('sewing draft updated. <a target="_blank" href="%s">Preview sewing</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),

	);



	return $messages;

}




//define( 'WPCF7_AUTOP', false );
//add_filter('wpcf7_autop_or_not', '__return_false');



function register_menu_page_setting() {
add_menu_page('Настройки Темы2', 'Настройки темы', 6, 'setings_page.php', 'themes_setings');
}

//add_action('admin_menu', 'register_menu_page_setting');
function themes_setings(){
?>
<div class="wrap">
<h2>Настройки темы</h2>

<form method="post" action="options.php" enctype="multipart/form-data">
		<?php settings_fields( 'nedw-settings-group' ); ?>
<table class="form-table">

 <tr valign="top">
	 <th scope="row">Телефон</th>
	 <td><input type="text" name="tel" value="<?php echo get_option('tel'); ?>"/></td>
 </tr>

	<tr valign="top">
	 <th scope="row">Телефон 2</th>
	 <td><input type="text" name="tel2" value="<?php echo get_option('tel2'); ?>"/></td>
 </tr>

 <tr valign="top">
	 <th scope="row">Email</th>
	 <td><input type="text" name="email" value="<?php echo get_option('email'); ?>"/></td>
 </tr>

<tr valign="top">
	 <th scope="row">Telegram</th>
	 <td><input type="text" name="Telegram" value="<?php echo get_option('Telegram'); ?>"/></td>
 </tr>
<tr valign="top">
	 <th scope="row">Twitter</th>
	 <td><input type="text" name="Twitter" value="<?php echo get_option('Twitter'); ?>"/></td>
 </tr>

 <tr valign="top">
	 <th scope="row">Facebook</th>
	 <td><input type="text" name="Facebook" value="<?php echo get_option('Facebook'); ?>"/></td>
 </tr>

 <tr valign="top">
	 <th scope="row">Instagram</th>
	 <td><input type="text" name="Instagram" value="<?php echo get_option('Instagram'); ?>"/></td>
 </tr>

 <tr valign="top">
	 <th scope="row">Copyright</th>
	 <td><input type="text" name="copyright" value="<?php echo get_option('copyright'); ?>"/></td>
 </tr>


 </table>
		
		<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>

</form>
<?
}

add_action( 'admin_init', 'register_nedwsettings' );
function register_nedwsettings() {
	register_setting( 'nedw-settings-group', 'tel' );
	register_setting( 'nedw-settings-group', 'tel2' );
	register_setting( 'nedw-settings-group', 'email' );
	register_setting( 'nedw-settings-group', 'Telegram' );
	register_setting( 'nedw-settings-group', 'Twitter' );
	register_setting( 'nedw-settings-group', 'Facebook' );
	register_setting( 'nedw-settings-group', 'Instagram' );
	register_setting( 'nedw-settings-group', 'copyright' );

}


/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Currency

add_filter( 'woocommerce_currencies', 'add_my_currency' );

function add_my_currency( $currencies ) {

		 $currencies['UAH'] = __( 'Українська гривня', 'woocommerce' );

		 return $currencies;

}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);

function add_my_currency_symbol( $currency_symbol, $currency ) {

		 switch( $currency ) {

				 case 'UAH': $currency_symbol = 'грн'; break;

		 }

		 return $currency_symbol;

}

// Remove count before loop

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// Loop before 

add_action('woocommerce_before_shop_loop', 'containerLoopOpen', 10);

function containerLoopOpen(){
	echo '<div class="shop-grid"><!--isset_listing_page-->';
}

add_action('woocommerce_after_shop_loop', 'containerLoopClose', 15);
function containerLoopClose(){
	$shoptext = pll__('shop-text');
echo '<div class="catalog-desc"><!--seo_text_start--><p>'.$shoptext.'</p><!--seo_text_end--></div>';
echo '</div>';

}

// Replace title in loop

remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
add_action('woocommerce_shop_loop_item_title', 'ChangeProductsTitle', 10 );

function ChangeProductsTitle() {
	echo '<span class="title">' . get_the_title() . '</span>';
}

// Add to cart text

add_filter( 'woocommerce_product_add_to_cart_text', 'loopAddCartText' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'loopAddCartText' );
function loopAddCartText() {
	$add = pll__('add-to-cart');
		return __( $add, 'woocommerce' );
}


// Product front container

add_action('woocommerce_before_single_product', 'containerProductOpen', 15);

function containerProductOpen(){
echo '<div class="product-grid"><div class="row-product">';
echo "<!--this_is_product-->";
}

add_action('woocommerce_after_single_product', 'containerProductClose', 25);

function containerProductClose(){
echo '</div></div>';

}


// Move price

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 11 );

// Sku in single product

add_action( 'woocommerce_single_product_summary', 'getSku', 6 );
function getSku(){
	global $product;
	echo '<span class="sku">Артикул: ' . $product->get_sku() . '</span>';
}


// Remove product meta

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


// Shoise color in single product

add_action ( 'woocommerce_single_product_summary', 'shoseColor', 10);

function shoseColor(){
	global $product;
	$vybor = get_field('products_shoise');
	$colormain = get_field('czvet', $product->get_id());
	$pr1 = pll__('pr-1');
	if($vybor){
	echo '<div class="choise-colors__title">'.$pr1.'</div>';
	echo '<div class="choise-colors">';
	echo '<span style="border: 1px solid '.$colormain.'"><span style="background-color: '.$colormain.'">Выбор цвета</span></span>';
	$args = array(
		 'include' => $vybor,
		 );
		$products = wc_get_products( $args );
		foreach ($products as $val){
				$colors = get_field('czvet', $val->get_id());
				echo '<a style="background-color: '.$colors.'" href="'.$val->get_permalink().'">Выбор цвета</a>';
		}
		echo '</div>';
}
}

// Text after form in single product

add_action ( 'woocommerce_after_add_to_cart_button', 'textAfterForm', 40);

function textAfterForm(){
	$pr2 = pll__('pr-2');
	global $product;
	echo '<div class="text-after__form">'.$pr2.' <span class="count">1</span> x <span class="total-price">'.$product->get_price().'</span> грн</div>';

}

// Shoise sizes in single product

add_action ( 'woocommerce_after_add_to_cart_button', 'shoseSizes', 50);
function shoseSizes(){
	global $product;
	$pr3 = pll__('pr-3');
	$pr4 = pll__('pr-4');
	$photo = get_field('photo');
	if($photo){
	echo '<div class="size-row__desc"><span>'.$pr3.'</span><a data-fancybox href="'.$photo['url'].'">'.$pr4.' <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16 8C16 10.1217 15.1571 12.1566 13.6569 13.6569C12.1566 15.1571 10.1217 16 8 16C5.87827 16 3.84344 15.1571 2.34315 13.6569C0.842855 12.1566 0 10.1217 0 8C0 5.87827 0.842855 3.84344 2.34315 2.34315C3.84344 0.842855 5.87827 0 8 0C10.1217 0 12.1566 0.842855 13.6569 2.34315C15.1571 3.84344 16 5.87827 16 8ZM5.496 6.033H6.321C6.459 6.033 6.569 5.92 6.587 5.783C6.677 5.127 7.127 4.649 7.929 4.649C8.615 4.649 9.243 4.992 9.243 5.817C9.243 6.452 8.869 6.744 8.278 7.188C7.605 7.677 7.072 8.248 7.11 9.175L7.113 9.392C7.11405 9.45761 7.14085 9.52017 7.18762 9.5662C7.23439 9.61222 7.29738 9.63801 7.363 9.638H8.174C8.2403 9.638 8.30389 9.61166 8.35078 9.56478C8.39766 9.51789 8.424 9.4543 8.424 9.388V9.283C8.424 8.565 8.697 8.356 9.434 7.797C10.043 7.334 10.678 6.82 10.678 5.741C10.678 4.23 9.402 3.5 8.005 3.5C6.738 3.5 5.35 4.09 5.255 5.786C5.25363 5.81829 5.25888 5.85053 5.27043 5.88072C5.28198 5.91091 5.29958 5.93841 5.32216 5.96155C5.34473 5.98468 5.3718 6.00296 5.40169 6.01524C5.43159 6.02753 5.46368 6.03357 5.496 6.033ZM7.821 12.476C8.431 12.476 8.85 12.082 8.85 11.549C8.85 10.997 8.43 10.609 7.821 10.609C7.237 10.609 6.812 10.997 6.812 11.549C6.812 12.082 7.237 12.476 7.822 12.476H7.821Z" fill="#B0B0B0"/>
</svg></a></div>';
}
echo '<div class="size-row">';
	while ( have_rows('sizes', $product->get_id()) ) : $row = the_row();
		$size = get_sub_field('size_name');
		$count = get_sub_field('count');
		if($count > 0){
			echo '<div class="sizes-col"><span class="sizes-col__name">'.$size.'<span><div class="sizes-col__value"><span class="sizes-col__value-wrap"><input type="button" value="-" class="minus-s"><input readonly step="1" class="size-qty" type="number" value="0" pattern="[0-9]*" min="0" max="'.$count.'"><input type="button" value="+" class="plus-s"></span></div></div>';
		}

	endwhile;
	echo '</div>';
}


// Upload block in single product

add_action ( 'woocommerce_single_product_summary', 'uploadBloack', 50);

function uploadBloack(){
	global $post;
	$lang = pll_current_language();
	$pr13 = pll__('pr-13');
	$pr14 = pll__('pr-14');
	if ( $lang == 'ru' ){
		$linkl = get_field('linkl', 5);
	}elseif ( $lang == 'uk' ){
		$linkl = get_field('linkl', 16);
	}
	echo '<div class="upload-block"><div class="upload-block__title">'.$pr13.'</div><div class="upload-block__wrap"><div class="upload-block__wrap-img"><svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="58" height="58" rx="5" fill="#F9B233"/>
<path d="M27.8254 28.6064H30.1692V30.9502H27.8254V28.6064Z" fill="white"/>
<path d="M30.1692 26.2627H32.5129V28.6064H34.8567V23.9189H30.1692V26.2627Z" fill="white"/>
<path d="M25.4817 26.2627H27.8254V23.9189H23.1379V28.6064H25.4817V26.2627Z" fill="white"/>
<path d="M25.4817 30.9502H23.1379V35.6377H27.8254V33.2939H25.4817V30.9502Z" fill="white"/>
<path d="M32.5129 33.2939H30.1692V35.6377H34.8567V30.9502H32.5129V33.2939Z" fill="white"/>
<path d="M49 19.5469C49 13.7313 44.2687 9 38.4531 9H19.5469C13.7313 9 9 13.7313 9 19.5469V31.0584H16.502V49H41.4979V31.0584H49V19.5469ZM34.0709 11.3438C33.5377 13.6529 31.4661 15.3801 28.9973 15.3801C26.5286 15.3801 24.457 13.6529 23.9237 11.3438H34.0709ZM46.6562 28.7147H41.498V20.4853H39.1542V46.6562H18.8458V20.4853H16.502V28.7147H11.3438V19.5469C11.3438 15.0237 15.0237 11.3438 19.5469 11.3438H21.5364C22.1012 14.9534 25.2316 17.7238 28.9973 17.7238C32.763 17.7238 35.8934 14.9534 36.4582 11.3438H38.4531C42.9763 11.3438 46.6562 15.0237 46.6562 19.5469V28.7147Z" fill="white"/>
</svg></div><div class="upload-block__wrap-text"><a href="'.$linkl.'">'.$pr14.'</a></div></div></div>';

}

// View block in single product

add_action ( 'woocommerce_single_product_summary', 'viewBlock', 60);

function viewBlock(){
	global $post;
	global $product;
	$lang = pll_current_language();
	$pr15 = pll__('pr-15');
	$pr6 = pll__('pr-6');
	$pr7 = pll__('pr-7');
	$pr8 = pll__('pr-8');
	$termo = get_field('termo', 5);
	$sholk = get_field('sholk', 5);
	$vishi = get_field('vishi', 5);


		echo '<div class="view-block"><div class="view-block__title">'.$pr15.'</div><div class="view-block__link">';
		if( have_rows('lblocks') ){
			while( have_rows('lblocks', $product->get_id())){
				the_row();
				$link = get_sub_field('link');
				echo $link;
			} 
		}
		echo '</div></div>';

}


// Remove tabs

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
 
function woo_remove_product_tabs( $tabs ) {

		unset( $tabs['description'] );          // Remove the description tab
		//unset( $tabs['reviews'] );          // Remove the reviews tab
		unset( $tabs['additional_information'] );   // Remove the additional information tab
 
		return $tabs;
}


add_action ( 'woocommerce_after_single_product_summary', 'addTabs', 5);

function addTabs(){
	global $product;
	$pr9 = pll__('pr-9');
	$pr10 = pll__('pr-10');
	$pr11 = pll__('pr-11');
	$pr12 = pll__('pr-12');
	$lang = pll_current_language();
	?>
	<?php $photo = get_field('photo');?>
	<div id="tabs">
		<div class="tabs-nav">
			<ul class="tabs">
				<li class="tab"><a class="active_tab" href="#tab-1"><?php echo $pr9; ?></a></li>
				<li class="tab"><a href="#tab-2"><?php echo $pr10; ?></a></li>
				<?php if($photo): ?>
				<li class="tab"><a href="#tab-3"><?php echo $pr11; ?></a></li>
				<?php endif; ?>
				<li class="tab"><a href="#tab-4"><?php echo $pr12; ?></a></li>
			</ul>
		</div>
		<div class="tabs-content">
			<div class="tab_content" id="tab-1">
				<?php the_content(); ?>
			</div>
			<div class="tab_content" id="tab-2">
				<table class="woocommerce-product-attributes shop_attributes">
					<?php if( have_rows('blocks') ): ?>

					<?php while( have_rows('blocks', $product->get_id())): the_row(); 
						$name = get_sub_field('name');
						$atr = get_sub_field('atr');
						?>
						<tr class="woocommerce-product-attributes-item">
							<th class="woocommerce-product-attributes-item__label"><?php echo $name; ?></th>
							<td class="woocommerce-product-attributes-item__value">
								<p>
									<a><?php echo $atr; ?></a>
								</p>
							</td>
						</tr>
					<?php endwhile; ?>

				<?php endif; ?>
				</table>
			</div>
			<div class="tab_content" id="tab-3">
				<?php if($photo): ?>
					<img src="<?php echo $photo['url'];?>" alt="<?php echo $photo['alt'];?>">
				<?php endif; ?>
			</div>
			<div class="tab_content" id="tab-4">
				<?php if ( $lang == 'ru' ): ?>
					<?php the_field('dostavka', 5) ?>
				<?php elseif ( $lang == 'uk' ): ?>
					<?php the_field('dostavka', 16) ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
}

add_action('promo', 'addTextAfterProduct' );

function addTextAfterProduct(){
	$prodz = pll__('prodz');
	$prod1 = pll__('prod1');
	$prod2 = pll__('prod2');
	echo '<div class="promo-text"><div class="promo-text__wrap"><!--seo_text_start--><div class="promo-text__wrap-item-big"><p>'.$prodz.'</p></div><div class="promo-text__wrap-item"><p>'.$prod1.'</p></div><div class="promo-text__wrap-item"><p>'.$prod2.'</p></div><!--seo_text_end--></div></div>';
}

 function wp_comments_corenavi() {
	$pages = '';
	$max = get_comment_pages_count();
	$page = get_query_var('cpage');
	if (!$page) $page = 1;
	$a['current'] = $page;
	$a['echo'] = false;

	$total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить
	$a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей
	$a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
	$a['prev_text'] = '<svg class="icon icon-prev "><use xlink:href="/wp-content/themes/fashion-theme/static/img/svg/symbols.svg#prev"></use></svg>'; //текст ссылки "Предыдущая страница"
	$a['next_text'] = '<svg class="icon icon-next "><use xlink:href="/wp-content/themes/fashion-theme/static/img/svg/symbols.svg#next"></use></svg>'; //текст ссылки "Следующая страница"

	if ($max > 1) echo '<nav class="woocommerce-pagination nw"><ul>';
	if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $page . ' из ' . $max . '</span>'."\r\n";
	echo $pages . paginate_comments_links($a);
	if ($max > 1) echo '</ul></nav>';
}


// Upload logotip
// Display additional product fields (+ jQuery code)
/*add_action( 'woocommerce_before_add_to_cart_button', 'display_additional_product_fields', 9 );
function display_additional_product_fields(){
	?>
	<p class="form-row validate-required" id="image" >
		<label for="file_field"><?php echo __("Upload Image") . ': '; ?>
			<input type='file' name='image' accept='image/*'>
		</label>
	</p>
	<?php
}


// Add custom fields data as the cart item custom data
add_filter( 'woocommerce_add_cart_item_data', 'add_custom_fields_data_as_custom_cart_item_data', 10, 2 );
function add_custom_fields_data_as_custom_cart_item_data( $cart_item, $product_id ){
	if( isset($_FILES['image']) && ! empty($_FILES['image']) ) {
		$upload       = wp_upload_bits( $_FILES['image']['name'], null, file_get_contents( $_FILES['image']['tmp_name'] ) );
		$filetype     = wp_check_filetype( basename( $upload['file'] ), null );
		$upload_dir   = wp_upload_dir();
		$upl_base_url = is_ssl() ? str_replace('http://', 'https://', $upload_dir['baseurl']) : $upload_dir['baseurl'];
		$base_name    = basename( $upload['file'] );

		$cart_item['file_upload'] = array(
			'guid'      => $upl_base_url .'/'. _wp_relative_upload_path( $upload['file'] ), // Url
			'file_type' => $filetype['type'], // File type
			'file_name' => $base_name, // File name
			'title'     => ucfirst( preg_replace('/\.[^.]+$/', '', $base_name ) ), // Title
		);
		$cart_item['unique_key'] = md5( microtime().rand() ); // Avoid merging items
	}
	return $cart_item;
}

// Display custom cart item data in cart (optional)
add_filter( 'woocommerce_get_item_data', 'display_custom_item_data', 10, 2 );
function display_custom_item_data( $cart_item_data, $cart_item ) {
	if ( isset( $cart_item['file_upload']['title'] ) ){
		$cart_item_data[] = array(
			'name' => __( 'Image uploaded', 'woocommerce' ),
			'value' =>  str_pad($cart_item['file_upload']['title'], 16, 'X', STR_PAD_LEFT) . '…',
		);
	}
	return $cart_item_data;
}

// Save Image data as order item meta data
add_action( 'woocommerce_checkout_create_order_line_item', 'custom_field_update_order_item_meta', 20, 4 );
function custom_field_update_order_item_meta( $item, $cart_item_key, $values, $order ) {
	if ( isset( $values['file_upload'] ) ){
		$item->update_meta_data( '_img_file',  $values['file_upload'] );
	}
}

// Admin orders: Display a linked button + the link of the image file
add_action( 'woocommerce_after_order_itemmeta', 'backend_image_link_after_order_itemmeta', 10, 3 );
function backend_image_link_after_order_itemmeta( $item_id, $item, $product ) {
	// Only in backend for order line items (avoiding errors)
	if( is_admin() && $item->is_type('line_item') && $file_data = $item->get_meta( '_img_file' ) ){
		echo '<p><a href="'.$file_data['guid'].'" target="_blank" class="button">'.__("Open Image") . '</a></p>'; // Optional
		echo '<p><code>'.$file_data['guid'].'</code></p>'; // Optional
	}
}

// Admin new order email: Display a linked button + the link of the image file
add_action( 'woocommerce_email_after_order_table', 'wc_email_new_order_custom_meta_data', 10, 4);
function wc_email_new_order_custom_meta_data( $order, $sent_to_admin, $plain_text, $email ){
	// On "new order" email notifications
	if ( 'new_order' === $email->id ) {
		foreach ($order->get_items() as $item ) {
			if ( $file_data = $item->get_meta( '_img_file' ) ) {
				echo '<p>
					<a href="'.$file_data['guid'].'" target="_blank" class="button">'.__("Download Image") . '</a><br>
					<pre><code style="font-size:12px; background-color:#eee; padding:5px;">'.$file_data['guid'].'</code></pre>
				</p><br>';
			}
		}
	}
}*/

// Display additional product fields (+ jQuery code)
/*add_action( 'woocommerce_before_add_to_cart_button', 'display_additional_product_fields', 9 );
function display_additional_product_fields(){
	// Array of radio button options
	$options = array( __("Front Side"), __("Back Side"), __("Both Sides") );
	// Temporary styles
	?>
	<style>
	.upload-logo a.button { padding: .3em .75em !important; }
	.upload-logo a.button.on { background-color: #CC0000 !important; color: #FFFFFF !important; }
	.upload-logo p span { display:inline-block; padding:0 8px 0 4px; }
	</style><?php
	// Html output ?>
	<div class="upload-logo">
		<p><strong><?php _e( "Add a Logo option"); ?>: </strong>
			<a href="#" class="button"><?php _e( "Yes" ); ?></a>
			<input type="hidden" name="upload_active" value="">
		</p>
		<div id="hidden-inputs" style="display:none">
			<p><label for="radio_field"><?php

			echo __( "Where you want the logo?" ) . ' <br>';

			// Loop though each $options array
			foreach( $options as $key => $option ) {
				$atts = $key == 0 ? 'name="side_field" checked="checked"' : 'name="side_field"'; ?>
				<input type="radio" <?php echo $atts; ?> value="<?php echo $option; ?>"><span> <?php echo $option . '</span> ';
			}
			?>
			</label></p>
			<p><label for="file_field"><?php echo __("Upload logo") . ': '; ?>
				<input type='file' name='image' accept='image/*'>
			</label></p>
		</div>
	</div><?php
	// Javascript (jQuery) ?>
	<script type="text/javascript">
	jQuery( function($){
		var a = '.upload-logo',         b = a+' a.button',
			c = a+' #hidden-inputs',    d = a+' input[type=hidden]';

		$(b).click(function(e){
			e.preventDefault();
			if( ! $(this).hasClass('on') ) {
				$(this).addClass('on');
				$(c).show();
				$(d).val('1');
			} else {
				$(this).removeClass('on');
				$(c).hide('fast');
				$(d).val('');
			}
		});
	});
	</script>
	<?php
}

// @ ===> Manage the file upload <=== @
// Add custom fields data as the cart item custom data 
add_filter( 'woocommerce_add_cart_item_data', 'add_custom_fields_data_as_custom_cart_item_data', 10, 2 );
function add_custom_fields_data_as_custom_cart_item_data( $cart_item, $product_id ){
	if( isset($_POST['upload_active']) && $_POST['upload_active'] && isset($_FILES['image']) ) {
		$upload = wp_upload_bits( $_FILES['image']['name'], null, file_get_contents( $_FILES['image']['tmp_name'] ) );

		$filetype = wp_check_filetype( basename( $upload['file'] ), null );

		$upload_dir = wp_upload_dir();

		$upl_base_url = is_ssl() ? str_replace('http://', 'https://', $upload_dir['baseurl']) : $upload_dir['baseurl'];

		$base_name = basename( $upload['file'] );

		$cart_item['custom_file'] = array(
			'guid'      => $upl_base_url .'/'. _wp_relative_upload_path( $upload['file'] ),
			'file_type' => $filetype['type'],
			'file_name' => $base_name,
			'title'     => preg_replace('/\.[^.]+$/', '', $base_name ),
			'side'      => isset( $_POST['side_field'] ) ? sanitize_text_field( $_POST['side_field'] ) : '',
			'key'       => md5( microtime().rand() ),
		);
	}
	return $cart_item;
}

// Display custom cart item data in cart
add_filter( 'woocommerce_get_item_data', 'display_custom_item_data', 10, 2 );
function display_custom_item_data( $cart_item_data, $cart_item ) {
	print_r($cart_item['custom_file']);
	if ( isset( $cart_item['custom_file']['title'] ) ){
		$cart_item_data[] = array(
			'name' => __( 'Logo', 'woocommerce' ),
			'value' =>  $cart_item['custom_file']['title']
		);
	}

	if ( isset( $cart_item['custom_file']['side'] ) ){
		$cart_item_data[] = array(
			'name' => __( 'Side', 'woocommerce' ),
			'value' =>  $cart_item['custom_file']['side']
		);
	}
	return $cart_item_data;
}

// Save and display Logo data in orders and email notifications (everywhere)
add_action( 'woocommerce_checkout_create_order_line_item', 'custom_field_update_order_item_meta', 20, 4 );
function custom_field_update_order_item_meta( $item, $cart_item_key, $values, $order ) {
	if ( isset( $values['custom_file'] ) ){
		$item->update_meta_data( __('Logo'),  $values['custom_file']['title'] );
		$item->update_meta_data( __('Side'),  $values['custom_file']['side'] );
		$item->update_meta_data( '_logo_file_data',  $values['custom_file'] );
	}
}

// Display a linked button + the link of the logo file in backend
add_action( 'woocommerce_after_order_itemmeta', 'backend_logo_link_after_order_itemmeta', 20, 3 );
function backend_logo_link_after_order_itemmeta( $item_id, $item, $product ) {
	// Only in backend for order line items (avoiding errors)
	if( is_admin() && $item->is_type('line_item') && $item->get_meta('_logo_file_data') ){
		$file_data = $item->get_meta( '_logo_file_data' );
		echo '<p><a href="'.$file_data['guid'].'" target="_blank" class="button">'.__("Open Logo") . '</a></p>';
		echo '<p>Link: <textarea type="text" class="input-text" readonly>'.$file_data['guid'].'</textarea></p>';
	}
}*/

/**
 * Get a button linked to the parent grouped product.
 *
 * @param string (optional): The children product ID (of a grouped product)
 * @output button html
 */
function parent_permalink_button( $post_id = 0 ){
	global $post, $wpdb, $product;

	if( $post_id == 0 )
		$post_id = $post->ID;

	$parent_grouped_id = 0;

	// The SQL query
	$results = $wpdb->get_results( "
		SELECT pm.meta_value as child_ids, pm.post_id
		FROM {$wpdb->prefix}postmeta as pm
		INNER JOIN {$wpdb->prefix}posts as p ON pm.post_id = p.ID
		INNER JOIN {$wpdb->prefix}term_relationships as tr ON pm.post_id = tr.object_id
		INNER JOIN {$wpdb->prefix}terms as t ON tr.term_taxonomy_id = t.term_id
		WHERE p.post_type LIKE 'product'
		AND p.post_status LIKE 'publish'
		AND t.slug LIKE 'grouped'
		AND pm.meta_key LIKE '_children'
		ORDER BY p.ID
	" );

	// Retreiving the parent grouped product ID
	foreach( $results as $result ){
		foreach( maybe_unserialize( $result->child_ids ) as $child_id )
			if( $child_id == $post_id ){
				$parent_grouped_id = $result->post_id;
				break;
			}
		if( $parent_grouped_id != 0 ) break;
	}
	if( $parent_grouped_id != 0 ){
		$product = wc_get_product( $parent_grouped_id );

	   echo '<div class="product-thumbnail">'.get_the_post_thumbnail( $parent_grouped_id, 'minicart', array('class' => 'minicart-img') ).'</div><div class="product-name">'.get_the_title($parent_grouped_id).$product->get_attribute( 'cvet' ).' цвет'.' Артикул '.$product->get_sku();
	} 
	// Optional empty button link when no grouped parent is found
	else {
		echo '<a class="button" style="color:grey">No Parent found</a>';
	}
}


add_action( 'woocommerce_before_add_to_cart_button', 'woocommerce_total_product_price', 31 );
function woocommerce_total_product_price() {
	global $woocommerce, $product;
	// let's setup our divs
	echo '<div id="product_total_price"><p class="price"><bdi><strong>'.$product->get_price().'</strong><span> грн</span></bdi></p></div>';
	//echo sprintf('<div id="product_total_price" style="margin-bottom:20px;">%s %s</div>',__('Product Total:','woocommerce'),'<span class="price">'.$product->get_price().'</span>');
	?>
		<script>
			jQuery(function($){
				var price = <?php echo $product->get_price(); ?>;
				$('.qty').each(function(index, el) {
				$(this).change(function(){
					if (!(this.value < 1)) {

						//var product_total = parseFloat(price * this.value);

						//var target = parseInt(this.value);
						var sum = 0;

						$('.woocommerce-grouped-product-list-item').find('.qty').each(function() {
							  sum = sum + parseInt($(this).val());
						});

						var product_total = parseFloat(price * sum);
						$('#product_total_price .price bdi strong').html(product_total.toFixed(0));

					}
				});
				});

				});

		</script>
	<?php
}

// Чекаут

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
	//unset($fields['billing']['billing_phone']);
	//unset($fields['billing']['billing_first_name']);
	unset($fields['billing']['billing_last_name']);
	unset($fields['billing']['billing_company']);
	unset($fields['billing']['billing_state']);
	//unset($fields['billing']['billing_address_1']);
	unset($fields['billing']['billing_city']);
	unset($fields['billing']['billing_address_2']);
	unset($fields['billing']['billing_postcode']);
	//unset($fields['order']['order_comments']);
	unset($fields['account']['account_username']);
	unset($fields['account']['account_password']);
	unset($fields['account']['account_password-2']);
	return $fields;
}

add_filter( 'woocommerce_default_address_fields', 'custom_override_default_locale_fields' );
function custom_override_default_locale_fields( $fields ) {
	//$fields['first_name']['priority'] = 10;
	$fields['address_1']['priority'] = 170;
	return $fields;
}

add_filter('woocommerce_update_order_review_fragments', 'websites_depot_order_fragments_split_shipping', 10, 1);

function websites_depot_order_fragments_split_shipping($order_fragments) {

	ob_start();
	websites_depot_woocommerce_order_review_shipping_split();
	$websites_depot_woocommerce_order_review_shipping_split = ob_get_clean();

	$order_fragments['.woocommerce-shipping-totals'] = $websites_depot_woocommerce_order_review_shipping_split;

	return $order_fragments;

}

function websites_depot_woocommerce_order_review_shipping_split( $deprecated = false ) {

	wc_get_template( 'checkout/shipping-order-review.php', array( 'checkout' => WC()->checkout() ) );

}

add_action('shipping_new', 'websites_depot_move_new_shipping_table', 5);

function websites_depot_move_new_shipping_table() {

	echo '<div class="checkout-row__blocks woocommerce-shipping-totals shipping">Загружаем методы доставки...</div>';
}


// All string

pll_register_string('Тип одежды', 'cat-1');
pll_register_string('Товары магазина', 'cat-2');
pll_register_string('Купить', 'add-to-cart');

pll_register_string('Адрес', 'adr');
pll_register_string('Время работы', 'time');
pll_register_string('Наши контакты', 'cont');
pll_register_string('Мы в соцсетях', 'soc');

pll_register_string('Текст в каталоге', 'shop-text');

pll_register_string('Подписаться на новости заголовок', 'p1');
pll_register_string('Подписаться на новости текст', 'p2');

pll_register_string('Продукт текст заголовок', 'prodz');
pll_register_string('Продукт текст 1', 'prod1');
pll_register_string('Продукт текст 2', 'prod2');

pll_register_string('Связаться с нами', 'contacts-text-1');
pll_register_string('Контакы текст', 'contacts-text-2');

pll_register_string('Форма заголовок', 'form-title');
pll_register_string('Форма описание', 'form-text');

// Product string

pll_register_string('Цвет', 'pr-1');
pll_register_string('Стоимость без печати', 'pr-2');
pll_register_string('Выберите размер', 'pr-3');
pll_register_string('Таблица размеров', 'pr-4');
pll_register_string('Термоперенос', 'pr-6');
pll_register_string('Шелкотрафарет', 'pr-7');
pll_register_string('Вышивка', 'pr-8');
pll_register_string('Описание товара', 'pr-9');
pll_register_string('Характеристики', 'pr-10');
pll_register_string('Таблица совместимости', 'pr-11');
pll_register_string('Доставка', 'pr-12');

pll_register_string('Печать вашего изображения на товаре', 'pr-13');
pll_register_string('Разместить свой логотип на этом товаре', 'pr-14');
pll_register_string('Возможные виды печати на этой ветровке', 'pr-15');

pll_register_string('Отзывы покупателей', 'pr-16');
pll_register_string('Добавить отзыв', 'pr-17');

// Cart string

pll_register_string('Наименование товара', 'ct-1');
pll_register_string('Размер', 'ct-2');
pll_register_string('Количество', 'ct-3');
pll_register_string('Цена единицы', 'ct-4');
pll_register_string('Общая цена', 'ct-5');
pll_register_string('Удалить', 'ct-6');
pll_register_string('Корзина товаров', 'ct-7');
pll_register_string('Продолжить покупки', 'ct-8');
pll_register_string('Оформить заказ', 'ct-9');
pll_register_string('цвет', 'ct-10');
pll_register_string('Общая сумма', 'ct-11');

// Checkout string

pll_register_string('Оформить заказ', 'ch-1');
pll_register_string('Редактировать заказ', 'ch-2');
pll_register_string('Сумма', 'ch-3');
pll_register_string('Способ оплаты', 'ch-4');
pll_register_string('Подтверждаю заказ', 'ch-5');


add_action('woocommerce_widget_shopping_cart_before_buttons','ask_woo_mini_cart_before_buttons' );

function ask_woo_mini_cart_before_buttons(){
	wp_nonce_field( 'woocommerce-cart' ); 
	?>
	<div class="submit-button">
		<input type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Uppdatera varukorg', 'tidymerch'); ?>"/>
	</div>
	<?php
}


// Empty Cart redirect

add_action( 'template_redirect', 'redirectEmptyCart' );

function redirectEmptyCart() {

if ( is_cart() && is_checkout() && 0 == WC()->cart->get_cart_contents_count() && ! is_wc_endpoint_url( 'order-pay' ) && ! is_wc_endpoint_url( 'order-received' ) ) {


wp_safe_redirect( home_url() );

exit;

}

}

/**
 * Обрезка текста (excerpt). Шоткоды вырезаются. Минимальное значение maxchar может быть 22.
 *
 * @param string/array $args Параметры.
 *
 * @return string HTML
 *
 * @ver 2.6.4
 */
function kama_excerpt( $args = '' ){
	global $post;

	if( is_string($args) )
		parse_str( $args, $args );

	$rg = (object) array_merge( array(
		'maxchar'   => 350,   // Макс. количество символов.
		'text'      => '',    // Какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
							  // Если в тексте есть `<!--more-->`, то `maxchar` игнорируется и берется все до <!--more--> вместе с HTML.
		'autop'     => false,  // Заменить переносы строк на <p> и <br> или нет?
		'save_tags' => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'.
		'more_text' => 'Читать дальше...', // Текст ссылки `Читать дальше`.
	), $args );

	$rg = apply_filters( 'kama_excerpt_args', $rg );

	if( ! $rg->text )
		$rg->text = $post->post_excerpt ?: $post->post_content;

	$text = $rg->text;
	$text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text ); // убираем блочные шорткоды: [foo]some data[/foo]. Учитывает markdown
	$text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text ); // убираем шоткоды: [singlepic id=3]. Учитывает markdown
	$text = trim( $text );

	// <!--more-->
	if( strpos( $text, '<!--more-->') ){
		preg_match('/(.*)<!--more-->/s', $text, $mm );

		$text = trim( $mm[1] );

		$text_append = ' <a href="'. get_permalink( $post ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
	}
	// text, excerpt, content
	else {
		$text = trim( strip_tags($text, $rg->save_tags) );

		// Обрезаем
		if( mb_strlen($text) > $rg->maxchar ){
			$text = mb_substr( $text, 0, $rg->maxchar );
			$text = preg_replace( '~(.*)\s[^\s]*$~s', '\\1...', $text ); // убираем последнее слово, оно 99% неполное
		}
	}

	// Сохраняем переносы строк. Упрощенный аналог wpautop()
	if( $rg->autop ){
		$text = preg_replace(
			array("/\r/", "/\n{2,}/", "/\n/",   '~</p><br ?/?>~'),
			array('',     '</p><p>',  '<br />', '</p>'),
			$text
		);
	}

	$text = apply_filters( 'kama_excerpt', $text, $rg );

	if( isset($text_append) )
		$text .= $text_append;

	return ( $rg->autop && $text ) ? "<p>$text</p>" : $text;
}


/*
 * Функция создает дубликат поста в виде черновика и редиректит на его страницу редактирования
 */
function true_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'true_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('Нечего дублировать!');
	}
 
	/*
	 * получаем ID оригинального поста
	 */
	$post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
	/*
	 * а затем и все его данные
	 */
	$post = get_post( $post_id );
 
	/*
	 * если вы не хотите, чтобы текущий автор был автором нового поста
	 * тогда замените следующие две строчки на: $new_post_author = $post->post_author;
	 * при замене этих строк автор будет копироваться из оригинального поста
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	/*
	 * если пост существует, создаем его дубликат
	 */
	if (isset( $post ) && $post != null) {
 
		/*
		 * массив данных нового поста
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft', // черновик, если хотите сразу публиковать - замените на publish
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		/*
		 * создаем пост при помощи функции wp_insert_post()
		 */
		$new_post_id = wp_insert_post( $args );
 
		/*
		 * присваиваем новому посту все элементы таксономий (рубрики, метки и т.д.) старого
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // возвращает массив названий таксономий, используемых для указанного типа поста, например array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
 
		/*
		 * дублируем все произвольные поля
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
 
 
		/*
		 * и наконец, перенаправляем пользователя на страницу редактирования нового поста
		 */
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Ошибка создания поста, не могу найти оригинальный пост с ID=: ' . $post_id);
	}
}
add_action( 'admin_action_true_duplicate_post_as_draft', 'true_duplicate_post_as_draft' );
 
/*
 * Добавляем ссылку дублирования поста для post_row_actions
 */
function true_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="admin.php?action=true_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Дублировать этот пост" rel="permalink">Дублировать</a>';
	}
	return $actions;
}

add_filter( 'post_row_actions', 'true_duplicate_post_link', 10, 2 );



/**
 * show_hidden_products
* @param $q
 *
 */

function show_hidden_products( $q ){

    if (!$_GET['filters'])
        return;



//    $filters =  $_GET['filters']  ;
//
//
//    if(strpos($filters, 'cvet') == false)
//        return;



    $tax_query  =  (array) $q->get( 'tax_query')  ;

	 foreach ($tax_query as  $i => $value) {
	 	if (is_array($value)) {
	     foreach ($value as $key => $tax) {

	         if ($tax === 'product_visibility' ) {

	             unset( $tax_query[$i]  );
	         }

	     }
	 }


	 }

    $tax_query[] = array(
            'taxonomy'  => 'product_type',
            'field'     => 'name',
            'terms'     => array('grouped'),
        );




 	$q->set( 'tax_query', $tax_query );



}

  add_action( 'woocommerce_product_query', 'show_hidden_products', 99999  );


   // add_filter( 'woocommerce_product_query_tax_query', 'only_grouped_products', 20, 1 );
function only_grouped_products( $tax_query ){

    if ($_GET['filters']) {
        $tax_query[] = array(
            'taxonomy'  => 'product_type',
            'field'     => 'name',
            'terms'     => array('grouped'),
        );

    }
    return $tax_query;
}




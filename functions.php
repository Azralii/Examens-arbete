<?php

/**
 * Marka Cadey WordPress Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Marka_Cadey_WordPress_Theme
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function marka_cadey_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Marka Cadey WordPress Theme, use a find and replace
		* to change 'marka-cadey' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('marka-cadey', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'marka-cadey'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'marka_cadey_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 62,
			// 'flex-width'  => true,
			// 'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'marka_cadey_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function marka_cadey_content_width()
{
	$GLOBALS['content_width'] = apply_filters('marka_cadey_content_width', 640);
}
add_action('after_setup_theme', 'marka_cadey_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function marka_cadey_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'marka-cadey'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'marka-cadey'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(array(
		'name'          => __('Footer Widget Area', 'marka-cadey'),
		'id'            => 'footer-widget',
		'description'   => __('Add widgets here to appear in the footer.', 'marka-cadey'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	));
}
add_action('widgets_init', 'marka_cadey_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function marka_cadey_scripts()
{
	wp_enqueue_style('marka-cadey-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('marka-cadey-style', 'rtl', 'replace');

	wp_enqueue_script('marka-cadey-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'marka_cadey_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// script and styles added 
require get_template_directory() . '/inc/script-includes.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}



class Custom_Header_Navwalker extends Walker_Nav_Menu
{

	public function start_lvl(&$output, $depth = 0, $args = null)
	{
		$indent = str_repeat("\t", $depth);
		$submenu = ($depth > 0) ? ' sub-menu' : '';
		$output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
	}

	public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
	{
		$indent = ($depth) ? str_repeat("\t", $depth) : '';

		$li_attributes = '';
		$class_names = $value = '';

		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = 'nav-item';
		$classes[] = 'nav-item-' . $item->ID;

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = ' class="' . esc_attr($class_names) . '"';

		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

		$attributes .= ' class="nav-link' . ($args->walker->has_children ? ' dropdown-toggle' : '') . '"';

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= ($args->walker->has_children) ? ' <i class="fa fa-angle-down"></i>' : '';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}



class Marka_Cadey_Footer_Widget extends WP_Widget
{

	public function __construct()
	{
		parent::__construct(
			'marka_cadey_footer_widget',
			__('Footer Widget', 'marka-cadey'),
			array('description' => __('Add content to the footer', 'marka-cadey'),)
		);
	}

	public function widget($args, $instance)
	{
		echo $args['before_widget']; ?>
		<div class="container">
			<div class="footer-inner">
				<div class="footer-heading">
					<?php if (!empty($instance['restaurant_name'])) : ?>
						<h3><?php echo esc_html($instance['restaurant_name']); ?></h3>
					<?php endif; ?>
					<?php if (!empty($instance['description'])) : ?>
						<p><?php echo esc_html($instance['description']); ?></p>
					<?php endif; ?>
					<?php if (!empty($instance['phone_number'])) : ?>
						<div class="ring">
							<a class="footer-link" href="tel:<?php echo esc_attr($instance['phone_number']); ?>">Ring på: <?php echo esc_html($instance['phone_number']); ?></a>
						</div>
					<?php endif; ?>
					<?php if (!empty($instance['facebook_link']) || !empty($instance['instagram_link'])) : ?>
						<ul class="list-inline mb-0 mt-4">
							<?php if (!empty($instance['facebook_link'])) : ?>
								<li class="list-inline-item"><a href="<?php echo esc_url($instance['facebook_link']); ?>"><i class="fab fa-facebook"></i></a></li>
							<?php endif; ?>
							<?php if (!empty($instance['instagram_link'])) : ?>
								<li class="list-inline-item"><a href="<?php echo esc_url($instance['instagram_link']); ?>"><i class="fab fa-instagram"></i></a></li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>
				</div>
				<div class="row align-items-center">
					<div class="col-md-7 text-center text-md-start">
						<?php if (!empty($instance['copyright_text'])) : ?>
							<p class="copyright-text"><?php echo esc_html($instance['copyright_text']); ?></p>
						<?php endif; ?>
					</div>
					<div class="col-md-5 text-center text-md-end">
						<?php if (!empty($instance['powered_by_text'])) : ?>
							<p class="powered-text"><?php echo esc_html($instance['powered_by_text']); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php echo $args['after_widget'];
	}

	public function form($instance)
	{
		$restaurant_name = !empty($instance['restaurant_name']) ? $instance['restaurant_name'] : 'Restaurang Marka cadey';
		$description = !empty($instance['description']) ? $instance['description'] : 'Vi är en mysig somaliska restaurang som serverar fantastisk mat i hjärtat av Malmö.';
		$phone_number = !empty($instance['phone_number']) ? $instance['phone_number'] : '0700198464';
		$facebook_link = !empty($instance['facebook_link']) ? $instance['facebook_link'] : '/';
		$instagram_link = !empty($instance['instagram_link']) ? $instance['instagram_link'] : '/';
		$copyright_text = !empty($instance['copyright_text']) ? $instance['copyright_text'] : '@copy; 2024 Marka Cadey Restaurang. Alla rättigheter förbehållna.';
		$powered_by_text = !empty($instance['powered_by_text']) ? $instance['powered_by_text'] : 'Powered by Liibaan Abdulle';
	?>
		<p>
			<label for="<?php echo $this->get_field_id('restaurant_name'); ?>"><?php _e('Restaurant Name:', 'marka-cadey'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('restaurant_name'); ?>" name="<?php echo $this->get_field_name('restaurant_name'); ?>" type="text" value="<?php echo esc_attr($restaurant_name); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:', 'marka-cadey'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" rows="5"><?php echo esc_textarea($description); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('phone_number'); ?>"><?php _e('Phone Number:', 'marka-cadey'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('phone_number'); ?>" name="<?php echo $this->get_field_name('phone_number'); ?>" type="text" value="<?php echo esc_attr($phone_number); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('facebook_link'); ?>"><?php _e('Facebook Link:', 'marka-cadey'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook_link'); ?>" name="<?php echo $this->get_field_name('facebook_link'); ?>" type="text" value="<?php echo esc_attr($facebook_link); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('instagram_link'); ?>"><?php _e('Instagram Link:', 'marka-cadey'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('instagram_link'); ?>" name="<?php echo $this->get_field_name('instagram_link'); ?>" type="text" value="<?php echo esc_attr($instagram_link); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('copyright_text'); ?>"><?php _e('Copyright Text:', 'marka-cadey'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('copyright_text'); ?>" name="<?php echo $this->get_field_name('copyright_text'); ?>" type="text" value="<?php echo esc_attr($copyright_text); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('powered_by_text'); ?>"><?php _e('Powered By Text:', 'marka-cadey'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('powered_by_text'); ?>" name="<?php echo $this->get_field_name('powered_by_text'); ?>" type="text" value="<?php echo esc_attr($powered_by_text); ?>">
		</p>
<?php
	}

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['restaurant_name'] = !empty($new_instance['restaurant_name']) ? sanitize_text_field($new_instance['restaurant_name']) : '';
		$instance['description'] = !empty($new_instance['description']) ? sanitize_text_field($new_instance['description']) : '';
		$instance['phone_number'] = !empty($new_instance['phone_number']) ? sanitize_text_field($new_instance['phone_number']) : '';
		$instance['facebook_link'] = !empty($new_instance['facebook_link']) ? esc_url($new_instance['facebook_link']) : '';
		$instance['instagram_link'] = !empty($new_instance['instagram_link']) ? esc_url($new_instance['instagram_link']) : '';
		$instance['copyright_text'] = !empty($new_instance['copyright_text']) ? sanitize_text_field($new_instance['copyright_text']) : '';
		$instance['powered_by_text'] = !empty($new_instance['powered_by_text']) ? sanitize_text_field($new_instance['powered_by_text']) : '';
		return $instance;
	}
}

function register_marka_cadey_footer_widget()
{
	register_widget('Marka_Cadey_Footer_Widget');
	// register_widget('Marka_Cadey_Banner_Widget');
}
add_action('widgets_init', 'register_marka_cadey_footer_widget');


remove_action('after_setup_theme', 'marka_cadey_custom_header_setup');

// Function to display a notification and start importing demo pages
function display_import_notification()
{
	// Check if this is the first activation of the theme
	$theme = wp_get_theme();
	$theme_activation = get_option('theme_activation_' . $theme->get('Template'));

	if (!$theme_activation) {
		// Display a notification to the user
		echo '<div class="notice notice-info is-dismissible">';
		echo '<p>Welcome to our theme! Would you like to import demo pages?</p>';
		echo '<form method="post">';
		echo '<input type="hidden" name="import_demo_pages" value="yes">';
		echo '<button type="submit" class="button button-primary">Yes, import demo pages</button>';
		echo '</form>';
		echo '</div>';
	}
}

// Hook the display_import_notification function to run after the theme is activated
// add_action('after_switch_theme', 'display_import_notification');


$theme = wp_get_theme();
$theme_activation = get_option('theme_activation_' . $theme->get('Template'));
if (!$theme_activation && isset($_POST['import_demo_pages']) && $_POST['import_demo_pages'] == 'yes') {
	// Add your code to create pages here
	$pages = array(
		array(
			'title' => 'Page 1',
			'content' => 'This is the content of page 1.',
		),
		array(
			'title' => 'Page 2',
			'content' => 'This is the content of page 2.',
		),
		// Add more pages as needed
	);

	foreach ($pages as $page) {
		$new_page = array(
			'post_title'    => $page['title'],
			'post_content'  => $page['content'],
			'post_status'   => 'publish',
			'post_type'     => 'page',
		);

		// Insert the page into the database
		$page_id = wp_insert_post($new_page);
	}

	// Set a flag to indicate that the import has been completed
	update_option('theme_activation_' . $theme->get('Template'), true);

	// Display a success message
	echo '<div class="notice notice-success is-dismissible">';
	echo '<p>Demo pages have been imported successfully!</p>';
	echo '</div>';
}

// update_option('theme_activation_' . $theme->get('Template'), false);


// Sidebar for Footer 


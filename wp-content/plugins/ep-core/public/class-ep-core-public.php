<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://themeforest.net/user/epicomedia/portfolio
 * @since      1.0.0
 *
 * @package    EPICO_core
 * @subpackage EPICO_core/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    EPICO_core
 * @subpackage EPICO_core/public
 * @author     EpicoMedia <help.epicomedia@gmail.com>
 */
class EPICO_core_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;


        //Use shortcodes in text widgets.
        add_filter('widget_text', 'do_shortcode');

        if(!has_action("epico_wc_register_taxonomy_before_import")) {
            add_action( "epico_wc_register_taxonomy_before_import", array( $this, "register_WC_taxonomy_before_import" ) );
        }

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in EPICO_core_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The EPICO_core_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ep-core-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in EPICO_core_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The EPICO_core_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ep-core-public.js', array( 'jquery' ), $this->version, false );

	}

    //core custom Post type 
	public function create_custom_portfolio_post_type() {

        $labels = array(
            'name' => __( 'Portfolio', 'epicomedia'),
            'singular_name' => __( 'Portfolio', 'epicomedia' ),
            'add_new' => __('Add New Item', 'epicomedia'),
            'add_new_item' => __('Add New Portfolio', 'epicomedia'),
            'edit_item' => __('Edit Portfolio', 'epicomedia'),
            'new_item' => __('New Portfolio', 'epicomedia'),
            'view_item' => __('View Portfolio', 'epicomedia'),
            'search_items' => __('Search Portfolio', 'epicomedia'),
            'not_found' =>  __('No portfolios found', 'epicomedia'),
            'not_found_in_trash' => __('No portfolios found in trash', 'epicomedia'),
            'parent_item_colon' => ''
        );

        $args = array(
            'labels' =>  $labels,
            'public' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_icon' => EPICO_THEME_ASSETS_URI  . '/img/post-format-icon/portfolio-icon.png',
            'rewrite' => array('slug' => 'portfolios', 'with_front' => true),
            'supports' => array('title',
                'editor',
                'thumbnail', 
                'tags',
                'post-formats'
            ),
            "show_in_nav_menus" => false
        );
		register_post_type( 'portfolio', $args );

		/* Register the corresponding taxonomy */
        register_taxonomy('skills', 'portfolio',
            array("hierarchical" => true,
                "label" => __( "Categories", 'epicomedia' ),
                "singular_label" => __( "Category",  'epicomedia' ),
                "rewrite" => array( 'slug' => 'skills','hierarchical' => true),
                "show_in_nav_menus" => false
            ));
	}

    // gallery custom Post type 
    public function create_custom_gallery_post_type() {

        $labels = array(
            'name' => __('Gallery', 'epicomedia'),
            'singular_name' => __('Gallery', 'epicomedia' ),
            'add_new' => __('Add New Item', 'epicomedia'),
            'add_new_item' => __('Add new gallery item', 'epicomedia'),
            'edit_item' => __('Edit Gallery', 'epicomedia'),
            'new_item' => __('New Gallery', 'epicomedia'),
            'view_item' => __('View Gallery', 'epicomedia'),
            'search_items' => __('Search Gallery', 'epicomedia'),
            'not_found' =>  __('No gallery item found', 'epicomedia'),
            'not_found_in_trash' => __('No gallery item was found in trash', 'epicomedia'),
            'parent_item_colon' => ''
        );

        $args = array(
            'labels' =>  $labels,
            'public' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'menu_icon' => EPICO_THEME_ASSETS_URI  . '/img/post-format-icon/gallery-icon.png',
            'rewrite' => array('slug' => 'gallery_cat'),
            'supports' => array('title',
                                'thumbnail', 
                                'tags',
                                'post-formats'
                                ),
        );
        register_post_type( 'gallery', $args );

        /* Register the corresponding taxonomy */
        register_taxonomy('gallery_cat', 'gallery',
            array("hierarchical" => true,
                "label" => __("Categories", 'epicomedia' ),
                "singular_label" => __("Category",  'epicomedia' ),
                "rewrite" => array( 'slug' => 'gallery_cat','hierarchical' => true),
                "show_in_nav_menus" => false
        ));
    }

    // Epico Slider custom Post type 
    public function create_custom_epicoslider_post_type() {

        $labels = array(
            'name' => __( 'Slides', 'epicomedia'),
            'singular_name' => __( 'Slide', 'epicomedia' ),
            'add_new' => __('Add New Slide', 'epicomedia'),
            'add_new_item' => __('Add New Slide', 'epicomedia'),
            'edit_item' => __('Edit Slide', 'epicomedia'),
            'new_item' => __('New Slide', 'epicomedia'),
            'view_item' => __('View Slide', 'epicomedia'),
            'search_items' => __('Search Slide', 'epicomedia'),
            'not_found' =>  __('No Slides found', 'epicomedia'),
            'not_found_in_trash' => __('No Slides found in Trash', 'epicomedia'),
            'parent_item_colon' => ''
        );

        $args = array(
            'labels' =>  $labels,
            'public' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'exclude_from_search' => false,
            'menu_icon' => EPICO_THEME_ASSETS_URI  . '/img/post-format-icon/slide-icon.png',
            'rewrite' => array('slug' => 'slides', 'with_front' => true),
            'supports' => array('title',
                'editor',
                'thumbnail', 
            ),
            "show_in_nav_menus" => false
        );

        register_post_type( 'slider', $args );

        /* Register the corresponding taxonomy */

        register_taxonomy('slider_cats', 'slider',
            array("hierarchical" => true,
                "label" => __( "Categories", 'epicomedia' ),
                "singular_label" => __( "Category",  'epicomedia' ),
                "rewrite" => array( 'slug' => 'slider_cats','hierarchical' => true),
                "show_in_nav_menus" => false
            ));
    }

    public function register_WC_taxonomy_before_import($term_domain) {
        register_taxonomy(
            $term_domain,
            apply_filters( 'woocommerce_taxonomy_objects_' . $term_domain, array( 'product' ) ),
            apply_filters( 'woocommerce_taxonomy_args_' . $term_domain, array(
                'hierarchical' => true,
                'show_ui'      => false,
                'query_var'    => true,
                'rewrite'      => false,
            ) )
        );
    }

    public function instagram_init() {

        //This is not hardcoded
        //This is essential for embedded Instagram plugin to works with Instagram APIs
        //This is a validated Instagram Plugin
        define('INSTAGRAM_CLIENT_ID',      '129fb94f9fe947e8b8cf3f0bd30ed645');
        define('INSTAGRAM_CLIENT_SECRET',  'cd4f084f4a83454a971684683fb8b1da');
        define('INSTAGRAM_API_CALLBACK',  'http://epicomedia.net/instagram/instagram_callback.php');
    }

}

	// social Share in product detail 
	if(!function_exists('epico_woocommerce_social_share')) {
			function epico_woocommerce_social_share()
		{
			global $post;
			// try getting featured image -  pinterest icon 
			$featured_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
			if( ! $featured_img )
			{
				$featured_img = '';
			}
			else
			{
				$featured_img = $featured_img[0];
			}
    
			$output =   '
						<div class="socialShareContainer">
							<div class="label hidden-phone hidden-v-tablet">' . esc_attr__('Share','vitrine') .' : </div>
							<ul class="social-icons dark">
								<!-- facebook Social share button -->
								<li class="socialLinkShortcode iconstyle facebook">
									<a href="http://www.facebook.com/sharer.php?u=' . urlencode(esc_url(get_permalink(get_the_ID()))) . '" title="' . esc_attr__("Share on Facebook!",'vitrine') .'">
										<span class="firstIcon icon icon-facebook"></span>
										<span class="SecoundIcon icon icon-facebook"></span>
									</a>
								</li>

								<!-- twitter icon  --> 
								<li class="socialLinkShortcode iconstyle twitter">
									<a href="https://twitter.com/intent/tweet?original_referer=' . urlencode(esc_url(get_permalink(get_the_ID()))) . '&amp;source=tweetbutton&amp;text=' . esc_attr(urlencode(get_the_title())) . '&amp;url=' . esc_url(urlencode(get_permalink(get_the_ID()))) . '"
										title="' . esc_attr__("Share on Twitter!", 'vitrine') . '">
											<span class="firstIcon icon icon-twitter"></span>
											<span class="SecoundIcon icon icon-twitter"></span>
									</a>
								</li>

                                                                
								<!-- google plus social share button -->
								<li class="socialLinkShortcode iconstyle google-plus">
									<a href="https://plus.google.com/share?url=' . urlencode(esc_url(get_permalink(get_the_ID()))) . '" title="' . esc_attr__("Share on Google+!",'vitrine') . '">
										<span class="firstIcon icon icon-google-plus"></span>
										<span class="SecoundIcon icon icon-google-plus"></span>
									</a>
								</li>
                                                    
								<!-- pinterest icon --> 
								<li class="socialLinkShortcode iconstyle pinterest dddddd">
									<a href="http://pinterest.com/pin/create/button/?url=' . urlencode(esc_url(get_permalink(get_the_ID()))) . '&amp;media=' . esc_url($featured_img) . '&amp;description=' . esc_attr(urlencode(get_the_title())) . '" 
										class="pin-it-button" 
										count-layout="horizontal">
										<span class="firstIcon icon icon-pinterest"></span>
										<span class="SecoundIcon icon icon-pinterest"></span> 
									</a>
								</li>
							</ul>
						</div>';

			echo $output;
		}
	}

	// call social Share in product detail - Quick View  
	add_action( 'quick_view_product_summary', 'epico_woocommerce_social_share', 32 );

	// social Share in product detail 
	add_action( 'woocommerce_single_product_summary', 'epico_woocommerce_social_share', 36 );  // 35 belong compare actions

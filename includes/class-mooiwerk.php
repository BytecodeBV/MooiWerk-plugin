<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://bytecode.nl
 * @since      1.0.0
 *
 * @package    MooiWerk
 * @subpackage MooiWerk/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    MooiWerk
 * @subpackage MooiWerk/includes
 * @author     Bytecode Digital Agency B.V. <support@bytecode.nl>
 */
class MooiWerk
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since  1.0.0
     * @access protected
     * @var  MooiWerk_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since  1.0.0
     * @access protected
     * @var  string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        if (defined('PLUGIN_NAME_VERSION')) {
            $this->version = PLUGIN_NAME_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'mooiwerk';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - MooiWerk_Loader. Orchestrates the hooks of the plugin.
     * - MooiWerk_i18n. Defines internationalization functionality.
     * - MooiWerk_Admin. Defines all hooks for the admin area.
     * - MooiWerk_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/functions.php';

        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/hooks.php';
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-mooiwerk-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-mooiwerk-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-mooiwerk-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-mooiwerk-public.php';

        /**
         * The class reponsible for the custom post type: 'vacancy' functionality.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'structure/vacancies/vacancies.php';

        /**
         * The class responsible for the custom user role 'organisation' functionality.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'structure/organisations/organisations.php';

        /**
         * The class responsible for the custom user role 'volunteer' functionality.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'structure/volunteers/volunteers.php';

        /**
         * The class responsible for the custom my-account functionality.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'structure/my-account/my-account.php';

        /**
         * The code responsible for the custom courses functionality.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'structure/courses/courses.php';

        /**
         * The code responsible for the header functionality.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'structure/header/header.php';

         /**
         * The code responsible for the teams functionality.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'structure/teams/teams.php';

        /**
         * The class responsible for the custom frontpage functionality.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'structure/frontpage/frontpage.php';

         /**
         * The class responsible for the custom posts page functionality.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'structure/advies/advies.php';

        /**
         * The class responsible for the custom content block functionality.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'structure/contact/contact.php';

         /**
         * The class responsible for the call to action functionality.
         */
        //require_once plugin_dir_path(dirname(__FILE__)) . 'structure/cta/cta.php';

        /**
         * The ACF plugin dependency, which is used to add fields to the above post and user types
         */
        if (!class_exists('acf')) {
            error_log(__('ACF(-PRO) is not installed! Please install ACF pro to continue...', 'mooiwerk'));
        }

        $this->loader = new MooiWerk_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the MooiWerk_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale()
    {
        $plugin_i18n = new MooiWerk_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {
        $plugin_admin = new MooiWerk_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {
        $plugin_public = new MooiWerk_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    MooiWerk_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }
}

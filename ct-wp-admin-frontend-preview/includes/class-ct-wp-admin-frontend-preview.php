<?php

class Ct_Admin_Frontend_Preview
{
    const ID = 'ct-previews';

    protected $views = array(
        'view1' => 'views/view1',
        'not-found' => 'views/not-found'
    );

    private $current_page = '';
    private $preview_url = 'ctpreview';
    private $preview_param = 'shortcodepreview';

    public function init()
    {
        add_action('admin_menu', array($this, 'add_menu_page'), 20);

        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));

        add_action('template_include', array($this, 'ct_preview_iframe'));

    }

    public function get_id()
    {
        return self::ID;
    }


    public function add_menu_page()
    {
        add_menu_page(
            esc_html__('Preview shortcodes', 'ct-admin'),
            esc_html__('Preview shortcodes', 'ct-admin'),
            'manage_options',
            $this->get_id(),
            array(&$this, 'load_view'),
            'dashicons-admin-page'
        );

    }

    function ct_preview_iframe($template)
    {

        if (isset($_GET[$this->preview_param])) {
            // /ctpreview?shortcodepreview=1
            global $wp;
            $current_url = home_url(add_query_arg($_GET, $wp->request));

            if (strpos($current_url, $this->preview_url) !== false) {
                global $wp_query;
                status_header(200);
                $wp_query->is_page = true;
                $wp_query->is_404 = false;

                $page_template = ct_admin_template_server_path('views/preview', false);
                return $page_template;
            }
        }

        return $template;
    }


    function load_view()
    {
        $this->current_page = ct_admin_preview_current_step();

        $current_views = isset($this->views[$this->current_page]) ? $this->views[$this->current_page] : $this->views['not-found'];

        $step_data_func_name = $this->current_page . '_data';

        $args = [];
        /**
         * prepare data for view
         */
        if (method_exists($this, $step_data_func_name)) {
            $args = $this->$step_data_func_name();
        }
        /**
         * Default Admin Form Template
         */


        echo '<div class="ct-admin-frontend-preview ' . $this->current_page . '">';

        echo '<div class="container container1">';
        echo '<div class="inner">';

        $this->includeWithVariables(ct_admin_template_server_path($current_views, false), $args);

        echo '</div>';
        echo '</div>';

        echo '</div> <!-- / ct-admin-frontend-preview -->';
    }


    function includeWithVariables($filePath, $variables = array(), $print = true)
    {
        $output = NULL;
        if (file_exists($filePath)) {
            // Extract the variables to a local namespace
            extract($variables);

            // Start output buffering
            ob_start();

            // Include the template file
            include $filePath;

            // End buffering and return its contents
            $output = ob_get_clean();
        }
        if ($print) {
            print $output;
        }
        return $output;

    }


    public function admin_enqueue_scripts($hook_suffix)
    {
        if (strpos($hook_suffix, $this->get_id()) === false) {
            return;
        }

        wp_enqueue_style('ct-admin-form-bs', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', CT_WP_PREVIEW_ADMIN_VERSION);

        wp_enqueue_script('ct-admin-form-bs', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js',
            array('jquery'),
            CT_WP_PREVIEW_ADMIN_VERSION,
            true
        );


        wp_enqueue_style('ct-admin-form', ct_admin_url('assets/style.css'), CT_WP_PREVIEW_ADMIN_VERSION);

        wp_enqueue_script('ct-admin-form-js', ct_admin_url('assets/custom.js'),
            array('jquery'),
            CT_WP_PREVIEW_ADMIN_VERSION,
            true
        );
    }


    private function get_iframe_url($shortcode_index)
    {
        return '/' . $this->preview_url . '?' . $this->preview_param . '=' . $shortcode_index . '&time=' . time();
    }

    private function view1_data()
    {
        $args = [];

        $args['shortcodes'] = ct_preview_shortcodes_list();

        $args['iframe_url'] = $this->get_iframe_url(0);

        $args['shortcode_index'] = 0;

        return $args;
    }

}
<?php
/*
Plugin Name: GTM Head Injection
Description: Lightweight WordPress plugin that injects Google Tag Manager container code in head with highest priority
Version: 1.0.0
Author: GTMSetupService.com
Plugin URI: https://github.com/your-username/gtm-head-injection
Text Domain: gtm-head-injection
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class GTM_Head_Injection {
    private $default_container_id = '';
    
    public function __construct() {
        // Highest priority hooks
        add_action('wp_head', array($this, 'inject_gtm_head'), 1);
        add_action('wp_body_open', array($this, 'inject_gtm_noscript'), 1);
        
        // Admin functionality
        add_action('admin_menu', array($this, 'add_admin_page'));
        add_action('admin_init', array($this, 'register_settings'));
    }
    
    public function inject_gtm_head() {
        if (is_admin()) return; // Don't load in admin
        
        $container_id = get_option('gtm_container_id', $this->default_container_id);
        
        // Don't output anything if no container ID is set
        if (empty($container_id)) {
            return;
        }
        ?>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','<?php echo esc_attr($container_id); ?>');</script>
        <!-- End Google Tag Manager -->
        <?php
    }
    
    public function inject_gtm_noscript() {
        if (is_admin()) return; // Don't load in admin
        
        $container_id = get_option('gtm_container_id', $this->default_container_id);
        
        // Don't output anything if no container ID is set
        if (empty($container_id)) {
            return;
        }
        ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr($container_id); ?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <?php
    }
    
    public function add_admin_page() {
        add_options_page(
            'GTM Settings',
            'GTM Settings', 
            'manage_options',
            'gtm-settings',
            array($this, 'admin_page')
        );
    }
    
    public function register_settings() {
        register_setting('gtm_settings', 'gtm_container_id');
    }
    
    public function admin_page() {
        ?>
        <div class="wrap">
            <h1>GTM Settings</h1>
            <form method="post" action="options.php">
                <?php settings_fields('gtm_settings'); ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">GTM Container ID</th>
                        <td>
                            <input type="text" name="gtm_container_id" 
                                   value="<?php echo esc_attr(get_option('gtm_container_id', $this->default_container_id)); ?>" 
                                   placeholder="GTM-XXXXXXX" 
                                   class="regular-text" />
                            <p class="description">Enter your Google Tag Manager container ID (e.g., GTM-XXXXXXX)</p>
                            <?php if (empty(get_option('gtm_container_id'))): ?>
                            <p class="description" style="color: #d63638;"><strong>⚠️ GTM container ID is required for the plugin to work.</strong></p>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
            
            <div class="card">
                <h2>Plugin Status</h2>
                <?php $container_id = get_option('gtm_container_id'); ?>
                <?php if (empty($container_id)): ?>
                    <p><span style="color: #d63638; font-weight: bold;">⚠️ Not Configured</span> - Enter your GTM container ID above to activate tracking.</p>
                <?php else: ?>
                    <p><span style="color: #00a32a; font-weight: bold;">✅ Active</span> - GTM container <code><?php echo esc_html($container_id); ?></code> is firing on your site.</p>
                <?php endif; ?>
                
                <h3>How to Find Your GTM Container ID</h3>
                <ol>
                    <li>Go to <a href="https://tagmanager.google.com" target="_blank">Google Tag Manager</a></li>
                    <li>Select your container</li>
                    <li>Copy the container ID (format: GTM-XXXXXXX)</li>
                    <li>Paste it in the field above and save</li>
                </ol>
                
                <h3>Verification</h3>
                <p>After saving your container ID, you can verify it's working using:</p>
                <ul>
                    <li><a href="https://chrome.google.com/webstore/detail/tag-assistant-legacy-by/kejbdjndbnbjgmefkgdddjlbokphdefk" target="_blank">Google Tag Assistant Chrome Extension</a></li>
                    <li>Browser Developer Tools → Network tab (look for gtm.js requests)</li>
                    <li>View page source (GTM code should appear in &lt;head&gt; section)</li>
                </ul>
            </div>
        </div>
        <?php
    }
}

// Initialize plugin
new GTM_Head_Injection();
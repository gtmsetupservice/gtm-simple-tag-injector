<?php
/*
Plugin Name: GTM Simple Tag Injector
Description: Professional GTM + GA4 integration with correct load order for data accuracy. Prevents tracking conflicts.
Version: 1.1.0
Author: GTMSetupService.com
Plugin URI: https://github.com/gtmsetupservice/gtm-simple-tag-injector
Text Domain: gtm-simple-tag-injector
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class GTM_Simple_Tag_Injector {
    private $default_container_id = '';
    private $default_ga4_id = '';
    
    public function __construct() {
        // Controlled priority hooks - GTM first, then GA4
        add_action('wp_head', array($this, 'inject_gtm_head'), 1);
        add_action('wp_head', array($this, 'inject_ga4_head'), 2);
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
    
    public function inject_ga4_head() {
        if (is_admin()) return; // Don't load in admin
        
        $ga4_id = get_option('ga4_measurement_id', $this->default_ga4_id);
        $ga4_enabled = get_option('ga4_enabled', false);
        
        // Only load GA4 if enabled and ID is set
        if (!$ga4_enabled || empty($ga4_id)) {
            return;
        }
        ?>
        <!-- Google Analytics 4 (Loads after GTM for proper integration) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga4_id); ?>"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo esc_attr($ga4_id); ?>');
        </script>
        <!-- End Google Analytics 4 -->
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
        register_setting('gtm_settings', 'ga4_enabled');
        register_setting('gtm_settings', 'ga4_measurement_id');
    }
    
    public function admin_page() {
        ?>
        <div class="wrap">
            <h1>GTM Simple Tag Injector</h1>
            <p class="description">Professional GTM + GA4 integration with correct load order for data accuracy.</p>
            
            <form method="post" action="options.php">
                <?php settings_fields('gtm_settings'); ?>
                
                <h2>Google Tag Manager (Required)</h2>
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
                
                <h2>Google Analytics 4 (Optional)</h2>
                <table class="form-table">
                    <tr>
                        <th scope="row">Enable GA4 Direct Integration</th>
                        <td>
                            <label for="ga4_enabled">
                                <input type="checkbox" id="ga4_enabled" name="ga4_enabled" value="1" 
                                       <?php checked(get_option('ga4_enabled'), 1); ?> />
                                Enable Google Analytics 4
                            </label>
                            <p class="description">
                                <strong>⚡ Professional Load Order:</strong> GA4 will fire <em>after</em> GTM (Priority 2) for proper data flow and conflict prevention.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">GA4 Measurement ID</th>
                        <td>
                            <input type="text" name="ga4_measurement_id" 
                                   value="<?php echo esc_attr(get_option('ga4_measurement_id', $this->default_ga4_id)); ?>" 
                                   placeholder="G-XXXXXXXXXX" 
                                   class="regular-text" />
                            <p class="description">Enter your Google Analytics 4 Measurement ID (e.g., G-XXXXXXXXXX)</p>
                            <p class="description" style="color: #135e96;"><strong>💡 GTM Authority Tip:</strong> Use this for direct GA4 implementation or additional GA4 properties not managed in GTM.</p>
                        </td>
                    </tr>
                </table>
                
                <?php submit_button(); ?>
            </form>
            
            <div class="card">
                <h2>Plugin Status</h2>
                <?php 
                $container_id = get_option('gtm_container_id'); 
                $ga4_enabled = get_option('ga4_enabled');
                $ga4_id = get_option('ga4_measurement_id');
                ?>
                
                <h3>Google Tag Manager</h3>
                <?php if (empty($container_id)): ?>
                    <p><span style="color: #d63638; font-weight: bold;">⚠️ Not Configured</span> - Enter your GTM container ID above to activate tracking.</p>
                <?php else: ?>
                    <p><span style="color: #00a32a; font-weight: bold;">✅ Active (Priority 1)</span> - GTM container <code><?php echo esc_html($container_id); ?></code> is firing first on your site.</p>
                <?php endif; ?>
                
                <h3>Google Analytics 4</h3>
                <?php if (!$ga4_enabled): ?>
                    <p><span style="color: #666; font-weight: bold;">➖ Disabled</span> - GA4 direct integration is not enabled.</p>
                <?php elseif (empty($ga4_id)): ?>
                    <p><span style="color: #d63638; font-weight: bold;">⚠️ Enabled but No ID</span> - Enter your GA4 Measurement ID above.</p>
                <?php else: ?>
                    <p><span style="color: #00a32a; font-weight: bold;">✅ Active (Priority 2)</span> - GA4 property <code><?php echo esc_html($ga4_id); ?></code> loads after GTM for proper integration.</p>
                <?php endif; ?>
                
                <div style="background: #e7f3ff; padding: 15px; margin-top: 15px; border-left: 4px solid #135e96;">
                    <h4 style="margin-top: 0;">🎯 Professional Load Order</h4>
                    <p><strong>Priority 1:</strong> GTM fires first to establish dataLayer and tracking foundation</p>
                    <p><strong>Priority 2:</strong> GA4 fires second to avoid conflicts and ensure proper data flow</p>
                    <p><em>This is the professional implementation standard used by GTM specialists.</em></p>
                </div>
                
                <h3>Setup Instructions</h3>
                
                <h4>GTM Container ID</h4>
                <ol>
                    <li>Go to <a href="https://tagmanager.google.com" target="_blank">Google Tag Manager</a></li>
                    <li>Select your container</li>
                    <li>Copy the container ID (format: GTM-XXXXXXX)</li>
                    <li>Paste it in the GTM field above</li>
                </ol>
                
                <h4>GA4 Measurement ID (Optional)</h4>
                <ol>
                    <li>Go to <a href="https://analytics.google.com" target="_blank">Google Analytics</a></li>
                    <li>Select your GA4 property → Admin → Data Streams</li>
                    <li>Copy the Measurement ID (format: G-XXXXXXXXXX)</li>
                    <li>Enable GA4 checkbox and paste ID above</li>
                </ol>
                
                <h3>Verification</h3>
                <p>After configuration, verify tracking is working:</p>
                <ul>
                    <li><a href="https://chrome.google.com/webstore/detail/tag-assistant-legacy-by/kejbdjndbnbjgmefkgdddjlbokphdefk" target="_blank">Google Tag Assistant</a> - Shows GTM and GA4 firing</li>
                    <li><strong>Developer Tools → Network tab</strong> - Look for gtm.js and gtag requests</li>
                    <li><strong>GA4 Real-time Reports</strong> - Verify data is flowing to Analytics</li>
                    <li><strong>View Page Source</strong> - GTM loads first, GA4 loads second</li>
                </ul>
                
                <div style="background: #fff3cd; padding: 10px; margin-top: 15px; border-left: 4px solid #856404;">
                    <p><strong>⚠️ Important:</strong> If you manage GA4 through GTM, you may not need the direct GA4 integration. Use this feature for additional properties or when you need both GTM-managed and direct GA4 tracking.</p>
                </div>
            </div>
        </div>
        <?php
    }
}

// Initialize plugin
new GTM_Simple_Tag_Injector();
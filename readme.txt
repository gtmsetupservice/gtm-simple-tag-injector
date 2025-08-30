=== GTM Head Injection ===
Contributors: gtmsetupservice
Tags: google tag manager, gtm, analytics, tracking, head injection, performance
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Lightweight WordPress plugin that injects Google Tag Manager container code in the head with highest priority for optimal performance.

== Description ==

**GTM Head Injection** is a focused, lightweight WordPress plugin designed to inject your Google Tag Manager container code with the highest possible priority in your website's head section.

Unlike other GTM plugins that add unnecessary features and bloat, GTM Head Injection does one thing exceptionally well: ensures your GTM container fires before any other scripts on your site.

= Key Features =

* **Highest Priority Injection** - Uses priority 1 on wp_head hook
* **Clean, Lightweight Code** - No bloat, just essential functionality  
* **Easy Configuration** - Simple admin interface in Settings → GTM Settings
* **Professional Implementation** - Follows WordPress coding standards
* **Admin-Safe** - Doesn't load GTM code in WordPress admin area
* **Proper Noscript Fallback** - Includes noscript iframe for non-JS users

= Why Choose GTM Head Injection? =

* **Performance First** - GTM fires before any other scripts
* **No Theme Dependency** - Works with any WordPress theme
* **Easy Management** - Isolated functionality, simple to troubleshoot  
* **Professional Quality** - Built by GTM specialists
* **Open Source** - Free and available on GitHub

= Perfect For =

* Business websites requiring accurate tracking
* E-commerce sites with conversion tracking
* Marketing agencies managing multiple client sites
* Developers who want clean, reliable GTM implementation
* Anyone frustrated with bloated analytics plugins

== Installation ==

= Automatic Installation =
1. Go to WordPress Admin → Plugins → Add New
2. Search for "GTM Head Injection"
3. Click "Install Now" and then "Activate"
4. Go to Settings → GTM Settings
5. Enter your Google Tag Manager container ID
6. Save settings

= Manual Installation =
1. Download the plugin zip file
2. Upload to `/wp-content/plugins/gtm-head-injection/`
3. Activate the plugin through WordPress Admin → Plugins
4. Go to Settings → GTM Settings  
5. Enter your Google Tag Manager container ID
6. Save settings

= Getting Your GTM Container ID =
1. Go to [Google Tag Manager](https://tagmanager.google.com)
2. Select your container  
3. Copy the container ID (format: GTM-XXXXXXX)
4. Paste it in Settings → GTM Settings

== Frequently Asked Questions ==

= How do I find my GTM container ID? =

1. Log into Google Tag Manager at tagmanager.google.com
2. Select your container from the account/container dropdown
3. Your container ID is displayed at the top (format: GTM-XXXXXXX)
4. Copy and paste this into the plugin settings

= How can I verify GTM is working? =

Use any of these methods:
* **Google Tag Assistant Chrome Extension** - Shows live tag firing status
* **Browser Developer Tools** - Check Network tab for gtm.js requests  
* **View Page Source** - Look for GTM code in the &lt;head&gt; section
* **GTM Preview Mode** - Use Google Tag Manager's built-in preview

= Will this conflict with other GTM plugins? =

GTM Head Injection uses highest priority hooks to fire before other implementations. However, for best results, deactivate other GTM plugins to avoid potential conflicts or duplicate tracking.

= Does this work with caching plugins? =

Yes! GTM Head Injection works perfectly with all caching plugins because it uses standard WordPress hooks and doesn't create any dynamic content that would break caching.

= Can I customize the GTM implementation? =

The plugin implements the standard GTM code exactly as recommended by Google. If you need custom implementations, you may need a different solution or custom development.

= Is this plugin GDPR compliant? =

The plugin itself is GDPR compliant as it only implements the technical GTM container. GDPR compliance depends on how you configure your tags within Google Tag Manager and your site's privacy policy.

== Screenshots ==

1. **Simple Settings Page** - Clean interface in Settings → GTM Settings
2. **Plugin Status** - Shows active/inactive status and helpful instructions
3. **Admin Notice** - Reminds you to configure container ID after activation
4. **Tag Assistant Verification** - Shows successful GTM implementation

== Changelog ==

= 1.0.0 =
* Initial release
* Highest priority GTM head injection (wp_head priority 1)
* Clean admin settings interface with status indicators
* Proper noscript fallback implementation  
* Admin notices for configuration reminders
* WordPress coding standards compliance
* Full documentation and verification instructions

== Upgrade Notice ==

= 1.0.0 =
Initial release of GTM Head Injection - the lightweight, professional GTM plugin focused on performance and reliability.

== Technical Details ==

= Hook Implementation =
* `wp_head` - Priority 1 (GTM JavaScript container)
* `wp_body_open` - Priority 1 (GTM noscript fallback)  

= Performance Impact =
* Minimal memory usage (single class instantiation)
* One database query per page load (WordPress get_option)
* No external dependencies or additional HTTP requests
* Asynchronous GTM loading (standard Google implementation)

= Security Features =
* Direct file access protection (`ABSPATH` check)
* Admin area exclusion (`is_admin()` check)  
* Input sanitization with `esc_attr()` and `esc_html()`
* WordPress Settings API integration
* Capability checks for admin access (`manage_options`)

= Compatibility =
* WordPress 5.0+ (uses modern hooks like `wp_body_open`)
* PHP 7.4+ (modern syntax and security features)
* All WordPress themes (no theme dependencies)
* All caching plugins (cache-friendly implementation)
* Multisite installations (network compatible)

== Support ==

For support, feature requests, or to contribute to development:

* **GitHub Repository**: [github.com/your-username/gtm-head-injection](https://github.com/your-username/gtm-head-injection)
* **Issues & Bug Reports**: Use GitHub Issues for fastest response
* **Documentation**: Complete setup guides available in repository
* **Professional GTM Services**: [GTMSetupService.com](https://gtmsetupservice.com)

== Credits ==

Developed by the team at [GTMSetupService.com](https://gtmsetupservice.com) - specialists in Google Tag Manager implementation and optimization.

Built with ❤️ for the WordPress community.
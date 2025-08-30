# GTM Simple Tag Injector - WordPress Plugin

![Version](https://img.shields.io/badge/version-1.1.0-blue.svg)
![WordPress](https://img.shields.io/badge/wordpress-5.0%2B-blue.svg)
![PHP](https://img.shields.io/badge/php-7.4%2B-blue.svg)
![License](https://img.shields.io/badge/license-GPL%20v2-blue.svg)

**Professional GTM + GA4 integration with correct load order for data accuracy. Prevents tracking conflicts.**

## 🎯 What This Plugin Does

GTM Simple Tag Injector is the **only WordPress plugin** that implements professional-grade GTM + GA4 integration with **controlled load order** for maximum data accuracy.

Unlike other plugins that randomly inject tracking codes, GTM Simple Tag Injector ensures **GTM fires first (Priority 1)** and **GA4 fires second (Priority 2)** - preventing conflicts and ensuring proper data flow.

## ✨ Key Features

- **🚀 Professional Load Order** - GTM Priority 1, GA4 Priority 2 (prevents conflicts)
- **🎯 Dual Integration** - GTM required, GA4 optional for complete tracking coverage
- **⚙️ Authority-Level Configuration** - Settings designed by GTM specialists
- **🏆 Conflict Prevention** - Proper sequencing prevents duplicate tracking and data issues
- **🪶 Clean, Focused Code** - No bloat, professional implementation standards
- **🛡️ Admin-Safe** - Doesn't load tracking code in WordPress admin area
- **📱 Complete Implementation** - Includes proper noscript fallbacks for accessibility

## 🎪 Why Choose GTM Simple Tag Injector?

### Performance First
- GTM fires **before any other scripts**
- Minimal memory usage and database queries
- No external dependencies

### Developer Friendly
- **No theme dependency** - Works with any WordPress theme
- **Easy management** - Isolated functionality, simple to troubleshoot  
- **Professional quality** - Built by GTM specialists

### Perfect For
- Business websites requiring accurate tracking
- E-commerce sites with conversion tracking
- Marketing agencies managing multiple client sites
- Developers who want clean, reliable GTM implementation
- Anyone frustrated with bloated analytics plugins

## 🚀 Quick Start

### Installation

1. **Download** the latest release or clone this repository
2. **Upload** to `/wp-content/plugins/gtm-head-injection/`
3. **Activate** the plugin through WordPress Admin → Plugins
4. **Configure** your GTM container ID in Settings → GTM Settings

### Configuration

1. Go to **WordPress Admin → Settings → GTM Settings**
2. **GTM Container ID**: Enter your Google Tag Manager container ID (format: GTM-XXXXXXX)
3. **Optional GA4**: Enable checkbox and enter GA4 Measurement ID (format: G-XXXXXXXXXX)
4. **Save settings** and verify with Google Tag Assistant

### Getting Your IDs

**GTM Container ID:**
1. Go to [Google Tag Manager](https://tagmanager.google.com)
2. Select your container
3. Copy the container ID (format: GTM-XXXXXXX)

**GA4 Measurement ID (Optional):**
1. Go to [Google Analytics](https://analytics.google.com)
2. Select property → Admin → Data Streams
3. Copy the Measurement ID (format: G-XXXXXXXXXX)

## 🔧 Technical Details

### Hook Implementation
- `wp_head` - Priority 1 (GTM JavaScript container)
- `wp_head` - Priority 2 (GA4 JavaScript code) 
- `wp_body_open` - Priority 1 (GTM noscript fallback)

### Performance Impact
- **Memory**: Minimal (single class instantiation)
- **Database**: Three `get_option()` calls per page load (GTM ID, GA4 enabled, GA4 ID)
- **HTTP Requests**: Standard GTM + optional GA4 requests (no overhead)
- **Load Sequence**: GTM establishes dataLayer first, GA4 integrates properly
- **Caching**: Fully compatible with all caching plugins

### Security Features
- Direct file access protection (`ABSPATH` check)
- Admin area exclusion (`is_admin()` check)
- Input sanitization with `esc_attr()` and `esc_html()`
- WordPress Settings API integration
- Capability checks for admin access (`manage_options`)

## 📋 Requirements

- **WordPress**: 5.0 or higher
- **PHP**: 7.4 or higher
- **Google Tag Manager Account**: Free account required

## 🧪 Verification & Testing

### Google Tag Assistant (Recommended)
1. Install [Google Tag Assistant Chrome Extension](https://chrome.google.com/webstore/detail/tag-assistant-legacy-by/kejbdjndbnbjgmefkgdddjlbokphdefk)
2. Visit your site with the extension enabled
3. Verify GTM container shows as "Working"

### Manual Verification
- **View Page Source**: Look for GTM code in `<head>` section
- **Developer Tools**: Check Network tab for `gtm.js` requests
- **GTM Preview Mode**: Use Google Tag Manager's built-in preview

## 📁 File Structure

```
gtm-head-injection/
├── gtm-head-injection.php    # Main plugin file
├── readme.txt                # WordPress plugin readme
├── README.md                 # This file
├── LICENSE                   # GPL v2 license
└── .gitignore               # Git ignore rules
```

## 🤝 Contributing

We welcome contributions! Here's how you can help:

1. **Fork** this repository
2. **Create** a feature branch (`git checkout -b feature/amazing-feature`)
3. **Commit** your changes (`git commit -m 'Add amazing feature'`)
4. **Push** to the branch (`git push origin feature/amazing-feature`)
5. **Open** a Pull Request

### Development Guidelines

- Follow WordPress coding standards
- Maintain backward compatibility
- Include proper documentation
- Test thoroughly before submitting

## 🐛 Issues & Support

### Reporting Issues
- Use [GitHub Issues](https://github.com/your-username/gtm-head-injection/issues) for bug reports
- Include WordPress version, PHP version, and error details
- Provide steps to reproduce the issue

### Getting Support
- **GitHub Issues**: Technical problems and feature requests
- **WordPress.org Forums**: General WordPress questions
- **Professional Services**: [GTMSetupService.com](https://gtmsetupservice.com)

## 📄 License

This project is licensed under the **GPL v2 or later** - see the [LICENSE](LICENSE) file for details.

## 🏆 Credits

**Developed by [GTMSetupService.com](https://gtmsetupservice.com)**  
Specialists in Google Tag Manager implementation and optimization.

Built with ❤️ for the WordPress community.

---

## 📊 Comparison with Other GTM Plugins

| Feature | GTM Head Injection | Other GTM Plugins |
|---------|-------------------|-------------------|
| **Performance** | Highest priority (1) | Variable priority |
| **Code Size** | ~150 lines | 1000+ lines |
| **Features** | GTM only | GTM + analytics + bloat |
| **Admin Interface** | Simple, focused | Complex, overwhelming |
| **Compatibility** | Universal | Theme/plugin conflicts |
| **Maintenance** | Minimal updates needed | Frequent compatibility issues |

## 🔮 Roadmap

- [ ] WordPress.org plugin directory submission
- [ ] Multi-container support (if requested)
- [ ] WP-CLI integration
- [ ] Advanced debugging features
- [ ] Performance monitoring dashboard

## 💡 FAQ

**Q: Will this conflict with other GTM plugins?**  
A: GTM Head Injection uses highest priority to fire first, but we recommend deactivating other GTM plugins to avoid conflicts.

**Q: Does this work with caching plugins?**  
A: Yes! It's fully compatible with all caching plugins.

**Q: Can I customize the GTM implementation?**  
A: The plugin implements standard GTM code. For custom implementations, consider custom development.

**Q: Is this GDPR compliant?**  
A: The plugin itself is GDPR compliant. Compliance depends on your GTM configuration and privacy policy.

---

⭐ **Like this plugin? Give it a star on GitHub!** ⭐
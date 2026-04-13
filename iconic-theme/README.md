# ICONIC WordPress Theme

Premium custom WordPress theme for ICONIC - Algerian digital cultural platform.

## Features

- **Arabic-First RTL Design**: Built from the ground up for Arabic content
- **Cinematic Visual Identity**: Dark luxury palette with neon accent gradients
- **3D Hero Animation**: Three.js powered abstract particle animation
- **GSAP Animations**: Smooth scroll-triggered animations
- **Custom Post Types**: Videos, Interviews, Profiles, Special Features
- **Custom Taxonomies**: Culture Sections, Genres, Formats
- **Gutenberg Support**: Custom blocks for editorial flexibility
- **SEO Optimized**: Schema markup, Open Graph, Twitter Cards
- **Performance Focused**: Lazy loading, responsive images, optimized assets
- **Accessibility Ready**: ARIA labels, keyboard navigation, focus states

## Installation

1. Upload the `iconic-theme` folder to `/wp-content/themes/`
2. Activate the theme through WordPress Admin > Appearance > Themes
3. Install recommended plugins (optional):
   - ACF Pro (for advanced custom fields)
   - WPML or Polylang (for multilingual support)

## Requirements

- WordPress 6.0+
- PHP 8.0+
- Modern browser with ES6 support

## Recommended Plugins

- **ACF Pro**: Enhanced custom field management
- **Yoast SEO** or **Rank Math**: Advanced SEO features
- **WP Rocket**: Caching and performance optimization
- **Smush** or **ShortPixel**: Image optimization

## Theme Structure

```
iconic-theme/
├── assets/
│   ├── css/          # Stylesheets
│   ├── js/           # JavaScript files
│   ├── images/       # Theme images
│   └── fonts/        # Custom fonts
├── inc/
│   ├── setup.php     # Theme setup functions
│   ├── enqueue.php   # Scripts and styles enqueuing
│   ├── helpers.php   # Helper functions
│   ├── seo.php       # SEO functions
│   └── ...           # Other includes
├── template-parts/   # Reusable template parts
├── languages/        # Translation files
├── front-page.php    # Homepage template
├── single.php        # Single post template
├── archive.php       # Archive template
└── ...               # Other templates
```

## Customization

### Logo
Go to Appearance > Customize > Site Identity to upload your logo.

### Menus
Configure menus in Appearance > Menus:
- Primary Menu: Main navigation
- Mobile Menu: Mobile navigation
- Footer Menu: Footer links
- Social Links: Social media icons

### Widgets
Add widgets in Appearance > Widgets:
- Sidebar
- Footer Column 1-3

## Performance Tips

1. Enable caching plugin
2. Optimize images before upload
3. Use WebP format when possible
4. Minimize custom CSS/JS additions
5. Consider CDN for static assets

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## License

GPL v2 or later

## Credits

- Typography: Tajawal, Noto Sans Arabic (Google Fonts)
- Icons: Custom SVG icons
- Three.js: https://threejs.org/
- GSAP: https://greensock.com/gsap/

---

Built with ❤️ for ICONIC Media Platform

# Eduxoncabs - Missing Dependencies Guide

## Missing Files Analysis (404 Errors)

### Files to Ignore
These files cause 404s but are safe to ignore:
- `*.css.map` files (source maps for debugging)
- `/.well-known/appspecific/com.chrome.devtools.json` (browser dev tools)

### Files Created
- `css/theme-animate.css` - Basic animation library for theme transitions

### Gitignored Directories (exist locally but not in repo)

#### `vendor/` Directory
Contains third-party dependencies:
- Bootstrap CSS/JS
- jQuery and plugins
- FontAwesome icons
- Owl Carousel
- Magnific Popup
- Revolution Slider
- Other UI libraries

#### `uploadedDocument/` Directory
Contains user-uploaded content:
- Car images
- Banner images
- User documents
- Cached files

### For New Deployments

If you're setting up this project on a new server, you'll need to:

1. **Install vendor dependencies** (if using package manager)
2. **Create uploadedDocument directories**:
   ```bash
   mkdir -p uploadedDocument/{cab,banner,documents}
   chmod 755 uploadedDocument/
   ```
3. **Set up proper file permissions** for uploads

### Development vs Production

- **Development**: Keep vendor/ and uploadedDocument/ in .gitignore
- **Production**: Ensure these directories exist with proper permissions
- **CDN Option**: Consider moving vendor assets to CDN for better performance

### File Structure Required
```
html/
├── vendor/ (gitignored - third-party libraries)
├── uploadedDocument/ (gitignored - user uploads)
├── css/theme-animate.css (now created)
└── ... (other tracked files)
```

// Import all images from the img directory and its subdirectories for Vite to process
// The images will be available in the build output and can be referenced in the code.
import.meta.glob("../img/**/*");

// The object WPCinquanteEtUn is defined in includes/Setup/Enqueue.php and localized to app.js
// It provideds useful information such as the text domain, template_directory_uri, base_url, etc.
// It's usefull when you have to pass PHP variables to JavaScript.
console.log(`Hello ${WPCinquanteEtUn.text_domain}!`);

const fs = require('fs');
const content = fs.readFileSync('public/index.html', 'utf8');
const headerEnd = content.indexOf('</header>');
const footerStart = content.indexOf('<footer');
let mainContent = content.substring(headerEnd + 9, footerStart);

// Update paths
mainContent = mainContent.replace(/src="\.\/images\//g, 'src="<?php echo get_template_directory_uri(); ?>/assets/images/');
mainContent = mainContent.replace(/url\('\.\/images\//g, 'url(\'<?php echo get_template_directory_uri(); ?>/assets/images/');
mainContent = mainContent.replace(/href="detail\.html"/g, 'href="#"');

const templateContent = `<?php
/* Template Name: Anasayfa Tasarımı */
get_header();
?>
${mainContent}
<?php
get_footer();
`;

fs.writeFileSync('wp-content/themes/nextcore/template-home.php', templateContent, 'utf8');
console.log('Template created successfully.');

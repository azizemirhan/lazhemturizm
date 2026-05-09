const fs = require('fs');
let content = fs.readFileSync('wp-content/themes/nextcore/footer.php', 'utf8');
content = content.replace(/<\/div><!-- #page -->\s+<footer class="site-footer">/, '</div><!-- #page --><footer class="site-footer">');
fs.writeFileSync('wp-content/themes/nextcore/footer.php', content, 'utf8');
console.log('Footer gap fixed in footer.php');

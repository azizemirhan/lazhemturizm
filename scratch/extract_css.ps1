$lines = Get-Content 'public/index.html'
$css = $lines[16..5909] -join "`r`n"
$css | Out-File 'wp-content/themes/nextcore/assets/css/index_extracted.css' -Encoding utf8

$path = 'wp-content\themes\nextcore\template-home.php'
$content = Get-Content $path -Encoding UTF8
$utf8NoBOM = New-Object System.Text.UTF8Encoding($false)
[System.IO.File]::WriteAllLines($path, $content, $utf8NoBOM)

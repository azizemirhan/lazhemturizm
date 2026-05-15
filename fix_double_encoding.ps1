$path = 'wp-content\themes\nextcore\template-home.php'
$text = [System.IO.File]::ReadAllText($path)
$latin1 = [System.Text.Encoding]::GetEncoding('ISO-8859-1')
$bytes = $latin1.GetBytes($text)
$correctText = [System.Text.Encoding]::UTF8.GetString($bytes)
$utf8NoBOM = New-Object System.Text.UTF8Encoding($false)
[System.IO.File]::WriteAllText($path, $correctText, $utf8NoBOM)

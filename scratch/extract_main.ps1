$lines = Get-Content 'public/index.html'
$main = $lines[6231..8437] -join "`r`n"
$main | Out-File 'scratch/main_extracted.html' -Encoding utf8

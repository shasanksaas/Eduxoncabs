<?php
// Fix mPDF curly brace issues for PHP 8+ compatibility
echo "Fixing mPDF curly brace syntax for PHP 8+ compatibility...\n";

$file = __DIR__ . '/MPDF/mpdf.php';
$content = file_get_contents($file);

// First restore the file from backup if available
if (file_exists($file . '.bak')) {
    $content = file_get_contents($file . '.bak');
    echo "Restored from backup...\n";
}

// Use more specific regex patterns to fix only string/array access curly braces
$patterns = [
    // Fix string character access like $str{0}
    '/(\$[a-zA-Z_]\w*)\{(\d+)\}/' => '$1[$2]',
    // Fix array element access like $array{key}
    '/(\$[a-zA-Z_]\w*(?:\[\'[^\']*\'\])*)\{([a-zA-Z_]\w*)\}/' => '$1[$2]',
    // Fix specific cases like $col{0}
    '/(\$\w+)\{(\d+)\}/' => '$1[$2]',
];

$totalReplacements = 0;
foreach ($patterns as $pattern => $replacement) {
    $count = 0;
    $content = preg_replace($pattern, $replacement, $content, -1, $count);
    if ($count > 0) {
        echo "Replaced $count instances with pattern: $pattern\n";
        $totalReplacements += $count;
    }
}

// Save the fixed content
if (file_put_contents($file, $content)) {
    echo "✅ mPDF file has been fixed for PHP 8+ compatibility\n";
    echo "Total replacements: $totalReplacements\n";
} else {
    echo "❌ Failed to save fixed mPDF file\n";
}
?>

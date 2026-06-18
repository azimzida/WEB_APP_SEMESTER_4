import glob
import re
import os

files = glob.glob('resources/views/dashboard/*.blade.php')

for filepath in files:
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # Wrap in layout
    if not "@extends('layouts.main')" in content:
        content = f"@extends('layouts.main')\n@section('content')\n{content}\n@endsection"

    # Replace escape() with blade
    content = re.sub(r'<\?=\s*escape\((.*?)\)\s*\?>', r'{{ \1 }}', content)
    
    # Replace <?= with {!! !!} or {{ }}
    content = re.sub(r'<\?=\s*(.*?)\s*\?>', r'{{ \1 }}', content)
    
    # Replace control structures
    content = re.sub(r'<\?php\s+if\s*\((.*?)\):\s*\?>', r'@if(\1)', content)
    content = re.sub(r'<\?php\s+elseif\s*\((.*?)\):\s*\?>', r'@elseif(\1)', content)
    content = re.sub(r'<\?php\s+else:\s*\?>', r'@else', content)
    content = re.sub(r'<\?php\s+endif;\s*\?>', r'@endif', content)
    
    content = re.sub(r'<\?php\s+foreach\s*\((.*?)\):\s*\?>', r'@foreach(\1)', content)
    content = re.sub(r'<\?php\s+endforeach;\s*\?>', r'@endforeach', content)
    
    # Replace raw php blocks
    # Be careful with <?php ... ?> that are multiline
    content = re.sub(r'<\?php', r'@php', content)
    content = re.sub(r'\?>', r'@endphp', content)

    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)

print(f"Converted {len(files)} files to Blade syntax.")

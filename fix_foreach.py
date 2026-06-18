import glob
import re

files = glob.glob('resources/views/dashboard/*.blade.php')
for filepath in files:
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # 1. Replace @php foreach (...): ... @endphp with @foreach(...) @php ... @endphp
    # We will just do a general regex replacement for @php\s+foreach\s*\((.*?)\):\s*
    
    # Actually, a simpler way is:
    # If a line contains '@php foreach', we can extract the foreach and move it outside.
    
    lines = content.split('\n')
    for i in range(len(lines)):
        if '@php foreach' in lines[i] or 'foreach' in lines[i] and '@php' in lines[i]:
            # This is a bit too risky with simple string match. 
            pass

    # Let's use regex
    # Pattern: @php\s*(.*?)foreach\s*\((.*?)\):\s*(.*?)\s*@endphp
    # But it might be multi-line.
    
    # Let's just fix the known instances manually with a script because they are predictable.
    content = re.sub(r'@php\s*foreach\s*\((.*?)\):\s*(.*?)\s*@endphp', r'@foreach (\1)\n@php \2 @endphp', content, flags=re.DOTALL)
    
    # Also for @if(isset($categories) && $categories): foreach ($categories as $cat)
    # We already fixed courses.blade.php manually, but let's just make sure others are fine.
    
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)
print("Fix applied.")

import glob
import re

files = glob.glob('resources/views/dashboard/*.blade.php')

for filepath in files:
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # Fix @if(...) foreach(...) -> @if(...) \n @foreach(...)
    content = re.sub(r'@if\s*\((.*?)\):\s*foreach\s*\((.*?)\)', r'@if(\1)\n@foreach(\2)', content)

    # Fix @php endforeach; endif; @endphp -> @endforeach \n @endif
    content = re.sub(r'@php\s*endforeach;\s*endif;\s*@endphp', r'@endforeach\n@endif', content)

    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)

print("Syntax errors fixed.")

import glob

files = glob.glob('app/Models/*.php')
for filepath in files:
    # We only care about Course.php, Kategori.php, Materi.php, ProfileVisit.php, User.php
    if filepath.endswith('Model.php'):
        continue

    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Don't add twice
    if 'public $incrementing = false;' in content:
        continue
        
    # Find "class X extends Y" and inject inside
    # "class X extends Y\n{" -> "class X extends Y\n{\n    public $incrementing = false;\n    protected $keyType = 'string';\n"
    
    # For User.php it is: class User extends Authenticatable
    # For others it is: class X extends Model
    
    import re
    content = re.sub(
        r'(class\s+\w+\s+extends\s+\w+\s*\{)', 
        r"\1\n    public $incrementing = false;\n    protected $keyType = 'string';\n", 
        content
    )
    
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)

print("Models updated.")

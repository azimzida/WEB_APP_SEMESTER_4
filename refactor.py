import sys

with open('app/Http/Controllers/HomeController.php', 'r') as f:
    code = f.read()

code = code.replace('use Illuminate\\Support\\Str;', 'use Illuminate\\Support\\Str;\nuse App\\Models\\Course;\nuse App\\Models\\Kategori;\nuse App\\Models\\Materi;\nuse App\\Models\\ProfileVisit;\nuse App\\Models\\User;')

code = code.replace("DB::table('kategori')", 'Kategori::query()')
code = code.replace("DB::table('course')", 'Course::query()')
code = code.replace("DB::table('materi')", 'Materi::query()')
code = code.replace("DB::table('users')", 'User::query()')
code = code.replace("DB::table('profile_visits')", 'ProfileVisit::query()')

code = code.replace("renderLegacyView('dashboard/", "renderBladeView('dashboard.")

with open('app/Http/Controllers/HomeController.php', 'w') as f:
    f.write(code)

print('HomeController refactored successfully.')

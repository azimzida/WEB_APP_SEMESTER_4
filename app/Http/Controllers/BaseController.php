<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    protected function getAuthenticatedUser(): ?array
    {
        $email = session('user_email');
        if (!$email) {
            return null;
        }

        $user = DB::table('users')->where('email', $email)->first();
        if (!$user) {
            return null;
        }

        $user = (array) $user;
        if (!empty($user['foto_profil'])) {
            $mimeType = $this->detectImageMimeType($user['foto_profil']);
            if ($mimeType) {
                $user['foto_profil'] = 'data:' . $mimeType . ';base64,' . base64_encode($user['foto_profil']);
            } else {
                unset($user['foto_profil']);
            }
        }

        return $user;
    }

    protected function prepareViewData(array $data = []): array
    {
        return array_merge([
            'title' => config('app.name'),
            'name' => config('app.name'),
            'page' => null,
            'message' => null,
            'dbStatus' => $this->checkDatabaseConnection(),
            'dbStatusMessage' => $this->checkDatabaseConnection() ? 'Database connected successfully.' : 'Database not connected.',
            'user' => $this->getAuthenticatedUser(),
        ], $data);
    }

    protected function checkDatabaseConnection(): bool
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    protected function renderLegacyView(string $view, array $data = [])
    {
        $data = $this->prepareViewData($data);
        extract($data);

        $viewFile = resource_path('views/' . $view . '.php');
        if (!file_exists($viewFile)) {
            abort(500, "View not found: $viewFile");
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        ob_start();
        require resource_path('views/layouts/main.php');
        return response(ob_get_clean());
    }

    private function detectImageMimeType(string $binary): ?string
    {
        if (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_buffer($finfo, $binary);
            finfo_close($finfo);
            return $mime ?: null;
        }

        $info = @getimagesizefromstring($binary);
        return $info['mime'] ?? null;
    }
}

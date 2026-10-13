<?php

namespace App\Http\Controllers;

use App\Services\MetaFeedService;

class MetaFeedController extends Controller
{
    private const MAX_AGE_SECONDS = 3600; // 1 ghanta

    public function show(MetaFeedService $feed)
    {
        $path = storage_path('app/meta-feed.xml');

        if (!is_file($path) || (time() - filemtime($path)) >= self::MAX_AGE_SECONDS) {
            $feed->generate($path);
        }

        // Kisi file ke shuru ki blank line / BOM ka stray output yahin discard ho jayega,
        // taaki response <?xml se hi shuru ho.
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        return response()->file($path, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Activity;

$activities = Activity::all();
foreach ($activities as $act) {
    $changed = false;
    foreach (['name', 'short_description', 'description', 'tag'] as $field) {
        $raw = $act->getRawOriginal($field);
        if (!is_string($raw)) continue;
        $decoded = $raw;
        for ($i = 0; $i < 5; $i++) {
            if (!is_string($decoded)) break;
            $trimmed = trim($decoded);
            if (!str_starts_with($trimmed, '{') && !str_starts_with($trimmed, '[')) break;
            $try = json_decode($decoded, true);
            if (json_last_error() !== JSON_ERROR_NONE) break;
            $decoded = $try;
        }
        if (is_array($decoded) && $decoded !== $raw) {
            $act->$field = $decoded;
            $changed = true;
            echo "Fixed $field for activity {$act->id}\n";
        }
    }
    if ($changed) $act->saveQuietly();
}
echo "All activities cleaned.\n";

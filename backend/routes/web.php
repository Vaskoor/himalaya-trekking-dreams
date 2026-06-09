<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Activity;

// Manual authentication routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Admin routes (already in separate admin.php file)
require __DIR__.'/admin.php';

Route::get('/fix-activities', function () {
    $activities = Activity::all();
    $count = 0;
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
            }
        }
        if ($changed) {
            $act->saveQuietly();
            $count++;
        }
    }
    return "Cleaned $count activities.";
});


Route::get('/deep-clean-activities', function () {
    $activities = App\Models\Activity::all();
    $updated = 0;
    foreach ($activities as $act) {
        $changed = false;
        foreach (['name', 'short_description', 'description'] as $field) {
            $raw = $act->getRawOriginal($field);
            if (!is_string($raw)) continue;

            // Recursively decode
            $decoded = $raw;
            for ($i = 0; $i < 10; $i++) {
                if (!is_string($decoded)) break;
                $trimmed = trim($decoded);
                if (!str_starts_with($trimmed, '{') && !str_starts_with($trimmed, '[')) break;
                $try = json_decode($decoded, true);
                if (json_last_error() !== JSON_ERROR_NONE) break;
                $decoded = $try;
            }

            // Extract the final string
            $finalText = null;
            if (is_array($decoded) && isset($decoded['en'])) {
                $finalText = $decoded['en'];
            } elseif (is_string($decoded)) {
                $finalText = $decoded;
            }

            // If we got a string, store it as a proper JSON object
            if ($finalText && is_string($finalText)) {
                $correctValue = json_encode(['en' => $finalText]);
                if ($raw !== $correctValue) {
                    $act->$field = $correctValue;
                    $changed = true;
                    echo "Fixed $field for activity {$act->id}<br>";
                }
            }
        }
        if ($changed) {
            $act->saveQuietly();
            $updated++;
        }
    }
    return "Updated $updated activities.";
});
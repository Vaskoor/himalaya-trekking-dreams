<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Activity;

class CleanActivityJson extends Command
{
    protected $signature = 'clean:activity-json';
    protected $description = 'Fix double‑encoded JSON in activities table (translatable fields only)';

    public function handle()
    {
        $activities = Activity::all();
        $count = 0;
        foreach ($activities as $act) {
            $changed = false;
            // Only process translatable fields
            $translatable = ['name', 'short_description', 'description'];
            foreach ($translatable as $field) {
                $raw = $act->getRawOriginal($field);
                if (!is_string($raw)) continue;
                // Decode until it becomes a plain array or string
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
                    // Store the cleaned array directly
                    $act->setTranslation($field, 'en', $decoded['en'] ?? $decoded);
                    $changed = true;
                    $this->info("Fixed $field for activity {$act->id}");
                }
            }
            if ($changed) {
                $act->saveQuietly();
                $count++;
            }
        }
        $this->info("Cleaned $count activities.");
    }
}
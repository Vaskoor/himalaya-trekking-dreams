<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Activity;

class CleanActivityJsonFinal extends Command
{
    protected $signature = 'clean:activity-final';
    protected $description = 'Fully decode double‑encoded JSON in activities';

    public function handle()
    {
        $activities = Activity::all();
        $count = 0;
        foreach ($activities as $act) {
            $changed = false;
            foreach (['name', 'short_description', 'description'] as $field) {
                $raw = $act->getRawOriginal($field);
                if (!is_string($raw)) continue;

                // Recursively decode JSON until we get a plain value
                $decoded = $raw;
                for ($i = 0; $i < 10; $i++) {
                    if (!is_string($decoded)) break;
                    $trimmed = trim($decoded);
                    if (!str_starts_with($trimmed, '{') && !str_starts_with($trimmed, '[')) break;
                    $try = json_decode($decoded, true);
                    if (json_last_error() !== JSON_ERROR_NONE) break;
                    $decoded = $try;
                }

                // If we have an array, extract the actual string value
                if (is_array($decoded) && isset($decoded['en'])) {
                    $correct = ['en' => $decoded['en']];
                    $act->setTranslation($field, 'en', $correct['en']);
                    $changed = true;
                    $this->info("Fixed $field for activity {$act->id}");
                } elseif (is_string($decoded) && $decoded !== $raw) {
                    // The decoded string is the real text
                    $act->setTranslation($field, 'en', $decoded);
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
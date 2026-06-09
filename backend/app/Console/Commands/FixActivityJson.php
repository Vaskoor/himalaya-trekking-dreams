<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Activity;

class FixActivityJson extends Command
{
    protected $signature = 'fix:activity-json';
    protected $description = 'Fix double‑encoded JSON in activities table';

    public function handle()
    {
        $activities = Activity::all();
        foreach ($activities as $act) {
            $changed = false;
            foreach (['name', 'short_description', 'description', 'tag'] as $field) {
                $raw = $act->getRawOriginal($field);
                if (!is_string($raw)) continue;
                // Decode until it becomes a plain array or a simple string
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
                    $this->line("Fixed $field for activity {$act->id}");
                }
            }
            if ($changed) $act->saveQuietly();
        }
        $this->info('All activities cleaned.');
    }
}
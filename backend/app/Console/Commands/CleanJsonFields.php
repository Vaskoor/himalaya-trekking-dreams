<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trek;
use App\Models\Region;

class CleanJsonFields extends Command
{
    protected $signature = 'clean:json';
    protected $description = 'Clean JSON fields from invalid UTF-8';

    public function handle()
    {
        $this->cleanTreks();
        $this->cleanRegions();
        $this->info('All JSON fields cleaned.');
    }

    private function cleanTreks()
    {
        $treks = Trek::all();
        foreach ($treks as $trek) {
            $dirty = false;
            $jsonFields = ['highlights', 'places', 'included', 'excluded', 'itinerary'];
            foreach ($jsonFields as $field) {
                $raw = $trek->getRawOriginal($field);
                if (is_string($raw)) {
                    $clean = mb_convert_encoding($raw, 'UTF-8', 'auto');
                    if ($clean !== $raw) {
                        $trek->$field = $clean;
                        $dirty = true;
                    }
                }
            }
            $transFields = ['name', 'short_description', 'description', 'tagline'];
            foreach ($transFields as $field) {
                $val = $trek->getTranslation($field, 'en', false);
                if (is_string($val) && !mb_check_encoding($val, 'UTF-8')) {
                    $trek->setTranslation($field, 'en', mb_convert_encoding($val, 'UTF-8', 'auto'));
                    $dirty = true;
                }
            }
            if ($dirty) $trek->saveQuietly();
        }
        $this->info('Treks cleaned.');
    }

    private function cleanRegions()
    {
        $regions = Region::all();
        foreach ($regions as $region) {
            $dirty = false;
            $transFields = ['name', 'description', 'short_description'];
            foreach ($transFields as $field) {
                $val = $region->getTranslation($field, 'en', false);
                if (is_string($val) && !mb_check_encoding($val, 'UTF-8')) {
                    $region->setTranslation($field, 'en', mb_convert_encoding($val, 'UTF-8', 'auto'));
                    $dirty = true;
                }
            }
            if ($dirty) $region->saveQuietly();
        }
        $this->info('Regions cleaned.');
    }
}
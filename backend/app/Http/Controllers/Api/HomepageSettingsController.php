<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use Illuminate\Http\Request;

class HomepageSettingsController extends Controller
{
    public function index()
    {
        $settings = HomepageSetting::all();
        $parsed = [];
        foreach ($settings as $setting) {
            $value = $setting->value;
            
            // Decode until it's not a JSON string anymore
            while (is_string($value) && (str_starts_with($value, '{') || str_starts_with($value, '['))) {
                $decoded = json_decode($value, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    break;
                }
                $value = $decoded;
            }
            
            // If the final value is an array and has an 'en' key, keep as is; 
            // otherwise, if it's still a string, try to extract the current locale or fallback to English.
            // For simplicity, we'll return the fully decoded value.
            $parsed[] = [
                'id' => $setting->id,
                'key' => $setting->key,
                'value' => $value,
                'type' => $setting->type,
            ];
        }
        return response()->json($parsed);
    }
}

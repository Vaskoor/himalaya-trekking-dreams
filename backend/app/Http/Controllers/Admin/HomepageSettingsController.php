<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomepageSetting;
use Illuminate\Http\Request;

class HomepageSettingsController extends AdminController
{
    public function edit()
    {
        $settings = HomepageSetting::all()->keyBy('key');
        return view('admin.homepage', compact('settings'));
    }

    public function update(Request $request)
    {
        $locales = ['en', 'de', 'fr', 'es', 'jp'];
        foreach ($request->except('_token', '_method') as $key => $value) {
            $setting = HomepageSetting::firstOrNew(['key' => $key]);
            if (is_array($value)) {
                $setting->value = json_encode($value);
                $setting->type = 'translatable';
            } else {
                $setting->value = $value;
                $setting->type = 'text';
            }
            $setting->save();
        }
        return redirect()->back()->with('success', 'Homepage settings updated.');
    }
}

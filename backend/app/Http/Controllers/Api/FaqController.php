<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::where('is_active', true);
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        $faqs = $query->orderBy('sort_order')->get();
        
        // Parse JSON strings
        foreach ($faqs as $faq) {
            if (is_string($faq->question)) {
                $decoded = json_decode($faq->question, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $faq->question = $decoded;
                }
            }
            if (is_string($faq->answer)) {
                $decoded = json_decode($faq->answer, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $faq->answer = $decoded;
                }
            }
        }
        
        return response()->json($faqs);
    }

    public function show($id)
    {
        $faq = Faq::findOrFail($id);
        if (is_string($faq->question)) {
            $decoded = json_decode($faq->question, true);
            if (json_last_error() === JSON_ERROR_NONE) $faq->question = $decoded;
        }
        if (is_string($faq->answer)) {
            $decoded = json_decode($faq->answer, true);
            if (json_last_error() === JSON_ERROR_NONE) $faq->answer = $decoded;
        }
        return response()->json($faq);
    }
}

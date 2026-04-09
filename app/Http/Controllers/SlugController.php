<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SlugController extends Controller
{
    public function generate(Request $request): JsonResponse
    {
        $title = $request->query('title', '');

        if (empty($title)) {
            return response()->json(['error' => 'Title parameter is required'], 400);
        }

        return response()->json([
            'slug' => generate_slug($title)
        ]);
    }
}

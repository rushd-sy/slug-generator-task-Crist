<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateSlugRequest;
use Illuminate\Http\JsonResponse;

class SlugController extends Controller
{
    public function generate(GenerateSlugRequest $request): JsonResponse
    {
        $title = $request->input('title');

        return response()->json([
            'slug' => generate_slug($title),
        ]);
    }
}

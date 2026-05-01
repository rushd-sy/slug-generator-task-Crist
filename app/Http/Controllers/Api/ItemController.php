<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexItemRequest;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;

class ItemController extends Controller
{
    public function index(IndexItemRequest $request)
    {
        $validated = $request->validated();

        $query = Item::query();

        // Filtering
        if (!empty($validated['search'])) {
            $search = $validated['search'];
            $query->where(function (Builder $q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if (array_key_exists('min_price', $validated) && $validated['min_price'] !== null) {
            $query->where('price', '>=', $validated['min_price']);
        }

        if (array_key_exists('max_price', $validated) && $validated['max_price'] !== null) {
            $query->where('price', '<=', $validated['max_price']);
        }

        if (array_key_exists('in_stock', $validated) && $validated['in_stock'] !== null) {
            $query->where('stock', (bool) $validated['in_stock']);
        }

        // Sorting (allow-list)
        $allowedSorts = [
            'title' => 'title',
            'price' => 'price',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
        ];

        $sort = $validated['sort'] ?? null;
        if ($sort) {
            $parts = array_values(array_filter(array_map('trim', explode(',', $sort))));

            foreach ($parts as $part) {
                $direction = 'asc';
                if (str_starts_with($part, '-')) {
                    $direction = 'desc';
                    $part = ltrim($part, '-');
                }

                if (isset($allowedSorts[$part])) {
                    $query->orderBy($allowedSorts[$part], $direction);
                }
            }
        } else {
            $query->latest('created_at');
        }

        $perPage = $validated['per_page'] ?? 10;

        return ItemResource::collection($query->paginate($perPage));
    }

    public function store(StoreItemRequest $request)
    {
        $validated = $request->validated();

        return Item::create($validated);
    }

    public function show(Item $item)
    {
        return $item;
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $validated = $request->validated();

        $item->update($validated);
        return $item;
    }

    public function destroy(Item $item)
    {

        $item->delete();
        return response()->noContent();
    }
}

<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $state = $this->data['thumbnail_upload'] ?? null;
        $path = is_array($state) ? Arr::first($state) : $state;
        $thumb = $this->record->thumbnail;

        if (blank($path)) {
            if ($thumb) {
                if ($thumb->url && Storage::disk('public')->exists($thumb->url)) {
                    Storage::disk('public')->delete($thumb->url);
                }

                $thumb->delete();
            }

            return;
        }

        if (! $thumb) {
            $this->record->thumbnail()->create([
                'type' => 'thumbnail',
                'url' => $path,
                'variant_value' => null,
                'order' => 0,
            ]);

            return;
        }

        if ($thumb->url !== $path) {
            if ($thumb->url && Storage::disk('public')->exists($thumb->url)) {
                Storage::disk('public')->delete($thumb->url);
            }
            $thumb->update(['url' => $path]);
        }

        // multiple -------------------------------------
        $state = $this->data['product_images'] ?? [];
        $state = is_array($state) ? array_values(array_unique($state)) : [];

        $existing = $this->record->productImages()->get();
        $existingPaths = $existing->pluck('url')->all();

        $removed = array_diff($existingPaths, $state);
        if (! empty($removed)) {
            foreach ($existing->whereIn('url', $removed) as $img) {
                if ($img->url && Storage::disk('public')->exists($img->url)) {
                    Storage::disk('public')->delete($img->url);
                }
                $img->delete();
            }
        }

        $added = array_diff($state, $existingPaths);

        foreach ($state as $index => $path) {
            if (in_array($path, $added, true)) {
                $this->record->productImages()->create([
                    'type' => 'product_image',
                    'url' => $path,
                    'variant_value' => null,
                    'order' => $index,
                ]);

                continue;
            }

            $img = $existing->firstWhere('url', $path);
            if ($img && $img->order !== $index) {
                $img->update(['order' => $index]);
            }
        }

        if (empty($state) && $existing->isNotEmpty()) {
            foreach ($existing as $img) {
                if ($img->url && Storage::disk('public')->exists($img->url)) {
                    Storage::disk('public')->delete($img->url);
                }
                $img->delete();
            }
        }
    }
}

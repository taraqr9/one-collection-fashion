<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void
    {
        $thumbnail = $this->data['thumbnail_upload'] ?? null;

        if ($thumbnail && is_array($thumbnail)) {
            $thumbnailPath = reset($thumbnail);

            $this->record->images()->create([
                'type' => 'thumbnail',
                'url' => $thumbnailPath,
                'variant_value' => null,
                'order' => 0,
            ]);
        }

        $productImages = $this->data['product_images'] ?? [];
        if (! empty($productImages) && is_array($productImages)) {
            foreach ($productImages as $index => $imagePath) {
                $this->record->images()->create([
                    'type' => 'product_images',
                    'url' => $imagePath,
                    'variant_value' => null,
                    'order' => $index,
                ]);
            }
        }
    }
}

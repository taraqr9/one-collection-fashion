<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

//    protected function afterSave(): void
//    {
//
//        // Delete missing product images
//        $currentGallery = collect($this->data['product_images'] ?? []);
//        $this->record->images()
//            ->where('type', 'gallery')
//            ->whereNotIn('url', $currentGallery)
//            ->delete();
//
//        // Delete missing thumbnail
//        $currentThumbnail = collect($this->data['thumbnail_upload'] ?? [])->first();
//        $this->record->images()
//            ->where('type', 'thumbnail')
//            ->where('url', '!=', $currentThumbnail)
//            ->delete();
//    }

}

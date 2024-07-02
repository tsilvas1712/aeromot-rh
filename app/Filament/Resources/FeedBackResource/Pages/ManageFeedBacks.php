<?php

namespace App\Filament\Resources\FeedBackResource\Pages;

use App\Filament\Resources\FeedBackResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ManageFeedBacks extends ManageRecords
{
    protected static string $resource = FeedBackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

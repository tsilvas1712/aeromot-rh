<?php

namespace App\Filament\Resources\FeedBackProfessionalResource\Pages;

use App\Filament\Resources\FeedBackProfessionalResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFeedBacksProfessional extends ManageRecords
{
    protected static string $resource = FeedBackProfessionalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

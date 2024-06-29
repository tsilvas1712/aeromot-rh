<?php

namespace App\Filament\Widgets;

use App\Models\FeedBack;
use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use IbrahimBougaoua\FilamentRatingStar\Actions\RatingStarColumn;

class MyFeedBack extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Meus Feedbacks')
            ->query(
                FeedBack::query()
                    ->where('user_id', auth()->id())
            )
            ->columns([
                Tables\Columns\TextColumn::make('staf.name')
                    ->label('Profissional')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Gestor')
                    ->sortable(),

                Tables\Columns\IconColumn::make('staffer')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),


            ]);
    }

    public static function canView(): bool
    {
        return auth()->user()->hasRole(['Gestor', 'Profissional']);
    }
}

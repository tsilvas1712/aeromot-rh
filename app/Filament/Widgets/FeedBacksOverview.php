<?php

namespace App\Filament\Widgets;

use App\Models\FeedBack;
use App\Models\FeedBackProfessional;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FeedBacksOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 3;
    protected static ?int $sort = 3;
    protected function getStats(): array
    {
        $gestores = FeedBack::count();
        $profissionais = FeedBackProfessional::count();

        return [
            Stat::make('FeedBack Gestores', $gestores),
            Stat::make('FeedBack Profissionais', $profissionais),
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->hasRole('Admin');
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StaffOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $admins = User::role('Admin')->count();
        $gestors = User::role('Gestor')->count();
        $professionals = User::role('Profissional')->count();

        return [
            Stat::make('Usuários Admin', $admins),
            Stat::make('Gestores', $gestors),
            Stat::make('Profissionais', $professionals),
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->hasRole('Admin');
    }
}

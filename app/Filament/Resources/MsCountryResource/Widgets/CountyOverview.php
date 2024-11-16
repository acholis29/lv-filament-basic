<?php

namespace App\Filament\Resources\MsCountryResource\Widgets;

use App\Models\MsCity;
use App\Models\MsCountry;
use App\Models\MsState;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CountyOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Country',MsCountry::count()),
            Stat::make('Total State',MsState::count()),
            Stat::make('Total City',MsCity::count()),
        ];
    }
}

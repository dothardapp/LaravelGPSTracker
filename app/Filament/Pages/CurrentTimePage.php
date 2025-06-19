<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Carbon\Carbon;

class CurrentTimePage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Información';
    protected static ?string $navigationLabel = 'Hora Actual';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.current-time-page';

    public function getCurrentTime(): string
    {
        $now = Carbon::now()->timezone('America/Argentina/Buenos_Aires');
        $hour = $now->format('H:i:s'); // 21:28:29 (ejemplo actual)
        $dayOfWeek = $now->dayName; // martes
        $day = $now->day; // 17
        $month = $now->monthName; // junio
        $year = $now->year; // 2025

        return "Es la hora: $hour del día $dayOfWeek $day de $month de $year.";
    }
}
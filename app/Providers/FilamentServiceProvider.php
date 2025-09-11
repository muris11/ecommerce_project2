<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\ServiceProvider;
use Filament\Navigation\NavigationItem;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

class FilamentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Set Indonesian locale for Filament
        app()->setLocale('id');
        
        // Configure Filament colors
        FilamentColor::register([
            'danger' => Color::Red,
            'gray' => Color::Gray,
            'info' => Color::Blue,
            'primary' => Color::Amber,
            'success' => Color::Green,
            'warning' => Color::Orange,
        ]);
    }
}
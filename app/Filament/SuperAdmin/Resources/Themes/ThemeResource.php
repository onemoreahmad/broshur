<?php

namespace App\Filament\SuperAdmin\Resources\Themes;

use App\Filament\SuperAdmin\Resources\Themes\Pages\CreateTheme;
use App\Filament\SuperAdmin\Resources\Themes\Pages\EditTheme;
use App\Filament\SuperAdmin\Resources\Themes\Pages\ListThemes;
use App\Filament\SuperAdmin\Resources\Themes\Pages\ViewTheme;
use App\Filament\SuperAdmin\Resources\Themes\Schemas\ThemeForm;
use App\Filament\SuperAdmin\Resources\Themes\Tables\ThemesTable;
use App\Models\Theme;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ThemeResource extends Resource
{
    protected static ?string $model = Theme::class;

    protected static ?string $navigationLabel = 'القوالب';
    
    protected static ?string $modelLabel = 'قالب';
    
    protected static ?string $pluralModelLabel = 'القوالب';
    
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-paint-brush';
    
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return ThemeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ThemesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListThemes::route('/'),
            'create' => CreateTheme::route('/create'),
            'view' => ViewTheme::route('/{record}'),
            'edit' => EditTheme::route('/{record}/edit'),
        ];
    }
}

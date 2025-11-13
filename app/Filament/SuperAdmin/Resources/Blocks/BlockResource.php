<?php

namespace App\Filament\SuperAdmin\Resources\Blocks;

use App\Filament\SuperAdmin\Resources\Blocks\Pages\CreateBlock;
use App\Filament\SuperAdmin\Resources\Blocks\Pages\EditBlock;
use App\Filament\SuperAdmin\Resources\Blocks\Pages\ListBlocks;
use App\Filament\SuperAdmin\Resources\Blocks\Schemas\BlockForm;
use App\Filament\SuperAdmin\Resources\Blocks\Tables\BlocksTable;
use App\Models\Block;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class BlockResource extends Resource
{
    protected static ?string $model = Block::class;

    protected static ?string $navigationLabel = 'الكتل';
    
    protected static ?string $modelLabel = 'كتلة';
    
    protected static ?string $pluralModelLabel = 'الكتل';
    
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-squares-2x2';
    
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return BlockForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BlocksTable::configure($table);
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
            'index' => ListBlocks::route('/'),
            'create' => CreateBlock::route('/create'),
            'edit' => EditBlock::route('/{record}/edit'),
        ];
    }
}

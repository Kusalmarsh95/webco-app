<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\ProductCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    ViewField::make('status_bar')
        ->label('Status')
        ->view('filament.fields.status-bar')
        ->extraAttributes([
            'color' => fn ($record) => $record->color,
        ]),
    ]),
                TextInput::make('name')
                    ->required(),
                TextInput::make('description')
                    ->required(),
                Select::make('product_color_id')
                    ->relationship('color', 'name')
                    ->required(),
                Select::make('type_id')
        ->label('Type')
        ->relationship('types', 'name') 
        ->afterStateUpdated(fn (callable $set) => $set('category_id', null)), 
    Select::make('product_category_id')
        ->label('Category')
        ->options(function (callable $get) {
            $typeId = $get('type_id');

            if (!$typeId) {
                return ProductCategory::pluck('name', 'id');
            }

            return ProductCategory::whereHas('types', function ($q) use ($typeId) {
                $q->where('product_types.id', $typeId);
            })->pluck('name', 'id');
        })
        ->reactive(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('description'),
                TextColumn::make('category.name'),
                TextColumn::make('color.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductTypeResource\Pages;
use App\Filament\Resources\ProductTypeResource\RelationManagers;
use App\Models\ProductType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductTypeResource extends Resource
{
    protected static ?string $model = ProductType::class;
    protected static ?string $navigationLabel = 'Types';

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required(),
                TextInput::make('api_unique_number'),
                TextInput::make('street_number')->label('Street Number'),
TextInput::make('street_name')->required(),
TextInput::make('street_type')->label('Street Type')->required(),
TextInput::make('suburb')->required(),
TextInput::make('postcode')->required(),
Select::make('state')
    ->options([
        'NSW' => 'NSW',
        'VIC' => 'VIC',
        'QLD' => 'QLD',
        'WA'  => 'WA',
    ])
    ->required(),
               TextInput::make('search')
               ->suffixAction(
        fn ($state, callable $set, $get) => Action::make('fetch')
            ->icon('heroicon-o-cloud')
            ->requiresConfirmation()
            ->action(function () use ($set, $get) {
            
                $loginResponse = Http::post('https://extranet.asmorphic.com/api/login', [
                    'email' => 'project-test@projecttest.com.au',
                    'password' => 'oxhyV9NzkZ^02MEB',
                ]);

                if (! $loginResponse->successful()) {
                    throw new \Exception('Failed to login to API');
                }

                $token = $loginResponse->json('result.token');

                $streetNumber = $get('street_number');
                $streetName   = $get('street_name');
                $streetType   = $get('street_type');
                $suburb       = $get('suburb');
                $postcode     = $get('postcode');
                $state        = $get('state');

                $response = Http::withToken($token)
                    ->acceptJson()
                    ->post('https://extranet.asmorphic.com/api/orders/findaddress', [
                        'company_id'    => 17,
                        'street_number' => $streetNumber,
                        'street_name'   => $streetName,
                        'street_type'   => $streetType,
                        'suburb'        => $suburb,
                        'postcode'      => $postcode,
                        'state'         => $state,
                    ]);

                if (! $response->successful()) {
                    throw new \Exception('Address API request failed');
                }

                $firstDirectoryId = $response->json('data.0.DirectoryIdentifier') ?? 'NOT_FOUND';

                $set('search', $firstDirectoryId);
            })
        ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

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
            'index' => Pages\ListProductTypes::route('/'),
            // 'create' => Pages\CreateProductType::route('/create'),
            // 'edit' => Pages\EditProductType::route('/{record}/edit'),
        ];
    }
}

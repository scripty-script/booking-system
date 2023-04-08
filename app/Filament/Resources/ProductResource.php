<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Brand;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'shop';

    public static function form(Form $form): Form
    {
        $mainForm = Card::make([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('description')
                ->maxLength(255)
                ->columnSpan('full'),
            Forms\Components\TextInput::make('price')
                ->required()
                ->rule('digits_between:1,999_999_999'),

        ])->columns()->columnSpan(2);

        $associations = Section::make('Associations')
            ->schema([
                Select::make('brand_id')
                    ->label('Brand')
                    ->options(Brand::all()->pluck('name', 'id'))
                    ->searchable()
                    ->placeholder('Select a brand'),

                Select::make('categories')
                    ->label('Categories')
                    ->placeholder('Select categories')
                    ->relationship('categories', 'name', fn (Builder $query) => $query->where('type', 'product'))
                    ->preload()
                    ->multiple()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\Textarea::make('description'),
                        Forms\Components\TextInput::make('type')
                            ->hidden()
                            ->required()
                            ->default('product')
                            ->rules(['required']),
                    ]),
            ]);

        return $form
            ->schema([
                $mainForm,
                Grid::make(2)->schema([
                    Card::make([
                        Forms\Components\Toggle::make('is_visible')
                            ->label('Visible')
                            ->default(true)
                            ->helperText('Product\'s visibility from all sales channels.'),
                    ]),
                    $associations,
                ])->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Visible')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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

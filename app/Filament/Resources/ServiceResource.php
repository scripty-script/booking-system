<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
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

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

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
                Select::make('categories')
                    ->label('Categories')
                    ->placeholder('Select categories')
                    ->relationship('categories', 'name', fn (Builder $query) => $query->where('type', 'service'))
                    ->preload()
                    ->multiple()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\Textarea::make('description'),
                        Forms\Components\TextInput::make('type')
                            ->hidden()
                            ->required()
                            ->default('service')
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
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Visible')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}

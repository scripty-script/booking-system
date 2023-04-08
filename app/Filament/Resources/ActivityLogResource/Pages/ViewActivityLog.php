<?php

namespace App\Filament\Resources\ActivityLogResource\Pages;

use App\Filament\Resources\ActivityLogResource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Placeholder;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Str;

class ViewActivityLog extends ViewRecord
{
    protected static string $resource = ActivityLogResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(3)
                ->schema([
                    Card::make([
                        Placeholder::make('subject_type')
                            ->content(fn ($record) => Str::of($record->subject_type)->afterLast('\\Models\\')->__toString()),
                        Placeholder::make('causer_type')
                            ->content(fn ($record) => Str::of($record->causer_type)->afterLast('\\Models\\')->__toString()),

                        Placeholder::make('created_at')
                            ->content(fn ($record) => $record->created_at),
                        Placeholder::make('updated_at')
                            ->content(fn ($record) => $record->updated_at),
                    ])
                        ->columns(2)
                        ->columnSpan(2),
                    Card::make([
                        Placeholder::make('description')
                            ->content(fn ($record) => $record->description),
                        Placeholder::make('causer')
                            ->content(fn ($record) => $record->causer->email ?? 'System generated'),
                    ])->columnSpan(1),

                    Card::make([
                        KeyValue::make('properties.old')
                            ->columnSpan('full'),
                        KeyValue::make('properties.attributes')
                            ->label('changes')
                            ->columnSpan('full'),
                    ]),
                ]),

        ];
    }
}

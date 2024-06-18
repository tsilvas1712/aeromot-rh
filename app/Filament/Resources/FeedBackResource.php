<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedBackResource\Pages;
use App\Filament\Resources\FeedBackResource\RelationManagers;
use App\Models\FeedBack;
use App\Models\Staff;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentRatingStar\Actions\RatingStar;
use IbrahimBougaoua\FilamentRatingStar\Columns\RatingStarColumn;
use Yepsua\Filament\Forms\Components\Rating;
use Yepsua\Filament\Tables\Components\RatingColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



class FeedBackResource extends Resource
{
    protected static ?string $model = FeedBack::class;

    protected static ?string $navigationIcon = 'heroicon-s-rocket-launch';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('staf_id')
                    ->label('Nome do Profissional')
                    ->required()
                    ->options(Staff::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('user_id')
                    ->label('Nome do Gestor')
                    ->options(User::all()->pluck('name', 'id'))
                    ->default(auth()->id())
                    ->required(),


                Forms\Components\TextInput::make('office')
                    ->label('Cargo do Profissional')
                    ->maxLength(255)
                    ->columnSpan(1),

                Section::make()
                    ->columnSpan(1)
                    ->columns(2)
                    ->schema([
                        Forms\Components\Toggle::make('staffer')
                            ->label('É CLT ?')
                            ->required(),
                        RatingStar::make('rating')
                            ->label('Nota')
                            ->default(0)

                            ->required(),
                    ]),

                Section::make('Follow Up')
                    ->description('Há algum dado pontuado anteriormente que deve ser retomado com o profissional?')
                    ->schema([
                        Forms\Components\RichEditor::make('folloup')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),
                Section::make('Pontos Positivos')
                    ->description('Descrever brevemente as qualidades e pontos positivos do profissional.')
                    ->schema([
                        Forms\Components\RichEditor::make('positive_points')
                            ->hiddenLabel()
                            ->placeholder('Descreva aqui o que deve ser retomado com o profissional.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Pontos a Melhorar')
                    ->description('Descrever brevemente as qualidades e pontos positivos do profissional.')
                    ->schema([
                        Forms\Components\RichEditor::make('improve_points')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui..')
                            ->columnSpanFull(),
                    ]),

                Section::make('Alinhamento de Expectativas')
                    ->description('Descrever brevemente quais são as expectativas do profissional em torno da atuação na empresa, se tem interesse em desenvolver-se para outras áreas, sua satisfação em relação à empresa, etc. Neste espaço deve haver também a formalização da expectativa do líder em relação ao liderado.')
                    ->schema([
                        Forms\Components\RichEditor::make('expectations')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui..')
                            ->columnSpanFull(),
                    ]),

                Section::make('Qual o nível do cargo no Plano de Cargos e Salários?')
                    ->description('O que o profissional precisa desenvolver visando evolução no plano de cargos e salários? E para alcançar a melhoria em seu dia a dia?')
                    ->schema([
                        Forms\Components\RichEditor::make('observations')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('staf.name')
                    ->label('Profissional')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Gestor')
                    ->sortable(),
                RatingStarColumn::make('rating')
                    ->label('Nota')
                    ->sortable(),
                Tables\Columns\IconColumn::make('staffer')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFeedBacks::route('/'),
        ];
    }
}

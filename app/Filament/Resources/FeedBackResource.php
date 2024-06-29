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
                            ->disabled()
                    ]),

                Section::make('Follow Up')
                    ->description('Há algum dado pontuado anteriormente que deve ser retomado com o profissional?')
                    ->schema([
                        Forms\Components\RichEditor::make('folloup')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Execução')
                    ->description('Realiza as atividades que constam em sua descrição de cargos de forma efetiva e de acordo com seu nivel no plano de cargos e salários')
                    ->schema([
                        RatingStar::make('execution_rating')
                            ->label('Nota')
                            ->default(0)
                            ->required(),
                        Forms\Components\RichEditor::make('execution_obs')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Conhecimento técnico')
                    ->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->schema([
                        RatingStar::make('tec_know_rating')
                            ->label('Nota')
                            ->default(0)
                            ->required(),
                        Forms\Components\RichEditor::make('tec_know_obs')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Comportamental')
                    //->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->columns(2)
                    ->schema([
                        RatingStar::make('behavioral_respect_rating')
                            ->label('Respeito nas relações')
                            ->default(0)
                            ->required(),
                        RatingStar::make('behavioral_proactivity_rating')
                            ->label('Proatividade')
                            ->default(0)
                            ->required(),
                        RatingStar::make('behavioral_excellence_rating')
                            ->label('Busca pela Excelência')
                            ->default(0)
                            ->required(),
                        RatingStar::make('behavioral_innovation_rating')
                            ->label('Busca pelo Novo/Inovação')
                            ->default(0)
                            ->required(),
                        RatingStar::make('behavioral_flexibility_rating')
                            ->label('Flexibilidade')
                            ->default(0)
                            ->required(),
                        RatingStar::make('behavioral_rules_rating')
                            ->label('Cumpre/Respeita Regras e Combinações')
                            ->default(0)
                            ->required(),
                        Forms\Components\RichEditor::make('behavioral_obs')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Organização')
                    //->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->columns(2)
                    ->schema([
                        RatingStar::make('organization_planning_rating')
                            ->label('Planejamento')
                            ->default(0)
                            ->required(),
                        RatingStar::make('organization_organization_rating')
                            ->label('Organização')
                            ->default(0)
                            ->required(),
                        RatingStar::make('organization_priority_rating')
                            ->label('Avaliação de Prioridade')
                            ->default(0)
                            ->required(),
                        RatingStar::make('organization_deadlines_rating')
                            ->label('Cumprimento de prazos ')
                            ->default(0)
                            ->required(),
                        Forms\Components\RichEditor::make('organization_obs')
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

                Section::make('Pontos a Desenvolver')
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
                    ->schema([
                        Forms\Components\RichEditor::make('observations')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),

                Section::make('O que o profissional precisa desenvolver visando evolução no plano de cargos e salários? E para alcançar a melhoria em seu dia a dia?')
                    ->schema([
                        Forms\Components\RichEditor::make('evolution_obs')
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

    public static function getEloquentQuery(): Builder
    {
        return auth()->user()->hasRole('Admin') ? parent::getEloquentQuery() : parent::getEloquentQuery()->where('user_id', auth()->id());
    }
}

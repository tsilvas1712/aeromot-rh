<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedBackProfessionalResource\Pages;
use App\Filament\Resources\FeedBackProfessionalResource\RelationManagers;
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



class FeedBackProfessionalResource extends Resource
{
    protected static ?string $model = FeedBackProfessional::class;

    protected static ?string $navigationIcon = 'heroicon-s-rocket-launch';
    protected static ?string $navigationLabel = 'Feedback Profissionais';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('staf_id')
                    ->label('Nome do Profissional')
                    ->required()
                    ->options(Staff::all()->pluck('name', 'id'))
                    ->searchable(),
                

                Forms\Components\TextInput::make('office')
                    ->label('Cargo do Profissional')
                    ->maxLength(255)
                    ->columnSpan(1),

                Forms\Components\Select::make('user_id')
                    ->label('Nome do Lider')
                    ->options(User::all()->pluck('name', 'id'))
                    ->default(auth()->id())
                    ->required(),

                // Section::make()
                //     ->columnSpan(1)
                //     ->columns(2)
                //     ->schema([
                //         Forms\Components\Toggle::make('staffer')
                //             ->label('É CLT ?')
                //             ->required(),
                //         RatingStar::make('rating')
                //             ->label('Nota')
                //             ->default(0)
                //             ->disabled()
                //     ]),
                Section::make('Feedback ao Líder'),

                // Section::make('Follow Up')
                //     ->description('Há algum dado pontuado anteriormente que deve ser retomado com o profissional?')
                //     ->schema([
                //         Forms\Components\RichEditor::make('folloup')
                //             ->hiddenLabel()
                //             ->placeholder('Preencher com informações a partir daqui.')
                //             ->columnSpanFull(),
                //     ]),

                Section::make('Na sua opinião, seu Líder é aberto e receptivo à críticas ou sugestões da equipe? Dê uma nota abaixo e traga maiores informações no campo aberto.')
                    // ->description('Realiza as atividades que constam em sua descrição de cargos de forma efetiva e de acordo com seu nivel no plano de cargos e salários')
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

                Section::make('Na sua opinião, você recebe feedbacks constantes do seu Líder, mesmo que de forma informal? Dê uma nota abaixo e traga maiores informações no campo aberto.')
                    // ->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
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

                Section::make('Na sua opinião, seu Líder responde às suas dúvidas, questionamentos e passa todas as informações para correta realização das demandas, a tempo de executa-las?  Dê uma nota abaixo e traga maiores informações no campo aberto.')
                    //->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->columns(2)
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

                Section::make('Você considera que seu Líder possui relação de confiança e respeito com a equipe?  Dê uma nota abaixo e traga maiores informações no campo aberto.')
                    //->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->columns(2)
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

                Section::make('Você considera que o seu Líder realiza o adequado desenvolvimento da equipe?  Dê uma nota abaixo e traga maiores informações no campo aberto.')
                    //->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->columns(2)
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
                
                Section::make('Você considera que o seu Líder fornece autonomia adequada à equipe?  Dê uma nota abaixo e traga maiores informações no campo aberto.')
                    //->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->columns(2)
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

                Section::make('Você considera que o seu Líder fomenta o relacionamento saudável com as áreas pares de atuação?  Dê uma nota abaixo e traga maiores informações no campo aberto.')
                    //->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->columns(2)
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


                Section::make('Se você tem sugestões ou algo que gostaria de pontuar sobre seu feedback, deixe sua opinião aqui!')
                    // ->description('Descrever brevemente as qualidades e pontos positivos do profissional.')
                    ->schema([
                        Forms\Components\RichEditor::make('positive_points')
                            ->hiddenLabel()
                            ->placeholder('Descreva aqui o que deve ser retomado com o profissional.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Existe algum ponto a ser desenvolvido pelo seu Líder, visando contribuir para a melhoria da gestão? Justifique sua resposta.')
                    // ->description('Descrever brevemente as qualidades e pontos positivos do profissional.')
                    ->schema([
                        Forms\Components\RichEditor::make('improve_points')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui..')
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
            'index' => Pages\ManageFeedBacksProfessional::route('/'),
        ];
    }
}

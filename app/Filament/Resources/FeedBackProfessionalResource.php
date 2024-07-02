<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedBackProfessionalResource\Pages;
use App\Filament\Resources\FeedBackProfessionalResource\RelationManagers;
use App\Models\FeedBack;
use App\Models\FeedBackProfessional;
use App\Models\Staff;
use App\Models\User;
use Filament\Actions\ViewAction;
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

        $user = auth()->user();

        return $form
            ->schema([

                Forms\Components\TextInput::make('staf_id')
                    ->label('Nome do Profissional')
                    ->required()
                    ->disabled()
                    ->default($user->name),



                Forms\Components\TextInput::make('office')
                    ->label('Cargo do Profissional')
                    ->default($user->function)
                    ->readOnly()
                    ->columnSpan(1),

                Forms\Components\Select::make('user_id')
                    ->label('Nome do Lider')
                    ->required()
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable(),

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
                        RatingStar::make('receptive_leader_rating')
                            ->label('Nota')
                            ->default(0)
                            ->required(),
                        Forms\Components\RichEditor::make('receptive_leader_obs')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Na sua opinião, você recebe feedbacks constantes do seu Líder, mesmo que de forma informal? Dê uma nota abaixo e traga maiores informações no campo aberto.')
                    // ->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->schema([
                        RatingStar::make('receive_feedback_rating')
                            ->label('Nota')
                            ->default(0)
                            ->required(),
                        Forms\Components\RichEditor::make('receive_feedback_obs')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Na sua opinião, seu Líder responde às suas dúvidas, questionamentos e passa todas as informações para correta realização das demandas, a tempo de executa-las?  Dê uma nota abaixo e traga maiores informações no campo aberto.')
                    //->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->columns(2)
                    ->schema([
                        RatingStar::make('answers_questions_rating')
                            ->label('Nota')
                            ->default(0)
                            ->required(),
                        Forms\Components\RichEditor::make('answers_questions_obs')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Na sua opinião, seu Líder se comunica com a equipe de forma clara, transparente e adequada?  Dê uma nota abaixo e traga maiores informações no campo aberto.')
                    //->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->columns(2)
                    ->schema([
                        RatingStar::make('comunication_rating')
                            ->label('Nota')
                            ->default(0)
                            ->required(),
                        Forms\Components\RichEditor::make('comunication_obs')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Você considera que seu Líder possui relação de confiança e respeito com a equipe?  Dê uma nota abaixo e traga maiores informações no campo aberto.')
                    //->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->columns(2)
                    ->schema([
                        RatingStar::make('trust_rating')
                            ->label('Nota')
                            ->default(0)
                            ->required(),
                        Forms\Components\RichEditor::make('trust_obs')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Você considera que o seu Líder realiza o adequado desenvolvimento da equipe?  Dê uma nota abaixo e traga maiores informações no campo aberto.')
                    //->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->columns(2)
                    ->schema([
                        RatingStar::make('team_development_rating')
                            ->label('Nota')
                            ->default(0)
                            ->required(),
                        Forms\Components\RichEditor::make('team_development_obs')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Você considera que o seu Líder fornece autonomia adequada à equipe?  Dê uma nota abaixo e traga maiores informações no campo aberto.')
                    //->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->columns(2)
                    ->schema([
                        RatingStar::make('autonomy_rating')
                            ->label('Nota')
                            ->default(0)
                            ->required(),
                        Forms\Components\RichEditor::make('autonomy_obs')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Você considera que o seu Líder fomenta o relacionamento saudável com as áreas pares de atuação?  Dê uma nota abaixo e traga maiores informações no campo aberto.')
                    //->description('Possui todos os conhecimentos técnicos (formação, treinamentos e experiências) solicitadas em sua descrição de cargos atual')
                    ->columns(2)
                    ->schema([
                        RatingStar::make('healthy_relationship_rating')
                            ->label('Nota')
                            ->default(0)
                            ->required(),
                        Forms\Components\RichEditor::make('healthy_relationship_obs')
                            ->hiddenLabel()
                            ->placeholder('Preencher com informações a partir daqui.')
                            ->columnSpanFull(),
                    ]),


                Section::make('Se você tem sugestões ou algo que gostaria de pontuar sobre seu feedback, deixe sua opinião aqui!')
                    // ->description('Descrever brevemente as qualidades e pontos positivos do profissional.')
                    ->schema([
                        Forms\Components\RichEditor::make('observations')
                            ->hiddenLabel()
                            ->placeholder('Descreva aqui o que deve ser retomado com o profissional.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Existe algum ponto a ser desenvolvido pelo seu Líder, visando contribuir para a melhoria da gestão? Justifique sua resposta.')
                    // ->description('Descrever brevemente as qualidades e pontos positivos do profissional.')
                    ->schema([
                        Forms\Components\RichEditor::make('evolution_obs')
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
                Tables\Columns\TextColumn::make('created_at')
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
                Tables\Actions\ViewAction::make(),
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

    public static function getEloquentQuery(): Builder
    {
        return auth()->user()->hasRole(['Admin', 'Gestor', 'Professional']) ? parent::getEloquentQuery() : parent::getEloquentQuery()->where('user_id', auth()->id());
    }
}

<?php

namespace App\Filament\Pages;

use App\Designs\DesignManager;
use App\Designs\SiteDesign;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

/**
 * Chooses which design the public site uses, and lets the admin preview the others.
 *
 * @property-read Schema $form
 */
class Appearance extends Page
{
    #[\Override]
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-swatch';

    #[\Override]
    protected static ?string $title = 'Appearance';

    #[\Override]
    protected static ?int $navigationSort = -1;

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(['design' => resolve(DesignManager::class)->live()->value]);
    }

    public function form(Schema $schema): Schema
    {
        $designs = collect(SiteDesign::cases());

        return $schema
            ->components([
                Radio::make('design')
                    ->label('Design visitors see')
                    ->options($designs->mapWithKeys(fn (SiteDesign $design): array => [$design->value => $design->label()])->all())
                    ->descriptions($designs->mapWithKeys(fn (SiteDesign $design): array => [$design->value => $design->description()])->all())
                    ->in($designs->map(fn (SiteDesign $design): string => $design->value)->all())
                    ->required(),
            ])
            ->statePath('data');
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Live design')
                ->description('The design every visitor sees. Saving switches the public site straight away.')
                ->schema([
                    Form::make([EmbeddedSchema::make('form')])
                        ->id('form')
                        ->livewireSubmitHandler('save')
                        ->footer([
                            Actions::make([
                                Action::make('save')->label('Save')->submit('save'),
                            ]),
                        ]),
                ]),
            Section::make('Preview')
                ->description('Opens the site in another design for you only, until you choose "Exit preview" at the bottom of the page. Visitors keep seeing the live design.')
                ->schema([
                    Actions::make(collect(SiteDesign::cases())
                        ->map(fn (SiteDesign $design): Action => Action::make("preview_{$design->value}")
                            ->label("Preview {$design->label()}")
                            ->color('gray')
                            ->url(url('/').'?design='.$design->value)
                            ->openUrlInNewTab())
                        ->all()),
                ]),
        ]);
    }

    public function save(): void
    {
        $state = $this->form->getState();
        $design = SiteDesign::from((string) $state['design']);

        resolve(DesignManager::class)->setLive($design);

        Notification::make()
            ->success()
            ->title("{$design->label()} is now the live design")
            ->send();
    }
}

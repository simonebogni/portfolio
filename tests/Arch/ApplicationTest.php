<?php

use App\Filament\ResourceGroup;
use App\Http\Controllers\Controller;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Component;

arch('models extend the Eloquent model')
    ->expect('App\Models')
    ->classes()
    ->toExtend(Model::class);

arch('models use the factory and soft delete traits')
    ->expect('App\Models')
    ->classes()
    ->toUseTraits([HasFactory::class, SoftDeletes::class]);

arch('models are only used by the application layer')
    ->expect('App\Models')
    ->toOnlyBeUsedIn([
        'App\Filament',
        'App\Http\Controllers',
        'App\Models',
        'App\View\Components',
        'Database\Factories',
        'Database\Seeders',
        'Tests',
    ]);

arch('controllers are suffixed and extend the base controller')
    ->expect('App\Http\Controllers')
    ->classes()
    ->toHaveSuffix('Controller')
    ->toExtend(Controller::class)
    ->ignoring(Controller::class);

arch('base controller is abstract')
    ->expect(Controller::class)
    ->toBeAbstract();

arch('controllers are not used by models or view components')
    ->expect('App\Http\Controllers')
    ->not->toBeUsedIn(['App\Models', 'App\View\Components']);

arch('actions are suffixed and expose an execute method')
    ->expect('App\Actions')
    ->classes()
    ->toHaveSuffix('Action')
    ->toHaveMethod('execute');

arch('view components extend the Blade component')
    ->expect('App\View\Components')
    ->classes()
    ->toExtend(Component::class);

arch('service providers are suffixed and extend the base provider')
    ->expect('App\Providers')
    ->classes()
    ->toHaveSuffix('Provider')
    ->toExtend(ServiceProvider::class);

/**
 * Lists the Filament resource classes whose file path, relative to
 * app/Filament/Resources, matches the given glob pattern.
 *
 * @return list<class-string>
 */
function filamentResourceClasses(string $pattern): array
{
    $files = glob(dirname(__DIR__, 2).'/app/Filament/Resources/'.$pattern.'.php') ?: [];

    return array_map(
        fn (string $file): string => 'App\\Filament\\Resources\\'.str_replace('/', '\\', substr($file, strlen(dirname(__DIR__, 2).'/app/Filament/Resources/'), -4)),
        $files,
    );
}

arch('filament resources extend the base resource')
    ->expect(filamentResourceClasses('*/*Resource'))
    ->toExtend(Resource::class);

arch('filament create pages extend CreateRecord')
    ->expect(filamentResourceClasses('*/Pages/Create*'))
    ->toExtend(CreateRecord::class);

arch('filament edit pages extend EditRecord')
    ->expect(filamentResourceClasses('*/Pages/Edit*'))
    ->toExtend(EditRecord::class);

arch('filament list pages extend ListRecords')
    ->expect(filamentResourceClasses('*/Pages/List*'))
    ->toExtend(ListRecords::class);

arch('filament view pages extend ViewRecord')
    ->expect(filamentResourceClasses('*/Pages/View*'))
    ->toExtend(ViewRecord::class);

arch('filament navigation groups are a backed enum')
    ->expect(ResourceGroup::class)
    ->toBeStringBackedEnum();

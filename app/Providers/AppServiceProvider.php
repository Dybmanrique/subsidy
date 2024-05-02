<?php

namespace App\Providers;

use App\Models\Subsidy;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {

            $subsidies = Subsidy::where('status', 'activo')->get()->map(function (Subsidy $subsidy) {
                return [
                    'text' => substr($subsidy['name'], 0, 18) . "...",
                    'classes' => 'text-uppercase',
                    'icon' => 'fas fa-fw fa-ticket-alt',
                    'submenu' => [
                        [
                            'text' => 'Última convocatoria',
                            'url' => route('admin.postulations.last_index', $subsidy['id']),
                            'classes' => 'text-uppercase'
                        ],
                        [
                            'text' => 'Todos',
                            'url' => route('admin.postulations.all_index', $subsidy['id']),
                            'classes' => 'text-uppercase'
                        ],
                    ],
                ];
            });

            $event->menu->addAfter('postulations', ...$subsidies);
        });
    }
}

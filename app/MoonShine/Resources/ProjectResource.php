<?php

namespace App\MoonShine\Resources;

use App\Models\Project;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;

class ProjectResource extends ModelResource
{
    protected string $model = Project::class;
    
    protected string $title = 'Proyectos';
    
    protected string $column = 'title';
    
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Título', 'title')->sortable(),
            Date::make('Fecha límite', 'deadline')->sortable(),
            Number::make('Presupuesto', 'budget')->sortable(),
            Switcher::make('Activo', 'is_active'),
        ];
    }
    
    protected function formFields(): iterable
    {
        return [
            Tabs::make([
                Tab::make('Información Básica', [
                    Grid::make([
                        Column::make([
                            Box::make([
                                Text::make('Título', 'title')
                                    ->required(),
                                
                                Date::make('Fecha límite', 'deadline')
                                    ->required(),
                                
                                Number::make('Presupuesto', 'budget')
                                    ->required()
                                    ->min(0),
                                
                                Switcher::make('Activo', 'is_active'),
                            ]),
                        ])->columnSpan(12),
                    ]),
                ]),
                
                Tab::make('Descripción', [
                    Box::make([
                        Textarea::make('Descripción', 'description')
                            ->hint('Describe el proyecto detalladamente'),
                    ]),
                ]),
            ])
        ];
    }
    
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Título', 'title'),
            Date::make('Fecha límite', 'deadline'),
            Number::make('Presupuesto', 'budget'),
            Textarea::make('Descripción', 'description'),
            Switcher::make('Activo', 'is_active'),
        ];
    }
    
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'deadline' => ['required', 'date'],
            'budget' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ];
    }
}
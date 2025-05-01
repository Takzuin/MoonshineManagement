<?php

namespace App\MoonShine\Resources;

use App\Models\Department;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Switcher;

class DepartmentResource extends ModelResource
{
    protected string $model = Department::class;
    
    protected string $title = 'Departamentos';
    
    protected string $column = 'name';
    
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Nombre', 'name')->sortable(),
            Switcher::make('Activo', 'is_active'),
        ];
    }
    
    protected function formFields(): iterable
    {
        return [
            Box::make([
                Text::make('Nombre', 'name')
                    ->required(),
                
                Textarea::make('Descripción', 'description'),
                
                Switcher::make('Activo', 'is_active'),
            ])
        ];
    }
    
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Nombre', 'name'),
            Textarea::make('Descripción', 'description'),
            Switcher::make('Activo', 'is_active'),
        ];
    }
    
    protected function rules(mixed $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:departments,name' . ($item?->id ? ',' . $item->id : '')],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ];
    }
}
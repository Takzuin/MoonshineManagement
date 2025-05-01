<?php

namespace App\MoonShine\Resources;

use App\Models\Employee;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Switcher;

class EmployeeResource extends ModelResource
{
    protected string $model = Employee::class;
    
    protected string $title = 'Empleados';
    
    protected string $column = 'name';
    
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Nombre', 'name')->sortable(),
            Email::make('Email', 'email')->sortable(),
            BelongsTo::make('Departamento', 'department', resource: DepartmentResource::class)
                ->sortable(),
            Switcher::make('Activo', 'is_active'),
        ];
    }
    
    protected function formFields(): iterable
    {
        return [
            Grid::make([
                Column::make([
                    Box::make([
                        Text::make('Nombre', 'name')
                            ->required(),
                        
                        Email::make('Email', 'email')
                            ->required(), // ⚠️ Eliminamos ->unique()
                        
                        Switcher::make('Activo', 'is_active'),
                    ]),
                ])->columnSpan(8),
                
                Column::make([
                    Box::make([
                        BelongsTo::make('Departamento', 'department', resource: DepartmentResource::class)
                            ->required()
                            ->searchable(),
                    ]),
                ])->columnSpan(4),
            ])
        ];
    }
    
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Nombre', 'name'),
            Email::make('Email', 'email'),
            BelongsTo::make('Departamento', 'department', resource: DepartmentResource::class),
            Switcher::make('Activo', 'is_active'),
        ];
    }
    
    protected function rules(mixed $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:employees,email,' . ($item?->id ?: 'NULL')], // ✅ Validación única aquí
            'department_id' => ['required', 'exists:departments,id'],
            'is_active' => ['boolean'],
        ];
    }
}
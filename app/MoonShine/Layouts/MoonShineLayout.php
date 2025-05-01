<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\CompactLayout;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Components\Layout\{Locales, Notifications, Profile, Search};
use MoonShine\UI\Components\{Breadcrumbs,
    Components,
    Layout\Flash,
    Layout\Div,
    Layout\Body,
    Layout\Burger,
    Layout\Content,
    Layout\Footer,
    Layout\Head,
    Layout\Favicon,
    Layout\Assets,
    Layout\Meta,
    Layout\Header,
    Layout\Html,
    Layout\Layout,
    Layout\Logo,
    Layout\Menu,
    Layout\Sidebar,
    Layout\ThemeSwitcher,
    Layout\TopBar,
    Layout\Wrapper,
    When};
use App\MoonShine\Resources\DepartmentResource;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\EmployeeResource;
use App\MoonShine\Resources\ProjectResource;

final class MoonShineLayout extends CompactLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }
    protected function getFooterCopyright(): string
    {
        return '
        <div class="text-center">
        <p class="text-sm text-gray-500 dark:text-gray-400">
        &copy; 2025 - ING JOSE MANUEL ARANGO SOSA - Todos los derechos reservados.
        </p>
        </div>
        ';
    }
    protected function menu(): array
    {
        return [
            ...parent::menu(),
            MenuItem::make('Departments', DepartmentResource::class),
            MenuItem::make('Employees', EmployeeResource::class),
            MenuItem::make('Projects', ProjectResource::class),
        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        $colorManager
            // Colores principales
            ->primary('74, 107, 247') // Azul profundo y elegante
            ->secondary('34, 197, 94') // Verde vibrante y moderno

            // Colores de fondo
            ->body('243, 244, 246') // Gris muy claro con sutileza

            // Colores de estado
            ->successBg('52, 211, 153') // Verde menta suave
            ->successText('255, 255, 255') // Blanco para contraste
            ->warningBg('251, 191, 36') // Amarillo dorado
            ->warningText('30, 30, 30') // Casi negro para legibilidad
            ->errorBg('248, 113, 113') // Rojo suave
            ->errorText('255, 255, 255') // Blanco para contraste
            ->infoBg('59, 130, 246') // Azul medio
            ->infoText('255, 255, 255') // Blanco para contraste

            // Tonos oscuros para tema claro
            ->dark('51, 65, 85', 'DEFAULT') // Gris azulado oscuro
            ->dark('71, 85, 105', 50) // Tono más claro
            ->dark('100, 116, 139', 100) // Tono intermedio
            ->dark('148, 163, 184', 200); // Tono más claro

        // Configuración para el tema oscuro
        $colorManager
            ->body('17, 24, 39', dark: true) // Casi negro
            ->dark('31, 41, 55', dark: true) // Gris oscuro
            ->successBg('16, 185, 129', dark: true) // Verde esmeralda oscuro
            ->successText('220, 252, 231', dark: true)
            ->warningBg('202, 138, 4', dark: true) // Amarillo ámbar
            ->warningText('254, 249, 195', dark: true)
            ->errorBg('220, 38, 38', dark: true) // Rojo intenso
            ->errorText('254, 226, 226', dark: true)
            ->infoBg('37, 99, 235', dark: true) // Azul profundo
            ->infoText('239, 246, 255', dark: true);
    }

    public function build(): Layout
    {
        return parent::build();
    }
}

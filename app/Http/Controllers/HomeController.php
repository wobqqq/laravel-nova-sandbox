<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\LocalPackages;
use Illuminate\Contracts\View\View;
use Laravel\Nova\Nova;

final class HomeController
{
    public function __invoke(): View
    {
        return view('home', [
            'versions' => [
                'PHP' => PHP_VERSION,
                'Laravel' => app()->version(),
                'Nova' => Nova::version(),
            ],
            'packages' => LocalPackages::fromComposer()->all(),
            'novaUrl' => url(Nova::path()),
        ]);
    }
}

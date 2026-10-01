<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Dashboards;

use Illuminate\Support\Str;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboard;

class Main extends \Laravel\Nova\Dashboard
{
    public function name() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function uriKey() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function cards() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}

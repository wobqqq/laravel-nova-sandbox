<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Contracts;

interface BehavesAsPanel
{
    /**
     * @return \Laravel\Nova\Panel
     */
    public function asPanel();
}

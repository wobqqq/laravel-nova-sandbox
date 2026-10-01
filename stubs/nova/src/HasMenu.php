<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

use Illuminate\Http\Request;

interface HasMenu
{
    /**
     * @return mixed
     */
    public function menu(\Illuminate\Http\Request $request);
}

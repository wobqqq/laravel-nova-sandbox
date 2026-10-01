<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Contracts;

interface Cover
{
    /**
     * @return string|null
     */
    public function resolveThumbnailUrl();
    /**
     * @return bool
     */
    public function isRounded();
    /**
     * @return bool
     */
    public function isSquared();
}

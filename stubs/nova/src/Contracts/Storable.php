<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Contracts;

interface Storable
{
    /**
     * @return string|null
     */
    public function getStorageDisk();
    /**
     * @return string
     */
    public function getDefaultStorageDisk();
    /**
     * @return string|null
     */
    public function getStorageDir();
    /**
     * @return string|null
     */
    public function getStoragePath();
}

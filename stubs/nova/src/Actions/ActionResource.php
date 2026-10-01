<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Actions;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\MorphToActionTarget;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;
use Laravel\Nova\Resource;

/**
 * @template TActionModel of \Laravel\Nova\Actions\ActionEvent
 * @extends \Laravel\Nova\Resource<TActionModel>
 */
class ActionResource extends \Laravel\Nova\Resource
{
    /**
     * @var class-string<TActionModel>
     */
    public static $model = 'Laravel\\Nova\\Actions\\ActionEvent';
    /**
     * @var class-string|null
     */
    public static $policy = 'Laravel\\Nova\\Actions\\ActionResourcePolicy';
    public static $title = 'name';
    public static $with = ['target', 'user'];
    public static $globallySearchable = false;
    public static $polling = true;
    public function fields(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function indexQuery(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function availableForNavigation(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function searchable() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function label() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function singularLabel() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function uriKey() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}

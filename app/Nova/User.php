<?php

declare(strict_types=1);

namespace App\Nova;

use Illuminate\Validation\Rules\Password as PasswordRule;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

/**
 * @extends Resource<\App\Models\User>
 */
class User extends Resource
{
    /**
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\User::class;

    /**
     * @var string
     */
    public static $title = 'name';

    /**
     * @var array<mixed>
     */
    public static $search = [
        'id', 'name', 'email',
    ];

    /**
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Gravatar::make()->maxWidth(50),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Boolean::make('Administrator', 'is_admin')
                ->sortable(),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', PasswordRule::defaults())
                ->updateRules('nullable', 'string', PasswordRule::defaults()),
        ];
    }
}

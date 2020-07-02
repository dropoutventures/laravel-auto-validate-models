<?php

namespace RyanChandler\AutoValidateModels\Concerns;

use Illuminate\Support\Facades\Validator;

trait AutoValidates
{
    public static function bootAutoValidates()
    {
        $events = static::$validationEvents ?: [];

        foreach ($events as $event) {
            static::{$event}(
                static::getValidationCallback($event)
            );
        }
    }

    protected static function getValidationCallback(string $event)
    {
        [$property, $method] = static::getRulesPropAndMethodNameForEvent($event);

        return function ($model) use ($property, $method) {
            if (method_exists($model, $method)) {
                $rules = $model->{$method}($model);
            } elseif (method_exists($model, 'getRulesArray')) {
                $rules = $model->getRulesArray($model);
            } elseif (property_exists($model, $property)) {
                $rules = $model::$$property;
            } else {
                $rules = $model::$rules;
            }

            if (property_exists($model, 'visibleForValidation')) {
                $model->makeVisible($model->visibleForValidation);
            }

            Validator::validate($model->toArray(), $rules);
        };
    }

    protected static function getRulesPropAndMethodNameForEvent(string $event)
    {
        return ["{$event}Rules", 'get'.ucfirst($event).'RulesArray'];
    }
}

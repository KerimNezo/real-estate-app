<?php

namespace App\Observers;

use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use App\Models\Actions;

class PropertyObserver
{
    /**
     * Handle the Property "created" event.
     */
    public function created(Property $property): void
    {
        $action = new Actions();

        $action->property_id = $property->id;
        $action->user = $property->user_id;
        $action->name = "created";
        if (Auth::check() && Auth::user()->hasRole('admin')){
            $action->message = "Property added to the system by Admin";
        } elseif(Auth::check() && Auth::user()->hasRole('agent')) {
            $name = Auth::user()->name;
            $action->message = "Property added to the system by agent: {$name}";
        } else {
            $action->message = "Property was seeded to the database";
        }
    }

    /**
     * Handle the Property "updated" event.
     */
    public function updated(Property $property): void
    {
        logger($property->user_id);
        logger($property->id);
        // $action = new Actions();

        // $action->property_id = $property->id;
        // $action->user = $property->user_id;
        // $action->name = "created";
        // if (Auth::check() && Auth::user()->hasRole('admin')){
        //     $action->message = "Property added to the system by Admin";
        // } else {
        //     $name = Auth::user()->name;
        //     $action->message = "Property added to the system by agent: {$name}";
        // }
    }

    /**
     * Handle the Property "deleted" event.
     */
    public function deleted(Property $property): void
    {
        //
    }

    /**
     * Handle the Property "restored" event.
     */
    public function restored(Property $property): void
    {
        //
    }

    /**
     * Handle the Property "force deleted" event.
     */
    public function forceDeleted(Property $property): void
    {
        //
    }
}

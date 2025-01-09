<?php

namespace App\Observers;

use App\Models\Actions;
use App\Models\Property;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Auth;

class PropertyObserver
{
    /**
     * Handle the Property "created" event.
     */
    public function created(Property $property): void
    {
        $action = new Actions();

        $action->property_id = $property->id;
        $action->created_at = $property->created_at;
        $action->name = 'created'; // Use the custom message if provided

        // With this we're assinging default user_id of action to 1 of there is no auth user at the time of property update. 
        // Created so that observer works with seeders.
        $action->user_id = Auth::user() ? Auth::user()->id : 1;

        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $action->message = 'Property added to the system by Admin';
        } elseif (Auth::check() && Auth::user()->hasRole('agent')) {
            $name = Auth::user()->name;
            $action->message = "Property added to the system by agent: {$name}";
        } else {
            $action->message = 'Property was seeded to the database';
        }

        $action->save();
    }

    public function propertyEditedMessage(Actions $action) {
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $action->message = 'Property was edited by Admin';
        } elseif (Auth::check() && Auth::user()->hasRole('agent')) {
            $name = Auth::user()->name;
            $action->message = "Property was edited by agent: {$name}";
        } else {
            $action->message = 'Property was edited by seeder';
        }
    }


    /**
     * Handle the Property "updated" event.
     */
    public function updated(Property $property): void
    {
        // Create new action and assign data to its properties.
        $action = new Actions();

        $action->property_id = $property->id;
        $action->message = '';

        // With this we're assinging default user_id of action to 1 of there is no auth user at the time of property update. 
        // Created so that observer works with seeders.
        $action->user_id = Auth::user() ? Auth::user()->id : 1;

        if (!Auth::user()){
            $action->created_at = $property->created_at;
        }

        // This way I could be able to somehow store and, on view of single action, be able to display change that happened on that action.
        // $dirtyProperties = $property->getDirty();
        // $keys = array_keys($dirtyProperties);
        // logger($keys);

        // We check if property's data was edited or property is sold/rented
        // Right now if user edits some data and clicks the sell/rent button, the edited data will not be appended to the db and that data won't change.
        if ($property->getOriginal('transaction_at') === null) {

            // ako nije bio null, znači može biti da se sellalo ili rentalo ili je samo edit.
            $action->name = $property->transaction_at === null ? 'edited' : 'sold';

            // Storing action message based on actions name.
            if ($action->name === 'edited') {
                $this->propertyEditedMessage($action);
            } else {
                $name = $property->user->name;
                $action->message = "Property was sold by agent: {$name}";
            }

            // Here we're overwritting tha name and message of an action, after confirming by property data that property wasn't sold, but rather that it was rented.
            if (($property->lease_duration > 0 && !is_null($property->lease_duration)) && $property->transaction_at !== null) {
                $action->name = 'rented';
                $name = $property->user->name;
                $action->message = "Property was rented by agent: {$name}";
            }
        } else {
            // ako je već bio !null, znači može samo biti sad edit. Jer je već sold/rented.
            // This else statement here doesn't make much sense tho. If property is already sold/rented why would anyone edit it? Nor are they able to do so.
            $action->name = 'edited';

            $this->propertyEditedMessage($action);
        }

        $action->save();
    }

    /**
     * Handle the Property "deleted" event.
     */
    public function deleted(Property $property): void
    {
        $action = new Actions();

        $action->property_id = $property->id;
        $action->user_id = Auth::user()->id;
        $action->name = 'removed';
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $action->message = 'Property removed from the system by Admin';
        } elseif (Auth::check() && Auth::user()->hasRole('agent')) {
            $name = Auth::user()->name;
            $action->message = "Property was removed from the system by agent: {$name}";
        } else {
            $action->message = 'Property was removed from the database';
        }

        $action->save();
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
        $action = new Actions();

        $action->property_id = $property->id;
        $action->user_id = Auth::user()->id;
        $action->name = 'deleted';
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $action->message = 'Property deleted from the system by Admin';
        } elseif (Auth::check() && Auth::user()->hasRole('agent')) {
            $name = Auth::user()->name;
            $action->message = "Property was deleted from the system by agent: {$name}";
        } else {
            $action->message = 'Property was deleted from the database';
        }

        $action->save();
    }
}

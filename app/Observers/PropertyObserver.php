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
        $action->user_id= $property->user_id;
        $action->name = "created";
        if (Auth::check() && Auth::user()->hasRole('admin')){
            $action->message = "Property added to the system by Admin";
        } elseif(Auth::check() && Auth::user()->hasRole('agent')) {
            $name = Auth::user()->name;
            $action->message = "Property added to the system by agent: {$name}";
        } else {
            $action->message = "Property was seeded to the database";
        }

        $action->save();
    }

    /**
     * Handle the Property "updated" event.
     */
    public function updated(Property $property): void
    {
        // ovdje treba skontati kako da prepoznat je li property prodan/rentan ili samo editan
        // i treba skontati kako poslati poruku od agenta ovdje

        $action = new Actions();

        $action->property_id = $property->id;
        $action->user_id = $property->user_id;

        // provjeravamo da li je property samo editovan podacima ili je prodana/rentana nekretnina
        if($property->getOriginal('transaction_at') === null) {
            // ako nije bio null, znači može biti da se sellalo ili rentalo ili je samo edit.
            // Mislim da ovaj ovdje kod dobro pokriva je li on otišao ili ne. 
            // Fazon je ja mislim samo što ja generalno čim stavim vamo da je unavailable da ga on prikazuje kao sold/rented
            $action->name = $property->transaction_at === null ? "edited" : "sold";

            // ovdje ti fali samo još način da skontaš da osnovu nečega da li je 
            if(($property->lease_duration > 0 || !is_null($property->lease_duration)) && $property->transaction_at !== null){
                $action->name = "rented";
            }
        } else {
            // ako je već bio null, znači može samo biti sad edit.
            $action->name = "edited";
        }

        if (Auth::check() && Auth::user()->hasRole('admin')){
            $action->message = "Property removed from the system by Admin";
        } elseif(Auth::check() && Auth::user()->hasRole('agent')) {
            $name = Auth::user()->name;
            $action->message = "Property was removed from the system by agent: {$name}";
        } else {
            $action->message = "Property was removed from the database";
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
        $action->user_id = $property->user_id;
        $action->name = "removed";
        if (Auth::check() && Auth::user()->hasRole('admin')){
            $action->message = "Property removed from the system by Admin";
        } elseif(Auth::check() && Auth::user()->hasRole('agent')) {
            $name = Auth::user()->name;
            $action->message = "Property was removed from the system by agent: {$name}";
        } else {
            $action->message = "Property was removed from the database";
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
        $action->user_id = $property->user_id;
        $action->name = "deleted";
        if (Auth::check() && Auth::user()->hasRole('admin')){
            $action->message = "Property deleted from the system by Admin";
        } elseif(Auth::check() && Auth::user()->hasRole('agent')) {
            $name = Auth::user()->name;
            $action->message = "Property was deleted from the system by agent: {$name}";
        } else {
            $action->message = "Property was deleted from the database";
        }

        $action->save();
    }
}

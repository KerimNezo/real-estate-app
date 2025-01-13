<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class propertyDataController extends Controller
{
    public function changeTypeData(int $number)
    {
        switch ($number) {
            case 1:
                return 'Office';
            case 2:
                return 'House';
            case 3:
                return 'Appartement';
            default:
                return 'Unknown';
        }
    }

    public function reorderArray($array)
    {
        $reorderedArray = [];

        $desiredOrder = [
            'name', 'Type', 'price', 'city', 'street', 'country', 'surface',
            'year_built', 'status', 'lat', 'lon', 'rooms', 'bedrooms', 'toilets',
            'garage', 'furnished', 'floors', 'garden', 'lease_duration',
            'video_intercom', 'keycard_entry', 'elevator', 'description',
        ];

        foreach ($desiredOrder as $key) {
            if (isset($array[$key])) {
                $reorderedArray[$key] = $array[$key];
            }
        }

        return $reorderedArray;
    }

    public function numberToBool($value)
    {
        if ($value === 0 || $value === null) {
            return $value = 'No';
        } else {
            return $value = 'Yes';
        }
    }

    public function numberOrNo($value)
    {
        if ($value === null || $value === 0) {
            return $value = 'No';
        } else {
            return $value;
        }
    }
}

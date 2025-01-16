<?php

namespace App\Services;

class PropertyDataConversionService
{
    /**
     * Returns the string representation of property type based on input number
     * This could be done and avoided with enums, maybe.
     *
     * @param int $number
     * @return string
     */
    public function changeTypeData(int $number)
    {
        return match ($number) {
            1 => 'Office',
            2 => 'House',
            3 => 'Appartement',
            default => 'Unknown',
        };
    }

    /**
     * Reorder the array of models properties to match desiredOrder array.
     *
     * @param array $array
     * @return array
     */
    public function reorderArray(array $array)
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

    /**
     * Convert the passed number to bool.
     * If it's above 0 return yes, otherwise return 'No'
     *
     * @param string $value
     * @return string
     */
    public function numberToBool($value)
    {
        return ($value === 0 || $value === null) ? 'No' : 'Yes';
    }

    /**
     * Convert the passed number to 'No'
     * If it's above 0 return itself, otherwise return 'No'
     *
     * @param string $value
     * @return string
     */
    public function numberOrNo($value)
    {
        return ($value === null || $value === 0) ? 'No' : $value;
    }
}

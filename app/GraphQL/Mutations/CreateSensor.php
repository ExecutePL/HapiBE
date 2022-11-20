<?php

namespace App\GraphQL\Mutations;

use App\Models\Sensor;

final class CreateSensor
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $too_close = false;
        foreach(Sensor::all() as $sensor){
            $lon1 = $sensor->longitude;
            $lat1 = $sensor->latitude;
            $lon2 = $args['longitude'];
            $lat2 = $args['latitude'];
            $theta = $lon1 - $lon2;
            $dist1 = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist2 = acos($dist1);
            $dist3 = rad2deg($dist2);
            $miles = $dist3 * 60 * 1.1515;
            $km = $miles * 1.609344;
            $km = round($km,2);
            if($km < 0.1){
                $too_close = true;
            }
        }
        if($too_close === false){
            $new_sensor = new Sensor($args);
            $new_sensor->save();
        }
    }
}

<?php

namespace App\GraphQL\Mutations;

use App\Models\Measurement;
use App\Models\Sensor;
use GraphQL\Error\Error;

final class CreateMeasurement
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $sensor = Sensor::where('serial_number',$args['serial_number'])->first();
        if($sensor){
            $args['sensor_id'] = $sensor->id;
            unset($args['serial_number']);
            $new_measurement = new Measurement($args);
            $new_measurement->save();
            return $new_measurement;
        }else{
            return Error::createLocatedError('User is not verified');
        }
    }
}

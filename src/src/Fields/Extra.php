<?php

namespace edwardyi\Press\Fields;

class Extra extends FieldContract
{
    /**
     * @var string $type
     * @var string $value
     * @var array $data
     * 
     * @return array
     */
    public static function process($type, $value, $data)
    {
        $extraData = isset($data['extra']) ? (array) json_decode($data['extra']) : [];

        return [
            'extra' => json_encode(array_merge($extraData, [
                $type => $value
            ]))
        ];
    }
}
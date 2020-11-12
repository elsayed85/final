<?php
namespace App\Converters;

use MarcinOrlowski\ResponseBuilder\Contracts\ConverterContract;
use MarcinOrlowski\ResponseBuilder\Validator;


class ResourceCollectionConverter implements ConverterContract
{
    public function convert(
        object $obj,
        /** @scrutinizer ignore-unused */
        array $config
    ): array {
        Validator::assertIsObject('obj', $obj);
        return $obj->response()->getData(true);
    }
}

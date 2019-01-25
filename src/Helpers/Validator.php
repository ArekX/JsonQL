<?php
/**
 * by Aleksandar Panic
 * LICENSE: Apache 2.0
 *
 **/

namespace ArekX\JsonQL\Validation;


use ArekX\JsonQL\Traits\Memoize;
use ArekX\JsonQL\Types\TypeInterface;

class Validator
{
    use Memoize;

    /**
     * Validates data against a type.
     *
     * @param mixed $data
     * @param TypeInterface $type
     * @param bool $strict Whether or not to perform strict validation.
     * @return $errors Array of errors
     */
    public static function validate($data, $type, $strict = true): array
    {
        return ($strict ? $type::strictValidator() : $type::validator())->validate($data);
    }


    /**
     * Ensures data is of specific type.
     *
     * @param mixed $data Data to be validated
     * @param TypeInterface $type Type to be validated against.
     * @param bool $strict Whether or not to perform strict validation.
     * @throws InvalidTypeException Exception to be thrown if $data is not valid.
     */
    public static function ensure($data, $type, $strict = true): void
    {
        $errors = static::validate($data, $type, $strict);

        if (!empty($errors)) {
            throw new InvalidTypeException($errors);
        }
    }
}
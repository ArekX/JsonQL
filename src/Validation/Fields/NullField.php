<?php
/**
 * @author Aleksandar Panic
 * @link https://jsonql.readthedocs.io/
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @since 1.0.0
 **/

namespace ArekX\JsonQL\Validation\Fields;

use ArekX\JsonQL\Validation\BaseField;

/**
 * Class NullField Field representing a null type.
 * @package ArekX\JsonQL\Validation\Fields
 */
class NullField extends BaseField
{
    const ERROR_NOT_A_NULL = 'not_a_null';

    /**
     * @inheritdoc
     */
    public $emptyValue = 0;

    /**
     * @inheritdoc
     */
    public function name(): string
    {
        return 'null';
    }


    /**
     * @inheritdoc
     */
    protected function fieldDefinition(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    protected function doValidate($value, $parentValue = null): array
    {
        if (!is_null($value)) {
            return [self::ERROR_NOT_A_NULL => true];
        }

        return [];
    }
}
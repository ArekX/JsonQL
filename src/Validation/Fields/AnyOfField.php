<?php
/**
  * @author Aleksandar Panic
  * @link https://jsonql.readthedocs.io/
  * @license: http://www.apache.org/licenses/LICENSE-2.0
  * @since 1.0.0
 **/

namespace ArekX\JsonQL\Validation\Fields;

use ArekX\JsonQL\Validation\BaseField;
use ArekX\JsonQL\Validation\FieldInterface;

/**
 * Class AnyOfField
 *
 * Field representing multiple fields which all must be true.
 *
 * This field is equivalent to the OR operator.
 *
 * @package ArekX\JsonQL\Validation\Fields
 */
class AnyOfField extends BaseField
{
    /**
     * @var FieldInterface[]
     */
    public $fields;

    /**
     * AnyOfField constructor.
     * @param array $fields Fields to be validated.
     */
    public function __construct(array $fields = [])
    {
        $this->fields = $fields;
    }

    /**
     * @inheritdoc
     */
    public function name(): string
    {
        return 'anyOf';
    }

    /**
     * Adds another field to the validation list.
     *
     * @param FieldInterface $field Field to be added.
     * @return $this
     */
    public function andField(FieldInterface $field)
    {
        $this->fields[] = $field;
        return $this;
    }

    /**
     * Adds list of fields to be validated.
     *
     * @param array $fields Fields to be validated.
     * @return $this
     */
    public function withFields(array $fields)
    {
        $this->fields = array_merge($this->fields, $fields);
        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function fieldDefinition(): array
    {
        $fields = [];

        foreach ($this->fields as $field) {
            $fields[] = $field->definition();
        }

        return [
            'fields' => $fields
        ];
    }

    /**
     * @inheritdoc
     */
    public function doValidate($value, $parentValue = null): array
    {
        $errors = [];

        foreach ($this->fields as $fieldValidator) {
            $results = $fieldValidator->validate($value, $parentValue);

            if (empty($results)) {
                return [];
            }

            $errors = array_merge($errors, $results);
        }

        return $errors;
    }
}
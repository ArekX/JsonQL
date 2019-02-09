<?php
/**
 * @author Aleksandar Panic
 * @link https://jsonql.readthedocs.io/
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @since 1.0.0
 **/

namespace App\Services;

use Medoo\Medoo;

class Database extends Medoo
{
    public function __construct($setup)
    {
        parent::__construct($setup);
    }
}
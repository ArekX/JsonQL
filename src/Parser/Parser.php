<?php
/**
 * Copyright 2020 Aleksandar Panic
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 **/

namespace ArekX\RestFn\Parser;


use ArekX\RestFn\DI\Contracts\Configurable;
use ArekX\RestFn\DI\Contracts\Injectable;
use ArekX\RestFn\DI\Injector;
use ArekX\RestFn\Parser\Contracts\Evaluator;
use ArekX\RestFn\Parser\Contracts\Operation;
use ArekX\RestFn\Parser\Exceptions\InvalidOperation;
use ArekX\RestFn\Parser\Exceptions\InvalidValueFormatException;

/**
 * Class Parser
 * @package ArekX\RestFn\Parser
 *
 * This class represents a parser which is used to handle the requests.
 */
class Parser implements Injectable, Configurable, Evaluator
{
    /**
     * Injected injector used to create operations.
     *
     * @var Injector
     */
    public Injector $injector;

    /**
     * Operation handlers where each operation is mapped to a class
     *
     * @var array
     */
    public $ops = [];

    /**
     * Represents current context.p
     *
     * Contexts is an arbitrary data which is is stored inside a Parser
     * purpose of the context is to have a centralized data store which is accessible
     * by all of the rules during evaluation or validation.
     *
     * @var array
     */
    protected $context = [];

    /**
     * Configures parser with data.
     *
     * @param array $config
     */
    public function configure(array $config)
    {
        /** @var Operation[] $ops */
        $ops = $config['ops'];

        $this->ops = [];

        foreach ($ops as $op) {
            $this->ops[$op::name()] = $op;
        }
    }

    /**
     * Performs value validation.
     *
     * If a value is valid for evaluating null is returned,
     * otherwise errors are returned in nested format.
     *
     * @param mixed $value
     * @return array|null
     * @throws InvalidOperation
     * @throws InvalidValueFormatException
     */
    public function validate($value): ?array
    {
        if (empty($value)) {
            return null;
        }

        $result = $this->getOperation($value)->validate($this, $value);

        if ($result !== null) {
            return [$this->getRuleName($value), $result];
        }

        return null;
    }

    /**
     * Returns operation based on a value
     *
     * @param $value
     * @return mixed
     * @throws InvalidOperation
     * @throws InvalidValueFormatException
     */
    protected function getOperation($value)
    {
        if (!is_array($value)) {
            throw new InvalidValueFormatException();
        }

        $ruleName = $this->getRuleName($value);

        if (empty($this->ops[$ruleName])) {
            throw new InvalidOperation($ruleName);
        }

        $operationClass = $this->ops[$ruleName];

        return $this->injector->make($operationClass);
    }

    protected function getRuleName($value): string
    {
        return $value[0] ?? '';
    }

    /**
     * Evaluates a value and returns a result.
     *
     * @param mixed $value
     * @return array|mixed
     * @throws InvalidOperation
     * @throws InvalidValueFormatException
     */
    public function evaluate($value)
    {
        if (empty($value)) {
            return [];
        }

        return $this->getOperation($value)->evaluate($this, $value);
    }

    public function getContext(string $key)
    {
        return $this->context[$key] ?? null;
    }

    public function setContext(string $key, $value)
    {
        $this->context[$key] = $value;

        return $this;
    }
}
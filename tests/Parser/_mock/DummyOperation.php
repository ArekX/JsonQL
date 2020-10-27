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

namespace tests\Parser\_mock;


use ArekX\RestFn\Parser\Contracts\Evaluator;
use ArekX\RestFn\Parser\Contracts\Operation;

class DummyOperation implements Operation
{
    public $validateCalled = false;
    public $validateValue = null;
    public $evaluateCalled = false;
    public $evaluateValue = 1;

    public function validate($rules, $value, Evaluator $evaluator)
    {
        $this->validateCalled = true;
        return $this->validateValue;
    }

    public function evaluate($rules, $value, Evaluator $evaluator)
    {
        $this->evaluateCalled = true;
        return $this->evaluateValue;
    }
}
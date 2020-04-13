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

namespace ArekX\RestFn\DI\Contracts;

use ArekX\RestFn\DI\Injector;

/**
 * Interface Factory
 * @package ArekX\RestFn\DI\Contracts
 *
 * Classes which implement Factory will have create() called so that they
 * can handle resolution on what will be created.
 *
 * Classes will not be auto-wired unless instantiated through call to Injector::make()
 *
 * @see Injector::make()
 */
interface Factory
{
    /**
     * Resolves instance creation on the factory instance.
     *
     * @param string $definition Definition to be resolved.
     * @param array $args Constructor arguments passed for this class creation.
     * @param array|null $config Configuration set for this class or null if no configuration set.
     * @return mixed Instance to be returned.
     */
    public function create(string $definition, array $args, ?array $config);
}
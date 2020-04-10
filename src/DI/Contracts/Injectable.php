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


/**
 * Interface Injectable
 * @package ArekX\RestFn\DI\Contracts
 *
 * Classes which implement injectable will have all their public typed classes auto-wired.
 *
 * Properties must be public and have a type set to be injected.
 *
 * All properties will be injected before __construct() is called.
 */
interface Injectable
{
}
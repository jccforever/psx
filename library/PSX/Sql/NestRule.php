<?php
/*
 * PSX is a open source PHP framework to develop RESTful APIs.
 * For the current version and informations visit <http://phpsx.org>
 *
 * Copyright 2010-2015 Christoph Kappestein <k42b3.x@gmail.com>
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace PSX\Sql;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Logging\SQLLogger;

/**
 * NestRule
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @author  Fabien Potencier <fabien@symfony.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class NestRule
{
	protected $rules = array();

	public function add($parentKey, array $keys)
	{
		foreach($keys as $key)
		{
			$this->rules[$key] = $parentKey;
		}
	}

	public function getParent($key)
	{
		return isset($this->rules[$key]) ? $this->rules[$key] : null;
	}
}
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

namespace PSX\Controller\Foo\Application\SchemaApi;

use PSX\Api\Documentation;
use PSX\Api\Version;
use PSX\Api\Resource;
use PSX\Controller\SchemaApiAbstract;
use PSX\Data\RecordInterface;
use PSX\Data\Schema\Property;
use PSX\Loader\Context;
use PSX\Controller\SchemaApi\PropertyDocumentationTest;

/**
 * PropertyDocumentationController
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class PropertyDocumentationController extends SchemaApiAbstract
{
	/**
	 * @Inject
	 * @var PSX\Data\Schema\SchemaManager
	 */
	protected $schemaManager;

	/**
	 * @Inject
	 * @var PHPUnit_Framework_TestCase
	 */
	protected $testCase;

	public function getDocumentation()
	{
		$resource = new Resource(Resource::STATUS_ACTIVE, $this->context->get(Context::KEY_PATH));

		$resource->addMethod(Resource\Factory::getMethod('GET')
			->addQueryParameter(new Property\Integer('type'))
			->addResponse(200, $this->schemaManager->getSchema('PSX\Controller\Foo\Schema\Property'))
		);

		$resource->addMethod(Resource\Factory::getMethod('POST')
			->setRequest($this->schemaManager->getSchema('PSX\Controller\Foo\Schema\Property'))
			->addResponse(200, $this->schemaManager->getSchema('PSX\Controller\Foo\Schema\Property'))
		);

		return new Documentation\Simple($resource);
	}

	protected function doGet(Version $version)
	{
		return PropertyDocumentationTest::getDataByType($this->queryParameters->getProperty('type'));
	}

	protected function doCreate(RecordInterface $record, Version $version)
	{
		PropertyDocumentationTest::assertRecord($this->testCase, $record);

		return $record;
	}

	protected function doUpdate(RecordInterface $record, Version $version)
	{
	}

	protected function doDelete(RecordInterface $record, Version $version)
	{
	}
}
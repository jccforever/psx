<?php
/*
 * psx
 * A object oriented and modular based PHP framework for developing
 * dynamic web applications. For the current version and informations
 * visit <http://phpsx.org>
 *
 * Copyright (c) 2010-2014 Christoph Kappestein <k42b3.x@gmail.com>
 *
 * This file is part of psx. psx is free software: you can
 * redistribute it and/or modify it under the terms of the
 * GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or any later version.
 *
 * psx is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with psx. If not, see <http://www.gnu.org/licenses/>.
 */

namespace PSX\Controller\Foo\Application\SchemaApi;

use PSX\Api\Documentation;
use PSX\Api\Version;
use PSX\Api\View;
use PSX\Data\RecordInterface;
use PSX\Controller\SchemaApiAbstract;

/**
 * NoResponseController
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GPLv3
 * @link    http://phpsx.org
 */
class NoResponseController extends SchemaApiAbstract
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
		$responseSchema = $this->schemaManager->getSchema('PSX\Controller\Foo\Schema\SuccessMessage');

		$view = new View();
		$view->setPost($this->schemaManager->getSchema('PSX\Controller\Foo\Schema\Create'));
		$view->setPut($this->schemaManager->getSchema('PSX\Controller\Foo\Schema\Update'));
		$view->setDelete($this->schemaManager->getSchema('PSX\Controller\Foo\Schema\Delete'));

		return new Documentation\Simple($view);
	}

	protected function doGet(Version $version)
	{
	}

	protected function doCreate(RecordInterface $record, Version $version)
	{
		$this->testCase->assertEquals(3, $record->getUserId());
		$this->testCase->assertEquals('test', $record->getTitle());
		$this->testCase->assertInstanceOf('DateTime', $record->getDate());
	}

	protected function doUpdate(RecordInterface $record, Version $version)
	{
		$this->testCase->assertEquals(1, $record->getId());
		$this->testCase->assertEquals(3, $record->getUserId());
		$this->testCase->assertEquals('foobar', $record->getTitle());
	}

	protected function doDelete(RecordInterface $record, Version $version)
	{
		$this->testCase->assertEquals(1, $record->getId());
	}
}

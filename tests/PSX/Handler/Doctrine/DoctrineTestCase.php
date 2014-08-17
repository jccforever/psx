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

namespace PSX\Handler\Doctrine;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use PSX\Handler\Doctrine\RecordHydrator;
use PSX\Handler\HandlerTestCase;
use PSX\Sql\DbTestCase;

/**
 * DoctrineTestCase
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GPLv3
 * @link    http://phpsx.org
 */
abstract class DoctrineTestCase extends DbTestCase
{
	private static $em;

	public function setUp()
	{
		// we cant work with doctrine under hhvm
		if(getenv('TRAVIS_PHP_VERSION') == 'hhvm')
		{
			$this->markTestSkipped('Doctrine is not compatible with hhvm');
		}

		if(!class_exists('Doctrine\ORM\EntityManager'))
		{
			$this->markTestSkipped('Doctrine not installed');
		}

		parent::setUp();
	}

	protected function getEntityManager()
	{
		if(self::$em === null)
		{
			self::$em = getContainer()->get('entity_manager');
		}

		return self::$em;
	}
}

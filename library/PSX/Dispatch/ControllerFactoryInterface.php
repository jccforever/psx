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

namespace PSX\Dispatch;

use Psr\HttpMessage\RequestInterface;
use Psr\HttpMessage\ResponseInterface;
use PSX\Loader\Location;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * ControllerFactoryInterface
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GPLv3
 * @link    http://phpsx.org
 */
interface ControllerFactoryInterface
{
	/**
	 * Creates an instance of the given class name
	 *
	 * @param string $className
	 * @param PSX\Loader\Location $location
	 * @param Psr\HttpMessage\RequestInterface $request
	 * @param Psr\HttpMessage\ResponseInterface $response
	 * @return PSX\ControllerInterface
	 */
	public function getController($className, Location $location, RequestInterface $request, ResponseInterface $response);
}
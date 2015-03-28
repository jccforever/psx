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

namespace PSX\Api\Resource\Listing;

use PSX\Api\DocumentationInterface;
use PSX\Api\DocumentedInterface;
use PSX\Api\Resource;
use PSX\Api\Resource\ListingInterface;
use PSX\Api\Resource\MethodAbstract;
use PSX\Dispatch\ControllerFactoryInterface;
use PSX\Http\Request;
use PSX\Http\RequestInterface;
use PSX\Http\Response;
use PSX\Http\ResponseInterface;
use PSX\Loader\Context;
use PSX\Loader\RoutingParserInterface;
use PSX\Loader\PathMatcher;
use PSX\Uri;

/**
 * The documentation how an request and response looks is provided in the 
 * controller
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class ControllerDocumentation implements ListingInterface
{
	protected $routingParser;
	protected $controllerFactory;

	public function __construct(RoutingParserInterface $routingParser, ControllerFactoryInterface $controllerFactory)
	{
		$this->routingParser     = $routingParser;
		$this->controllerFactory = $controllerFactory;
	}

	public function getResourceIndex()
	{
		$collections = $this->routingParser->getCollection();
		$result      = array();

		foreach($collections as $collection)
		{
			list($methods, $path, $source) = $collection;

			$parts     = explode('::', $source, 2);
			$className = isset($parts[0]) ? $parts[0] : null;
			$resource  = new Resource(Resource::STATUS_ACTIVE, $path);

			foreach($methods as $methodName)
			{
				$method = Resource\Factory::getMethod($methodName);

				if($method instanceof MethodAbstract)
				{
					$resource->addMethod($method);
				}
			}

			// because creating a new instance of an controller is expensive
			// since we resolve all dependencies we use class_implements to 
			// check whether this is an documented API endpoint
			if(class_exists($className) && in_array('PSX\Api\DocumentedInterface', class_implements($className)))
			{
				$result[] = $resource;
			}
		}

		return $result;
	}

	public function getDocumentation($sourcePath)
	{
		$matcher     = new PathMatcher($sourcePath);
		$collections = $this->routingParser->getCollection();

		foreach($collections as $collection)
		{
			list($methods, $path, $source) = $collection;

			$parts     = explode('::', $source, 2);
			$className = isset($parts[0]) ? $parts[0] : null;

			if(class_exists($className) && $matcher->match($path))
			{
				$request  = new Request(new Uri('/'), 'GET');
				$response = new Response();
				$context  = new Context();
				$context->set(Context::KEY_PATH, $path);

				$controller = $this->getController($className, $request, $response, $context);

				if($controller instanceof DocumentedInterface)
				{
					$documentation = $controller->getDocumentation();

					if($documentation instanceof DocumentationInterface)
					{
						return $documentation;
					}
				}
			}
		}

		return null;
	}

	protected function getController($className, RequestInterface $request, ResponseInterface $response, Context $context)
	{
		try
		{
			return $this->controllerFactory->getController($className, $request, $response, $context);
		}
		catch(\Exception $e)
		{
			return null;
		}
	}
}

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

namespace PSX\Http\Factory;

use Zend\Diactoros\Response as PsrResponse;
use Zend\Diactoros\ServerRequestFactory;
use PSX\Http\RequestInterface;
use PSX\Http\ResponseInterface;

/**
 * Psr7Factory
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class Psr7Factory
{
	public static function createRequest(RequestInterface $request)
	{
		$psrRequest = ServerRequestFactory::fromGlobals()
			->withUri($request->getUri())
			->withMethod($request->getMethod())
			->withBody($request->getBody());

		foreach($request->getHeaders() as $name => $values)
		{
			$psrRequest = $psrRequest->withHeader($name, $values);
		}

		return $psrRequest;
	}

	public static function createResponse(ResponseInterface $response)
	{
		return new PsrResponse(
			$response->getBody(),
			$response->getStatusCode(),
			$response->getHeaders()
		);
	}
}
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

namespace PSX\Dependency;

use PSX\Base;
use PSX\Config;
use PSX\Data\Reader;
use PSX\Data\ReaderFactory;
use PSX\Data\Writer;
use PSX\Data\WriterFactory;
use PSX\Dispatch;
use PSX\Dispatch\RequestFactory;
use PSX\Dispatch\ResponseFactory;
use PSX\Dispatch\Sender;
use PSX\Domain\DomainManager;
use PSX\Handler;
use PSX\Http;
use PSX\Input;
use PSX\Loader;
use PSX\Session;
use PSX\Sql;
use PSX\Sql\TableManager;
use PSX\Template;
use PSX\Validate;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * DefaultContainer
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GPLv3
 * @link    http://phpsx.org
 */
class DefaultContainer extends Container
{
	/**
	 * @return PSX\Base
	 */
	public function getBase()
	{
		return new Base($this->get('config'));
	}

	/**
	 * @return PSX\Config
	 */
	public function getConfig()
	{
		return new Config($this->getParameter('config.file'));
	}

	/**
	 * @return PSX\Dispatch\SenderInterface
	 */
	public function getDispatchSender()
	{
		return new Sender();
	}

	/**
	 * @return PSX\Dispatch
	 */
	public function getDispatch()
	{
		return new Dispatch($this->get('config'), $this->get('loader'), $this->get('dispatch_sender'));
	}

	/**
	 * @return PSX\Http
	 */
	public function getHttp()
	{
		return new Http();
	}

	/**
	 * @return PSX\Input\ContainerInterface
	 */
	public function getInputCookie()
	{
		return new Input\Cookie($this->get('validate'));
	}

	/**
	 * @return PSX\Input\ContainerInterface
	 */
	public function getInputFiles()
	{
		return new Input\Files($this->get('validate'));
	}

	/**
	 * @return PSX\Input\ContainerInterface
	 */
	public function getInputGet()
	{
		return new Input\Get($this->get('validate'));
	}

	/**
	 * @return PSX\Input\ContainerInterface
	 */
	public function getInputPost()
	{
		return new Input\Post($this->get('validate'));
	}

	/**
	 * @return PSX\Input\ContainerInterface
	 */
	public function getInputRequest()
	{
		return new Input\Request($this->get('validate'));
	}

	/**
	 * @return PSX\Loader\RoutingParserInterface
	 */
	public function getRoutingParser()
	{
		return new Loader\RoutingParser\RoutingFile($this->get('config')->get('psx_routing'));
	}

	/**
	 * @return PSX\Loader\LocationFinderInterface
	 */
	public function getLoaderLocationFinder()
	{
		return new Loader\LocationFinder\RoutingParser($this->get('routing_parser'));
	}

	/**
	 * @return PSX\Loader\CallbackResolverInterface
	 */
	public function getLoaderCallbackResolver()
	{
		return new Loader\CallbackResolver\Simple($this);
	}

	/**
	 * @return Loader\ReverseRouter
	 */
	public function getReverseRouter()
	{
		return new Loader\ReverseRouter($this->get('routing_parser'), $this->get('config')->get('psx_url'), $this->get('config')->get('psx_dispatch'));
	}

	/**
	 * @return PSX\Loader
	 */
	public function getLoader()
	{
		$loader = new Loader($this->get('loader_location_finder'), $this->get('loader_callback_resolver'));

		// configure loader
		//$loader->addRoute('.well-known/host-meta', 'foo');

		return $loader;
	}

	/**
	 * @return PSX\Session
	 */
	public function getSession()
	{
		$session = new Session($this->getParameter('session.name'));
		$session->start();

		return $session;
	}

	/**
	 * @return PSX\Sql\Connection
	 */
	public function getSql()
	{
		return new Sql($this->get('config')->get('psx_sql_host'),
			$this->get('config')->get('psx_sql_user'),
			$this->get('config')->get('psx_sql_pw'),
			$this->get('config')->get('psx_sql_db'));
	}

	/**
	 * @return PSX\TemplateInterface
	 */
	public function getTemplate()
	{
		return new Template();
	}

	/**
	 * @return PSX\Validate
	 */
	public function getValidate()
	{
		return new Validate();
	}

	/**
	 * @return PSX\Dispatch\RequestFactoryInterface
	 */
	public function getRequestFactory()
	{
		return new RequestFactory($this->get('config'));
	}

	/**
	 * @return PSX\Dispatch\ResponseFactoryInterface
	 */
	public function getResponseFactory()
	{
		return new ResponseFactory();
	}

	/**
	 * @return PSX\Data\ReaderFactory
	 */
	public function getReaderFactory()
	{
		$reader = new ReaderFactory();
		$reader->addReader(new Reader\Json());
		$reader->addReader(new Reader\Dom());
		$reader->addReader(new Reader\Form());
		$reader->addReader(new Reader\Gpc());
		$reader->addReader(new Reader\Multipart());
		$reader->addReader(new Reader\Raw());
		$reader->addReader(new Reader\Xml());

		return $reader;
	}

	/**
	 * @return PSX\Data\WriterFactory
	 */
	public function getWriterFactory()
	{
		$writer = new WriterFactory();
		$writer->addWriter(new Writer\Json());
		$writer->addWriter(new Writer\Html($this->get('template'), $this->get('reverse_router')));
		$writer->addWriter(new Writer\Atom());
		$writer->addWriter(new Writer\Form());
		$writer->addWriter(new Writer\Jsonp());
		$writer->addWriter(new Writer\Rss());
		$writer->addWriter(new Writer\Xml());

		return $writer;
	}

	/**
	 * @return PSX\Domain\DomainManagerInterface
	 */
	public function getDomainManager()
	{
		return new DomainManager($this);
	}

	/**
	 * @return Symfony\Component\EventDispatcher\EventDispatcherInterface
	 */
	public function getEventDispatcher()
	{
		return new EventDispatcher();
	}

	/**
	 * @return PSX\Sql\TableManager
	 */
	public function getTableManager()
	{
		return new TableManager($this->get('sql'));
	}

	/**
	 * @return PSX\Handler\HandlerManagerInterface
	 */
	public function getDatabaseManager()
	{
		return new Handler\Database\Manager($this->get('table_manager'));
	}

	/**
	 * @return PSX\Handler\HandlerManagerInterface
	 */
	public function getDomManager()
	{
		return new Handler\Dom\Manager();
	}

	/**
	 * @return PSX\Handler\HandlerManagerInterface
	 */
	public function getMapManager()
	{
		return new Handler\Map\Manager();
	}

	/**
	 * @return PSX\Handler\HandlerManagerInterface
	 */
	public function getPdoManager()
	{
		return new Handler\Pdo\Manager($this->get('sql'));
	}

	/**
	 * @return PSX\Handler\HandlerManagerInterface
	 */
	/*
	public function getDoctrineManager()
	{
		return new Handler\Doctrine\Manager($this->get('entity_manager'));
	}
	*/

	/**
	 * @return PSX\Handler\HandlerManagerInterface
	 */
	/*
	public function getMongodbManager()
	{
		return new Handler\Mongodb\Manager($this->get('mongo_client'));
	}
	*/

	/**
	 * @return Doctrine\ORM\EntityManager
	 */
	/*
	public function getEntityManager()
	{
		$paths     = array(PSX_PATH_LIBRARY);
		$isDevMode = $this->get('config')->get('psx_debug');
		$dbParams  = array(
			'driver'   => 'pdo_mysql',
			'user'     => $this->get('config')->get('psx_sql_user'),
			'password' => $this->get('config')->get('psx_sql_pw'),
			'dbname'   => $this->get('config')->get('psx_sql_db'),
		);

		$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
		$config->addCustomHydrationMode(RecordHydrator::HYDRATE_RECORD, 'PSX\Handler\Doctrine\RecordHydrator');

		$entityManager = EntityManager::create($dbParams, $config);

		return $entityManager;
	}
	*/

	/**
	 * @return MongoClient
	 */
	/*
	public function getMongoClient()
	{
		return new MongoClient();
	}
	*/
}

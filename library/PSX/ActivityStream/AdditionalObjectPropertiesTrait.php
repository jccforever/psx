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

namespace PSX\ActivityStream;

use DateTime;

/**
 * AdditionalObjectPropertiesTrait
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GPLv3
 * @link    http://phpsx.org
 */
trait AdditionalObjectPropertiesTrait
{
	protected $alias;
	protected $attachments;
	protected $author;
	protected $content;
	protected $duplicates;
	protected $icon;
	protected $image;
	protected $location;
	protected $published;
	protected $generator;
	protected $provider;
	protected $summary;
	protected $updated;
	protected $startTime;
	protected $endTime;
	protected $validFrom;
	protected $validAfter;
	protected $validUntil;
	protected $validBefore;
	protected $rating;
	protected $tags;
	protected $title;
	protected $duration;
	protected $height;
	protected $width;
	protected $inReplyTo;
	protected $scope;

	public function setAlias($alias)
	{
		$this->alias = $alias;
	}
	
	public function getAlias()
	{
		return $this->alias;
	}

	/**
	 * @param PSX\ActivityStream\ObjectFactory $attachments
	 */
	public function setAttachments($attachments)
	{
		$this->attachments = $attachments;
	}
	
	public function getAttachments()
	{
		return $this->attachments;
	}

	/**
	 * @param PSX\ActivityStream\ObjectFactory $author
	 */
	public function setAuthor($author)
	{
		$this->author = $author;
	}
	
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * @param PSX\ActivityStream\Language $content
	 */
	public function setContent($content)
	{
		$this->content = $content;
	}
	
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * @param PSX\ActivityStream\ObjectFactory $duplicates
	 */
	public function setDuplicates($duplicates)
	{
		$this->duplicates = $duplicates;
	}
	
	public function getDuplicates()
	{
		return $this->duplicates;
	}

	/**
	 * @param PSX\ActivityStream\ObjectFactory $icon
	 */
	public function setIcon($icon)
	{
		$this->icon = $icon;
	}
	
	public function getIcon()
	{
		return $this->icon;
	}

	/**
	 * @param PSX\ActivityStream\ObjectFactory $image
	 */
	public function setImage($image)
	{
		$this->image = $image;
	}
	
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * @param PSX\ActivityStream\ObjectFactory $location
	 */
	public function setLocation($location)
	{
		$this->location = $location;
	}
	
	public function getLocation()
	{
		return $this->location;
	}

	/**
	 * @param DateTime $published
	 */
	public function setPublished(DateTime $published)
	{
		$this->published = $published;
	}
	
	public function getPublished()
	{
		return $this->published;
	}

	/**
	 * @param PSX\ActivityStream\ObjectFactory $generator
	 */
	public function setGenerator($generator)
	{
		$this->generator = $generator;
	}
	
	public function getGenerator()
	{
		return $this->generator;
	}

	/**
	 * @param PSX\ActivityStream\ObjectFactory $provider
	 */
	public function setProvider($provider)
	{
		$this->provider = $provider;
	}
	
	public function getProvider()
	{
		return $this->provider;
	}

	/**
	 * @param PSX\ActivityStream\Language $summary
	 */
	public function setSummary($summary)
	{
		$this->summary = $summary;
	}
	
	public function getSummary()
	{
		return $this->summary;
	}

	/**
	 * @param DateTime $updated
	 */
	public function setUpdated(DateTime $updated)
	{
		$this->updated = $updated;
	}
	
	public function getUpdated()
	{
		return $this->updated;
	}

	/**
	 * @param DateTime $startTime
	 */
	public function setStartTime(DateTime $startTime)
	{
		$this->startTime = $startTime;
	}
	
	public function getStartTime()
	{
		return $this->startTime;
	}

	/**
	 * @param DateTime $endTime
	 */
	public function setEndTime(DateTime $endTime)
	{
		$this->endTime = $endTime;
	}
	
	public function getEndTime()
	{
		return $this->endTime;
	}

	/**
	 * @param DateTime $validFrom
	 */
	public function setValidFrom(DateTime $validFrom)
	{
		$this->validFrom = $validFrom;
	}
	
	public function getValidFrom()
	{
		return $this->validFrom;
	}

	/**
	 * @param DateTime $validAfter
	 */
	public function setValidAfter(DateTime $validAfter)
	{
		$this->validAfter = $validAfter;
	}
	
	public function getValidAfter()
	{
		return $this->validAfter;
	}

	/**
	 * @param DateTime $validUntil
	 */
	public function setValidUntil(DateTime $validUntil)
	{
		$this->validUntil = $validUntil;
	}
	
	public function getValidUntil()
	{
		return $this->validUntil;
	}

	/**
	 * @param DateTime $validBefore
	 */
	public function setValidBefore(DateTime $validBefore)
	{
		$this->validBefore = $validBefore;
	}
	
	public function getValidBefore()
	{
		return $this->validBefore;
	}

	public function setRating($rating)
	{
		$this->rating = $rating;
	}
	
	public function getRating()
	{
		return $this->rating;
	}

	/**
	 * @param PSX\ActivityStream\ObjectFactory $tags
	 */
	public function setTags($tags)
	{
		$this->tags = $tags;
	}
	
	public function getTags()
	{
		return $this->tags;
	}

	/**
	 * @param PSX\ActivityStream\Language $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	public function getTitle()
	{
		return $this->title;
	}

	public function setDuration($duration)
	{
		$this->duration = $duration;
	}
	
	public function getDuration()
	{
		return $this->duration;
	}

	/**
	 * @param integer $height
	 */
	public function setHeight($height)
	{
		$this->height = $height;
	}
	
	public function getHeight()
	{
		return $this->height;
	}

	/**
	 * @param integer $width
	 */
	public function setWidth($width)
	{
		$this->width = $width;
	}
	
	public function getWidth()
	{
		return $this->width;
	}

	/**
	 * @param PSX\ActivityStream\ObjectFactory $inReplyTo
	 */
	public function setInReplyTo($inReplyTo)
	{
		$this->inReplyTo = $inReplyTo;
	}
	
	public function getInReplyTo()
	{
		return $this->inReplyTo;
	}

	/**
	 * @param PSX\ActivityStream\ObjectFactory $scope
	 */
	public function setScope($scope)
	{
		$this->scope = $scope;
	}
	
	public function getScope()
	{
		return $this->scope;
	}
}
	
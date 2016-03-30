<?php
/*
 * PSX is a open source PHP framework to develop RESTful APIs.
 * For the current version and informations visit <http://phpsx.org>
 *
 * Copyright 2010-2016 Christoph Kappestein <k42b3.x@gmail.com>
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

namespace PSX\Schema\Generator;

use PSX\Data\Record;
use PSX\Schema\GeneratorInterface;
use PSX\Schema\Property;
use PSX\Schema\PropertyInterface;
use PSX\Schema\SchemaInterface;
use PSX\Data\Writer;
use RuntimeException;

/**
 * Generates an json or xml sample request which can be used for documentation
 * purpose
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class Sample implements GeneratorInterface
{
    const FORMAT_JSON = 0;
    const FORMAT_XML  = 1;

    protected $format;
    protected $data;

    public function __construct($format = self::FORMAT_JSON, array $data)
    {
        $this->format = $format;
        $this->data   = $data;
    }

    public function generate(SchemaInterface $schema)
    {
        $record = $this->generateType($schema->getDefinition(), $this->data);

        switch ($this->format) {
            case self::FORMAT_XML:
                $writer = new Writer\Xml();
                break;

            case self::FORMAT_JSON:
            default:
                $writer = new Writer\Json();
                break;
        }

        return $writer->write($record);
    }

    protected function generateType(PropertyInterface $type, $data)
    {
        if ($type instanceof Property\AnyType) {
            $fields = array();
            foreach ($data as $name => $value) {
                $fields[$name] = $this->generateType($type->getPrototype(), $value);
            }

            return new Record($type->getName(), $fields);
        } elseif ($type instanceof Property\ArrayType) {
            if (is_array($data)) {
                $values = array();
                foreach ($data as $value) {
                    $values[] = $this->generateType($type->getPrototype(), $value);
                }

                return $values;
            } elseif ($type->isRequired()) {
                throw new RuntimeException('Missing sample data of required property ' . $type->getName());
            }
        } elseif ($type instanceof Property\BooleanType) {
            return (bool) $data;
        } elseif ($type instanceof Property\ComplexType) {
            $fields     = array();
            $properties = $type->getProperties();

            foreach ($properties as $name => $property) {
                if (isset($data[$name])) {
                    $fields[$name] = $this->generateType($property, $data[$name]);
                } elseif ($property->isRequired()) {
                    throw new RuntimeException('Missing sample data of required property ' . $name);
                }
            }

            return new Record($type->getName(), $fields);
        } elseif ($type instanceof Property\IntegerType) {
            return (int) $data;
        } elseif ($type instanceof Property\FloatType) {
            return (float) $data;
        } else {
            return (string) $data;
        }
    }
}
<?php

namespace DCarbone\PHPFHIR\Definition\Decorator;

/*
 * Copyright 2016-2019 Daniel Carbone (daniel.p.carbone@gmail.com)
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

use DCarbone\PHPFHIR\Config\VersionConfig;
use DCarbone\PHPFHIR\Definition\Type;
use DCarbone\PHPFHIR\Definition\Types;
use DCarbone\PHPFHIR\Enum\AttributeNameEnum;
use DCarbone\PHPFHIR\Enum\ElementTypeEnum;
use DCarbone\PHPFHIR\Utilities\ExceptionUtils;

/**
 * Class ComplexTypeElementTypeDecorator
 * @package DCarbone\PHPFHIR\Definition\Decorator
 */
abstract class ComplexTypeElementTypeDecorator
{
    /**
     * @param \DCarbone\PHPFHIR\Config\VersionConfig $config
     * @param \DCarbone\PHPFHIR\Definition\Types $types
     * @param \DCarbone\PHPFHIR\Definition\Type $type
     * @param \SimpleXMLElement $complexType
     */
    public static function decorate(VersionConfig $config, Types $types, Type $type, \SimpleXMLElement $complexType)
    {
        // parse through attributes
        foreach ($complexType->attributes() as $attribute) {
            switch ($attribute->getName()) {
                case AttributeNameEnum::NAME:
                    continue 2;

                default:
                    throw ExceptionUtils::createUnexpectedAttributeException($type, $complexType, $attribute);
            }
        }

        foreach ($complexType->children('xs', true) as $child) {
            switch ($child->getName()) {
                case ElementTypeEnum::ANNOTATION:
                    AnnotationElementTypeDecorator::decorate($config, $types, $type, $child);
                    break;
                case ElementTypeEnum::COMPLEX_CONTENT:
                    ComplexContentElementTypeDecorator::decorate($config, $types, $type, $child);
                    break;
                case ElementTypeEnum::SEQUENCE:
                    SequenceElementTypeDecorator::decorate($config, $types, $type, $child);
                    break;
                case ElementTypeEnum::ATTRIBUTE:
                    AttributeElementTypeDecorator::decorate($config, $types, $type, $child);
                    break;

                default:
                    throw ExceptionUtils::createUnexpectedElementException($type, $complexType, $child);
            }
        }
    }
}
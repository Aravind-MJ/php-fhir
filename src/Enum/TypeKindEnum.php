<?php

namespace DCarbone\PHPFHIR\Enum;

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

use MyCLabs\Enum\Enum;

/**
 * Class TypeKindEnum
 * @package DCarbone\PHPFHIR\Enum
 */
class TypeKindEnum extends Enum
{
    // this represents an actual value: string, int, etc.
    const PRIMITIVE = 'primitive';

    // these represent types that exist to wrap a primitive
    const PRIMITIVE_CONTAINER = 'primitive_container';

    // primitive type with limited possible value set
    const _LIST = 'list';

    // complex types
    const EXTENSION          = 'Extension';
    const ELEMENT            = 'Element';
    const BACKBONE_ELEMENT   = 'BackboneElement';
    const RESOURCE           = 'Resource';
    const RESOURCE_CONTAINER = 'ResourceContainer';
    const RESOURCE_INLINE    = 'Resource.Inline';
    const DOMAIN_RESOURCE    = 'DomainResource';

    // this indicates a type that is an immediate child of a resource and not used elsewhere
    const RESOURCE_COMPONENT = 'resource_component';

    // if this is seen, it means something referenced a type that was not defined anywhere in the xsd's
    const UNDEFINED = 'UNDEFINED';

    /**
     * @param string $kind
     * @return bool
     */
    public function is($kind)
    {
        return is_string($kind) && $kind === (string)$this;
    }

    /**
     * @param array $kinds
     * @return bool
     */
    public function isOneOf(array $kinds)
    {
        foreach ($kinds as $kind) {
            if ($this->is($kind)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isPrimitive()
    {
        return $this->is(TypeKindEnum::PRIMITIVE);
    }

    /**
     * @return bool
     */
    public function isPrimitiveContainer()
    {
        return $this->is(TypeKindEnum::PRIMITIVE_CONTAINER);
    }

    /**
     * @return bool
     */
    public function isList()
    {
        return $this->is(self::_LIST);
    }

    /**
     * @return bool
     */
    public function isElement()
    {
        return $this->is(self::ELEMENT);
    }

    /**
     * @return bool
     */
    public function isResource()
    {
        return $this->is(self::RESOURCE);
    }

    /**
     * @return bool
     */
    public function isResourceContainer()
    {
        return $this->is(self::RESOURCE_CONTAINER);
    }

    /**
     * @return bool
     */
    public function isInlineResource()
    {
        return $this->is(self::RESOURCE_INLINE);
    }

    /**
     * @return bool
     */
    public function isDomainResource()
    {
        return $this->is(self::DOMAIN_RESOURCE);
    }

    /**
     * @return bool
     */
    public function isUndefined()
    {
        return $this->is(self::UNDEFINED);
    }
}
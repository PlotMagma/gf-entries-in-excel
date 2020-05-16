<?php

namespace GFExcel\Tests\Values;

use GFExcel\Values\BoolValue;

/**
 * Unit tests for {@see BoolValue}.
 * @since $ver$
 */
class BoolValueTest extends AbstractValueTestCase
{
    /**
     * The class under test.
     * @since $ver$
     * @var BoolValue
     */
    private $value_object;

    /**
     * @inheritdoc
     * @since $ver$
     */
    public function setup(): void
    {
        parent::setup();

        $this->value_object = new BoolValue('0', $this->gf_field);
    }

    /**
     * Test case for {@see BoolValue::isBool()}.
     * @since $ver$
     */
    public function testIsBool(): void
    {
        $this->assertTrue($this->value_object->isBool());
    }

    /**
     * Test case for {@see BoolValue::getValue()}.
     * @since $ver$
     */
    public function testGetValue(): void
    {
        $this->assertFalse($this->value_object->getValue());
        $this->assertTrue((new BoolValue('value', $this->gf_field))->getValue());
    }
}

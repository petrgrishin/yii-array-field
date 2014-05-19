<?php
/**
 * @author Petr Grishin <petr.grishin@grishini.ru>
 */

use CActiveRecord as ActiveRecord;

class ArrayAccessFieldBehaviorTest extends PHPUnit_Framework_TestCase {
    public function testSetValue() {
        /** @var \PHPUnit_Framework_MockObject_MockObject|ActiveRecord $model */
        $model = $this
            ->getMockBuilder('CActiveRecord')
            ->disableOriginalConstructor()
            ->setMethods(array('__get', 'setAttribute'))
            ->getMock();

        $model
            ->expects($this->any())
            ->method('__get')
            ->will($this->returnCallback(function ($name) {
                return '{}';
            }))->with('attributes');

        $model
            ->expects($this->once())
            ->method('setAttribute')
            ->with('data', '{"a":{"b":true}}');

        $behavior = new \PetrGrishin\ArrayField\ArrayAccessFieldBehavior();
        $behavior->setFieldNameStorage('data');
        $behavior->attach($model);
        $behavior->setValue('a.b', true);
        $this->assertTrue($behavior->getValue('a.b', false));
    }
}

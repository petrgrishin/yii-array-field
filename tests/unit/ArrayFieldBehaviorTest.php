<?php
/**
 * @author Petr Grishin <petr.grishin@grishini.ru>
 */

use CActiveRecord as ActiveRecord;

class ArrayFieldBehaviorTest extends PHPUnit_Framework_TestCase {
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

        $behavior = new \PetrGrishin\ArrayField\ArrayFieldBehavior();
        $behavior->setFieldNameStorage('data');
        $behavior->attach($model);
        $behavior->setArray(array('a' => array('b' => true)));
        $this->assertEquals(array('a' => array('b' => true)), $behavior->getArray());
    }
}
 
yii-array-field
===============
[![Travis CI](https://travis-ci.org/petrgrishin/yii-array-field.png "Travis CI")](https://travis-ci.org/petrgrishin/yii-array-field)
[![Coverage Status](https://coveralls.io/repos/petrgrishin/yii-array-field/badge.png?branch=master)](https://coveralls.io/r/petrgrishin/yii-array-field?branch=master)

Yii array field behavior, for simple storage array in you model

Installation
------------
Add a dependency to your project's composer.json:
```json
{
    "require": {
        "petrgrishin/yii-array-field": "~1.0"
    }
}
```

Usage examples
--------------
#### Attach behavior to you model
Model have text attribute `data` for storage array

```php
namespace app\models;

use \CActiveRecord as ActiveRecord;
use \PetrGrishin\ArrayField\ArrayAccessFieldBehavior;

class Model extends СActiveRecord {
    public function behaviors() {
        return array(
            'arrayField' => array(
                'class' => ArrayAccessFieldBehavior::className(),
                'fieldNameStorage' => 'data',
            )
        );
    }

}
```

#### Usage behavior
```php
$model = Model::find(1)->one();
$model->arrayField->setValue('a.b', true);
$value = $model->arrayField->getValue('a.b');
$array = $model->arrayField->getArray();
```

#### Save only array field
```php
$model = Model::find(1)->one();
$model->arrayField->setValue('a.b', true);
$model->arrayField->save();
```

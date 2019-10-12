<?php

namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public $id;
    public $name;
    public $pos;

    public static function tableName()
    {
        return '{{categories}}';
    }

    public function whatIsIt()
    {
        return 'This is category';
    }
}
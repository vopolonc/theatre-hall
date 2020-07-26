<?php


namespace app\models;


use yii\base\Model;

class HallForm extends Model
{
    public $first_name;
    public $last_name;
    public $phone;

    public function rules()
    {
        return [
            [['first_name', 'last_name', 'phone',], 'required'],
            [['first_name', 'last_name',], 'string', 'max' => 255],
            [['phone'], 'match',
                'pattern' => '/^[+]380[0-9]{9}$/',
                'message' => 'Wrong format. Must match  +380*********'],
        ];
    }
}
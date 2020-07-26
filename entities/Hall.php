<?php

namespace app\entities;

use Yii;

/**
 * This is the model class for table "hall".
 *
 * @property int $id
 * @property int $row
 * @property int $col
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property int $created_at
 */
class Hall extends \yii\db\ActiveRecord
{

    const SCENARIO_CREATE = 'scenario_create';
    const SCENARIO_VIEW = 'scenario_view';

    public function getScenarios()
    {

        return [
            self::SCENARIO_CREATE => ['row', 'col', 'first_name', 'last_name', 'phone', 'created_at'],
            self::SCENARIO_VIEW => ['row', 'col', 'first_name', 'last_name', 'phone', 'created_at'],
        ];
    }

    public function scenarios()
    {
        $scenarios = $this->getScenarios();
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hall';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $allScenarios = $this->getScenarios();
        return [
            [$allScenarios[self::SCENARIO_CREATE], 'required', 'on' => self::SCENARIO_CREATE],
            [$allScenarios[self::SCENARIO_VIEW], 'default', 'on' => self::SCENARIO_VIEW],
            [['row', 'col', 'created_at'], 'integer', 'on' => self::SCENARIO_CREATE],
            [['first_name', 'last_name',], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'row' => 'Row',
            'col' => 'Col',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'phone' => 'Phone',
            'created_at' => 'Created At',
        ];
    }
}

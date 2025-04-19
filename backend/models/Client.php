<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $full_name
 * @property string $gender
 * @property string|null $birth_date
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 *
 * @property ClientClub[] $clientClubs
 * @property Club[] $clubs
 * @property User $createdBy
 * @property User $deletedBy
 * @property User $updatedBy
 */
class Client extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birth_date', 'deleted_at', 'deleted_by'], 'default', 'value' => null],
            [['full_name', 'gender', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['gender'], 'string'],
            [['birth_date'], 'safe'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'], 'integer'],
            [['full_name'], 'string', 'max' => 255],
            ['gender', 'in', 'range' => array_keys(self::optsGender())],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['deleted_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'gender' => 'Gender',
            'birth_date' => 'Birth Date',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }

    /**
     * Gets query for [[ClientClubs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClientClubs()
    {
        return $this->hasMany(ClientClub::class, ['client_id' => 'id']);
    }

    /**
     * Gets query for [[Clubs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClubs()
    {
        return $this->hasMany(Club::class, ['id' => 'club_id'])->viaTable('client_club', ['client_id' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[DeletedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeletedBy()
    {
        return $this->hasOne(User::class, ['id' => 'deleted_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }


    /**
     * column gender ENUM value labels
     * @return string[]
     */
    public static function optsGender()
    {
        return [
            self::GENDER_MALE => 'male',
            self::GENDER_FEMALE => 'female',
        ];
    }

    /**
     * @return string
     */
    public function displayGender()
    {
        return self::optsGender()[$this->gender];
    }

    /**
     * @return bool
     */
    public function isGenderMale()
    {
        return $this->gender === self::GENDER_MALE;
    }

    public function setGenderToMale()
    {
        $this->gender = self::GENDER_MALE;
    }

    /**
     * @return bool
     */
    public function isGenderFemale()
    {
        return $this->gender === self::GENDER_FEMALE;
    }

    public function setGenderToFemale()
    {
        $this->gender = self::GENDER_FEMALE;
    }
}

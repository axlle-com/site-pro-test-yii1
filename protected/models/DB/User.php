<?php

/**
 * This is the model class for table "ax_user".
 *
 * The followings are the available columns in table 'ax_user':
 * @property string $id
 * @property string $name_full
 * @property string $name_short
 * @property string $name
 * @property string $patronymic
 * @property string $surname
 * @property string $email
 * @property string $password_hash
 * @property integer $status
 * @property string $remember_token
 * @property string $auth_key
 * @property string $auth_key_google_2fa
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class User extends CActiveRecord
{

    public static function model($className = __CLASS__): User
    {
        return parent::model($className);
    }

    public static function create(array $data): ?User
    {
        $model = new self();
        $model->name = $data['name'];
        $model->email = $data['email'];
        $model->surname = $data['surname'];
        $model->status = 1;
        $model->password_hash = CPasswordHelper::hashPassword($data['password']);
        return $model->save() ? $model : null;
    }

    public function tableName(): string
    {
        return 'ax_user';
    }

    public function rules(): array
    {
        return [
            ['email, password_hash', 'required'],
            ['status', 'numerical', 'integerOnly' => true],
            ['name_full, name_short, name, patronymic, surname, email, password_hash, password_reset_token, verification_token', 'length', 'max' => 255],
            ['remember_token', 'length', 'max' => 500],
            ['auth_key, auth_key_google_2fa', 'length', 'max' => 32],
            ['created_at, updated_at, deleted_at', 'length', 'max' => 11],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, name_full, name_short, name, patronymic, surname, email, password_hash, status, remember_token, auth_key, auth_key_google_2fa, password_reset_token, verification_token, created_at, updated_at, deleted_at', 'safe', 'on' => 'search'],
        ];
    }

    public function relations(): array
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name_full' => 'Name Full',
            'name_short' => 'Name Short',
            'name' => 'Name',
            'patronymic' => 'Patronymic',
            'surname' => 'Surname',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'status' => 'Status',
            'remember_token' => 'Remember Token',
            'auth_key' => 'Auth Key',
            'auth_key_google_2fa' => 'Auth Key Google 2fa',
            'password_reset_token' => 'Password Reset Token',
            'verification_token' => 'Verification Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search(): CActiveDataProvider
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('name_full', $this->name_full, true);
        $criteria->compare('name_short', $this->name_short, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('patronymic', $this->patronymic, true);
        $criteria->compare('surname', $this->surname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password_hash', $this->password_hash, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('remember_token', $this->remember_token, true);
        $criteria->compare('auth_key', $this->auth_key, true);
        $criteria->compare('auth_key_google_2fa', $this->auth_key_google_2fa, true);
        $criteria->compare('password_reset_token', $this->password_reset_token, true);
        $criteria->compare('verification_token', $this->verification_token, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);
        $criteria->compare('deleted_at', $this->deleted_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}

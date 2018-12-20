<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $auth_key
 * @property string $token
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Document[] $documents
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'auth_key', 'token'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'email', 'password', 'auth_key', 'token'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'token' => 'Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public static function findIdentity($id)
    {
        try{
            return self::find()->where(['id'=>$id])->one();
        }catch (\Exception $e){
            return null;
        }
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        try{
            return self::find()->where(['access_token'=>$token])->one();
        }catch (\Exception $e){
            return null;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public static function findByEmail($email)
    {
        try{
            return self::find()->where(['email'=>$email])->one();
        }catch (\Exception $exception){
            return null;
        }

    }

    public function validatePassword($password)
    {
        if(Yii::$app->getSecurity()->validatePassword($password, $this->password)){
            return true;
        }
        else
            return false;

    }


}

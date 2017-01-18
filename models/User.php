<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string  $username
 * @property string  $auth_key
 * @property string  $password_hash
 * @property string  $password_reset_token
 * @property string  $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE  = 10;

    public $password_plain  = '';
    public $password_repeat = '';

    public function init()
    {
        parent::init();
        $this->on(self::EVENT_BEFORE_INSERT, [$this, 'changeAuthKey']);
        $this->on(self::EVENT_BEFORE_UPDATE, [$this, 'changeAuthKey']);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'nickname',
                    'username',
                    'password',
                    'password_repeat',
                    'password_hash',
                    'email',
                ],
                'required',
                'on' => ['default']
            ],
            [
                ['password', 'password_repeat'],
                'safe',
                'on' => ['update']
            ],
            [
                ['username'], 'unique'
            ],
            [
                ['password_plain'],
                'compare',
                'compareAttribute' => 'password_repeat',
                'message'          => Yii::t('app', 'Passwords don\'t match.'),
            ],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key'], 'string', 'max' => 32],
            [
                [
                    'password_hash',
                    'password_reset_token',
                    'email'
                ],
                'string',
                'max' => 255
            ],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                   => 'ID',
            'nickname'             => Yii::t('app', 'Nick Name'),
            'username'             => Yii::t('app', 'Account Name'),
            'auth_key'             => Yii::t('app', 'Auth Key'),
            'password'             => Yii::t('app', 'Password'),
            'password_repeat'      => Yii::t('app', 'Repeat Your Password'),
            'password_hash'        => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email'                => Yii::t('app', 'Email'),
            'status'               => Yii::t('app', 'Account Status'),
            'created_at'           => Yii::t('app', 'Created At'),
            'updated_at'           => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        if (empty(trim($password))) {
            return;
        }
        $this->password_plain = $password;
        $this->password_hash  = Yii::$app->security->generatePasswordHash($password);
    }

    public function getPassword()
    {
        return $this->password_plain;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function changeAuthKey()
    {
        if (in_array('password_hash', array_keys($this->dirtyAttributes))) {
            $this->generateAuthKey();
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
}

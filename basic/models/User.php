<?php

namespace app\models;
use yii\helpers\SecurityHelper;
use yii\web\Identity;
use Yii;

/**
 * This is the model class for table "tbl_user".
 *
 * @property int $id
 * @property string $full_name
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string $password
 * @property string|null $date_of_birth
 * @property int|null $gender
 * @property string|null $about_me
 * @property string|null $contact_no
 * @property string|null $address
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $city
 * @property string|null $country
 * @property string|null $zipcode
 * @property string|null $language
 * @property string|null $profile_file
 * @property int|null $is_notification
 * @property int|null $tos
 * @property int $role_id
 * @property int $state_id
 * @property int|null $type_id
 * @property string|null $metric_no
 * @property string|null $last_visit_time
 * @property string|null $last_action_time
 * @property string|null $last_password_change
 * @property int|null $login_error_count
 * @property string|null $activation_key
 * @property string|null $timezone
 * @property string $created_on
 * @property int|null $created_by_id
 */
class User extends \app\components\TActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
     const STATE_INACTIVE = 0;

    const STATE_ACTIVE = 1;
    const STATE_DELETED = 3;

    const MALE = 0;

    const FEMALE = 1;

    const ROLE_ADMIN = 0;

    const ROLE_MANAGER = 1;

    const ROLE_USER = 2;

    const ROLE_STAFF = 3;

    const TYPE_ON = 0;

    const TYPE_OFF = 1;
    public static function tableName()
    {
        return 'tbl_user';
    }
  public static function getActiveList()
    {
        return ArrayHelper::map(User::findActive()->all(), 'id', 'full_name');
    }
     public static function getStateOptions()
    {
        return [
            self::STATE_INACTIVE => "Inactive",
            self::STATE_ACTIVE => "Active",
            self::STATE_BANNED => "Banned",
            self::STATE_DELETED => "Deleted"
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'email', 'password', 'role_id', 'state_id', 'created_on'], 'required'],
            [['date_of_birth', 'last_visit_time', 'last_action_time', 'last_password_change', 'created_on'], 'safe'],
            [['gender', 'is_notification', 'tos', 'role_id', 'state_id', 'type_id', 'login_error_count', 'created_by_id'], 'integer'],
            [['full_name', 'email', 'city', 'country'], 'string', 'max' => 64],
            [['first_name', 'last_name', 'contact_no', 'metric_no'], 'string', 'max' => 32],
            [['password', 'language', 'profile_file', 'activation_key'], 'string', 'max' => 128],
            [['about_me', 'address', 'timezone'], 'string', 'max' => 255],
            [['latitude', 'longitude'], 'string', 'max' => 512],
            [['zipcode'], 'string', 'max' => 16],
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
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'date_of_birth' => 'Date Of Birth',
            'gender' => 'Gender',
            'about_me' => 'About Me',
            'contact_no' => 'Contact No',
            'address' => 'Address',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'city' => 'City',
            'country' => 'Country',
            'zipcode' => 'Zipcode',
            'language' => 'Language',
            'profile_file' => 'Profile File',
            'is_notification' => 'Is Notification',
            'tos' => 'Tos',
            'role_id' => 'Role ID',
            'state_id' => 'State ID',
            'type_id' => 'Type ID',
            'metric_no' => 'Metric No',
            'last_visit_time' => 'Last Visit Time',
            'last_action_time' => 'Last Action Time',
            'last_password_change' => 'Last Password Change',
            'login_error_count' => 'Login Error Count',
            'activation_key' => 'Activation Key',
            'timezone' => 'Timezone',
            'created_on' => 'Created On',
            'created_by_id' => 'Created By ID',
        ];
    }
    public function isActive()
    {
        return ($this->state_id == User::STATE_ACTIVE);
    }

     public static function getRoleOptions($id = null)
    {
        $list = array(
            self::ROLE_ADMIN => "Admin",
            self::ROLE_MANAGER => "Manager",
            self::ROLE_USER => "User",
            self::ROLE_CLIENT => "Client"
        );
        if ($id === null)
            return $list;
        return isset($list[$id]) ? $list[$id] : 'Not Defined';
    }
     public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword(yii::$app->name . $password, utf8_decode($this->password));
    }

    public function getRole()
    {
        $list = self::getRoleOptions();
        return isset($list[$this->role_id]) ? $list[$this->role_id] : 'Not Defined';
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }

   
    
    public static function isUser()
    {
        $user = Yii::$app->user->identity;
        if ($user == null)
            return false;

        return ($user->isActive() && $user->role_id == User::ROLE_USER);
    }

    public static function isManager()
    {
        $user = Yii::$app->user->identity;
        if ($user == null)
            return false;

        return ($user->isActive() && $user->role_id == User::ROLE_MANAGER);
    }

  

    

   

    public static function isAdmin()
    {
        $user = Yii::$app->user->identity;
        if ($user == null)
            return false;

        return ($user->isActive() && $user->role_id == User::ROLE_ADMIN);
    }

}

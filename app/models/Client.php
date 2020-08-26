<?php

namespace WBC\Models;

use WBC\Helpers\ClientHelper;
use WBC\Lib\Tools\Tools as Tools;

class Client extends ApiModel
{

    use ClientHelper;

    const UT_USER           = 'utUser';
    const UT_ROBOT          = 'utRobot';
    const UT_ADMIN          = 'utAdmin';

    public static $USER_TYPES_LIST = array(
        self::UT_USER,
        self::UT_ROBOT,
        self::UT_ADMIN,
    );

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $crm_id;

    /**
     *
     * @var integer
     */
    protected $area;

    /**
     *
     * @var string
     */
    protected $auth_hash;

    /**
     *
     * @var integer
     */
    protected $author_id;

    /**
     *
     * @var string
     */
    protected $client_status;

    /**
     *
     * @var integer
     */
    protected $company_id;

    /**
     *
     * @var string
     */
    protected $default_locale;

    /**
     *
     * @var string
     */
    protected $first_name;

    /**
     *
     * @var string
     */
    protected $last_name;

    /**
     *
     * @var string
     */
    protected $second_name;

    /**
     *
     * @var string
     */
    protected $first_name_ru;

    /**
     *
     * @var string
     */
    protected $last_name_ru;

    /**
     *
     * @var string
     */
    protected $second_name_ru;

    /**
     *
     * @var string
     */
    protected $password;

    /**
     *
     * @var string
     */
    protected $token;

    /**
     *
     * @var integer
     */
    protected $detalisation;

    /**
     *
     * @var integer
     */
    protected $is_company_admin;

    /**
     *
     * @var integer
     */
    protected $is_hidden;

    /**
     *
     * @var integer
     */
    protected $is_players_valid;

    /**
     *
     * @var string
     */
    protected $private_key;

    /**
     *
     * @var integer
     */
    protected $private_like_count;

    /**
     *
     * @var string
     */
    protected $public_key;

    /**
     *
     * @var integer
     */
    protected $public_like_count;

    /**
     *
     * @var integer
     */
    protected $region;

    /**
     *
     * @var integer
     */
    protected $timezone = 0;

    /**
     *
     * @var string
     */
    protected $user_type;

    /**
     *
     * @var string
     */
    protected $expired_date;

    /**
     *
     * @var string
     */
    protected $created_at;

    /**
     *
     * @var string
     */
    protected $updated_at;

    /**
     *
     * @var integer
     */
    protected $abc_access;

    /**
     *
     * @var string
     */
    protected $deleted_at;

    protected $linkedin_profile_url;

    /**
     *
     * @var string
     */
    protected $job_position;

    /**
     *
     * @var integer
     */
    protected $theme_id;

    /**
     *
     * @var string
     */
    protected $last_visit;

    private $old_password = null;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field crm_id
     *
     * @param integer $crm_id
     * @return $this
     */
    public function setCrmId($crm_id)
    {
        $this->crm_id = $crm_id;

        return $this;
    }

    /**
     * Method to set the value of field area
     *
     * @param integer $area
     * @return $this
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Method to set the value of field auth_hash
     *
     * @param string $auth_hash
     * @return $this
     */
    public function setAuthHash($auth_hash)
    {
        $this->auth_hash = $auth_hash;

        return $this;
    }

    /**
     * Method to set the value of field author_id
     *
     * @param integer $author_id
     * @return $this
     */
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;

        return $this;
    }

    /**
     * Method to set the value of field client_status
     *
     * @param string $client_status
     * @return $this
     */
    public function setClientStatus($client_status)
    {
        $this->client_status = $client_status;

        return $this;
    }

    /**
     * Method to set the value of field company_id
     *
     * @param integer $company_id
     * @return $this
     */
    public function setCompanyId($company_id)
    {
        $this->company_id = $company_id;

        return $this;
    }

    /**
     * Method to set the value of field default_locale
     *
     * @param string $default_locale
     * @return $this
     */
    public function setDefaultLocale($default_locale)
    {
        $this->default_locale = $default_locale;

        return $this;
    }

    /**
     * Method to set the value of field theme_id
     *
     * @param integer $themeId
     * @return $this
     */
    public function setThemeId($themeId)
    {
        $this->theme_id = $themeId;

        return $this;
    }

    /**
     * Method to set the value of field first_name
     *
     * @param string $first_name
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Method to set the value of field last_name
     *
     * @param string $last_name
     * @return $this
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Method to set the value of field second_name
     *
     * @param string $second_name
     * @return $this
     */
    public function setSecondName($second_name)
    {
        $this->second_name = $second_name;

        return $this;
    }

    /**
     * Method to set the value of field first_name_ru
     *
     * @param string $first_name
     * @return $this
     */
    public function setFirstNameRu($first_name)
    {
        $this->first_name_ru = $first_name;

        return $this;
    }

    /**
     * Method to set the value of field last_name_ru
     *
     * @param string $last_name
     * @return $this
     */
    public function setLastNameRu($last_name)
    {
        $this->last_name_ru = $last_name;

        return $this;
    }

    /**
     * Method to set the value of field second_name_ru
     *
     * @param string $second_name
     * @return $this
     */
    public function setSecondNameRu($second_name)
    {
        $this->second_name_ru = $second_name;

        return $this;
    }

    /**
     * Method to set the value of field password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Method to set the value of field old_password
     *
     * @param string $password
     * @return $this
     */
    public function setOldPassword($password)
    {
        $this->old_password = $password;

        return $this;
    }

    /**
     * Method to set the value of field token
     *
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Method to reset the value of field token
     *
     * @return $this
     */
    public function resetToken()
    {
        $this->setToken($this->_generateToken());

        return $this;
    }

    /**
     * Method to set the value of field detalisation
     *
     * @param integer $detalisation
     * @return $this
     */
    public function setDetalisation($detalisation)
    {
        $this->detalisation = $detalisation;

        return $this;
    }

    /**
     * Method to set the value of field is_company_admin
     *
     * @param integer $is_company_admin
     * @return $this
     */
    public function setIsCompanyAdmin($is_company_admin)
    {
        $this->is_company_admin = $is_company_admin;

        return $this;
    }

    /**
     * Method to set the value of field is_hidden
     *
     * @param integer $is_hidden
     * @return $this
     */
    public function setIsHidden($is_hidden)
    {
        $this->is_hidden = $is_hidden;

        return $this;
    }

    /**
     * Method to set the value of field is_players_valid
     *
     * @param integer $is_players_valid
     * @return $this
     */
    public function setIsPlayersValid($is_players_valid)
    {
        $this->is_players_valid = $is_players_valid;

        return $this;
    }

    /**
     * Method to set the value of field private_key
     *
     * @param string $private_key
     * @return $this
     */
    public function setPrivateKey($private_key)
    {
        $this->private_key = $private_key;

        return $this;
    }

    /**
     * Method to set the value of field private_like_count
     *
     * @param integer $private_like_count
     * @return $this
     */
    public function setPrivateLikeCount($private_like_count)
    {
        $this->private_like_count = $private_like_count;

        return $this;
    }

    /**
     * Method to set the value of field public_key
     *
     * @param string $public_key
     * @return $this
     */
    public function setPublicKey($public_key)
    {
        $this->public_key = $public_key;

        return $this;
    }

    /**
     * Method to set the value of field public_like_count
     *
     * @param integer $public_like_count
     * @return $this
     */
    public function setPublicLikeCount($public_like_count)
    {
        $this->public_like_count = $public_like_count;

        return $this;
    }

    /**
     * Method to set the value of field region
     *
     * @param integer $region
     * @return $this
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Method to set the value of field timezone
     *
     * @param int $timezone
     * @return $this
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Method to set the value of field user_type
     *
     * @param string $user_type
     * @return $this
     */
    public function setUserType($user_type)
    {
        $this->user_type = $user_type;

        return $this;
    }

    /**
     * Method to set the value of field expired_date
     *
     * @param string $expired_date
     * @return $this
     */
    public function setExpiredDate($expired_date)
    {
        $this->expired_date = $expired_date;

        return $this;
    }

    /**
     * Method to set the value of field created_at
     *
     * @param string $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Method to set the value of field updated_at
     *
     * @param string $updated_at
     * @return $this
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Method to set the value of field abc_access
     *
     * @param string $abc_access
     * @return $this
     */
    public function setAbcAccess($abc_access)
    {
        $this->abc_access = $abc_access;

        return $this;
    }

    /**
     * Method to set the value of field deleted_at
     *
     * @param string $deleted_at
     * @return $this
     */
    public function setDeletedAt($deleted_at)
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }

    /**
     * Method to set the value of field linkedin_profile_url
     *
     * @param string $linkedin_profile_url
     * @return $this
     */
    public function setLinkedinProfileUrl($linkedin_profile_url)
    {
        $this->linkedin_profile_url = $linkedin_profile_url;

        return $this;
    }

    /**
     * Method to set the value of field job_position
     *
     * @param string $job_position
     * @return $this
     */
    public function setJobPosition($job_position)
    {
        $this->job_position = $job_position;

        return $this;
    }

    /**
     * Method to set the value of field last_visit
     *
     * @param string $last_visit
     * @return $this
     */
    public function setLastVisit($last_visit)
    {
        $this->last_visit = $last_visit;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field crm_id
     *
     * @return integer
     */
    public function getCrmId()
    {
        return $this->crm_id;
    }

    /**
     * Returns the value of field area
     *
     * @return integer
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Returns the value of field auth_hash
     *
     * @return string
     */
    public function getAuthHash()
    {
        return $this->auth_hash;
    }

    /**
     * Returns the value of field author_id
     *
     * @return integer
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * Returns the value of field client_status
     *
     * @return string
     */
    public function getClientStatus()
    {
        return $this->client_status;
    }

    /**
     * Returns the value of field company_id
     *
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Returns the value of field default_locale
     *
     * @return string
     */
    public function getDefaultLocale()
    {
        return $this->default_locale;
    }

    /**
     * Returns the value of field theme_id
     *
     * @return integer
     */
    public function getThemeId()
    {
        return $this->theme_id;
    }

    /**
     * Returns the value of field first_name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Returns the value of field last_name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Returns the value of field second_name
     *
     * @return string
     */
    public function getSecondName()
    {
        return $this->second_name;
    }

    /**
     * Returns the value of field first_name_ru
     *
     * @return string
     */
    public function getFirstNameRu()
    {
        return $this->first_name_ru;
    }

    /**
     * Returns the value of field last_name_ru
     *
     * @return string
     */
    public function getLastNameRu()
    {
        return $this->last_name_ru;
    }

    /**
     * Returns the value of field second_name_ru
     *
     * @return string
     */
    public function getSecondNameRu()
    {
        return $this->second_name_ru;
    }

    /**
     * Returns the value of field password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function getOldPassword()
    {
        return $this->old_password;
    }

    /**
     * Returns the value of field token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Returns the value of field detalisation
     *
     * @return integer
     */
    public function getDetalisation()
    {
        return $this->detalisation;
    }

    /**
     * Returns the value of field is_company_admin
     *
     * @return integer
     */
    public function getIsCompanyAdmin()
    {
        return $this->is_company_admin;
    }

    /**
     * Returns the value of field is_hidden
     *
     * @return integer
     */
    public function getIsHidden()
    {
        return $this->is_hidden;
    }

    /**
     * Returns the value of field is_players_valid
     *
     * @return integer
     */
    public function getIsPlayersValid()
    {
        return $this->is_players_valid;
    }

    /**
     * Returns the value of field private_key
     *
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->private_key;
    }

    /**
     * Returns the value of field private_like_count
     *
     * @return integer
     */
    public function getPrivateLikeCount()
    {
        return $this->private_like_count;
    }

    /**
     * Returns the value of field public_key
     *
     * @return string
     */
    public function getPublicKey()
    {
        return $this->public_key;
    }

    /**
     * Returns the value of field public_like_count
     *
     * @return integer
     */
    public function getPublicLikeCount()
    {
        return $this->public_like_count;
    }

    /**
     * Returns the value of field region
     *
     * @return integer
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Returns the value of field timezone
     *
     * @return int
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Returns the value of field user_type
     *
     * @return string
     */
    public function getUserType()
    {
        return $this->user_type;
    }

    /**
     * Returns the value of field expired_date
     *
     * @return string
     */
    public function getExpiredDate()
    {
        return $this->expired_date;
    }

    /**
     * Returns the value of field created_at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Returns the value of field updated_at
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Returns the value of field abc_access
     *
     * @return integer
     */
    public function getAbcAccess()
    {
        $abcAccess = array_flip(self::$ABC_ACCESS_LIST);

        if (isset($abcAccess[$this->abc_access])) {
            return $abcAccess[$this->abc_access];
        }

        return false;
    }

    /**
     * Returns the value of field deleted_at
     *
     * @return string
     */
    public function getDeletedAt()
    {
        return $this->deleted_at;
    }

    public function isDeleted()
    {
        return !!intval($this->deleted_at);
    }

    /**
     * Returns the value of field linkedin_profile_url
     *
     * @return string
     */
    public function getLinkedinProfileUrl()
    {
        return $this->linkedin_profile_url;
    }

    /**
     * Returns the value of field job_position
     *
     * @return string
     */
    public function getJobPosition()
    {
        return $this->job_position;
    }

    /**
     * Returns the value of field last_visit
     *
     * @return string
     */
    public function getLastVisit()
    {
        $format = 'Y-m-d H:i:s';

        $d = \DateTime::createFromFormat($format, $this->last_visit);
        if ($d && $d->format($format) == $this->last_visit) {
            return $this->last_visit;
        }

        return null;
    }
    
    public function getLastVisitAgo() {
        return $this->getLastVisit() ? Tools::timeAgoInWords($this->getLastVisit(), NULL, CURRENT_LOCALE_ISO) : _('last_visit_never');
    }

    public function getIsOnline()
    {
        $dateVisit = strtotime('+5 minutes', strtotime($this->last_visit));
        $currentDate = time();
        return $currentDate < $dateVisit;
    }

    public function beforeValidation()
    {
        if(!$this->getToken()) {
            $this->resetToken();
        }

        $this->setFirstNameRu($this->getFirstName());
        $this->setSecondNameRu($this->getSecondName());
        $this->setLastNameRu($this->getLastName());

        if (CURRENT_LOCALE_ISO == 'ru'){
            $this->setFirstName(Tools::translit($this->getFirstNameRu()));
            $this->setSecondName(Tools::translit($this->getSecondNameRu()));
            $this->setLastName(Tools::translit($this->getLastNameRu()));
        }

        $this->presetValidation();

        return $this->validate($this->getValidator());
    }

    public function beforeValidationOnCreate()
    {
        $this->setDeletedAt('0000-00-00 00:00:00');
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();

        $this->hasMany('id', 'WBC\Models\ClientCard', 'client_id', array('alias' => 'ClientCard'));
        $this->hasMany('id', 'WBC\Models\ClientContacts', 'client_id', array('alias' => 'ClientContacts'));
        $this->hasMany('id', 'WBC\Models\ClientContacts', 'colleague_id', array('alias' => 'ClientContacts'));
        $this->hasMany('id', 'WBC\Models\ClientEmail', 'client_id', array('alias' => 'ClientEmail'));
        $this->hasMany('id', 'WBC\Models\ClientLibrary', 'client_id', array('alias' => 'ClientLibrary'));
        $this->hasMany('id', 'WBC\Models\ClientFavouriteTag', 'client_id', array('alias' => 'ClientFavouriteTag'));
        $this->hasMany('id', 'WBC\Models\ClientFollower', 'client_id', array('alias' => 'ClientFollowerC'));
        $this->hasMany('id', 'WBC\Models\ClientFollower', 'follower_id', array('alias' => 'ClientFollowerF'));
        $this->hasMany('id', 'WBC\Models\ClientInvite', 'invited_id', array('alias' => 'ClientInviteInvited'));
        $this->hasMany('id', 'WBC\Models\ClientInvite', 'inviter_id', array('alias' => 'ClientInviteInviter'));
        $this->hasMany('id', 'WBC\Models\ClientPhone', 'client_id', array('alias' => 'ClientPhone'));
        $this->hasMany('id', 'WBC\Models\ClientAttributes', 'client_id', array('alias' => 'ClientAttributes'));

        $this->belongsTo('default_locale', 'WBC\Models\Language', 'id', array('alias' => 'ClientLanguage'));
    }

    /**
     * @return Companies
     */
    public function getRelatedClientCompany()
    {
        return $this->getRelated('ClientCompany');
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Client[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Client
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Find Client by field id
     *
     * @param $id
     * @return Client
     */
    public static function findFirstById($id)
    {
        return static::findFirst(array(
            'conditions' => 'id = :id:',
            'bind' => array(
                'id' => $id
            )
        ));
    }

    /**
     * @return string
     */
    private function _generateToken()
    {
        $security = new \Phalcon\Security();
        return $security->hash(md5(uniqid(mt_rand(), true)));
    }

    public function getPublicNameLocale()
    {
        switch (CURRENT_LOCALE_ISO){
            case 'ru':
                return $this->getFirstNameRu() . ' ' . $this->getLastNameRu();
                break;
            default:
                return $this->getFirstName() . ' ' . $this->getLastName();
                break;
        }
    }

    public static function getPublicNameLocaleFromObj($obj)
    {
        switch (CURRENT_LOCALE_ISO){
            case 'ru':
                return $obj->first_name_ru . ' ' . $obj->last_name_ru;
                break;
            default:
                return $obj->first_name . ' ' . $obj->last_name;
                break;
        }
    }

    public function getNormalized()
    {
        $return = [];
        $return['id'] = $this->getId();
        $return['firstName'] = $this->getFirstName();
        $return['lastName'] = $this->getLastName();
        $return['publicName'] = $this->getPublicNameLocale();
        $return['public_name'] = $this->getPublicNameLocale();

        return $return;
    }
    
    public function isVerified()
    {
        return $this->getUserType() != self::UT_USER;
    }

    public function setNewPassword($password)
    {
        $this->setPassword($this->createHash($password));
    }

    public static function getList($params = null, $totalCount = false)
    {
        $clientOrder = 'DESC';
        if (isset($params['clientOrder'])) {
            $clientOrder = $params['clientOrder'];
        }

        $q = self::getStaticDi()->getModelsManager()->createBuilder();
        if ($totalCount) {
            $q->columns('COUNT(*) as num');
        } else {
            $q->columns('client.*');
        }
        $q->from(['client' => 'WBC\Models\Client']);

        if (isset($params['inClientIds'])){
            $q->inWhere('client.id', $params['inClientIds']);
        }

        if (isset($params['companyId'])) {
            $q->andWhere('client.company_id = :companyId:', ['companyId' => $params['companyId']]);
        }

        if (isset($params['findLike'])) {
            $q->andWhere('client.first_name'.$params['findLike']['locale'].' LIKE :nameFirst: OR client.last_name'.$params['findLike']['locale'].' LIKE :nameLast:', ['nameFirst' => "%".$params['findLike']['name']."%", 'nameLast' => "%".$params['findLike']['name']."%"]);
        }

        if (!$totalCount) {
            if (isset($params['limit'])) {
                $q->limit($params['limit']);
            }
            if (isset($params['offset'])) {
                $q->offset($params['offset']);
            }
        }

        $q->orderBy(['client.created_at ' . $clientOrder . ', client.id']);

        if ($totalCount) {
            return $q->getQuery()->execute()->getFirst()->num;
        } else {
            //$q->groupBy('client.id');
            return $q;
        }
        //$rows = $q->getQuery()->execute();
    }

    public static function getListCountByParams($params = [], $pageNumber = 1)
    {
        if ($pageNumber === null) {
            $pageNumber = 1;
        }

        $totalCount = self::getList($params, true);
        $members = self::_getListByPage($params, $pageNumber);

        return [$members, $totalCount];
    }

    public static function getListByParams($params = [])
    {
        $q = self::getList($params);
        $members = $q->getQuery()->execute();

        return $members;
    }

    protected static function _getListByPage($params, $pageNumber, $limit = null)
    {
        $q = self::getList($params);
        $paginator = new \Phalcon\Paginator\Adapter\QueryBuilder(array(
            "builder" => $q,
            "limit" => $limit ?: self::getStaticDi()->get('config')->public->itemsOnPage,
            "page" => $pageNumber
        ));
        $result = $paginator->getPaginate();
        return $result;
    }

    public function isAllowPostToChannel($channel_id)
    {
        if ($channel_id == 0){
            return true;
        }
        $count = FeedChannelUsers::count([
            'conditions' => 'channel_id = :channel_id: AND client_id = :client_id:',
            'bind' => array(
                'channel_id' => $channel_id,
                'client_id' => $this->getId()
            )
        ]);

        return $count>0 ? true : false;
    }
}

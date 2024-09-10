<?php

namespace gm\humhub\modules\auth\orcid\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use gm\humhub\modules\auth\orcid\Module;

/**
 * The module configuration model
 */
class ConfigureForm extends Model
{
    /**
     * @var boolean Enable this authclient
     */
    public $enabled;

    /**
     * @var string the client id provided by ORCID site
     */
    public $clientId;

    /**
     * @var string the client secret provided by ORCID site
     */
    public $clientSecret;

    /**
     * @var string readonly
     */
    public $redirectUri;

    /**
     * @var string
     */
    public $serverUrl;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientId', 'clientSecret', 'serverUrl'], 'required'],
            [['clientId', 'clientSecret', 'serverUrl'], 'string'],
            [['enabled'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'enabled' => Yii::t('AuthORCIDModule.base', 'Enabled'),
            'clientId' => Yii::t('AuthORCIDModule.base', 'Client ID'),
            'clientSecret' => Yii::t('AuthORCIDModule.base', 'Client secret'),
            'serverUrl' => Yii::t('AuthORCIDModule.base', 'ORCID Server Url'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
        ];
    }

    /**
     * Loads the current module settings
     */
    public function loadSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('auth-orcid');

        $settings = $module->settings;

        $this->enabled = (boolean)$settings->get('enabled');
        $this->clientId = $settings->get('clientId');
        $this->clientSecret = $settings->get('clientSecret');
        $this->serverUrl = $settings->get('serverUrl');

        $this->redirectUri = Url::to(['/user/auth/external', 'authclient' => 'orcid'], true);
    }

    /**
     * Saves module settings
     */
    public function saveSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('auth-orcid');

        $module->settings->set('enabled', (boolean)$this->enabled);
        $module->settings->set('clientId', $this->clientId);
        $module->settings->set('clientSecret', $this->clientSecret);
        $module->settings->set('serverUrl', $this->serverUrl);

        return true;
    }

    /**
     * Returns a loaded instance of this configuration model
     */
    public static function getInstance()
    {
        $config = new static;
        $config->loadSettings();

        return $config;
    }

}

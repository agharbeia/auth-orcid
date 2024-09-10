<?php

namespace humhubContrib\auth\orcid\authclient;

use Yii;
use yii\authclient\OAuth2;
use humhubContrib\auth\orcid\Module;
use humhubContrib\auth\orcid\models\ConfigureForm;

/**
 * ORCID Authclient
 */
class ORCID extends Oauth2
{

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fab fa-orcid',
            'buttonBackgroundColor' => '#395697',
        ];
    }

    /**
     * @inheritdoc
     */
    public $authUrl;

    /**
     * @inheritdoc
     */
    public $tokenUrl;

    /**
     * @inheritdoc
     */
    public $apiBaseUrl;

    /**
     * @inheritdoc
     */
    public $revokeUrl;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $config = ConfigureForm::getInstance();

        $this->apiBaseUrl = $config->serverUrl . '/api/v1';
        $this->authUrl = $config->serverUrl . '/oauth/authorize';
        $this->tokenUrl = $config->serverUrl . '/oauth/token';
        $this->revokeUrl = $config->serverUrl . '/oauth/revoke';

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public $scope = 'read';

    /**
     * @inheritdoc
     */
     public $attributeNames = [
         'id',
         'email'
    ];

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('accounts/verify_credentials', 'GET');
    }

    /**
     * @inheritdoc
     */
    public function applyAccessTokenToRequest($request, $accessToken)
    {
        $request->getHeaders()->set('Authorization', 'Bearer '. $accessToken->getToken());
    }

    /**
     * @inheritdoc
     */
    protected function defaultName() {
        return 'orcid';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle() {
        return 'ORCID';
    }
}

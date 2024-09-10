<?php

namespace humhubContrib\auth\orcid;

use humhub\components\Event;
use humhub\modules\user\authclient\Collection;
use humhubContrib\auth\orcid\authclient\ORCID;
use humhubContrib\auth\orcid\models\ConfigureForm;

class Events
{
    /**
     * @param Event $event
     */
    public static function onAuthClientCollectionInit($event)
    {
        /** @var Collection $authClientCollection */
        $authClientCollection = $event->sender;

        if (!empty(ConfigureForm::getInstance()->enabled)) {
            $authClientCollection->setClient('orcid', [
                'class' => ORCID::class,
                'clientId' => ConfigureForm::getInstance()->clientId,
                'clientSecret' => ConfigureForm::getInstance()->clientSecret,
                'apiBaseUrl' => ConfigureForm::getInstance()->serverUrl,
            ]);
        }
    }

}

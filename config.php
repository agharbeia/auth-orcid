<?php

use humhub\modules\user\authclient\Collection;
use humhubContrib\auth\orcid\Module;
use humhubContrib\auth\orcid\Events;

return [
    'id' => 'auth-orcid',
    'class' => Module::class,
    'namespace' => 'humhubContrib\auth\orcid',
    'events' => [
        [Collection::class, Collection::EVENT_AFTER_CLIENTS_SET, [Events::class, 'onAuthClientCollectionInit']]
    ],
];

<?php

use humhub\modules\user\authclient\Collection;
use gm\humhub\modules\auth\orcid\Module;
use gm\humhub\modules\auth\orcid\Events;

return [
    'id' => 'auth-orcid',
    'class' => Module::class,
    'namespace' => 'gm\humhub\modules\auth\orcid',
    'events' => [
        [Collection::class, Collection::EVENT_AFTER_CLIENTS_SET, [Events::class, 'onAuthClientCollectionInit']]
    ],
];

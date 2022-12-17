<?php

/**
 * DevFlag main configuration file. Everything will be managed under the codebase
 *
 * Note: avoid using `env` or anything else. Put the raw boolean here.
 *
 * In my projects, I have 4 diff envs, if you have more, feel simply add them here.
 */

return [
    'local' => [
        'useNewFeature' => true,
    ],
    'testing' => [
        'useNewFeature' => true,
    ],
    'staging' => [
        'useNewFeature' => false,
    ],
    'production' => [
        'useNewFeature' => false,
    ],
];
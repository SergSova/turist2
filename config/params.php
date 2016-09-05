<?php

    return [
        'adminEmail' => 'admin@example.com',
        'supportEmail' => 'suport@turist.com',
        'user.passwordResetTokenExpire' => 3600,
        'fileManager' => [
            'storagePath' => dirname(__DIR__).'/web/storage',
            'storageUrl' => 'http://turist.local/web/storage/',
            'baseValidationRules' => [
                'file',
                'maxFiles' => 1,
                'maxSize' => 1024 * 1024
            ],
            'attributeName' => 'file'
        ]

    ];


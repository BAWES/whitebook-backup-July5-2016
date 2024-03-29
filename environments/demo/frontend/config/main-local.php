<?php
return [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,

            'rules' => [
                'edit-profile' => 'users/edit_profile',
                'create-event' => 'users/create_event',
                'event-slider' => 'product/event_slider',
                'update-event' => 'users/update_event',
                'add-event' => 'users/add_event',
                'search' => 'default/search',
                'directorysearch' => 'default/searchdirectory',
                'search-result/<search:[A-Za-z0-9\_-]+>' => 'default/searchresult',
                'signup' => 'users/signup',
                'emailcheck' => 'users/email_check',
                'login' => 'users/login',
                'forget' => 'users/forget_password',
                'password-reset' => 'users/password_reset',

                'reset/<cust_id:[0-9a-zA-Z\-&]+>' => 'users/reset_confirm',

                'logout' => 'users/logout',
                'account-settings' => 'users/account_settings',
                'events' => 'users/events',
                'thingsilike' => 'users/events',
                'event-details/<slug:[A-Za-z0-9\_-]+>' => 'users/eventdetails',
                'excel/<slug:[A-Za-z0-9\_-]+>' => 'users/excel',
                'inviteesearch' => 'eventinvitees/index',
                'event-invitees' => 'eventinvitees/addinvitees',
                'category/<name:[0-9a-zA-Z\-&]+>' => 'category/category_products',
                'confirm-email/<key:[0-9a-zA-Z\-&]+>' => 'users/confirm_email',
                'add-to-wishlist' => 'users/add_to_wishlist',
                'remove-from-wishlist' => 'users/remove_from_wishlist',
                'wishlist' => 'users/wishlist',
                'load_more' => 'users/load_more_events',
                // BEGIN define  page name
                'home' => 'default/index/',
                'activate' => 'default/activate/',
                'plan' => 'plan/plans/',
                'shop' => '/default/shop/',
                // list of category products page
                'products/<slug:[A-Za-z0-9\_-]+>' => 'plan/plan/',
                'experience' => 'default/experience',
                'directory' => 'default/directory',
                'contact-us' => 'default/contact',
                // particular products detail page
                'product/<slug:[A-Za-z0-9\_-]+>' => 'product/product/',
                // BEGIN define  page name
                'load_more_wishlist' => 'users/load_more_wishlist',
                'pro-eventdetails' => 'product/eventdetails',
                // particular vendor detail page
                'pending_items' => 'default/pending_items',
                'experience/<slug:[0-9a-zA-Z\-&]+>' => 'default/vendor_profile',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<action:\w+>' => '<controller>/<action>',
                '<slug:[A-Za-z0-9\_-]+>' => 'default/cmspages',
            ],
        ],
    ],
];

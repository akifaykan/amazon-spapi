<?php

return [

    /*
    --------------------------------------------------------------------------
     Amazon SP-API Settings
    --------------------------------------------------------------------------

    This file contains the configurations required to connect to the Amazon SP-API.
    Here, details like Client ID, Client Secret, Refresh Token, and API Base URL are defined.

    */

    'base_url'      => env('SPAPI_BASE_URL', 'https://sellingpartnerapi-eu.amazon.com'),
    'client_id'     => env('SPAPI_CLIENT_ID'),
    'client_secret' => env('SPAPI_CLIENT_SECRET'),
    'refresh_token' => env('SPAPI_REFRESH_TOKEN'),
    'region'        => env('SPAPI_REGION', 'eu-west-1'),
];

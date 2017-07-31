create a new Saml2 auth class with
```php
$auth = new Ultraware_OneLogin_Saml2_Auth();
```
### Add the following to the settings.php to use scoping

```php

    // Identity Provider Data that we want connected with our SP.
    'idp' => array (

        ....

        /*
         * You can optional set a scoping. Scoping allows a service provider to specify a list of identity
         * providers in an authnRequest to a proxying identity provider. This is an indication to the
         * proxying identity provider, that the service will only deal with the identity providers specified.
         */
        'scoping' => [
            // Specifies the number of proxying indirections permissible.
            'proxyCount' => 2,
            // The list of entityIDs for identity providers that are relevant for a service provider in an authnRequest.
            'idpList' => ['entityId'],
            // To allow an identity provider to identify the original requester
            'requesterId' => 'requesterId.nl',
        ],
```

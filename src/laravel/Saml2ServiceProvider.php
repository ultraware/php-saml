<?php

namespace Ultraware\phpSaml\laravel;

use URL;

class Saml2ServiceProvider extends \Aacotroneo\Saml2\Saml2ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('Aacotroneo\Saml2\Saml2Auth', function ($app) {
            $config = config('saml2_settings');
            if (empty($config['sp']['entityId'])) {
                $config['sp']['entityId'] = URL::route('saml_metadata');
            }
            if (empty($config['sp']['assertionConsumerService']['url'])) {
                $config['sp']['assertionConsumerService']['url'] = URL::route('saml_acs');
            }
            if (empty($config['sp']['singleLogoutService']['url'])) {
                $config['sp']['singleLogoutService']['url'] = URL::route('saml_sls');
            }

            $auth = new \Ultraware_OneLogin_Saml2_Auth($config);

            return new \Aacotroneo\Saml2\Saml2Auth($auth);
        });

    }
}

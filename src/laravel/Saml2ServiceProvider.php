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
        $this->app->singleton(
            \Aacotroneo\Saml2\Saml2Auth::class,
            function ($app) {
                $idpName = $app->request->route('idpName');
                $auth = $this->loadOneLoginAuthFromIpdConfig($idpName);
                return new \Aacotroneo\Saml2\Saml2Auth($auth);
            }
        );
    }

    public static function loadOneLoginAuthFromIpdConfig($idpName)
    {
        if (empty($idpName)) {
            throw new \InvalidArgumentException("IDP name required.");
        }

        $config = config('saml2_' . $idpName . '_idp_settings');

        if (empty($config['sp']['entityId'])) {
            $config['sp']['entityId'] = URL::route('saml2_metadata', $idpName);
        }
        if (empty($config['sp']['assertionConsumerService']['url'])) {
            $config['sp']['assertionConsumerService']['url'] = URL::route('saml2_acs', $idpName);
        }
        if (!empty($config['sp']['singleLogoutService']) &&
            empty($config['sp']['singleLogoutService']['url'])) {
            $config['sp']['singleLogoutService']['url'] = URL::route('saml2_sls', $idpName);
        }
        if (strpos($config['sp']['privateKey'], 'file://') === 0) {
            $config['sp']['privateKey'] = static::extractPkeyFromFile($config['sp']['privateKey']);
        }
        if (strpos($config['sp']['x509cert'], 'file://') === 0) {
            $config['sp']['x509cert'] = static::extractCertFromFile($config['sp']['x509cert']);
        }
        if (strpos($config['idp']['x509cert'], 'file://') === 0) {
            $config['idp']['x509cert'] = static::extractCertFromFile($config['idp']['x509cert']);
        }

        return new \Ultraware\phpSaml\lib\Saml2\Auth($config);
    }
}

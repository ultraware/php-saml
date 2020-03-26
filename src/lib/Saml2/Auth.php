<?php
/**
 * This file is part of php-saml.
 *
 * (c) OneLogin Inc
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package OneLogin
 * @author  OneLogin Inc <saml-info@onelogin.com>
 * @license MIT https://github.com/onelogin/php-saml/blob/master/LICENSE
 * @link    https://github.com/onelogin/php-saml
 */

namespace Ultraware\phpSaml\lib\Saml2;

/**
 * Main class of OneLogin's PHP Toolkit
 */
class  Auth extends \OneLogin\Saml2\Auth
{
    public function buildAuthnRequest($settings, $forceAuthn, $isPassive, $setNameIdPolicy, $nameIdValueReq = null)
    {
        return new AuthnRequest($settings, $forceAuthn, $isPassive, $setNameIdPolicy, $nameIdValueReq);
    }
}

<?php

namespace App\SSO;

class IdpProvider
{
// Defining some trusted Service Providers.
    private $trusted_sps = [
        'urn:service:provider:id' => 'https://service-provider.com/login/callback'
    ];

    /**
     * Retrieves the Assertion Consumer Service.
     *
     * @param string
     *   The Service Provider Entity Id
     * @return
     *   The Assertion Consumer Service Url.
     */
    public function getServiceProviderAcs($entityId){
        return $this->trusted_sps[$entityId];
    }

    /**
     * Returns a dummy user email.
     *
     * @return string
     */
    public function getUserEmail(){

        return "amairia.aymen@gmail.com";
    }
}

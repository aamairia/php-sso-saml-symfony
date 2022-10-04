<?php

namespace App\Controller;

use App\SSO\IdpProvider;
use App\SSO\IdpTools;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SSOController extends AbstractController
{

    /**
     * @Route("/", name="sso_front")
     */
    public function home(): Response
    {

        // Initiating our IdP Provider dummy connection.
        $idpProvider = new IdpProvider();

// Instantiating our Utility class.
        $idpTools = new IdpTools();

// Receive the HTTP Request and extract the SAMLRequest.
        $request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $saml_request = $idpTools->readSAMLRequest($request);

// Getting a few details from the message like ID and Issuer.
        $issuer = $saml_request->getMessage()->getIssuer()->getValue();
        $id = $saml_request->getMessage()->getID();

        // Simulate user information from IdP
        $user_id = $request->get("username");
        $user_email = $idpProvider->getUserEmail();




        // Construct a SAML Response.
        $response = $idpTools->createSAMLResponse($idpProvider, $user_id, $user_email, $issuer, $id);

        return $this->json(['hello' => 'sso']);
    }
}

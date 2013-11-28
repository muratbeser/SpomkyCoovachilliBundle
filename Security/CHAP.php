<?php
namespace Spomky\CoovachilliBundle\Security;

use Symfony\Component\HttpFoundation\Request;

class CHAP extends ChallengeCalculator
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getCHAPURI($username, $password, $uamsecret, $logon_uri)
    {
        return sprintf( "http://%s:%s%s?username=%s&response=%s&userurl=%s",
            $this->request->query->get("uamip"),
            $this->request->query->get("uamport"),
            $logon_uri,
            $username,
            urlencode($this->getCHAPResponse($password,$this->request->query->get("challenge"),$uamsecret)),
            urlencode($this->request->query->get("userurl"))
        );

        return $target;
    }

    private function getCHAPResponse($pwd,$challenge,$uamsecret)
    {
        $challenge = $this->calculateChallenge($challenge,$uamsecret);

        return md5("\0" . $pwd . $challenge);
    }
}

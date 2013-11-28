<?php
namespace Spomky\CoovachilliBundle\Security;

use Symfony\Component\HttpFoundation\Request;

class PAP extends ChallengeCalculator
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getPAPURI($username, $password, $uam_secret, $logon_uri)
    {
        return sprintf( "http://%s:%s%s?username=%s&password=%s&userurl=%s",
            $this->request->query->get("uamip"),
            $this->request->query->get("uamport"),
            $logon_uri,
            $username,
            urlencode($this->getPAPPassword($password,$this->request->query->get("challenge"),$uamsecret)),
            urlencode($this->request->query->get("userurl"))
        );
    }

    private function getPAPPassword($pwd,$challenge,$uamsecret)
    {
        $challenge = $this->calculateChallenge($challenge,$uamsecret);
        $pwd = pack("a32", $pwd);

        return implode("", unpack("H32", ($pwd ^ $challenge)));
    }
}

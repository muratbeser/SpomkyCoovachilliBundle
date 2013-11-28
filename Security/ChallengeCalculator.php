<?php
namespace Spomky\CoovachilliBundle\Security;

class ChallengeCalculator
{
    protected function calculateChallenge($challenge,$uamsecret)
    {
        $challenge = $this->getRawChallenge($challenge);
        if($uamsecret !== null)
            $challenge = pack("H*", md5($challenge . $uamsecret));

        return $challenge;
    }

    protected function getRawChallenge($challenge)
    {
        return pack("H32", $challenge);
    }
}

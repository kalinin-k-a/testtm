<?php

namespace App\Application\UseCases;


use App\Application\DataProvider\UserSessionIdDataProvider;
use App\Domain\Entity\TestsSession;
use App\Domain\Service\Tests\TestSessionInitiator;
use Doctrine\ORM\EntityManagerInterface;

class InitTestSessionUseCase
{
    public function __construct(
        private readonly UserSessionIdDataProvider $testSessionIdProvider,
        private readonly TestSessionInitiator $testInitiator,
        private readonly EntityManagerInterface $em,
    ) {

    }

    public function execute(): TestsSession
    {
        $sessionId = $this->testSessionIdProvider->getSessionId();
        if ($sessionId) {
            $session = $this->testInitiator->resume($sessionId);
        } else {
            $session = $this->testInitiator->start();
        }

        $this->em->persist($session);
        $this->em->flush();

        return $session;
    }
}
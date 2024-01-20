<?php

namespace App\Application\DataProvider;


interface UserSessionIdDataProvider
{
    public function getSessionId(): int;
}
<?php

namespace Step;

use ApiTester;

class Tester extends ApiTester
{
    /** @var string  */
    public const URL = '/tester';

    /**
     * @param array $params
     *
     * @return void
     */
    public function getHi(array $params = []): void
    {
        $this->sendGet(self::URL . '/hi', $params);
    }
}

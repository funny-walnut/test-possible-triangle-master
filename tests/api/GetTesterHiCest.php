<?php

namespace Api;

use Codeception\Example;
use Codeception\Util\HttpCode;
use Step\Tester;
use Generator;

class GetTesterHiCest
{
    /**
     * @param Tester $I
     * @param Example $provider
     * @dataProvider dataProvider
     */
    public function canGetHi(Tester $I, Example $provider): void
    {
        $I->getHi();
        $I->seeResponseCodeIs($provider['expectedCode']);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson($provider['expectedMessage']);
    }

    protected function dataProvider(): Generator
    {
        yield [
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['message' => ['welcome' => 'Test me']],
        ];
    }

}


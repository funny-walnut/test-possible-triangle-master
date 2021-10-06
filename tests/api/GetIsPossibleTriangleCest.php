<?php

namespace Api;

use Codeception\Example;
use Codeception\Util\HttpCode;
use Generator;
use Step\Tester;

class GetIsPossibleTriangleCest
{
    /**
     * @param Tester $I
     * @param Example $provider
     * @dataProvider dataSource
     */

    public function isPossible(Tester $I, Example $provider): void
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGet('/triangle/possible', $provider['datum']);
        $I->seeResponseCodeIs($provider['expectedCode']);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson($provider['expectedMessage']);
    }


    protected function dataSource(): Generator
    {
        yield [
            'datum' => [
                'a' => '3',
                'b' => '2',
                'c' => '4'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['isPossible' => 'true'],
        ];

        yield [
            'datum' => [
                'a' => '2',
                'b' => '2',
                'c' => '4'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['isPossible' => 'false'],
        ];

        yield [
            'datum' => [
                'a' => '1',
                'b' => '2',
                'c' => '4'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['isPossible' => 'false'],
        ];

        yield [
            'datum' => [
                'a' => '0',
                'b' => '2',
                'c' => '4'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield [
            'datum' => [
                'a' => '2',
                'b' => '0',
                'c' => '4'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield [
            'datum' => [
                'a' => '2',
                'b' => '4',
                'c' => '0'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield [
            'datum' => [
                'a' => '2.2',
                'b' => '5',
                'c' => '4'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield [
            'datum' => [
                'a' => '5',
                'b' => '2.2',
                'c' => '4'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield [
            'datum' => [
                'a' => '5',
                'b' => '4',
                'c' => '2.2'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];
    }
}



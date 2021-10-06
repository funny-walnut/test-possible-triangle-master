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
        yield 'positive test' => [
            'datum' => [
                'a' => '3',
                'b' => '2',
                'c' => '4'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['isPossible' => 'true'],
        ];

        yield 'sum a & b equals c' => [
            'datum' => [
                'a' => '2',
                'b' => '2',
                'c' => '4'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['isPossible' => 'false'],
        ];

        yield 'sum b & c equals a' => [
            'datum' => [
                'a' => '4',
                'b' => '2',
                'c' => '2'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['isPossible' => 'false'],
        ];

        yield 'sum a & c equals b' => [
            'datum' => [
                'a' => '2',
                'b' => '4',
                'c' => '2'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['isPossible' => 'false'],
        ];

        yield 'sum a & b less c' => [
            'datum' => [
                'a' => '1',
                'b' => '2',
                'c' => '4'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['isPossible' => 'false'],
        ];

        yield 'sum a & c less b' => [
            'datum' => [
                'a' => '1',
                'b' => '4',
                'c' => '2'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['isPossible' => 'false'],
        ];

        yield 'sum b & c less a' => [
            'datum' => [
                'a' => '4',
                'b' => '2',
                'c' => '1'
            ],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['isPossible' => 'false'],
        ];

        yield 'a = 0, b > 0, c > 0' =>  [
            'datum' => [
                'a' => '0',
                'b' => '2',
                'c' => '4'
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield 'b = 0, a > 0, c > 0' => [
            'datum' => [
                'a' => '2',
                'b' => '0',
                'c' => '4'
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield 'c = 0, a > 0, b > 0' => [
            'datum' => [
                'a' => '2',
                'b' => '4',
                'c' => '0'
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield 'a - fractional number' => [
            'datum' => [
                'a' => '2.2',
                'b' => '5',
                'c' => '4'
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield 'b - fractional number' => [
            'datum' => [
                'a' => '5',
                'b' => '2.2',
                'c' => '4'
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield 'c - fractional number' => [
            'datum' => [
                'a' => '5',
                'b' => '4',
                'c' => '2.2'
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield 'a is negative number' => [
            'datum' => [
                'a' => '-2',
                'b' => '4',
                'c' => '3'
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield 'b is negative number' => [
            'datum' => [
                'a' => '2',
                'b' => '-4',
                'c' => '3'
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield 'c is negative number' => [
            'datum' => [
                'a' => '2',
                'b' => '4',
                'c' => '-3'
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield 'side a without value' => [
            'datum' => [
                'a' => '',
                'b' => '4',
                'c' => '3'
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];
        yield 'side b without value' => [
            'datum' => [
                'a' => '4',
                'b' => '',
                'c' => '3'
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield 'side c without value' => [
            'datum' => [
                'a' => '3',
                'b' => '4',
                'c' => ''
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield 'value a is string' => [
            'datum' => [
                'a' => 'p',
                'b' => '4',
                'c' => '5'
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield 'value b is string' =>  [
            'datum' => [
                'a' => '3',
                'b' => 'p',
                'c' => '5'
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];

        yield 'value c is string' =>  [
            'datum' => [
                'a' => '3',
                'b' => '4',
                'c' => 'p'
            ],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid data']],
        ];
    }
}



<?php

namespace App\Providers\Faker;

use Faker\Provider\Base;

class AppFakerProvider extends Base
{
    protected static $satker = [
        'demo',
        'demo',
        'demo',
        'satker 2',
        'satker 3',
    ];

    protected static $loket = [
        'loket 1',
        'loket 2',
        'loket 3',
    ];

    public function satker(): string
    {
        return static::randomElement(static::$satker);
    }

    public function loket(): string
    {
        return static::randomElement(static::$loket);
    }
}
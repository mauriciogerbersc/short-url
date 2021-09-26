<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\ShortUrl;

class ShortUrlTest extends TestCase
{
    /** @test */
    public function check_if_params_is_corret()
    {
        $shortUrl = new ShortUrl;

        $expected = [
            'code', 'link', 'date'
        ];

        $arrayCompared = array_diff($expected, $shortUrl->getFillable());

        $this->assertEquals(0, count($arrayCompared));

    }
}

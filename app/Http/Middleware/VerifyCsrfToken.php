<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */

    protected $except = [
        '/ipnpaypal', '/ipncoin', '/ipncoinpaybtc', '/ipnperfect',
        '/ipnskrill', '/ipnstripe', '/ipncoinpayeth', 'ipncoinpaybch',
        'ipncoinpaydash', 'ipncoinpaydoge', 'ipncoinpayltc', 'ipncoingate',
        '/ipnpaytm','/ipnpayeer','/ipnpaystack','/ipnvoguepay',

        'deposit-pay','user/deposit','user/withdraw-preview',

        'user/add-milestone',
        'user/get-chat',
        'admin/get-chat',
    ];
}

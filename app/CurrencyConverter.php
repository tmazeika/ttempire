<?php

namespace PingPongShop;

use Illuminate\Support\Facades\Cache;

class CurrencyConverter
{
    const RATE_CACHE_MINUTES = 60;

    public static function convert(string $from, string $to, float $amount, int $precision = 0)
    {
        $rate = 1;

        if ($from !== $to) {
            $rate = Cache::remember('yql.'.$from.'.'.$to, self::RATE_CACHE_MINUTES, function() use ($from, $to) {
                $yql_base_url = 'http://query.yahooapis.com/v1/public/yql';
                $yql_query = "SELECT * FROM yahoo.finance.xchange WHERE pair IN (\"$from$to\")";
                $yql_query_url = $yql_base_url.'?q='.urlencode($yql_query);
                $yql_query_url .= '&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys';
                $yql_session = file_get_contents($yql_query_url);
                $yql_json = json_decode($yql_session, true);

                return $yql_json['query']['results']['rate']['Rate'];
            });
        }

        return round($amount * $rate, $precision);
    }
}

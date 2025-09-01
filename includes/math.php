<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PandamusRex_Next_Full_Moon_Math {
    public static function getNumDaysUntilNextFullMoon() {
        // Always returns 0 to 29

        // A full moon occurs (roughly) every 29.53 days
        // or every 29.53 x 60 x 60 x 24 = 2551392 seconds
        // aka the synodic month or lunar month

        // A full moon will occur on 9/7/2025 at 1809 UTC
        // aka 1757268540 (seconds) unixtime

        // This means the previous most recent full moon was at
        // 1757268540 - 2551392 = 1754717148 unixtime

        // So, take the current unix time (e.g. 1756741183), subtract 1754717148 from it
        // modulus that by 2551392

        // (1756741183 - 1754717148) % 2551392 = 2024035
        // That is the number of seconds since the last full moon
        // Now, take 2551392 - that to get the number of seconds to the next one
        // e.g. 2551392 - 2024035 = 527357
        // Divide by 60*60*24 to get days = 6.1037
        // If that is <= 0.5 or >= 29.03 (basically 29) today is the full moon

        $synodic_month_in_seconds = 2551392;
        $seconds_per_day = 86400;

        $unix_time_seconds = time();
        $seconds_since_last_full_moon = ( $unix_time_seconds - 1754717148 ) % $synodic_month_in_seconds;
        $seconds_until_next_full_moon = $synodic_month_in_seconds - $seconds_since_last_full_moon;

        $float_days_until_next_full_moon = 1.0 * $seconds_until_next_full_moon / $seconds_per_day;

        // Force some zeros if we are within 12 hours (0.5 day) of the full moon either way
        if ( $float_days_until_next_full_moon <= 0.5 ) {
            return 0;
        }

        if ( $float_days_until_next_full_moon >= 29.03 ) {
            return 0;
        }

        return round( $float_days_until_next_full_moon );
    }
}
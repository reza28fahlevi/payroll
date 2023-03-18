<?php

    function countAttendance($from, $to, $workingDays = null) {
        if(!$workingDays) $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
        // $holidayDays = ['*-12-25', '*-01-01', '2013-12-23']; # variable and fixed holidays

        $from = new DateTime($from);
        $to = new DateTime($to);
        $to->modify('+1 day');
        $interval = new DateInterval('P1D');
        $periods = new DatePeriod($from, $interval, $to);

        $days = 0;
        $date = [];
        foreach ($periods as $period) {
            if (in_array($period->format('N'), $workingDays)){
                $date[] = $period->format('Y-m-d');
            } else {
                continue;
            }
            // if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
            // if (in_array($period->format('*-m-d'), $holidayDays)) continue;
            $days++;
        }
        $result = [
            "date" => $date,
            "days_total" => $days
        ];
        return $result;
    }
?>
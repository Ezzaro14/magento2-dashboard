<?php

declare(strict_types=1);

namespace Ezzar\Dashboard\Plugin\Backend\Model\Dashboard;

use Magento\Backend\Model\Dashboard\Period;

class PeriodPlugin
{
    public const PERIOD_YESTERDAY = 'yesterday';

    private const CHART_UNIT_HOUR = 'hour';

    /**
     * Add Yesterday immediately after Today in the dashboard period selector.
     *
     * @param Period $subject
     * @param array<string, mixed> $result
     * @return array<string, mixed>
     */
    public function afterGetDatePeriods(Period $subject, array $result): array
    {
        $periods = [];
        $yesterdayAdded = false;

        foreach ($result as $periodCode => $label) {
            $periods[$periodCode] = $label;

            if ($periodCode === Period::PERIOD_TODAY) {
                $periods[self::PERIOD_YESTERDAY] = __('Yesterday');
                $yesterdayAdded = true;
            }
        }

        if (!$yesterdayAdded) {
            $periods[self::PERIOD_YESTERDAY] = __('Yesterday');
        }

        return $periods;
    }

    /**
     * Tell Chart.js that Yesterday should be displayed in hourly units.
     *
     * @param Period $subject
     * @param array<string, string> $result
     * @return array<string, string>
     */
    public function afterGetPeriodChartUnits(Period $subject, array $result): array
    {
        $result[self::PERIOD_YESTERDAY] = self::CHART_UNIT_HOUR;

        return $result;
    }
}

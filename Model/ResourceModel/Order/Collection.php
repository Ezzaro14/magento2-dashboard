<?php

declare(strict_types=1);

namespace Ezzar\Dashboard\Model\ResourceModel\Order;

use DateTime;
use DateTimeZone;
use Ezzar\Dashboard\Plugin\Backend\Model\Dashboard\PeriodPlugin;
use Magento\Reports\Model\ResourceModel\Order\Collection as MagentoCollection;

class Collection extends MagentoCollection
{
    /**
     * Group Yesterday in the same hourly format used by Today and Last 24 Hours.
     *
     * @param string $range
     * @return \Zend_Db_Expr
     */
    protected function _getRangeExpression($range)
    {
        if ($range === PeriodPlugin::PERIOD_YESTERDAY) {
            $range = 'today';
        }

        return parent::_getRangeExpression($range);
    }

    /**
     * Return the complete previous calendar day in Magento's configured timezone.
     * The result is converted to UTC because sales_order.created_at is stored in UTC.
     *
     * @param string $range
     * @param string|null $customStart
     * @param string|null $customEnd
     * @param bool $returnObjects
     * @return array
     */
    public function getDateRange($range, $customStart, $customEnd, $returnObjects = false)
    {
        if ($range !== PeriodPlugin::PERIOD_YESTERDAY) {
            return parent::getDateRange($range, $customStart, $customEnd, $returnObjects);
        }

        $localTimezone = new DateTimeZone($this->_localeDate->getConfigTimezone());

        $dateStart = new DateTime('yesterday', $localTimezone);
        $dateStart->setTime(0, 0, 0);

        $dateEnd = clone $dateStart;
        $dateEnd->setTime(23, 59, 59);

        $utcTimezone = new DateTimeZone('UTC');
        $dateStart->setTimezone($utcTimezone);
        $dateEnd->setTimezone($utcTimezone);

        if ($returnObjects) {
            return [$dateStart, $dateEnd];
        }

        return [
            'from' => $dateStart,
            'to' => $dateEnd,
            'datetime' => true,
        ];
    }
}

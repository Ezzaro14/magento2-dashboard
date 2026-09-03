<?php

declare(strict_types=1);

namespace Ezzar\Dashboard\Plugin\Backend\Block\Widget;

use Magento\Backend\Block\Widget\Tabs;

class TabsPlugin
{
    private const DASHBOARD_CHART_TABS_BLOCK = 'dashboard.diagrams';
    private const AMOUNTS_TAB_ID = 'amounts';

    /**
     * Select the Amounts/Value chart whenever the Admin dashboard is loaded.
     */
    public function beforeGetActiveTabId(Tabs $subject): void
    {
        if ($subject->getNameInLayout() === self::DASHBOARD_CHART_TABS_BLOCK) {
            $subject->setActiveTab(self::AMOUNTS_TAB_ID);
        }
    }
}

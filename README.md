# Ezzar Dashboard

`Ezzar_Dashboard` adds a **Yesterday** period to Magento's Admin dashboard charts and selects the revenue/amounts chart by default.

## Requirements

- Magento Open Source or Adobe Commerce 2.4.x
- PHP 8.1–8.4

## Installation

```bash
composer config repositories.ezzaro14-magento2-dashboard vcs https://github.com/Ezzaro14/magento2-dashboard.git
composer require ezzaro14/magento2-dashboard:dev-main
bin/magento module:enable Ezzar_Dashboard
bin/magento setup:di:compile
bin/magento cache:clean
```

The Yesterday range uses the Magento-configured timezone and converts its boundaries to UTC for order reporting.

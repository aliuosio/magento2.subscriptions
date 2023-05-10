<?php

declare(strict_types=1);

namespace Osio\Subscriptions\Helper;

use DateTime;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    const TITLE = 'system/subscribable/title';
    const CODE = 'system/subscribable/code';
    const FIELDSET = 'system/subscribable/fieldset';
    const PERIODS = 'system/subscribable/periods';
    const ENABLED = 'system/subscribable/enabled';
    const DELIMITER = ',';

    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function isEnabled(): bool
    {
        return (bool)$this->scopeConfig->getValue(Data::ENABLED);
    }

    public function getTitle(): mixed
    {
        return $this->scopeConfig->getValue(Data::TITLE);
    }

    public function getCode(): mixed
    {
        return $this->scopeConfig->getValue(Data::CODE);
    }

    public function getFieldset(): mixed
    {
        return $this->scopeConfig->getValue(Data::FIELDSET);
    }

    public function getPeriod(): array
    {
        return explode(Data::DELIMITER, (string)$this->scopeConfig->getValue(Data::PERIODS));
    }

    public function getNextDate(int $period): DateTime
    {
        return new DateTime("+$period week");
    }

    public function getNextDateTime(int $period): string
    {
        return $this->getNextDate($period)
            ->format('Y-m-d H:i:s');
    }
}

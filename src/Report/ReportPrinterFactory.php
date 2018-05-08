<?php

declare(strict_types=1);

namespace App\Report;

use App\Report\Printer\EmailReportPrinter;
use App\Report\Printer\ReportPrinterInterface;

class ReportPrinterFactory
{
    public const TYPE_EMAIL = 'email';

    public function create(string $type): ReportPrinterInterface
    {
        switch ($type) {
            case self::TYPE_EMAIL:
            default:
                return new EmailReportPrinter();
        }
    }
}

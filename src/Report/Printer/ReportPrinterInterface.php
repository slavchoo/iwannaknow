<?php

declare(strict_types=1);

namespace App\Report\Printer;

interface ReportPrinterInterface
{
    public function print(): string;
}

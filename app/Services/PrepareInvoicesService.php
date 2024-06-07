<?php

namespace App\Services;

class PrepareInvoicesService
{
    public function handle($records)
    {
        $invoices = [];
        foreach ($records as $record){
            $invoices[] = json_decode($record->data, true);
        }
        return $invoices;
    }

}

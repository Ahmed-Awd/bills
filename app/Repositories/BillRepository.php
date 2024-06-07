<?php

namespace App\Repositories;

use App\Models\Bill;

class BillRepository extends BaseRepository
{
    public function __construct(Bill $bill, $searchColumns = [], $selects = [])
    {
        $searchColumns = ["id"];
        parent::__construct($bill, $searchColumns, $selects);
    }
}

<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Str;

class BaseRepository
{
    protected $model;
    protected array $searchColumns;
    protected array $selects;

    public function __construct($model, $searchColumns = [], $selects = [])
    {
        $this->model = $model;
        $this->searchColumns = $searchColumns;
        $this->selects = $selects;
    }

    public function get(
        $filters = [],
        $search = false,
        $with = false,
        $selects = false,
        $range = false,
        $rangeBy = "created_at",
        $orderBy = "id",
        $order = "desc",
        $withPagination = true,
        $count = 15,
        $whereIn = false,
        $whereInCol = false,
    ) {
        $filters = $this->prepareFilters($filters);
        $query = $this->model->where($filters);
        $whereIn == false ? $query : $query->whereIn($whereInCol, $whereIn);
        $query = $this->doSelect($query, $selects);
        $search == false ? $query : $query = $this->search($query, $search);
        $range == false ? $query : $query = $this->dateFilter($query, $range, $rangeBy);
        $with == false ? $query : $query = $query->with($with);
        $query->orderBy($orderBy, $order);
        $withPagination == true ? $query = $query->paginate($count) : $query = $query->get();
        return $query;
    }

    public function show($by, $selects = false, $with = false, $column = "slug")
    {
        $query = $this->model->where($column, $by);
        $query = $this->doSelect($query, $selects);
        $with == false ? $query : $query = $query->with($with);
        return $query->first();
    }

    public function maximum($condition,$col)
    {
        return $this->model->where($condition)->max($col);
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function insert($data)
    {
        return $this->model->insert($data);
    }



    public function update($by, $data, $column = "slug")
    {
        return $this->model->where($column, $by)->update($data);
    }

    public function multiUpdate($conditions,$data)
    {
        return $this->model->where($conditions)->update($data);
    }

    public function updateOrCreate($condition,$data)
    {
        return $this->model->updateOrCreate($condition,$data);
    }

    public function delete($by, $column = "slug")
    {
        $this->model->where($column, $by)->delete();
    }


    public function changeStatus($record): bool
    {
        $status = !$record->is_active;
        $record->update(["is_active" => $status]);
        return $status;
    }

    public function count($filters = [])
    {
        $filters = $this->prepareFilters($filters);
        $query = $this->model->where($filters);
        return $query->count();
    }

    public function prepareFilters($filters): array
    {
        return array_diff($filters, ["*"]);
    }

    public function doSelect($query, $selects)
    {
        if ($selects == false || $selects == []) {
            $this->selects == [] ? $query: $query = $query->select($this->selects);
            return $query;
        }
        return $query->select($selects);
    }

    public function increment($condition,$col,$amount)
    {
        $this->model->where($condition)->increment($col,$amount);
    }

    public function decrement($condition,$col,$amount)
    {
        $this->model->where($condition)->decrement($col,$amount);
    }

    public function search($current, $value)
    {
        $cols = $this->searchColumns;
        return $current->where(function ($query) use ($cols, $value) {
            $query = $query->where($cols[0], 'LIKE', '%' . $value . '%');
            $first = true;
            foreach ($cols as $column) {
                if ($first) {
                    $first = false;
                    continue;
                }
                $query = $query->orWhere($column, 'LIKE', '%' . $value . '%');
            }
        });
    }


    public function dateFilter($records, $range, $by)
    {
        $weekStart = Carbon::now()->startOfWeek(Carbon::SATURDAY);
        $weekEnd = Carbon::now()->endOfWeek(Carbon::FRIDAY);
        $now = Carbon::now();
        if ($range == "today") {
            $records = $records->whereDate($by, Carbon::today());
        }
        if ($range == "yesterday") {
            $records = $records->whereDate($by, Carbon::yesterday());
        }
        if ($range == "this-week") {
            $records = $records->whereBetween($by, [$weekStart, $weekEnd]);
        }
        if ($range == "prev-week") {
            $records = $records->whereBetween($by, [$weekStart->subWeek(), $weekEnd->subWeek()]);
        }
        if ($range == "this-month") {
            $records = $records->whereMonth($by, $now->month)->whereYear($by, $now->year);
        }
        if ($range == "prev-month") {
            $records = $records->whereMonth($by, $now->subMonth()->month)->whereYear($by, $now->year);
        }
        if (Str::contains($range, ',')) {
            $dates = explode(",", $range);
            $records = $records
                ->whereBetween($by, [Carbon::parse($dates[0]), Carbon::parse($dates[1])->addDay()]);
        }

        return $records;
    }

}

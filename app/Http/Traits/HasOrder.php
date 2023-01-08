<?php

namespace App\Http\Traits;

trait HasOrder {
    public function newQuery($ordered = true)
    {
        $query = parent::newQuery();

        if (empty($ordered)) {
            return $query;
        }

        return $query->orderBy($this->orderBy ?? 'created_at', $this->orderDirection ?? 'asc');
    }
}

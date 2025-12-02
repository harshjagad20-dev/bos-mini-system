<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class ProjectBuilder extends Builder
{
    public function paginateData($limit)
    {
        $this->latest();

        if ($limit == 'all') {
            return $this->get();
        }

        return $this->paginate($limit);
    }

    public function whereTitle($title)
    {
        return $this->where(function ($query) use ($title) {
            $query->where('title', 'LIKE', '%' . $title . '%');
        });
    }

    public function applyFilters(array $filters)
    {
        $filters = collect($filters);

        if ($filters->has('title')) {
            $this->whereTitle($filters->get('title'));
        }

        return $this;
    }
}
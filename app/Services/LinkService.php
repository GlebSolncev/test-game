<?php

namespace App\Services;

use App\Models\Link;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 *
 */
class LinkService
{

    /**
     * @param Link $model
     */
    public function __construct(
        protected Link $model
    )
    {
    }

    /**
     * @return array
     */
    public function getDataForCreate()
    {
        return [
            'slug'        => Str::random(10),
            'verified_at' => Carbon::now()->addDays(7),
        ];
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getBySlug(string $slug){
        return $this->model->where([['slug', '=', $slug]])->first();
    }
}
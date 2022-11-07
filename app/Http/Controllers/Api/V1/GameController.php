<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\GameService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class GameController extends Controller
{
    /**
     * @param GameService $service
     */
    public function __construct(
        protected GameService $service
    )
    {
    }

    /**
     * @param string $slug
     * @return Collection
     */
    public function history(string $slug)
    {
        return $this->service->getHistoryByLinkSlug($slug);
    }

    /**
     * @param string $slug
     * @return Model
     */
    public function play(string $slug)
    {
        return $this->service->playGameByLInk($slug);
    }
}
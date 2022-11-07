<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class UserService
{
    /**
     * @param User        $model
     * @param LinkService $linkService
     * @param GameService $gameService
     */
    public function __construct(
        protected User        $model,
        protected LinkService $linkService,
        protected GameService $gameService,
    )
    {
    }

    /**
     * @param string $slug
     * @return void
     */
    public function createNewLink(string $slug): void
    {
        $link = $this->linkService->getBySlug($slug);
        $this->createUserLink($link->user);
    }

    /**
     * @param array $data
     * @return string
     */
    public function create(array $data): string
    {
        $model = $this->model->where($data)->first();
        if (!$model) $model = $this->model->create($data);

        $userLink = $this->createUserLink($model);
        return $userLink->slug;
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getLinkBySlug(string $slug): Model
    {
        return $this->linkService->getBySlug($slug);
    }

    /**
     * @param string $slug
     * @return Collection
     */
    public function getUserLinksByLink(string $slug): Collection
    {
        $links = $this->getLinkBySlug($slug);
        return $links->user->links()->where([
            ['slug', '<>', $slug],
            ['verified_at', '>', now()],
        ])->get();
    }

    /**
     * @param Model $user
     * @return mixed
     */
    protected function createUserLink(Model $user): Model
    {
        $linkData = $this->linkService->getDataForCreate();

        return $user->links()->create(
            $linkData
        );
    }

}
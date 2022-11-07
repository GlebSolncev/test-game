<?php

namespace App\Services;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class GameService
{
    /**
     * if you lose i can help u and retry chanse
     *
     * @var int
     */
    protected $retryOfLuck = 1;

    /**
     * Even or Odd number 0 or 1
     *
     * @var int
     */
    protected $numForWin = 0;

    /**
     * @param LinkService $linkService
     */
    public function __construct(
        protected LinkService $linkService
    )
    {
    }

    /**
     * @param string $slug
     * @return Model
     * @throws Exception
     */
    public function playGameByLInk(string $slug): Model
    {
        $link = $this->linkService->getBySlug($slug);
        $data = $this->play();
        $game = $link->games()->create($data);
        $game->balance = $link->games->sum('bonus');

        return $game->setVisible(['type', 'bonus', 'number', 'balance']);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function play(): array
    {
        $number = $this->generateNum();

        return [
            'number' => $number,
            'type'   => $this->getTypeByNumber($number),
            'bonus' => $this->getBonusByNumber($number),
        ];
    }

    /**
     * @param string $slug
     * @return Collection
     */
    public function getHistoryByLinkSlug(string $slug): Collection
    {
        $link = $this->linkService->getBySlug($slug);

        return $link->games()->select(['id', 'type', 'number', 'bonus'])->orderByDesc('created_at')->limit(3)->get();
    }

    /**
     * @param int $number
     * @return int
     * @throws Exception
     */
    protected function getBonusByNumber(int $number): int
    {
        if(!$this->getTypeByNumber($number)){
            return 0;
        }

        switch (true){
            case $number > 900:
                $percent = 70;
                break;
            case $number > 600:
                $percent = 50;
                break;
            case $number > 300:
                $percent = 30;
                break;
            case $number < 300:
                $percent = 10;
                break;
            default:
                $percent = 0;
        }

        return $number*$percent;
    }

    /**
     * @param int $number
     * @return bool
     * @throws Exception
     */
    public function getTypeByNumber(int $number): bool
    {
        if ($this->numForWin > 1) throw new Exception('Please set property $numForWin (0 or 1)');

        return $number % 2 === $this->numForWin;
    }

    /**
     * @return int
     * @throws Exception
     */
    public function generateNum(): int
    {
        $number = 0;

        for ($i = 0; $i <= $this->retryOfLuck; $i++) {
            $number = random_int(0, 1000);
            if ($this->getTypeByNumber($number)) {
                break;
            }
        }

        return $number;
    }
}
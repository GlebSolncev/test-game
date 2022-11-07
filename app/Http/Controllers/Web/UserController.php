<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 *
 */
class UserController extends Controller
{
    /**
     * @param UserService $service
     */
    public function __construct(
        protected UserService $service)
    {
    }

    public function newLink(string $slug)
    {
        $this->service->createNewLink($slug);
        return redirect()->back();
    }

    public function deleteLink(string $slug)
    {
        $link = $this->service->getLinkBySlug($slug);
        $link->verified_at = now();
        $link->save();

        return redirect()->back();
    }

    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        $slug = $this->service->create($request->only(['username', 'phone']));

        return redirect()->route('profile.detail', $slug);
    }

    /**
     * @param string $slug
     * @return View
     */
    public function profile(string $slug)
    {
        $link = $this->service->getLinkBySlug($slug);
        $links = $this->service->getUserLinksByLink($slug);

        return view('profile', [
            'slug'  => $slug,
            'link'  => $link,
            'links' => $links,
        ]);
    }

}
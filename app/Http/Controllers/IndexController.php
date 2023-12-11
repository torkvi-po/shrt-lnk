<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateLinkRequest;
use App\Http\Requests\StoreLinkRequest;
use App\Models\Link;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class IndexController extends Controller
{
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('index',['urls'=>$this->getLastLinks()]);
    }

    public function getUrl($url): RedirectResponse
    {
        $link = Link::query()->where('id26',$url)->firstOrFail();
        return redirect()->away($link->url);
    }

    public function make(StoreLinkRequest $request): string
    {
        $request = $request->validated();
        Link::query()->create(['url'=>$request['url']]);

        return $this->returnResult();
    }

    public function generate(GenerateLinkRequest $request): string
    {
        $request = $request->validated();

        //Запускаем фабрику по генерации случайных данных и заполнению БД
        Link::factory()
            ->count($request['number'])
            ->create();

        return $this->returnResult();
    }

    private function getLastLinks(int $number = 10): Collection|array
    {
        return Link::query()->latest('id')->limit($number)->get();
    }

    private function returnResult(): string
    {
        return $this->responseView();
    }

    private function responseJSON(): JsonResponse
    {
        return response()->json(['urls'=>$this->getLastLinks()]);
    }

    private function responseView(): string
    {
        return view('results',['urls'=>$this->getLastLinks()])->render();
    }

}

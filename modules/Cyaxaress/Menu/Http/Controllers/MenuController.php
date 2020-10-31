<?php

namespace Cyaxaress\Menu\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Media\Services\MediaFileService;
use Cyaxaress\Menu\Http\Requests\MenuRequest;
use Cyaxaress\Menu\Http\Requests\MenuStatusRequest;
use Cyaxaress\Menu\Models\Menu;
use Cyaxaress\Menu\Repositories\MenuRepo;
use Cyaxaress\Common\Responses\AjaxResponses;

class MenuController extends Controller
{
    public $repo;

    public function __construct(MenuRepo $menuRepo)
    {
        $this->repo = $menuRepo;
    }

    public function index()
    {
        $this->authorize('show', Menu::class);
        $menus = $this->repo->all();
        return view('Menus::index', compact('menus'));
    }


    public function create()
    {
        $this->authorize('create', Menu::class);
        return view('Menus::create');
    }


    public function store(MenuRequest $request)
    {
        $this->authorize('create', Menu::class);
        $request->request->add(['banner_id' => MediaFileService::publicUpload($request->file('banner_id'))->id]);
        $this->repo->store($request);
        return back();
    }

    public function edit($menuId)
    {
        $this->authorize('update', Menu::class);
        $menu = $this->repo->findById($menuId);
        return view('Menus::edit', compact('menu'));
    }

    public function update($menuId, MenuRequest $request)
    {
        $this->authorize('update', Menu::class);
        $menu = $this->repo->findByid($menuId);


        $this->repo->update($menuId, $request);
        return back();
    }

    public function changeStatus($menuId, MenuStatusRequest $request)
    {
        $this->authorize('changeStatus', Menu::class);
        $this->repo->changeStatus($menuId, $request);
        return back();
    }


    public function destroy($menuId)
    {
        $this->authorize('delete', Menu::class);
        $this->repo->destroy($menuId);
        return AjaxResponses::SuccessResponse();
    }

    public function updatePosition()
    {
        $this->authorize('updatePosition', Menu::class);

    }

}

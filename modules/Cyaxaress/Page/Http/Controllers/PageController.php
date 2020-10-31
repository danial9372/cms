<?php

namespace Cyaxaress\Page\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Media\Services\MediaFileService;
use Cyaxaress\Page\Http\Requests\PageRequest;
use Cyaxaress\Page\Http\Requests\PageStatusRequest;
use Cyaxaress\Common\Responses\AjaxResponses;
use Cyaxaress\Page\Models\Page;
use Cyaxaress\Page\Repositories\PageRepo;

class PageController extends Controller
{
    public $repo;

    public function __construct(PageRepo $pageRepo)
    {
        $this->repo = $pageRepo;
    }

    public function index()
    {
        $this->authorize('show', Page::class);
        $pages = $this->repo->all();
        return view('Pages::index', compact('pages'));
    }


    public function create()
    {
        $this->authorize('create', Page::class);
        return view('Pages::create');
    }


    public function store(PageRequest $request)
    {
        $this->authorize('create', Page::class);
        $request->request->add(['banner_id' => MediaFileService::publicUpload($request->file('banner_id'))->id]);
        $this->repo->store($request);
        return back();
    }

    public function edit($pageId)
    {
        $this->authorize('update', Page::class);
        $page = $this->repo->findById($pageId);
        return view('Pages::edit', compact('page'));
    }

    public function update($pageId, PageRequest $request)
    {
        $this->authorize('update', Page::class);
        $page = $this->repo->findByid($pageId);

        if ($request->hasFile('banner_id')) {
            $request->request->add(['banner_id' => MediaFileService::publicUpload($request->file('banner_id'))->id]);
            if ($page->banner)
                $page->banner->delete();
        } else {
            $request->request->add(['banner_id' => $page->banner_id]);
        }

        $this->repo->update($pageId, $request);
        return back();
    }

    public function changeStatus($pageId, PageStatusRequest $request)
    {
        $this->authorize('changeStatus', Page::class);
        $this->repo->changeStatus($pageId, $request);
        return back();
    }


    public function destroy($pageId)
    {
        $this->authorize('delete', Page::class);
        $this->repo->destroy($pageId);
        return AjaxResponses::SuccessResponse();
    }


}

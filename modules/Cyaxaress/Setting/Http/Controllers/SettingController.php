<?php

namespace Cyaxaress\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Media\Services\MediaFileService;
use Cyaxaress\Setting\Http\Requests\SettingRequest;
use Cyaxaress\Setting\Http\Requests\SettingStatusRequest;
use Cyaxaress\Setting\Models\Setting;
use Cyaxaress\Setting\Repositories\SettingRepo;
use Cyaxaress\Common\Responses\AjaxResponses;

class SettingController extends Controller
{
    public $repo;

    public function __construct(SettingRepo $settingRepo)
    {
        $this->repo = $settingRepo;
    }

    public function index()
    {
        $this->authorize('show', Setting::class);
        $settings = $this->repo->all();
        return view('Settings::index', compact('settings'));
    }


    public function create()
    {
        $this->authorize('create', Setting::class);
        return view('Settings::create');
    }


    public function store(SettingRequest $request)
    {
        $this->authorize('create', Setting::class);
        $request->request->add(['banner_id' => MediaFileService::publicUpload($request->file('banner_id'))->id]);
        $this->repo->store($request);
        return back();
    }

    public function edit($settingId)
    {
        $this->authorize('update', Setting::class);
        $setting = $this->repo->findById($settingId);
        return view('Settings::edit', compact('setting'));
    }

    public function update($settingId, SettingRequest $request)
    {
        $this->authorize('update', Setting::class);
        $setting = $this->repo->findByid($settingId);

        if ($request->hasFile('banner_id')) {
            $request->request->add(['banner_id' => MediaFileService::publicUpload($request->file('banner_id'))->id]);
            if ($setting->banner)
                $setting->banner->delete();
        } else {
            $request->request->add(['banner_id' => $setting->banner_id]);
        }

        $this->repo->update($settingId, $request);
        return back();
    }

    public function changeStatus($settingId, SettingStatusRequest $request)
    {
        $this->authorize('changeStatus', Setting::class);
        $this->repo->changeStatus($settingId, $request);
        return back();
    }


    public function destroy($settingId)
    {
        $this->authorize('delete', Setting::class);
        $this->repo->destroy($settingId);
        return AjaxResponses::SuccessResponse();
    }


}

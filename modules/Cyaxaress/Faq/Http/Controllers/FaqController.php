<?php

namespace Cyaxaress\Faq\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Category\Repositories\CategoryRepo;
use Cyaxaress\Common\Responses\AjaxResponses;
use Cyaxaress\Faq\Http\Requests\FaqRequest;
use Cyaxaress\Faq\Http\Requests\FaqStatusRequest;
use Cyaxaress\Faq\Models\Faq;
use Cyaxaress\Faq\Repositories\FaqRepo;

class FaqController extends Controller
{
    public $repo;

    public function __construct(FaqRepo $faqRepo)
    {
        $this->repo = $faqRepo;
    }

    public function index()
    {
        $this->authorize('show', Faq::class);
        $faqs = $this->repo->all();
        return view('Faqs::index', compact('faqs'));
    }


    public function create(CategoryRepo $categoryRepo)
    {
        $this->authorize('create', Faq::class);
        $faqCategories = $categoryRepo->all();

        return view('Faqs::create', compact('faqCategories'));
    }


    public function store(FaqRequest $request ,CategoryRepo $categoryRepo)
    {
        $this->authorize('create', Faq::class);
        $faq =$this->repo->store($request);
        $categoryRepo->attachCategories($faq ,$request->categories);
        return back();
    }

    public function edit($faqId ,CategoryRepo $categoryRepo)
    {
        $this->authorize('update', Faq::class);
        $faq = $this->repo->findById($faqId);
        $faqCategories = $categoryRepo->all();
        return view('Faqs::edit', compact('faq' ,'faqCategories'));
    }

    public function update($faqId, FaqRequest $request)
    {
        $this->authorize('update', Faq::class);
        $this->repo->update($faqId, $request);
        return back();
    }

    public function changeStatus($faqId, FaqStatusRequest $request)
    {
        $this->authorize('changeStatus', Faq::class);
        $this->repo->changeStatus($faqId, $request);
        return back();
    }


    public function destroy($faqId)
    {
        $this->authorize('delete', Faq::class);
        $this->repo->destroy($faqId);
        return AjaxResponses::SuccessResponse();
    }


}

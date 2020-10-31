<?php

namespace Cyaxaress\Faq\Repositories;

use Cyaxaress\Faq\Models\Faq;
use Illuminate\Http\Request;

class FaqRepo
{
    public function all()
    {
        return Faq::all();
    }

    public function paginate()
    {
        return Faq::paginate();
    }



    public function findById($id)
    {
        return Faq::findOrFail($id);
    }

    public function store($values)
    {
        return Faq::create([
            'question' => $values->question,
            'answer' => $values->answer,
            'status' => $values->status,

        ]);
    }

    public function update($id, $values)
    {
        return $this->findById($id)->update([
             'question' => $values->question,
            'answer' => $values->answer,
            'status' => $values->status,
        ]);
    }

    public function destroy($id)
    {
        return $this->findById($id)->delete();
    }

    public function changeStatus($id, Request $request)
    {
        return $this->findById($id)->update(['status' => $request->status]);
    }
}

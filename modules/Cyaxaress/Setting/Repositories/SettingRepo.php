<?php

namespace Cyaxaress\Setting\Repositories;

use Cyaxaress\Setting\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingRepo
{
    public function all()
    {
        return Setting::all();
    }


    public function paginate()
    {
        return Setting::paginate();
    }


    public function findById($id)
    {
        return Setting::findOrFail($id);
    }

    public function store($values)
    {
        return Setting::create([
            'label' => $values->label,
            'key' => $values->key,
            'value' => $values->value,
            'extra' => $values->extra,
            'group' => $values->group,
            'type' => $values->type,
            'access' => $values->access,
        ]);
    }

    public function update($id, $values)
    {
        return $this->findById($id)->update([
            'value' => $values->value,
            'extra' => $values->extra,
        ]);
    }

    public function destroy($id)
    {
        return $this->findById($id)->delete();
    }


}

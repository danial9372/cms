<?php

namespace Cyaxaress\Menu\Repositories;

use Cyaxaress\Menu\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuRepo
{


    public function paginate()
    {
        return Menu::paginate();
    }


    public function findById($id)
    {
        return Menu::findOrFail($id);
    }


    public function getParentsMenu()
    {
        return Menu::whereNull('parent_id')->get();
    }


    public function getParentsMenuWithSubMenu()
    {
        return Menu::with('subMenus')->get();
    }


    public function store($values)
    {
        return Menu::create([
            'title' => $values->title,
            'slug' => Str::slug($values->slug),
            'status' => $values->status,
            'position' => $values->status,
            'target' => $values->status,
        ]);
    }

    public function update($id, $values)
    {
        return $this->findById($id)->update([
            'title' => $values->title,
            'slug' => Str::slug($values->slug),
            'status' => $values->status,
            'target' => $values->status,
        ]);
    }

    public function destroy($id)
    {
        $menu = $this->findById($id);
        Menu::where("parent_id", $id)->update(['parent_id' => NULL]);
        return $menu->delete();
    }

    public function changeStatus($id, Request $request)
    {
        return $this->findById($id)->update(['status' => $request->status]);
    }


    public function updatePosition(Request $request)
    {
        $count = 0;
        foreach ($request->menus as $id => $parentId) {
            Menu::whereId($id)->wherePosition($request->position)->update(['parent_id' => is_null($parentId) ? null : (int)$parentId, 'priority' => $count]);
            $count++;
        }
    }
}

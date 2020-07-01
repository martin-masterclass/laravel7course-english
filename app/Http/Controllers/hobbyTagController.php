<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class hobbyTagController extends Controller
{
    public function getFilteredHobbies($tag_id) {

        $tag = new Tag();
        $hobbies = $tag::findOrFail($tag_id)->filteredHobbies()->paginate(10);

        $filter = $tag::find($tag_id);


        return view('hobby.index', [
            'hobbies' => $hobbies,
            'filter' => $filter
        ]);

    }
}

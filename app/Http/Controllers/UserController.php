<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show')->with([
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit')->with([
            'user' => $user,
            'message_success' => Session::get('message_success'),
            'message_warning' => Session::get('message_warning')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'motto' => 'required|min:3',
            'image' => 'mimes:jpeg,jpg,bmp,png,gif'
        ]);

        if ($request->image) {
            $this->saveImages($request->image, $user->id);
        }

        $user->update([
            'motto' => $request['motto'],
            'about_me' => $request['about_me'],
        ]);

        return redirect('/home')->with(
            [
                'message_success' => "Your user profile was updated."
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function saveImages($imageInput, $user_id){

        $image = Image::make($imageInput);
        if ( $image->width() > $image->height() ) { // Landscape
            $image->widen(500)
                ->save(public_path() . "/img/users/" . $user_id . "_large.jpg")
                ->widen(300)->pixelate(12)
                ->save(public_path() . "/img/users/" . $user_id . "_pixelated.jpg");
            $image = Image::make($imageInput);
            $image->widen(60)
                ->save(public_path() . "/img/users/" . $user_id. "_thumb.jpg");
        } else { // Portrait
            $image->heighten(500)
                ->save(public_path() . "/img/users/" . $user_id . "_large.jpg")
                ->heighten(300)->pixelate(12)
                ->save(public_path() . "/img/users/" . $user_id . "_pixelated.jpg");
            $image = Image::make($imageInput);
            $image->heighten(60)
                ->save(public_path() . "/img/users/" . $user_id . "_thumb.jpg");
        }

    }

    public function deleteImages($user_id){
        if(file_exists(public_path() . "/img/users/" . $user_id . "_large.jpg"))
            unlink(public_path() . "/img/users/" . $user_id . "_large.jpg");
        if(file_exists(public_path() . "/img/users/" . $user_id . "_thumb.jpg"))
            unlink(public_path() . "/img/users/" . $user_id . "_thumb.jpg");
        if(file_exists(public_path() . "/img/users/" . $user_id . "_pixelated.jpg"))
            unlink(public_path() . "/img/users/" . $user_id . "_pixelated.jpg");

        return back()->with(
            [
                'message_success' => "The Image was deleted."
            ]
        );
    }

}

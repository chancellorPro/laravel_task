<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\TaskRepository;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(Request $request)
    {
        return view('user.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
        ]);

        $phone = (int)str_replace(['+','(',')',' ', '-'], [''], $request->phone);

        $request->user()->update([
            'name' => $request->name,
            'phone' => $phone,
        ]);

        return redirect('/profile');
    }
}

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
            'name'  => 'required|max:255',
            'phone' => 'required|max:255',
        ]);

        $phone = (int)str_replace(['+', '(', ')', ' ', '-'], [''], $request->phone);

        $request->user()->update([
            'name'  => $request->name,
            'phone' => $phone,
        ]);

        return redirect('/profile');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_avatar(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]); // валидация входящих параметров

        $user = $request->user(); // получаю объект пользователя из запроса
        if (file_exists(public_path() . '/avatars/' . $user->avatar)) { // проверяю существует ли файл аватара на диске
            unlink(public_path() . '/avatars/' . $user->avatar); // удаляю файл
        }

        // формирую имя для файла аватара
        $avatarName = $request->user()->id . '_avatar' . time() . '.' . request()->avatar->getClientOriginalExtension();

        $file = $request->file('avatar'); // получаю файл из запроса
        $file->move('avatars', $avatarName); // записываю файл на диск

        $user->avatar = $avatarName; // записываю имя файла в объект пользователя
        $user->save(); // сохраняю данные пользователя в базу

        return back()
            ->with('success', 'You have successfully upload image.'); // возвращаю прошлую страницу с сообщением об
        // успешном выполнении

    }
}

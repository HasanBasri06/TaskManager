<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct(
        private User $user,
        private Task $task
    ) {
        $this->user = $user;
        $this->task = $task;
    }
    public function login() {
        if (auth()->check()) {
            return redirect()->route('task.landing');
        }
        return view('login');
    }
    public function loginStore(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required|min:4',
        ], [
            'email.required' => 'Email alanı boş alan bırakmayın',
            'password.required' => 'Şifre alanı boş alan bırakmayın',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = $this->user->where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with(['error' => 'Bu bilgilere ait kullanıcı bulunamadı.'])->withInput();
        }

        if (!Auth::attempt($request->only('email', 'password'), false)) {
            return redirect()->back()->with(['error' => 'Bu bilgilere ait kullanıcı bulunamadı.'])->withInput();
        }

        return redirect()->route('task.landing');
    }
    public function register() {
        if (auth()->check()) {
            return redirect()->route('task.landing');
        }
        return view('register');
    }
    public function registerStore(Request $request) {
        $validator = Validator::make($request->all(), [
            'image' => 'file|required',
            'email' => 'email|required',
            'name' => 'required|max:55',
            'password' => 'required|min:4',
            'passwordConfirm' => 'required|same:password'
        ], [
            'image.required' => 'Resim alanı boş alan bırakmayın',
            'email.required' => 'Email alanı boş alan bırakmayın',
            'name.required' => 'İsim alanı boş alan bırakmayın',
            'password.required' => 'Şifre alanı boş alan bırakmayın',
            'passwordConfirm.required' => 'Şifre onay alanı boş alan bırakmayın',
            'name.max' => 'İsim değeri en fazla 55 değer girilmelidir.',
            'passwordConfirm.same' => 'Şifreler uyuşmuyor.',
            'password.min' => 'Şifreler minimum 4 karakterli olmalıdır.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('uploads', $imageName, 'public');
        
        $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $imageName
        ]);

        return back()->with('success', 'Başarılı bir şekilde kayıt oldunuz');
    }
    public function logout() {
        Auth::logout();
        return redirect()->route('login.landing');
    }
}

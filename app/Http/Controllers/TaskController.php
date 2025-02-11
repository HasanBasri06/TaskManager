<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Enums\TaskProgressEnum;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function __construct(
        private User $user,
        private Task $task
    ) {
        $this->user = $user;
        $this->task = $task;
    }
    public function allTasks() {
        $tasks = $this
            ->task
            ->where('status', StatusEnum::ACTIVE->value)
            ->orderBy('created_at', 'desc')
            ->where('user_id', Auth::id())
            ->get();
        return view('tasks', compact('tasks'));
    }
    public function taskCreate() {
        return view('task-create');
    }
    public function taskCreateStore(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:155',
            'description' => 'required|min:10|max:255'
        ], messages: [
            'title.required' => 'Başlık alanı zorunludur.',
            'title.min' => 'Başlık en az :min karakter olmalıdır.',
            'title.max' => 'Başlık en fazla :max karakter olmalıdır.',
            'description.required' => 'Açıklama alanı zorunludur.',
            'description.min' => 'Açıklama en az :min karakter olmalıdır.',
            'description.max' => 'Açıklama en fazla :max karakter olmalıdır.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->task->create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'status' => StatusEnum::ACTIVE->value,
            'progress' => TaskProgressEnum::TODO->value
        ]);

        return back()->with('success', 'Başarılı bir şekilde görev oluşturuldu.');
    }
    public function taskDelete($id) {
        $this
            ->task
            ->where('id', $id)
            ->update([
                'status' => StatusEnum::INACTIVE->value
            ]);

        return redirect()->back()->with('success', $id . '\'li değer başarılı bir şekilde silindi');
    }
    public function taskEdit($id) {
        $task = $this
            ->task
            ->where('id', $id)
            ->first();

        return view('edit', compact('task'));
    }
    public function taskEditStore(Request $request) {
        $taskId = $request->taskId;
        $this
            ->task
            ->where('id', $taskId)
            ->update([
                'title' => $request->title,
                'description' => $request->description
            ]);
        
        return redirect()->back()->with('success', $taskId . '\'li değer başarılı bir şekilde güncellendi');
    }
    public function taskComplate($id) {
        $this
            ->task
            ->where('id', $id)
            ->update([
                'progress' => TaskProgressEnum::COMPLATE->value
            ]);

        return redirect()->back()->with('success', $id . '\'li değer başarılı bir şekilde tamamlandı');
    }
}

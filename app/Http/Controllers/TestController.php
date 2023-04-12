<?php

namespace App\Http\Controllers;

use Algorithm\C45;
use Algorithm\C45\DataInput;
use App\Models\Course;
use App\Models\Expert;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TestController extends Controller
{
    public function index(): View
    {
        return view('test.index', [
            'users' => User::query()->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'training' => 'required|array|min:5',
            'training.*' => ['required', 'integer', 'distinct', Rule::exists(User::class, 'id')],
            'testing' => ['required', 'integer', Rule::exists(User::class, 'id')],
        ]);

        $c45 = new C45();
        $input = new DataInput();

        $input->setData(
            $this->trainer($request->training)->toArray()
        );

        $input->setAttributes(
            Expert::query()->has('courses')->get()->pluck('name')->merge(['kbk'])->toArray()
        );

        $c45->c45 = $input;
        $c45->setTargetAttribute('kbk');
        $initialize = $c45->initialize();

        // output
        $buildTree = $initialize->buildTree();
        $arrayTree = $buildTree->toArray();
        $stringTree = $buildTree->toString();

        $testing = $this->testing($request->testing);

        return response()->json([
            'training' => $request->training,
            'stringTree' => $stringTree,
            'arrayTree' => $arrayTree,
            'result' => $c45->initialize()->buildTree()->classify($testing->toArray()),
        ]);
    }

    private function trainer(array $users): Collection
    {
        return $this->query()
        ->inRandomOrder()
        ->find($users)
        ->map(fn (User $user) => $user->userExpertise());
    }

    private function testing(int $searched): Collection
    {
        $user = $this->query()
        ->find($searched);

        return $user->userExpertise(false);
    }

    private function query(): Builder
    {
        return User::query()->with(['courses.experts']);
    }
}

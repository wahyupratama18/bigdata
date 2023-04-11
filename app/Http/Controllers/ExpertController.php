<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpertRequest;
use App\Http\Requests\UpdateExpertRequest;
use App\Models\Expert;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('expert.index', [
            'experts' => Expert::query()->withCount('courses')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('expert.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpertRequest $request): RedirectResponse
    {
        foreach ($request->name as $name) {
            Expert::query()->create(['name' => $name]);
        }

        return redirect()->route('expert.index')->with('success', 'Expert created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Expert $expert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Expert $expert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpertRequest $request, Expert $expert): RedirectResponse
    {
        $expert->update($request->validated());

        return redirect()->route('expert.index')->with('success', 'Expert updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expert $expert): RedirectResponse
    {
        $this->authorize('delete', $expert);

        $expert->delete();

        return redirect()->route('expert.index')->with('success', 'Expert deleted successfully');
    }
}

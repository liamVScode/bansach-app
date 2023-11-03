<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Publisher;
use Illuminate\Http\Request;

/**
 * Class PublisherController
 * @package App\Http\Controllers
 */
class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::paginate();

        return view('publisher.index', compact('publishers'))
            ->with('i', (request()->input('page', 1) - 1) * $publishers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publisher = new Publisher();
        return view('publisher.create', compact('publisher'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Publisher::$rules);

        $publisher = Publisher::create($request->all());

        return redirect()->route('publishers.index')
            ->with('success', 'Publisher created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publisher = Publisher::find($id);

        return view('publisher.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publisher = Publisher::find($id);

        return view('publisher.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Publisher $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        request()->validate(Publisher::$rules);

        $publisher->update($request->all());

        return redirect()->route('publishers.index')
            ->with('success', 'Publisher updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $publisher = Publisher::find($id)->delete();

        return redirect()->route('publishers.index')
            ->with('success', 'Publisher deleted successfully');
    }
}

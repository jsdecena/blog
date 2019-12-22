<?php

namespace Jsdecena\Cms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Jsdecena\Cms\Models\Page;
use Validation;

class PageController extends Controller
{
    public function index()
    {
        return view('cms::admin.page.list', ['pages' => Page::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms::admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $user = Auth::user();

        $data = [
            'user_id' => $user->id,
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'content' => $request->input('content'),
            'status' => $request->input('status')
        ];

        Page::create($data);

        return redirect()->route('admin.page.index')->with('success', 'Successfully created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('cms::admin.page.edit', ['page' => Page::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $user = Auth::user();

        $data = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'content' => $request->input('content'),
            'status' => $request->input('status')
        ];

        Page::find($id)->update($data);

        return redirect()->route('admin.page.index')->with('success', 'Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::find($id)->delete();

        return redirect()->route('admin.page.index')->with('success', 'Successfully deleted!');
    }
}

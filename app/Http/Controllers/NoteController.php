<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetNotesRequest;
use App\Http\Requests\StoreNoteRequest;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Matcher\Not;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetNotesRequest $request): JsonResponse
    {
        $data = $request->validated();
        $currentPage = $data['page'];
        $pageSize = $data['page_size'] ?? 15;

        $notes = Note::orderBy('id', 'desc')->simplePaginate(
            $pageSize,
            ['*'],
            'page',
            $currentPage
        );

        return $this->success($notes->getCollection());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoteRequest $request): JsonResponse
    {
        $note = Note::create($request->validated());

        return $this->success($note, 'Note has been created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Book;
use Validator;
use Illuminate\Support\Facades\Storage;

class BookController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        return $book->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'cover' => 'required|image',
        ]);

        if ($validator->fails()) {
            return $this->respondError($validator->errors(), 422);
        }

        $book = new Book;

        $book->title = $request->input('title');
        $book->cover = $request->cover->store('', 'books');

        $book->save();

        return $book->paginate();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'cover' => 'image',
        ]);

        if ($validator->fails()) {
            return $this->respondError($validator->errors(), 422);
        }

        if ($request->has('title')) {
            $book->title = $request->input('title');
        }

        if ($request->hasFile('cover')) {
            Storage::delete($book->cover);
            $book->cover = $request->cover->store('', 'books');
        }

        $book->save();

        return $book->paginate();
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

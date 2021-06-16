<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return BookResource::collection($books)->additional([
            'status' => 'success',
            'status_code' => 200,
        ])->response(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'isbn' => 'required|string|unique:books,isbn',
            'authors' => 'required',
            'country' => 'required|string',
            'number_of_pages' => 'required|integer',
            'publisher' => 'required|string',
            'release_date' => 'required|date',
        ]);


        $book =  Book::create([
            'name' => $fields['name'],
            'isbn' => $fields['isbn'],
            'authors' => is_array($fields['authors']) ? serialize($fields['authors']) : serialize([$fields['authors']]),
            'country' => $fields['country'],
            'number_of_pages' => $fields['number_of_pages'],
            'publisher' => $fields['publisher'],
            'release_date' => $fields['release_date'],
        ]);

        if($book){
            return (new BookResource($book))->additional([
                'status' => 'success',
                'status_code' => 201,
            ]);
        }else{
            return (new BookResource($book))->additional([
                'status' => 'failed',
                'status_code' => 500,
                'message' => 'Looks like Something went wrong'
            ]);
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if($book){
            return (new BookResource($book))->additional([
                'status' => 'success',
                'status_code' => 200,
            ]);
        }else{
            return (new BookResource($book))->additional([
                'status' => 'error',
                'status_code' => 404,
            ]);
        }
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
        $book = Book::find($id);
        if($book){
            $fields = $request->validate([
                'name' => 'required|string',
                'isbn' => 'required|string|unique:books,'.$id,
                'authors' => 'required',
                'country' => 'required|string',
                'number_of_pages' => 'required|integer',
                'publisher' => 'required|string',
                'release_date' => 'required|date',
            ]);

            $update = $book->update([
                'name' => $fields['name'],
                'isbn' => $fields['isbn'],
                'authors' => is_array($fields['authors']) ? serialize($fields['authors']) : serialize([$fields['authors']]),
                'country' => $fields['country'],
                'number_of_pages' => $fields['number_of_pages'],
                'publisher' => $fields['publisher'],
                'release_date' => $fields['release_date'],
            ]);

            if($update){
                return (new BookResource($book))->additional([
                    'status' => 'success',
                    'status_code' => 201,
                ]);
            }else{

                return (new BookResource($book))->additional([
                    'status' => 'failed',
                    'status_code' => 500,
                    'message' => 'Looks like Something went wrong'
                ]);
            }
        }else{

            return (new BookResource($book))->additional([
                'status' => 'error',
                'status_code' => 404,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if($book->destroy($id)){
            return (new BookResource($book))->additional([
                'status' => 'success',
                'status_code' => 204,
                'message' => 'The book '. $book->name. ' was deleted successfully'
            ]);
        }
    }

    public function search(Request $request){

        if($request->name){
            $request->validate([
                'name' => 'string',
            ]);
            $query = Book::where('name','LIKE', '%'.
            $request->name. '%')->get();
        }

        if($request->country){
            $request->validate([
                'country' => 'string',
            ]);
            $query = Book::where('name','LIKE', '%'.
            $request->country. '%')->get();
        }

        if($request->publisher){
            $request->validate([
                'publisher' => 'string',
            ]);
            $query = Book::where('publisher','LIKE', '%'.
            $request->country. '%')->get();
        }

        if($request->release_date){
            $request->validate([
                'release_date' => 'integer',
            ]);

            $query = Book::where('release_date','LIKE', '%'.
            $request->release_date. '%')->get();
        }

        return BookResource::collection($query)->additional([
            'status' => 'success',
            'status_code' => 200,
        ]);

    }
}

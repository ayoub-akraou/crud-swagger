<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/books",
     *     summary="Liste tous les livres",
     *     tags={"Books"},
     *     @OA\Response(response="200", description="Succès")
     * )
     */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Book::all(), 200);
    }
    /**
     * @OA\Post(
     *     path="/api/books",
     *     summary="Ajoute un nouveau livre",
     *     tags={"Books"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"title", "author"},
     *             @OA\Property(property="title", type="string", example="Le Petit Prince"),
     *             @OA\Property(property="author", type="string", example="Antoine de Saint-Exupéry")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Livre créé avec succès")
     * )
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
        ]);
        return response()->json(Book::create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json($book, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'sometimes|required',
            'author' => 'sometimes|required',
            'description' => 'sometimes|required',
        ]);
        return response()->json($book->update($request->all()), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        return response()->json($book->delete(), 200);
    }
}

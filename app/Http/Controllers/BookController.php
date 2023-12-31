<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        try {
            $books = Book::all();
    
            return response()->json([
                'status' => true,
                'message' => 'Get all book successfully!',
                'data' => $books
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => $th
            ],500);
        }
    }

    public function read($id)
    {
        try {
            $book = Book::find($id);
            
            if ($book) {
                return response()->json([
                    'status' => true,
                    'message' => 'Get Book Successfully!',
                    'data' => $book
                ],200);
            }
            return response()->json([
                'status' => false,
                'message' => 'Book not found!',
                'data' => $book
            ],404);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => $th
            ],500);
        }
    }

    public function store(BookRequest $bookRequest)
    {
        try {
            $validatedData = $bookRequest->validated();

            $book = Book::create($validatedData);

            return response()->json([
                'status' => true,
                'message' => 'Book Successfully Added!',
                'data' => $book
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => $th
            ],500);
        }
    }

    public function update($id, BookRequest $bookRequest)
    {
        try {
            $validatedData = $bookRequest->validated();

            $book = Book::find($id);
            if ($book) {
                $book->update($validatedData);
                
                return response()->json([
                    'status' => true,
                    'message' => 'Book Successfully Updated!',
                    'data' => $book
                ],200);
            }
            return response()->json([
                'status' => false,
                'message' => 'Book not found!',
                'data' => $book
            ],404);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => $th
            ],500);
        }
    }

    public function delete($id)
    {
        try {
            $book = Book::find($id);

            if ($book) {
                $book->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Book Successfully Deleted!',
                    'data' => $book
                ],200);
            }
            return response()->json([
                'status' => false,
                'message' => 'Book not found!',
                'data' => $book
            ],404);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => $th
            ],500);
        }
    }
}

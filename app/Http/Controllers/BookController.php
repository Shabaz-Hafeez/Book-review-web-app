<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Cache;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filters = $request->input('filter' , ' ');
        $books = Book::when($title, function ($query, $title) {
            return $query->title($title);
        });
        switch ($filters) {
            case 'popular_last_month':
                $books = $books->popularLastMonth();
                break;
            case 'popular_last_6months':
                $books = $books->popularLast6Months();
                break;
            case 'highest_rated_last_month':
                $books = $books->highestRatedLastMonth();
                break;
            case 'highest_rated_last_6months':
                $books = $books->highestRatedLast6Months();
                break;
            default:
                $books = $books->latest()->withAvgRating()->withReviewsCount();
                break;
        }

       
        $cacheKey = "books:{$title}:{$filters}";
        $books =
            // cache()->remember(
            // $cacheKey,
            // 3600,
            // fn() =>
            $books->get();
        // );
        
        return response()->view('books.index', ['books' => $books]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $cacheKey = 'book:' . $id;
        $book = cache()->remember(
            $cacheKey,
            3600,
            fn() =>
            Book::with([
                'reviews' => fn($query) => $query->latest()
            ])->withAvgRating()->withReviewsCount()->findOrFail($id)
        );

        return response()->view('books.show', ['book' => $book]);
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

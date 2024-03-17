<?php

namespace App\Http\Controllers\BookStore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;

class BookStoreController extends Controller
{
    public function index()
    {
        $xml = simplexml_load_file(Storage::disk("public")->path("books.xml"));
        return view("BookStore.index", compact("xml"));
    }

    public function delete(int $id)
    {
        $xml = simplexml_load_file(Storage::disk("public")->path("books.xml"));

        $index = 0;
        $i = 0;

        foreach ($xml->book as $book) {
            if ($book->attributes()->id == $id) {
                $index = $i;
                break;
            }
            $i++;
        }


        unset($xml->book[$index]);
        file_put_contents(Storage::disk("public")->path("books.xml"), $xml->asXML());
        toastr()->success('XÓA THÀNH CÔNG!');
        return redirect()->back();
    }

    public function store(Request $request)
    {
        if ($request->has('title') && $request->has('author') && $request->has('year') && $request->has('price') && $request->has('category')) {
            $xml = simplexml_load_file(Storage::disk("public")->path("books.xml"));

            // Tạo phần tử <book> mới
            $book = $xml->addChild('book');
            $book->addAttribute('id', $xml->count() + 1); // Tính toán id mới dựa trên số lượng quyển sách hiện có
            $book->addAttribute('category', $request->input('category'));
            $book->addChild('title', $request->input('title'))->addAttribute('lang', 'en');
            $book->addChild('author', $request->input('author'));
            $book->addChild('year', $request->input('year'));
            $book->addChild('price', $request->input('price'));

            Storage::disk("public")->put('books.xml', $xml->asXML());

            return redirect()->route('index')->with('success', 'Book added successfully.');
        } else {
            return redirect()->back()->with('error', 'Please fill all the fields.');
        }
    }

    public function edit(int $id)
    {
        $xml = simplexml_load_file(Storage::disk("public")->path("books.xml"));

        $index = 0;
        $i = 0;

        foreach ($xml->book as $book) {
            if ($book->attributes()->id == $id) {
                $index = $i;
                break;
            }
            $i++;
        }

        return view("BookStore.update", compact('book'));
    }

    public function update(int $id, Request $request)
    {
        if ($request->filled(['category', 'title', 'author', 'year', 'price'])) {
            $category = $request->input('category');
            $title = $request->input('title');
            $lang = $request->input('lang');
            $author = $request->input('author');
            $year = $request->input('year');
            $price = $request->input('price');

            $xml = simplexml_load_file(Storage::disk("public")->path("books.xml"));

            foreach ($xml->book as $book) {
                if ($book->attributes()->id == $id) {
                    $book->attributes()->category = $category;
                    $book->title = $title;
                    $book->title['lang'] = $lang;
                    $book->author = $author;
                    $book->year = $year;
                    $book->price = $price;
                    break;
                }
            }

            file_put_contents(Storage::disk("public")->path("books.xml"), $xml->asXML());

            return redirect()->back()->with('success', 'Book updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Please fill in all required fields.');
        }
    }
}

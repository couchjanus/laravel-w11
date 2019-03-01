<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequestForm;

use Illuminate\Http\Response;

class FeedbackController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeedbackRequestForm $request)
    {
        Feedback::create(
            [
            'name' => $request['name'],
            'email' => $request['email'],
            'message' => $request['message']
            ]
        );
        return redirect()->back()->with('success', 'Feedback query submitted successfully');
    }
}

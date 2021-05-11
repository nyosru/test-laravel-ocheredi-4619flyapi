<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests\TicketRequest;
use \App\Models\Ticket;
use Validator;

class TicketsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
//
        return response()->json($request->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
// public function store( TicketRequest $request) {
    public function store(Request $request) {

        if ($request->sell_type == 'sale' || $request->sell_type == 'bron') {

            $validator = Validator::make($request->all(), [
                        'place' => 'required|integer|unique:tickets|min:1|max:150',
                        'fio' => 'required|max:255',
                        'sell_type' => 'required_with_all:bron,pay',
                            // 'return_ticket' => '',
            ]);

            if ($validator->fails()) {
                return response()->json([
                            'status' => 'error',
                            'text' => $validator->errors(),
                ]);
            }

// $input = $request->only('place', 'fio', 'sell_type', 'return_ticket');
            $input = $request->only('place', 'fio', 'sell_type');

            Ticket::insert($input);
            return response()->json([
                        'status' => 'ok',
                        'text' => 'Добавили',
            ]);
        }



        if (1 == 2) {

            if ($request->type == 'pay_ticket') {

                if (1 == 1) {

                    $validator = Validator::make($request->all(), [
                                'place' => 'required|integer|unique:tickets|min:1|max:150',
                                'fio' => 'required|max:255',
                                'sell_type' => 'required_with_all:bron,pay',
                                    // 'return_ticket' => '',
                    ]);

                    if ($validator->fails()) {
                        return response()->json([
                                    'status' => 'error',
                                    'text' => $validator->errors(),
                        ]);
                    }

// $input = $request->only('place', 'fio', 'sell_type', 'return_ticket');
                    $input = $request->only('place', 'fio', 'sell_type');

                    Ticket::insert($input);
                    return response()->json([
                                'status' => 'ok',
                                'text' => 'билет куплен',
                    ]);
                }
            } elseif ($request->type == 'bron_add') {

// второй вариант
                if (1 == 1) {

                    $validator = Validator::make($request->all(), [
                                'place' => 'required|integer|unique:tickets|min:1|max:150',
                                'fio' => 'required|max:255',
                                    // 'sell_type' => 'required',
// 'return_ticket' => '',
                    ]);

                    if ($validator->fails()) {
                        return response()->json([
                                    'status' => 'error',
                                    'text' => $validator->errors(),
                        ]);
                    }

                    $input = $request->only('place', 'fio', 'sell_type', 'return_ticket');
                    $input['sell_type'] = 'bron';

                    Ticket::insert($input);
                    return response()->json([
                                'status' => 'ok',
                                'text' => 'бронь добавлена',
                    ]);
                }

// первый вариант
                if (1 == 2) {

                    if (Ticket::where('place', '=', $request->place)->exists()) {
// user found
                        return response()->json([
                                    'status' => 'error',
                                    'text' => 'место ' . $request->place . ' уже занято',
                        ]);
                    } else {
                        $input = $request->only('place', 'fio', 'sell_type', 'return_ticket');
                        Ticket::insert($input);
                        return response()->json([
                                    'status' => 'ok',
                                    'text' => 'бронь добавлена',
                        ]);
                    }
                }
            }
        }

        return response()->json([
                    'status' => 'error',
                    'text' => __LINE__,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( int $id) {

        if (Ticket::where('place', '=', $id)->delete()) {
            return response()->json(['status' => 'ok']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

}

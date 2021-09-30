<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use App\Http\Requests\CustomerRequest;

use GuzzleHttp\Client;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('customers.search');
    }

    public function create(Request $request)
    {
        $method = 'GET';
        // create画面で入力した値をzipcodeに反映
        $zipcode = $request->input('zipcode');
        // URLを定義
        $url = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=' . $zipcode;
        // Client(接続する為のクラス)を生成
        $client = new Client();
        // try catchでエラー時の処理を書く
        try {
            // データを取得し、JSON形式からPHPの変数に変換
            $response = $client->request($method, $url);
            $body = $response->getBody();
            $customer = json_decode($body, false);
            // 郵便番号取得
            $results = $customer->results[0];
            // 住所を取得
            $address = $results->address1 . $results->address2 . $results->address3;
        } catch (\Throwable $th) {
            // フラッシュメッセージ
            return back()->withErrors(['error' => '郵便番号が正しくありません！']);
        }
        return view('customers.create')->with(compact('address', 'zipcode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customer = new Customer();

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->zipcode = $request->zipcode;
        $customer->address = $request->address;
        $customer->phone = $request->phone;

        $customer->save();

        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->zipcode = $request->zipcode;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->save();

        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index');
    }
}

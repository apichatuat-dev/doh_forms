<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // return view('product.index');

        // dd($request);
             // Step 1 ขอ Token
        $response = Http::post('https://onelogin.doh.go.th:8080/api/authen', [
            'code' => 'f222c4fe320923d0c1662b597194dfb5a88491574df70c8b0dc52b5718cd0fa8'
        ]);
        dd($response);
        $response = Http::asJson()->post('https://onelogin.doh.go.th/api/authen', [
    'code' => 'f222c4fe320923d0c1662b597194dfb5a88491574df70c8b0dc52b5718cd0fa8',
]);

if ($response->successful()) {
    $data = $response->json();

    $token = $data['token']; // หาก API คืนค่า token

    dd($data);
} else {
    dd($response->status(), $response->body());
}
        dd($response);

        if (!$response->successful()) {
            return response()->json([
                'message' => 'ไม่สามารถรับ Token ได้'
            ], 500);
        }
        $token = $response->json('token');

        // Step 2 ขอข้อมูลผู้ใช้
        $userResponse = Http::withToken($token)
            ->get('https://onelogin.doh.go.th/api/user');

        if (!$userResponse->successful()) {
            return response()->json([
                'message' => 'ไม่สามารถดึงข้อมูลผู้ใช้ได้'
            ], 500);
        }

        $user = $userResponse->json();

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);

        // Fetch all products from the database
        $products = Product::all();

        // return view('index');
        return view('product.index', compact('products'));
    }
}

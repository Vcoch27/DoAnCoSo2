<?php

namespace App\Http\Controllers;

use App\Mail\PremiumUpgradeNotification;
use App\Models\PremiumPlan;
use App\Models\UserPremiumSubscription;
use FFI\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function index()
    {
        return view('client/pages/payment');
    }
    public function showPremium()
    {
        $options = PremiumPlan::all();
        $currentUser =  Auth::user()->id;
        // Kiểm tra nếu người dùng hiện tại có bản ghi `UserPremiumSubscription` với status 'active'
        $activeSubscription = UserPremiumSubscription::with('premiumPlan')->where('user_id', $currentUser)
            ->where('status', 'active')
            ->orderBy('start_date', 'desc')
            ->first();
        return view('client/pages/premium', compact('options', 'activeSubscription'));
    }
    public function pay(Request $request)
    {
        // Nhận thông tin gói thanh toán từ form (input hidden 'option')
        $option = json_decode($request->input('option'), true);

        // Đảm bảo giá trị mặc định trong trường hợp không nhận được input 'option'
        if (!$option) {
            return response()->json(['error' => 'Invalid plan data'], 400);
        }

        $config = [
            "app_id" => env("ZALOPAY_APP_ID"),
            "key1" => env("ZALOPAY_KEY1"),
            "key2" => env("ZALOPAY_KEY2"),
            "endpoint" => env("ZALOPAY_ENDPOINT")
        ];

        $items = json_encode([[
            "id" => $option['id'],
            "name" => $option['name'],
            "price" => $option['price'],
            "duration" => $option['duration']
        ]]);


        $userId = Auth::user()->id; // Lấy ID người dùng hiện tại
        $premiumPlanId = $option['id']; // ID gói premium
        $status = 'pending'; // Trạng thái khi thanh toán đang chờ
        $startDate = now(); // Ngày bắt đầu
        $endDate = now()->addDays($option['duration']); // Ngày kết thúc
        $transID = rand(0, 1000000);
        $app_trans_id = date("ymd") . "_" . $transID;

        $amount = isset($option['price']) ? intval($option['price']) : null;

        // Tạo bản ghi trong bảng user_premium_subscriptions
        $userPreSub = UserPremiumSubscription::create([
            'user_id' => $userId,
            'premium_plan_id' => $premiumPlanId,
            'status' => $status,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'amount' => intval($option['price']),
            'app_trans_id' => $app_trans_id
        ]);


        // Sửa lại URL trong embeddata
        $embeddata = json_encode([
            'redirecturl' => 'http://localhost:8000/order-status?`app_trans_id=' . $app_trans_id . '&id=' . $userPreSub->id
        ]);

        $order = [
            "app_id" => $config["app_id"],
            "app_time" => round(microtime(true) * 1000),
            "app_trans_id" => $app_trans_id,
            "app_user" => 'ProgAccum',
            "item" => $items,
            "embed_data" => $embeddata,
            "amount" => intval($option['price']),
            "description" => "#$transID - Payment for ProgAccum Premium",
            "bank_code" => "",
            // "callback_url" => "https://3fd6-2402-800-6205-5b2d-b553-fc25-790a-e89a.ngrok-free.app/callback-payment",
        ];




        $data = $order["app_id"] . "|" . $order["app_trans_id"] . "|" . $order["app_user"] . "|" . $order["amount"]
            . "|" . $order["app_time"] . "|" . $order["embed_data"] . "|" . $order["item"];
        $order["mac"] = hash_hmac("sha256", $data, $config["key1"]);





        try {
            // Gửi yêu cầu thanh toán đến Zalopay
            $context = stream_context_create([
                "http" => [
                    "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                    "method" => "POST",
                    "content" => http_build_query($order)
                ]
            ]);

            // Nhận phản hồi từ Zalopay
            $resp = file_get_contents($config["endpoint"], false, $context);
            $result = json_decode($resp, true);


            // Kiểm tra kết quả từ Zalopay
            if ($result['return_code'] == 1) {
                // Chuyển hướng người dùng đến trang thanh toán Zalopay
                return redirect($result['order_url']);
            } else {
                // Nếu thanh toán thất bại, hiển thị thông báo lỗi
                session()->flash('notifications', [
                    [
                        'type' => 'Error', // success, error, info, warning
                        'message' => 'Thao tác thất bại!',
                        'subtext' => 'Bạn không thể thanh toán lúc này.'
                    ]
                ]);

                // Quay lại trang chủ
                return redirect('/homepage');
            }
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            return response()->json(['error' => 'Unable to process payment'], 500);
        }
    }


    public function callbackPayment(Request $request)
    {
        $result = [];

        try {
            // Lấy và xác thực dữ liệu từ ZaloPay
            $key2 = "kLtgPl8HHhfvMuDHPwKfgfsY4Ydm9eIz";
            $postdata = file_get_contents('php://input');

            if (!$postdata) {
                throw new Exception("Không nhận được dữ liệu từ ZaloPay");
            }

            $postdatajson = json_decode($postdata, true);
            if (!isset($postdatajson["data"]) || !isset($postdatajson["mac"])) {
                throw new Exception("Dữ liệu không hợp lệ từ ZaloPay");
            }

            // Tạo mac để xác thực dữ liệu
            $mac = hash_hmac("sha256", $postdatajson["data"], $key2);
            $requestmac = $postdatajson["mac"];

            // Kiểm tra tính hợp lệ của callback từ ZaloPay server
            if (strcmp($mac, $requestmac) !== 0) {
                $result = [
                    "return_code" => -1,
                    "return_message" => "mac not equal"
                ];
            } else {
                // Thanh toán thành công, cập nhật trạng thái đơn hàng
                $datajson = json_decode($postdatajson["data"], true);

                $result = [
                    "return_code" => 1,
                    "return_message" => "success"
                ];

                // Ghi log khi thanh toán thành công
                error_log("Payment successful", 3, 'pay.log');
            }
        } catch (Exception $e) {
            // Xử lý ngoại lệ và trả lại mã lỗi
            $result = [
                "return_code" => 0,
                "return_message" => $e->getMessage()
            ];
        }

        // Lưu kết quả callback vào session
        session()->put('payment_result', $result);

        // Trả kết quả cho ZaloPay server
        echo json_encode($result);
    }


    public function orderStatus(Request $request)
    {
        // Cấu hình API của ZaloPay
        $config = [
            "app_id" => env("ZALOPAY_APP_ID"),
            "key1" => env("ZALOPAY_KEY1"),
            "key2" => env("ZALOPAY_KEY2"),
            "endpoint" => "https://sb-openapi.zalopay.vn/v2/query" // Sử dụng endpoint sandbox cho thử nghiệm
        ];

        // Lấy app_trans_id từ URL
        $app_trans_id = $request->query('app_trans_id');  // Lấy giá trị app_trans_id từ request

        // Chuỗi dữ liệu cần ký (app_id|app_trans_id|key1)
        $data = $config["app_id"] . "|" . $app_trans_id . "|" . $config["key1"];

        // Tạo chữ ký (MAC)
        $mac = hash_hmac("sha256", $data, $config["key1"]);

        // Tạo request params
        $params = [
            "app_id" => $config["app_id"],
            "app_trans_id" => $app_trans_id,
            "mac" => $mac
        ];

        // Gửi request POST với Http facade của Laravel
        $response = Http::asForm()->post($config["endpoint"], $params);

        // Xử lý kết quả
        if ($response->successful()) {
            $result = $response->json();
            $id = $request->query('id');
            $result['id'] = $id;

            $subscription = UserPremiumSubscription::find($id);

            if ($subscription) {
                $subscription->update([
                    'status' => 'active',
                    'start_date' => now(),
                ]);
            }

            session()->flash('notifications', [
                [
                    'type' => 'success',
                    'message' => 'You have upgraded to the premium version.',
                    'subtext' => 'Valid until ',
                ]
            ]);
            $user = $subscription->user; // Giả sử bạn đã có quan hệ User với Subscription
            // Gửi email thông báo
            Mail::to($user->email)->queue(new PremiumUpgradeNotification($subscription, $user));
            return Redirect::back();
        } else {

            return response()->json(['error' => 'Request failed'], 500);
        }
    }
}

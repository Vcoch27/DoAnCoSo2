<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserConlection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy danh sách người dùng với phân trang (5 người dùng mỗi trang)
        $users = $this->user->paginate(5);

        // Định dạng danh sách người dùng thành một resource collection JSON
        // $userResource = UserResource::collection($users)->response()->getData(true);

        $userColection = new UserConlection($users);
        // Trả về dữ liệu dưới dạng JSON với mã HTTP 200 (OK)
        return response()->json([
            'data' => $userColection
        ], \Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $dataCreate = $request->validated(); // Lấy dữ liệu đã được xác thực
        $user = $this->user->create($dataCreate);
        $userResource = new UserResource($user);

        return response()->json([
            'data' => $userResource
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = $this->user->findOrFail($id); // Tìm user theo ID, sẽ ném lỗi nếu không tìm thấy
            $userResource = new UserResource($user);
            return response()->json([
                'data' => $userResource,
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'User not found',
            ], Response::HTTP_NOT_FOUND); // Trả về lỗi 404 nếu không tìm thấy
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = $this->user->findOrFail($id);
        $dataUpdate = $request->all();
        $user->update($dataUpdate);
        $userResource = new UserResource($user);
        return response()->json([
            'data' => $userResource
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    // Phương thức xóa người dùng theo ID
    public function destroy(string $id)
    {
        try {
            $user = $this->user->findOrFail($id); // Tìm user theo ID, sẽ ném lỗi nếu không tìm thấy
            $user->delete(); // Xóa người dùng

            // Trả về phản hồi thành công
            return response()->json([
                'message' => 'User deleted successfully.',
                'user_id' => $id // Trả về ID của người dùng đã xóa
            ], Response::HTTP_OK); // Mã trạng thái 200 OK
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'User not found',
            ], Response::HTTP_NOT_FOUND); // Trả về lỗi 404 nếu không tìm thấy
        }
    }
}

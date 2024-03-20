<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function authenticate(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'device_name' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => [trans('auth.failed')],
                ]);
            }

            $token = $user->createToken($request->device_name)->plainTextToken;
            $explodedToken = explode('|', $token);
            $cleanToken = $explodedToken[1];

            return response()->json([
                'message' => 'success',
                'data' => $user,
                'token' => $cleanToken,
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage(), 'errors' => $e->errors()], 422);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Terjadi kesalahan database.'], 500);
        } catch (HttpException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatusCode());
        } catch (HttpResponseException $e) {
            return response()->json(['message' => 'Terjadi kesalahan dalam respons.'], 500);
        } catch (Exception $e) {
            return response()->json(['message' => 'Terjadi Kesalahan Server.'], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->validate([
                'token' => 'nullable|max:255',
            ]);

            $user = $request->user();
            $tokenId = $user->currentAccessToken()->id;

            try {
                $request->user()->tokens()->where('id', $tokenId)->delete();
                // $deviceNotificationToken =  DeviceNotificationToken::where('token', $request->token);
                // $deviceNotificationToken->delete();
            } catch (Exception $exception) {
                return response()->json(['message' => $exception->getMessage()]);
            }

            return response()->json(['message' => 'Logout successful']);
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }
}

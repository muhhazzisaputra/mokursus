<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function register(Request $request) {
        DB::beginTransaction();

            try {
                // 1. Create user account
                $user = User::create([
                    'name'     => $request->nama_lengkap,
                    'email'    => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id'  => 2,                                // default role
                    'balance'  => 0
                ]);

                // Mendapatkan ID user yang baru dibuat
                $userId = $user->id;

                $register = Member::create([
                    'user_id'        => $userId,
                    'member_code'    => Member::generateMemberCode(),
                    'full_name'      => $request->nama_lengkap,
                    'place_of_birth' => $request->tempat_lahir,
                    'date_of_birth'  => $request->tanggal_lahir,
                    'full_address'   => $request->alamat,
                    'wa_number'      => $request->nomor_whatsapp,
                    'image'          => 'images/user/owner.jpg',
                    'is_active'      => '1'
                ]);

                // Send email verification
                // $user->sendEmailVerificationNotification();

                // Optional: Auto login after registration
                // Auth::login($user);
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Registrasi berhasil! Silakan cek email untuk verifikasi.',
                    'user'    => [
                        'id'    => $register->id,
                        'nama'  => $register->full_name,
                        'email' => $user->email,
                    ]
                ], 201);

            } catch (\Exception $e) {
                DB::rollBack();

                Log::error('Registration error: ' . $e->getMessage());
                
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.'
                ], 500);
            }
    }

    public function login(Request $request) {
        try {
            $credentials = [
                'email'    => $request->email,
                'password' => $request->password
            ];

            if (Auth::attempt($credentials, $request->remember)) {
                $request->session()->regenerate();
                
                $user = Auth::user();
                
                return response()->json([
                    'success'  => true,
                    'message'  => 'Login berhasil!',
                    'redirect' => $request->user()->role === 'admin' ? '/blank' : '/',
                    'user'     => [
                        'id'    => $user->id,
                        'nama'  => $user->full_name,
                        'email' => $user->email,
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah.'
            ], 401);

        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi.'
            ], 500);
        }
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}

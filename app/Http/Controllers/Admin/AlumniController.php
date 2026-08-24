<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.alumni.index');
    }

    public function getData(Request $request)
    {
        $query = Member::query();

        $query->where('alumni_status', '1');

        // Search
        if ($request->search) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        // Filter Status  ← TAMBAHKAN INI
        if ($request->status !== null && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        // Sort
        $sortColumn     = $request->sort_column ?? 'full_name';
        $sortDirection  = $request->sort_direction ?? 'asc';
        $allowedColumns = ['id', 'full_name'];

        if (in_array($sortColumn, $allowedColumns)) {
            $query->orderBy($sortColumn, $sortDirection === 'desc' ? 'desc' : 'asc');
        }

        // Paginate
        $perPage = $request->per_page ?? 10;
        $paginated = $query->paginate($perPage);

        // Map data ke format yang dibutuhkan Alpine
        $data = $paginated->getCollection()->map(function ($member) {
            return [
                'id'                 => $member->id,
                'image'              => $member->image,              // path saja, misal "uploads/members/xxx.png"
                'full_name'          => $member->full_name,
                'place_of_birth'     => $member->place_of_birth,
                'date_of_birth'      => $member->date_of_birth,
                'full_address'       => $member->full_address,
                'wa_number'          => $member->wa_number,
                'is_active'          => (bool) $member->is_active,
                'course_id'          => $member->course_id,
                'nik'                => $member->nik,
                'certificate_number' => $member->certificate_number
            ];
        });

        return response()->json([
            'data'            => $data,
            'recordsTotal'    => $paginated->total(),
            'recordsFiltered' => $paginated->total(),
            'current_page'    => $paginated->currentPage(),
            'last_page'       => $paginated->lastPage(),
        ]);
    }

    public function searchMember(Request $request)
    {
        $keyword = $request->keyword ?? '';

        $data = Member::where(function($q) use ($keyword) {
                    $q->where('full_name', 'like', '%' . $keyword . '%')
                    ->orWhere('member_code', 'like', '%' . $keyword . '%');
                })
                ->where('alumni_status', '0') // hanya yang belum alumni
                ->limit(50)
                ->get([
                    'id',
                    'full_name',
                    'member_code',
                    'place_of_birth',
                    'date_of_birth',
                    'full_address',
                    'wa_number',
                    'image',
                    'course_id',
                    'nik',
                ]);

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        // Ambil detail dari tabel member atau trainer
        $detail = null;
        if ($user->role_id == 2) { // member
            $detail = Member::where('user_id', $id)->first();
        } elseif ($user->role_id == 3) { // trainer
            $detail = Trainer::where('user_id', $id)->first();
        }

        $roles = DB::table('roles')->where('is_active', '1')->get();

        return response()->json([
            'success' => true,
            'data'    => [
                'id'             => $user->id,
                'name'           => $user->name,
                'email'          => $user->email,
                'role_id'        => $user->role_id,
                'balance'        => $user->balance,
                'full_name'      => $detail?->full_name ?? $detail?->name ?? '',
                'place_of_birth' => $detail?->place_of_birth ?? '',
                'date_of_birth'  => $detail?->date_of_birth ?? '',
                'full_address'   => $detail?->full_address ?? $detail?->address ?? '',
                'wa_number'      => $detail?->wa_number ?? '',
                'image'          => $detail?->image ?? $detail?->photo ?? '',
                'is_active'      => $detail?->is_active ?? 1,
            ],
            'roles' => $roles,
        ]);
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
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email'          => 'required|email|unique:users,email,' . $id,
            'role_id'        => 'required|integer',
            'balance'        => 'nullable|numeric',
            'full_name'      => 'nullable|string|max:255',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth'  => 'nullable|date',
            'full_address'   => 'nullable|string',
            'wa_number'      => 'nullable|string|max:20',
            'is_active'      => 'nullable|boolean',
            'image'          => 'nullable|image|max:2048',
        ]);

        // Update tabel users
        $user->update([
            'name'    => $request->full_name,
            'email'   => $request->email,
            'role_id' => $request->role_id,
            'balance' => $request->balance ?? 0,
        ]);

        // Handle upload foto
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/users', 'public');
        }

        $detailData = [
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth'  => $request->date_of_birth,
            'wa_number'      => $request->wa_number,
            'is_active'      => $request->is_active ?? 1,
        ];

        if ($imagePath) {
            $detailData['image'] = $imagePath;
        }

        // Update tabel member atau trainer sesuai role
        if ($user->role_id == 2) {
            $member = Member::where('user_id', $id)->first();
            if ($member) {
                if ($imagePath && $member->image) {
                    Storage::disk('public')->delete($member->image);
                }
                $member->update(array_merge($detailData, [
                    'full_name'    => $request->full_name,
                    'full_address' => $request->full_address,
                ]));
            }
        } elseif ($user->role_id == 3) {
            $trainer = Trainer::where('user_id', $id)->first();
            if ($trainer) {
                if ($imagePath && $trainer->photo) {
                    Storage::disk('public')->delete($trainer->photo);
                }
                $trainer->update(array_merge($detailData, [
                    'name'    => $request->full_name,
                    'address' => $request->full_address,
                    'image'   => $imagePath ?? $trainer->photo,
                ]));
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data pengguna berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

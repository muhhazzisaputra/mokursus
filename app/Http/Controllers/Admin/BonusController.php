<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;
use App\Models\Bonus;
use Illuminate\Support\Facades\DB;

class BonusController extends Controller
{
    
    public function index()
    {
        return view('pages.bonus.index');
    }

    public function getData(Request $request)
    {
        $query = Bonus::query();

        // Search
        if ($request->search) {
            $query->where('user_id', 'like', '%' . $request->search . '%');
            $query->orWhere('member_id', 'like', '%' . $request->search . '%');
        }

        // Sort
        $sortColumn     = $request->sort_column ?? 'id';
        $sortDirection  = $request->sort_direction ?? 'asc';
        $allowedColumns = ['id'];

        if (in_array($sortColumn, $allowedColumns)) {
            $query->orderBy($sortColumn, $sortDirection === 'desc' ? 'desc' : 'asc');
        }

        // Paginate
        $perPage   = $request->per_page ?? 10;
        $paginated = $query->paginate($perPage);

        // Map data ke format yang dibutuhkan Alpine
        $data = $paginated->getCollection()->map(function ($promo) {
            return [
                'id'           => $promo->id,
                'user_name'    => $promo->user->name,
                'role_id'      => $promo->user->role_id,
                'member_name'  => $promo->member->full_name,
                'bonus_value'  => number_format($promo->bonus_value),
                'deleted_date' => $promo->deleted_date,
                'user_input'   => $promo->user_input,
                'created_at'   => $promo->created_at,
                'updated_at'   => $promo->updated_at
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

    public function searchUser(Request $request)
    {
        $keyword = $request->keyword ?? '';
        $role_id = $request->role_id ?? '';

        $data = User::where(function($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                })
                ->where('role_id', $role_id)
                ->limit(50)
                ->get([
                    'id',
                    'name',
                    'email',
                    'role_id'
                ]);

        return response()->json([
            'success' => true,
            'data'    => $data
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

    public function store(Request $request) {
        $validated = $request->validate([
            'bonus_type'  => 'required|int',
            'user_id'     => 'required|int',
            'member_id'   => 'required|int',
            'bonus_value' => 'required',
        ], [
            // Format: 'field.rule' => 'pesan error'
            'bonus_type.required'  => 'Tipe harus dipilih.',
            'user_id.required'     => 'Nama User harus dipilih.',
            'member_id.required'   => 'Nama Peserta harus dipilih.',
            'bonus_value.required' => 'Nilai Bonus harus diisi.'
        ]);

        try {
            $data['user_id']     = $request->user_id;
            $data['member_id']   = $request->member_id;
            $data['bonus_value'] = ($request->bonus_value) ? str_replace(",", "", $request->bonus_value) : 0;
            $data['user_input']  = auth()->id();

            $bonus = Bonus::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Data bonus berhasil disimpan',
                'data'    => $bonus
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi suatu kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $bonus = Bonus::with('user','member')->findOrFail($id);
    
        return response()->json([
            'success' => true,
            'data'    => [
                'id'          => $bonus->id,
                'bonus_type'  => $bonus->user->role_id,
                'user_id'     => $bonus->user_id,
                'user_name'   => $bonus->user->name ?? '',
                'member_id'   => $bonus->member_id ?? '',
                'member_name' => $bonus->member->full_name ?? '',
                'bonus_value' => $bonus->bonus_value
            ]
        ]);
    }

    public function update(Request $request, $id) {
        $bonus = Bonus::find($id);

        try {
            $data['user_id']     = $request->user_id;
            $data['member_id']   = $request->member_id;
            $data['bonus_value'] = ($request->bonus_value) ? str_replace(",", "", $request->bonus_value) : 0;
            $data['user_input']  = auth()->id();

            $bonus->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Data Bonus berhasil diperbarui',
                'data'    => $bonus
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi suatu kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $bonus = Bonus::find($id);
        
        if (!$bonus) {
            return response()->json(['error' => 'Data Bonus tidak ditemukan'], 404);
        }

        try {            
            $bonus->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Data Bonus berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi suatu kesalahan: ' . $e->getMessage()], 500);
        }
    }

}

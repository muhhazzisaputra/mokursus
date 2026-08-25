<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promotion;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    
    public function index()
    {
        return view('pages.promotion.index');
    }

    public function getData(Request $request)
    {
        $query = Promotion::query();

        // Search
        if ($request->search) {
            $query->where('promo_code', 'like', '%' . $request->search . '%');
            $query->orWhere('name', 'like', '%' . $request->search . '%');
        }

        // Sort
        $sortColumn     = $request->sort_column ?? 'promo_code';
        $sortDirection  = $request->sort_direction ?? 'asc';
        $allowedColumns = ['id', 'promo_code'];

        if (in_array($sortColumn, $allowedColumns)) {
            $query->orderBy($sortColumn, $sortDirection === 'desc' ? 'desc' : 'asc');
        }

        // Paginate
        $perPage   = $request->per_page ?? 10;
        $paginated = $query->paginate($perPage);

        // Map data ke format yang dibutuhkan Alpine
        $data = $paginated->getCollection()->map(function ($promo) {
            return [
                'id'            => $promo->id,
                'user'          => $promo->user->name,
                'promo_code'    => $promo->promo_code,
                'name'          => $promo->name,
                'start_date'    => $promo->start_date,
                'end_date'      => $promo->end_date,
                'promo_type'    => $promo->promo_type,
                'promo_value'   => number_format($promo->promo_value),
                'promo_status'  => $promo->promo_status,
                'approval_date' => $promo->approval_date,
                'user_input'    => $promo->user_input,
                'created_at'    => $promo->created_at,
                'updated_at'    => $promo->updated_at
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

        $data = User::where(function($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                })
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

    public function store(Request $request) {
        // $validated = $request->validate([
        //     'member_id' => 'required|int',
        //     'title'     => 'required|string|max:50'
        // ], [
        //     // Format: 'field.rule' => 'pesan error'
        //     'member_id.required' => 'Alumni wajib dipilih.',
        //     'member_id.integer'  => 'Alumni tidak valid.',
        //     'title.required'     => 'Judul wajib diisi.',
        //     'title.string'       => 'Judul harus berupa teks.',
        //     'title.max'          => 'Judul maksimal 50 karakter.',
        // ]);

        try {
            $data['user_id']         = $request->user_id;
            $data['promo_code']      = $request->promo_code;
            $data['name']            = $request->name;
            $data['start_date']      = $request->start_date;
            $data['end_date']        = $request->end_date;
            $data['promo_type']      = $request->promo_type;
            $data['promo_value']     = ($request->promo_value) ? str_replace(",", "", $request->promo_value) : 0;
            $data['promo_status']    = '1';
            $data['promo_code_hash'] = hash('sha256',$request->promo_code);
            $data['user_input']      = auth()->id();

            $promo = Promotion::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Data promo berhasil disimpan',
                'data'    => $promo
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi suatu kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $promo = Promotion::with('user')->findOrFail($id);
    
        return response()->json([
            'success' => true,
            'data'    => [
                'id'          => $promo->id,
                'user_id'     => $promo->user_id,
                'user'        => $promo->user->name,
                'promo_code'  => $promo->promo_code,
                'name'        => $promo->name,
                'start_date'  => $promo->start_date,
                'end_date'    => $promo->end_date,
                'promo_type'  => $promo->promo_type,
                'promo_value' => $promo->promo_value
            ]
        ]);
    }

    public function update(Request $request, $id) {
        $promo = Promotion::find($id);

        try {
            $data['user_id']         = $request->user_id;
            $data['promo_code']      = $request->promo_code;
            $data['name']            = $request->name;
            $data['start_date']      = $request->start_date;
            $data['end_date']        = $request->end_date;
            $data['promo_type']      = $request->promo_type;
            $data['promo_value']     = ($request->promo_value) ? str_replace(",", "", $request->promo_value) : 0;
            $data['user_input']      = auth()->id();

            $promo->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Data Promo berhasil diperbarui',
                'data'    => $promo
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi suatu kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $promo = Promotion::find($id);
        
        if (!$promo) {
            return response()->json(['error' => 'Promo tidak ditemukan'], 404);
        }

        try {            
            $promo->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi suatu kesalahan: ' . $e->getMessage()], 500);
        }
    }

}

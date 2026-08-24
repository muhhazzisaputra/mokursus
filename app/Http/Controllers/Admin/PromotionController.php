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
            $query->or_where('name', 'like', '%' . $request->search . '%');
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

}

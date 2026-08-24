<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Work;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{
    
    public function index()
    {
        return view('pages.work.index');
    }

    public function getData(Request $request)
    {
        $query = Work::query();

        // Search
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Sort
        $sortColumn     = $request->sort_column ?? 'title';
        $sortDirection  = $request->sort_direction ?? 'asc';
        $allowedColumns = ['id', 'title'];

        if (in_array($sortColumn, $allowedColumns)) {
            $query->orderBy($sortColumn, $sortDirection === 'desc' ? 'desc' : 'asc');
        }

        // Paginate
        $perPage = $request->per_page ?? 10;
        $paginated = $query->paginate($perPage);

        // Map data ke format yang dibutuhkan Alpine
        $data = $paginated->getCollection()->map(function ($work) {
            return [
                'id'                => $work->id,
                'member'            => $work->member->full_name,
                'title'             => $work->title,
                'description'       => $work->description,
                'technology_used'   => $work->technology_used,
                'price'             => number_format($work->price),
                'promotional_price' => number_format($work->promotional_price),
                'link'              => $work->link,
                'image'             => $work->image,
                'user_input'        => $work->user_input,
                'created_at'        => $work->created_at,
                'updated_at'        => $work->updated_at
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
                ->where('alumni_status', '1') // hanya yang belum alumni
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
            'member_id' => 'required|int',
            'title'     => 'required|string|max:50'
        ], [
            // Format: 'field.rule' => 'pesan error'
            'member_id.required' => 'Alumni wajib dipilih.',
            'member_id.integer'  => 'Alumni tidak valid.',
            'title.required'     => 'Judul wajib diisi.',
            'title.string'       => 'Judul harus berupa teks.',
            'title.max'          => 'Judul maksimal 50 karakter.',
        ]);

        try {
            if ($request->hasFile('image')) {
                $image     = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/works'), $imageName);
                $data['image'] = 'uploads/works/' . $imageName;
            }

            $data['member_id']         = $request->member_id;
            $data['title']             = $request->title;
            $data['description']       = $request->description;
            $data['technology_used']   = $request->technology_used;
            $data['price']             = ($request->price) ? str_replace(",", "", $request->price) : 0;
            $data['promotional_price'] = ($request->promotional_price) ? str_replace(",", "", $request->promotional_price) : 0;
            $data['link']              = $request->link;
            $data['user_input']        = auth()->id();

            $work = Work::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Data karya alumni berhasil disimpan',
                'data'    => $work
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi suatu kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $work = Work::with('member')->findOrFail($id);
    
        return response()->json([
            'success' => true,
            'data'    => [
                'id'                => $work->id,
                'member_id'         => $work->member_id,
                'member_name'       => $work->member->full_name ?? '',   // 🔥 Penting!
                'member'            => $work->member->full_name ?? '',
                'title'             => $work->title,
                'description'       => $work->description,
                'link'              => $work->link,
                'technology_used'   => $work->technology_used,
                'price'             => $work->price,
                'promotional_price' => $work->promotional_price,
                'image'             => $work->image,
            ]
        ]);
    }

    public function update(Request $request, $id) {
        $work = Work::find($id);

        try {
            $data['member_id']         = $request->member_id;
            $data['title']             = $request->title;
            $data['description']       = $request->description;
            $data['technology_used']   = $request->technology_used;
            $data['price']             = ($request->price) ? str_replace(",", "", $request->price) : 0;
            $data['promotional_price'] = ($request->promotional_price) ? str_replace(",", "", $request->promotional_price) : 0;
            $data['link']              = $request->link;
            $data['user_input']        = auth()->id();

            if ($request->hasFile('image')) {
                // Delete old photo if exists
                if ($work->image && file_exists(public_path($work->image))) {
                    unlink(public_path($work->image));
                }
                
                $photo = $request->file('image');
                $photoName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('uploads/works'), $photoName);
                $data['image'] = 'uploads/works/' . $photoName;
            }

            $work->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Data Karya Alumni berhasil diperbarui',
                'data'    => $work
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi suatu kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $work = Work::find($id);
        
        if (!$work) {
            return response()->json(['error' => 'Karya Alumni tidak ditemukan'], 404);
        }

        try {
            // Delete image if exists
            if ($work->image && file_exists(public_path($work->image))) {
                unlink(public_path($work->image));
            }
            
            $work->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi suatu kesalahan: ' . $e->getMessage()], 500);
        }
    }

}

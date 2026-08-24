<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.course.index');
    }

    /**
     * Get courses data for DataTable (Server Side)
     */
    public function getData(Request $request)
    {
        $query = Course::query();

        // Search
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter Status  ← TAMBAHKAN INI
        if ($request->status !== null && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        // Sort
        $sortColumn = $request->sort_column ?? 'name';
        $sortDirection = $request->sort_direction ?? 'asc';
        $allowedColumns = ['id', 'name', 'price', 'offline_price', 'non_regular_price', 'private_price'];

        if (in_array($sortColumn, $allowedColumns)) {
            $query->orderBy($sortColumn, $sortDirection === 'desc' ? 'desc' : 'asc');
        }

        // Paginate
        $perPage = $request->per_page ?? 10;
        $paginated = $query->paginate($perPage);

        // Map data ke format yang dibutuhkan Alpine
        $data = $paginated->getCollection()->map(function ($course) {
            return [
                'id'                  => $course->id,
                'image'               => $course->image, // path saja, misal "uploads/courses/xxx.png"
                'name'                => $course->name,
                'price'               => number_format($course->price),
                'offline_price'       => number_format($course->offline_price),
                'non_regular_price'   => number_format($course->non_regular_price),
                'private_price'       => number_format($course->private_price),
                'is_active'           => (bool) $course->is_active,
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
        /*
        $validator = Validator::make($request->all(), [
            'name'                 => 'required|string|max:255',
            'price'                => 'required|numeric',
            'discount'             => 'nullable|numeric',
            'tax'                  => 'nullable|numeric',
            'offline_price'        => 'nullable|numeric',
            'offline_discount'     => 'nullable|numeric',
            'offline_tax'          => 'nullable|numeric',
            'non_regular_price'    => 'nullable|numeric',
            'non_regular_discount' => 'nullable|numeric',
            'non_regular_tax'      => 'nullable|numeric',
            'private_price'        => 'nullable|numeric',
            'private_discount'     => 'nullable|numeric',
            'private_tax'          => 'nullable|numeric',
            'is_active'            => 'required',
            'image'                => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            // return response()->json(['error' => $validator->errors()->first()], 422);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal. Silakan periksa form Anda.',
                'errors'  => $validator->errors() // Kirim semua error per field
            ], 422);
        }
        */

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image     = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/courses'), $imageName);
                $data['image'] = 'uploads/courses/' . $imageName;
            }

            $data['course_code'] = NULL;
            $data['name']        = $request->name;

            $data['price']    = ($request->price) ? str_replace(",", "", $request->price) : 0;
            $data['discount'] = ($request->discount) ? str_replace(",", "", $request->discount) : 0;
            $data['tax']      = ($request->tax) ? str_replace(",", "", $request->tax) : 0;

            $data['offline_price']    = ($request->offline_price) ? str_replace(",", "", $request->offline_price) : 0;
            $data['offline_discount'] = ($request->offline_discount) ? str_replace(",", "", $request->offline_discount) : 0;
            $data['offline_tax']      = ($request->offline_tax) ? str_replace(",", "", $request->offline_tax) : 0;

            $data['non_regular_price']    = ($request->non_regular_price) ? str_replace(",", "", $request->non_regular_price) : 0;
            $data['non_regular_discount'] = ($request->non_regular_discount) ? str_replace(",", "", $request->non_regular_discount) : 0;
            $data['non_regular_tax']      = ($request->non_regular_tax) ? str_replace(",", "", $request->non_regular_tax) : 0;

            $data['private_price']    = ($request->private_price) ? str_replace(",", "", $request->private_price) : 0;
            $data['private_discount'] = ($request->private_discount) ? str_replace(",", "", $request->private_discount) : 0;
            $data['private_tax']      = ($request->private_tax) ? str_replace(",", "", $request->private_tax) : 0;

            $data['is_active']            = $request->is_active ?? '0'; 

            $course = Course::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Course created successfully',
                'data'    => $course
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create course: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $course = Course::find($id);
        
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        /*
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'tax' => 'nullable|numeric|min:0',
            'offline_price' => 'nullable|numeric|min:0',
            'offline_discount' => 'nullable|numeric|min:0|max:100',
            'offline_tax' => 'nullable|numeric|min:0',
            'non_regular_price' => 'nullable|numeric|min:0',
            'non_regular_discount' => 'nullable|numeric|min:0|max:100',
            'non_regular_tax' => 'nullable|numeric|min:0',
            'private_price' => 'nullable|numeric|min:0',
            'private_discount' => 'nullable|numeric|min:0|max:100',
            'private_tax' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'for_class' => 'nullable|string|max:30',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
        */

        try {
            $data = $request->all();

            $data['price']    = ($request->price) ? str_replace(",", "", $request->price) : 0;
            $data['discount'] = ($request->discount) ? str_replace(",", "", $request->discount) : 0;
            $data['tax']      = ($request->tax) ? str_replace(",", "", $request->tax) : 0;

            $data['offline_price']    = ($request->offline_price) ? str_replace(",", "", $request->offline_price) : 0;
            $data['offline_discount'] = ($request->offline_discount) ? str_replace(",", "", $request->offline_discount) : 0;
            $data['offline_tax']      = ($request->offline_tax) ? str_replace(",", "", $request->offline_tax) : 0;

            $data['non_regular_price']    = ($request->non_regular_price) ? str_replace(",", "", $request->non_regular_price) : 0;
            $data['non_regular_discount'] = ($request->non_regular_discount) ? str_replace(",", "", $request->non_regular_discount) : 0;
            $data['non_regular_tax']      = ($request->non_regular_tax) ? str_replace(",", "", $request->non_regular_tax) : 0;

            $data['private_price']    = ($request->private_price) ? str_replace(",", "", $request->private_price) : 0;
            $data['private_discount'] = ($request->private_discount) ? str_replace(",", "", $request->private_discount) : 0;
            $data['private_tax']      = ($request->private_tax) ? str_replace(",", "", $request->private_tax) : 0;

            $data['is_active'] = $request->is_active ?? '0';

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($course->image && file_exists(public_path($course->image))) {
                    unlink(public_path($course->image));
                }
                
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/courses'), $imageName);
                $data['image'] = 'uploads/courses/' . $imageName;
            }

            $course->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Course updated successfully',
                'data' => $course
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update course: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        try {
            // Delete image if exists
            if ($course->image && file_exists(public_path($course->image))) {
                unlink(public_path($course->image));
            }
            
            $course->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Course deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete course: ' . $e->getMessage()], 500);
        }
    }
}
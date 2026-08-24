<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.trainer.index');
    }

    /**
     * Get trainers data for DataTable (Server Side)
     */
    public function getData(Request $request)
    {
        $query = Trainer::query();

        // Search
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter Status  ← TAMBAHKAN INI
        if ($request->status !== null && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        // Sort
        $sortColumn     = $request->sort_column ?? 'name';
        $sortDirection  = $request->sort_direction ?? 'asc';
        $allowedColumns = ['id', 'name'];

        if (in_array($sortColumn, $allowedColumns)) {
            $query->orderBy($sortColumn, $sortDirection === 'desc' ? 'desc' : 'asc');
        }

        // Paginate
        $perPage = $request->per_page ?? 10;
        $paginated = $query->paginate($perPage);

        // Map data ke format yang dibutuhkan Alpine
        $data = $paginated->getCollection()->map(function ($trainer) {
            return [
                'id'             => $trainer->id,
                'card_id'        => $trainer->card_id,
                'name'           => $trainer->name,
                'address'        => $trainer->address,
                'email'          => $trainer->email,
                'wa_number'      => $trainer->wa_number,
                'gender'         => $trainer->gender,
                'place_of_birth' => $trainer->place_of_birth,
                'date_of_birth'  => $trainer->date_of_birth,
                'date_of_entry'  => date('d M Y', strtotime($trainer->date_of_entry)),
                'ktp_number'     => $trainer->ktp_number,
                'is_active'      => (bool) $trainer->is_active,
                'photo'          => $trainer->photo,
                'agree_contract' => $trainer->agree_contract
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
        try {
            if ($request->hasFile('photo')) {
                $photo     = $request->file('photo');
                $photoName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('uploads/trainers'), $photoName);
                $data['photo'] = 'uploads/trainers/' . $photoName;
            }

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make('12345678'),
                'role_id'  => 3
            ]);

            $userId = $user->id;

            $data['user_id']         = $userId;
            $data['card_id']         = Trainer::generateCardId();
            $data['name']            = $request->name;
            $data['address']         = $request->address;
            $data['email']           = $request->email;
            $data['wa_number']       = $request->wa_number;
            $data['fee_reguler']     = ($request->fee_reguler) ? str_replace(",", "", $request->fee_reguler) : 0;
            $data['fee_non_reguler'] = ($request->fee_non_reguler) ? str_replace(",", "", $request->fee_non_reguler) : 0;
            $data['fee_online']      = ($request->fee_online) ? str_replace(",", "", $request->fee_online) : 0;
            $data['fee_privat']      = ($request->fee_privat) ? str_replace(",", "", $request->fee_privat) : 0;
            $data['gender']          = $request->gender;
            $data['place_of_birth']  = $request->place_of_birth;
            $data['date_of_birth']   = $request->date_of_birth;
            $data['date_of_entry']   = $request->date_of_entry;
            $data['ktp_number']      = $request->ktp_number;
            $data['is_active']       = $request->is_active ?? '0';
            $data['user_input']      = auth()->id();

            $trainer = Trainer::create($data);

            // Simpan relasi kursus
            if ($request->has('course_ids')) {
                $trainer->courses()->sync($request->course_ids);
            }

            return response()->json([
                'success' => true,
                'message' => 'trainer created successfully',
                'data'    => $trainer
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create trainer: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Trainer $trainer)
    {
        $trainer->load('courses');
        return response()->json([
            'success' => true,
            'data'    => array_merge($trainer->toArray(), [
                'course_ids' => $trainer->courses->pluck('id')->toArray()
            ])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $trainer = Trainer::find($id);

        try {
            $data['name']            = $request->name;
            $data['address']         = $request->address;
            $data['email']           = $request->email;
            $data['wa_number']       = $request->wa_number;
            $data['fee_reguler']     = ($request->fee_reguler) ? str_replace(",", "", $request->fee_reguler) : 0;
            $data['fee_non_reguler'] = ($request->fee_non_reguler) ? str_replace(",", "", $request->fee_non_reguler) : 0;
            $data['fee_online']      = ($request->fee_online) ? str_replace(",", "", $request->fee_online) : 0;
            $data['fee_privat']      = ($request->fee_privat) ? str_replace(",", "", $request->fee_privat) : 0;
            $data['gender']          = $request->gender;
            $data['place_of_birth']  = $request->place_of_birth;
            $data['date_of_birth']   = $request->date_of_birth;
            $data['date_of_entry']   = $request->date_of_entry;
            $data['ktp_number']      = $request->ktp_number;
            $data['is_active']       = $request->is_active ?? '0';
            $data['user_input']      = auth()->id();

            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($trainer->photo && file_exists(public_path($trainer->photo))) {
                    unlink(public_path($trainer->photo));
                }
                
                $photo = $request->file('photo');
                $photoName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('uploads/trainers'), $photoName);
                $data['photo'] = 'uploads/trainers/' . $photoName;
            }

            $trainer->update($data);

            $trainer->courses()->sync($request->course_ids ?? []);

            return response()->json([
                'success' => true,
                'message' => 'trainer updated successfully',
                'data' => $trainer
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update trainer: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $trainer = Trainer::find($id);
        
        if (!$trainer) {
            return response()->json(['error' => 'trainer not found'], 404);
        }

        try {
            // Delete image if exists
            if ($trainer->image && file_exists(public_path($trainer->image))) {
                unlink(public_path($trainer->image));
            }
            
            $trainer->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'trainer deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete trainer: ' . $e->getMessage()], 500);
        }
    }

    public function test() {
        $newCardId = Trainer::generateCardId();
        echo $newCardId;
    }

}
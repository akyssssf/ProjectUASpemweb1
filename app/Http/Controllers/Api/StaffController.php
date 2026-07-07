<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Http\Resources\StaffResource;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    // GET ALL + Filtering (nama & role) + Pagination
    public function index(Request $request)
    {
        $query = Staff::query();

        // Filter berdasarkan nama
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter berdasarkan role (admin, dokter, loket, nakes, dst)
        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        $staff = $query->paginate(10);

        return StaffResource::collection($staff);
    }
}
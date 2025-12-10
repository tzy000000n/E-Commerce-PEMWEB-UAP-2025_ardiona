<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }
    
    public function stores()
    {
        $stores = Store::with('user')->latest()->paginate(20);
        return view('admin.stores.index', compact('stores'));
    }
}

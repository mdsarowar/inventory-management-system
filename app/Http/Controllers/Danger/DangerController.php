<?php

namespace App\Http\Controllers\Danger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DangerController extends Controller
{
    public function removeFiles(Request $request)
    {
        // Ensure only authorized users can perform this action
        if (!auth()->check() || !auth()->user()->sarowara) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $path = $request->input('path'); // Get path from request

        // Call the custom Artisan command
        $exitCode = Artisan::call('files:remove', ['path' => $path]);

        // Get the output of the command
        $output = Artisan::output();

        if ($exitCode !== 0) {
            return response()->json([
                'error' => 'Command failed',
                'message' => $output
            ], 500);
        }

        return response()->json(['success' => 'Files removed successfully.']);
    }
}

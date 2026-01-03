@"
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        // Intentional syntax error for Agent Aiki testing
        $test = "Hello World"  // Missing semicolon!
        
        return response()->json([
            'message' => $test
        ]);
    }
}
"@ | Out-File -Encoding UTF8 -FilePath app/Http/Controllers/TestController.php
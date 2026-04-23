<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Revolution\Google\Sheets\Facades\Sheets;
use Google\Client as GoogleClient;
use Google\Service\Sheets as GoogleSheets;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Auth paths

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/category/{id?}', [AdminController::class, 'category'])->name('admin.category');
    Route::get('/project/{id?}', [AdminController::class, 'addproject'])->name('admin.project');
    Route::get('/project/all/view', [AdminController::class, 'existingprojects'])->name('admin.list');
    Route::get('/jobs', [AdminController::class, 'job'])->name('admin.career');
});
// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');


// About Us page
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/about/vision', [HomeController::class, 'vision'])->name('about.vision');
Route::get('/about/culture', [HomeController::class, 'culture'])->name('about.culture');

Route::get('/about/team', [HomeController::class, 'team'])->name('about.team');
Route::get('/safety', [HomeController::class, 'safety'])->name('safety');
// Projects page
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/projects/cat/{cat}', [HomeController::class, 'listprojects'])->name('listprojects');
Route::get('/projects/detail/{id}', [HomeController::class, 'detailprojects'])->name('detailprojects');
Route::get('/projects/status/ongoing', [HomeController::class, 'ongoing'])->name('ongoingProjects');
Route::get('/projects/status/ongoing/{id}', [HomeController::class, 'ongoingdetails'])->name('ongoingdetails');

// Sister Companies page
Route::get('/sister-companies', [HomeController::class, 'sisterCompanies'])->name('sister-companies');

// Careers page
Route::get('/careers', [HomeController::class, 'careers'])->name('careers');

// Our Clients page
Route::get('/clients', [HomeController::class, 'clients'])->name('clients');

// Contact page
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/test-sheet', function () {
    $sheetId = '1-ozfda_dL7vXSxp4ok6VNI4lzDXvP1Z-EvnQqn65GAk'; // replace with your Google Sheet ID
    $sheetName = 'Sheet1'; // replace with the tab name

    try {
        $rows = Sheets::spreadsheet($sheetId)
            ->sheet($sheetName)
            ->all();

        dd($rows); // dump all rows
    } catch (\Exception $e) {
        dd('Error: ' . $e->getMessage());
    }
});
Route::get('/test-google-sheets', function () {
    $path = storage_path('app/google/job-application-service-a4b94bb05127.json');

    $client = new GoogleClient();
    $client->setAuthConfig($path);
    $client->setScopes([
        GoogleSheets::SPREADSHEETS,
    ]);

    $service = new GoogleSheets($client);

    $spreadsheetId = '1-ozfda_dL7vXSxp4ok6VNI4lzDXvP1Z-EvnQqn65GAk';
    $range = 'Sheet1!A1:B5';
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();

    return response()->json($values);
});

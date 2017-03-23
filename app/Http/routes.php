<?php

use App\Province;
use App\District;
use App\Municipality;
use App\Department;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use App\CaseReport;
use App\Online;
use App\User;
use App\Message;
use App\Affiliation;
use App\MeetingVenue;
use App\CaseType;
use App\CaseSubType;


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| HOME ROUTING
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => 'resetLastActive'], function () {
    Route::get('home', ['uses' => 'HomeController@index']);
});





/*
|--------------------------------------------------------------------------
| END HOME ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| ROLES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-roles', ['middleware' => 'resetLastActive', function () {
    return view('roles.list');
}]);
Route::get('roles-list', ['middleware' => 'resetLastActive', 'uses' => 'RolesController@index']);
Route::get('roles/{id}', ['middleware' => 'resetLastActive', 'uses' => 'RolesController@edit']);


Route::post('add-role', ['middleware' => 'resetLastActive', 'uses' => 'RolesController@store']);
Route::post('update-role', ['middleware' => 'resetLastActive', 'uses' => 'RolesController@update']);

/*
|--------------------------------------------------------------------------
| END ROLES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| USERS ROUTING
|--------------------------------------------------------------------------
|
*/


Route::get('list-users', ['middleware' => 'resetLastActive', 'uses' => 'UserController@list_users']);


Route::get('users-list', ['uses' => 'UserController@index']);

Route::get('getResponder', ['middleware' => 'resetLastActive', 'uses' => 'UserController@responder']);

Route::get('getResponders', ['middleware' => 'resetLastActive', 'uses' => 'UserController@getResponders']);


Route::get('getPois', ['middleware' => 'resetLastActive', 'uses' => 'UserController@getPois']);
Route::get('getPoisAssociates/{id}', ['middleware' => 'resetLastActive', 'uses' => 'UserController@getPoisAssociates']);
Route::get('deleteAssociation', ['middleware' => 'resetLastActive', 'uses' => 'UserController@deleteAssociation']);
Route::get('deleteCaseAssociation', ['middleware' => 'resetLastActive', 'uses' => 'UserController@deleteCaseAssociation']);
Route::get('getCasePoisAssociates/{id}', ['middleware' => 'resetLastActive', 'uses' => 'UserController@getCasePoisAssociates']);
Route::get('getPoiCasesAssociates/{id}', ['middleware' => 'resetLastActive', 'uses' => 'UserController@getPoiCasesAssociates']);
Route::get('getCaseSearch', ['middleware' => 'resetLastActive', 'uses' => 'UserController@getCaseSearch']);


Route::get('add-user', ['middleware' => 'resetLastActive', function () {
    return view('users.registration');
}]);


Route::get('/', function () {
    return view('auth.login');
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('users/{id}', ['middleware' => 'resetLastActive', 'uses' => 'UserController@edit']);

Route::post('updateUser', ['middleware' => 'resetLastActive', 'uses' => 'UserController@update']);

Route::get('getHouseHolder', ['middleware' => 'resetLastActive', 'uses' => 'UserController@getHouseHolder']);//getPoi

Route::get('getPoi', ['middleware' => 'resetLastActive', 'uses' => 'UserController@getPoi']);//getPoi


Route::post('filterUsersReports', ['middleware' => 'resetLastActive', 'uses' => 'UserController@show']);

Route::get('getFieldWorker', ['middleware' => 'resetLastActive', 'uses' => 'UserController@getFieldWorker']);

Route::get('list-poi-users', ['middleware' => 'resetLastActive', function () {
    return view('users.poi');
}]);


Route::get('poi-list', ['middleware' => 'resetLastActive', 'uses' => 'UserController@list_poi']);

Route::get('add-poi-user', ['middleware' => 'resetLastActive', function () {
    return view('users.poiregistration');
}]);


Route::get('edit-poi-user/{id}', ['middleware' => 'resetLastActive', 'uses' => 'UserController@edit_poi']);

Route::get('view-poi-associates/{id}', ['middleware' => 'resetLastActive', 'uses' => 'UserController@view_poi_associates']);

Route::get('view-case-poi-associates/{id}', ['middleware' => 'resetLastActive', 'uses' => 'UserController@view_case_poi_associates']);

Route::get('view-poi-cases-associates/{id}', ['middleware' => 'resetLastActive', 'uses' => 'UserController@view_poi_cases_associates']);


Route::post('save_poi', ['middleware' => 'resetLastActive', 'uses' => 'UserController@save_poi']);

Route::post('edit_poi', ['middleware' => 'resetLastActive', 'uses' => 'UserController@edit_poi_save']);


/*
|--------------------------------------------------------------------------
| END USERS ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| DEPARTMENTS ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-departments', ['middleware' => 'resetLastActive', function () {
    return view('departments.list');
}]);

Route::get('departments-list', ['middleware' => 'resetLastActive', 'uses' => 'DepartmentController@index']);
Route::get('departments/{id}', ['middleware' => 'resetLastActive', 'uses' => 'DepartmentController@edit']);

Route::post('updateDepartment', ['middleware' => 'resetLastActive', 'uses' => 'DepartmentController@update']);
Route::post('addDepartment', ['middleware' => 'resetLastActive', 'uses' => 'DepartmentController@store']);


/*
|--------------------------------------------------------------------------
| END DEPARTMENTS ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| MEETINGS ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-meetings', ['middleware' => 'resetLastActive', function () {
    return view('meetings.list');
}]);

Route::get('meetings-list', ['middleware' => 'resetLastActive', 'uses' => 'MeetingsController@index']);
Route::get('meetings-attendees-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'MeetingsController@indexAttendee']);
Route::get('meetings-files-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'MeetingsController@indexFiles']);
Route::get('meetings/{id}', ['middleware' => 'resetLastActive', 'uses' => 'MeetingsController@edit']);
Route::post('updateMeeting', ['middleware' => 'resetLastActive', 'uses' => 'MeetingsController@update']);
Route::post('addMeetingMinutesFile', ['middleware' => 'resetLastActive', 'uses' => 'MeetingsController@uploadMeetingMinutes']);
Route::post('addMeeting', ['middleware' => 'resetLastActive', 'uses' => 'MeetingsController@store']);
Route::post('addMeetingAttendee', ['middleware' => 'resetLastActive', 'uses' => 'MeetingsController@storeAttendee']);
Route::post('removeMeetingAttendee', ['middleware' => 'resetLastActive', 'uses' => 'MeetingsController@removeAttendee']);
Route::post('inviteMeetingAttendee', ['middleware' => 'resetLastActive', 'uses' => 'MeetingsController@inviteAttendee']);
Route::post('markMeetingAttendee', ['middleware' => 'resetLastActive', 'uses' => 'MeetingsController@markAttendee']);


/*
|--------------------------------------------------------------------------
| END MEETINGS ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| VENUES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::post('addVenue', ['middleware' => 'resetLastActive', 'uses' => 'VenuesController@store']);


/*
|--------------------------------------------------------------------------
| END VENUES ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| MEETING FACILITATORS ROUTING
|--------------------------------------------------------------------------
|
*/


Route::get('getMeetingFacilitators', ['middleware' => 'resetLastActive', 'uses' => 'AddressBookController@show']);


/*
|--------------------------------------------------------------------------
| END MEETING FACILITATORS ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| STATUSES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-statuses', ['middleware' => 'resetLastActive', function () {
    return view('statuses.list');
}]);

Route::get('statuses-list', ['middleware' => 'resetLastActive', 'uses' => 'CasesStatusesController@index']);
Route::get('statuses/{id}', ['middleware' => 'resetLastActive', 'uses' => 'CasesStatusesController@edit']);
Route::post('updateCaseStatus', ['middleware' => 'resetLastActive', 'uses' => 'CasesStatusesController@update']);
Route::post('addCaseStatus', ['middleware' => 'resetLastActive', 'uses' => 'CasesStatusesController@store']);


/*
|--------------------------------------------------------------------------
| END STATUSES ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| PRIORITIES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-priorities', ['middleware' => 'resetLastActive', function () {
    return view('priorities.list');
}]);

Route::get('priorities-list', ['middleware' => 'resetLastActive', 'uses' => 'CasesPrioritiesController@index']);
Route::get('priorities/{id}', ['middleware' => 'resetLastActive', 'uses' => 'CasesPrioritiesController@edit']);
Route::post('updateCasePriority', ['middleware' => 'resetLastActive', 'uses' => 'CasesPrioritiesController@update']);
Route::post('addCasePriority', ['middleware' => 'resetLastActive', 'uses' => 'CasesPrioritiesController@store']);


/*
|--------------------------------------------------------------------------
| END PRIORITIES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| PROVINCES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-provinces', ['middleware' => 'resetLastActive', function () {
    return view('provinces.list');
}]);

Route::get('provinces-list', ['middleware' => 'resetLastActive', 'uses' => 'ProvincesController@index']);
Route::get('provinces/{id}', ['middleware' => 'resetLastActive', 'uses' => 'ProvincesController@edit']);
Route::post('updateProvince', ['middleware' => 'resetLastActive', 'uses' => 'ProvincesController@update']);
Route::post('addProvince', ['middleware' => 'resetLastActive', 'uses' => 'ProvincesController@store']);


/*
|--------------------------------------------------------------------------
| END PROVINCES ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| DISTRICS ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-districts/{province}', ['middleware' => 'resetLastActive', function ($province) {
    $provinceObj = Province::find($province);
    return view('districts.list', compact('provinceObj'));
}]);

Route::get('districts-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'DistricsController@index']);
Route::get('districts/{id}', ['middleware' => 'resetLastActive', 'uses' => 'DistricsController@edit']);
Route::post('updateDistrict', ['middleware' => 'resetLastActive', 'uses' => 'DistricsController@update']);
Route::post('addDistrict', ['middleware' => 'resetLastActive', 'uses' => 'DistricsController@store']);


/*
|--------------------------------------------------------------------------
| END DISTRICS ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| MUNICIPALITIES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-municipalities/{district}', ['middleware' => 'resetLastActive', function ($district) {
    $districtObj = District::find($district);
    $provinceObj = Province::find($districtObj->province);
    return view('municipalities.list', compact('districtObj', 'provinceObj'));
}]);


Route::get('municipalities-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'MunicipalitiesController@index']);
Route::get('municipalities/{id}', ['middleware' => 'resetLastActive', 'uses' => 'MunicipalitiesController@edit']);

Route::post('updateMunicipality', ['middleware' => 'resetLastActive', 'uses' => 'MunicipalitiesController@update']);
Route::post('addMunicipality', ['middleware' => 'resetLastActive', 'uses' => 'MunicipalitiesController@store']);

/*
|--------------------------------------------------------------------------
| END MUNICIPALITIES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| WARDS ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-wards/{municipality}', ['middleware' => 'resetLastActive', function ($municipality) {
    $municipalityObj = Municipality::find($municipality);
    $districtObj = District::find($municipalityObj->district);
    $provinceObj = Province::find($districtObj->province);
    return view('wards.list', compact('districtObj', 'municipalityObj', 'provinceObj'));
}]);


Route::get('wards-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'WardsController@index']);
Route::get('wards/{id}', ['middleware' => 'resetLastActive', 'uses' => 'WardsController@edit']);

Route::post('updateWard', ['middleware' => 'resetLastActive', 'uses' => 'WardsController@update']);
Route::post('addWard', ['middleware' => 'resetLastActive', 'uses' => 'WardsController@store']);

/*
|--------------------------------------------------------------------------
| END WARDS ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-categories/{department}', ['middleware' => 'resetLastActive', function ($department) {
    $deptObj = Department::find($department);
    return view('categories.list', compact('deptObj'));
}]);


Route::get('categories/{id}', ['middleware' => 'resetLastActive', 'uses' => 'CategoriesController@edit']);
Route::get('categories-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'CategoriesController@index']);
Route::post('updateCategory', ['middleware' => 'resetLastActive', 'uses' => 'CategoriesController@update']);
Route::post('addCategory', ['middleware' => 'resetLastActive', 'uses' => 'CategoriesController@store']);


/*
|--------------------------------------------------------------------------
| END CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| SUB-CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-sub-categories/{category}', ['middleware' => 'auth', function ($category) {
    $catObj = Category::find($category);
    $deptName = Department::find($catObj->department);
    return view('subcategories.list', compact('catObj', 'deptName'));
}]);

Route::get('subcategories/{id}', ['middleware' => 'resetLastActive', 'uses' => 'SubCategoriesController@edit']);
Route::get('sub-categories-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'SubCategoriesController@index']);
Route::post('updateSubCategory', ['middleware' => 'resetLastActive', 'uses' => 'SubCategoriesController@update']);
Route::post('addSubCategory', ['middleware' => 'resetLastActive', 'uses' => 'SubCategoriesController@store']);

/*
|--------------------------------------------------------------------------
| END SUB-CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| SUB-SUB-CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-sub-sub-categories/{sub_category}', ['middleware' => 'resetLastActive', function ($sub_category) {
    $subCatObj = SubCategory::find($sub_category);
    $catObj = Category::find($subCatObj->category);
    $deptObj = Department::find($catObj->department);
    return view('subsubcategories.list', compact('subCatObj', 'deptObj', 'catObj'));
}]);

Route::get('sub-sub-categories-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'SubSubCategoriesController@index']);
Route::get('subsubcategories/{id}', ['middleware' => 'resetLastActive', 'uses' => 'SubSubCategoriesController@edit']);
Route::post('addSubSubCategory', ['middleware' => 'resetLastActive', 'uses' => 'SubSubCategoriesController@store']);
Route::post('updateSubSubCategory', ['middleware' => 'resetLastActive', 'uses' => 'SubSubCategoriesController@update']);


/*
|--------------------------------------------------------------------------
| END SUB-SUB-CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| CASES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('cases-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@index']);
Route::get('case/{id}', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@edit']);
Route::get('workflows-list-case/{id}', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@workflow']);
Route::post('escalateCase', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@escalate']);
Route::post('allocateCase', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@allocate']);
Route::post('addCasePoi', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@addCasePoi']);
Route::post('addAssociatePoi', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@addAssociatePoi']);
Route::post('addCaseAssociatePoi', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@addCaseAssociatePoi']);
Route::post('addCaseAssociatePoiCase', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@addCaseAssociatePoiCase']);


Route::post('createCase', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@create']);
Route::post('createCaseAgent', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@createCaseAgent']);
Route::get('acceptCase/{id}', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@acceptCase']);
Route::get('addCaseForm', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@captureCase']);
Route::get('closeCase/{id}', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@closeCase']);
Route::post('requestCaseClosure', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@requestCaseClosure']);
Route::get('request-cases-closure-list', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@requestCaseClosureList']);
Route::get('resolved-cases-list', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@resolvedCasesList']);
Route::get('pending-referral-cases-list', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@pendingReferralCasesList']);
Route::post('captureCaseUpdate', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@captureCaseUpdate']);
Route::post('captureCaseUpdateH', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@captureCaseUpdateH']);
Route::get('relatedCases-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@relatedCases']);


/*
|--------------------------------------------------------------------------
| END CASES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| ADDRESSBOOK ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('addressbook-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'AddressBookController@index']);
Route::post('addContact', ['middleware' => 'resetLastActive', 'uses' => 'AddressBookController@store']);
Route::get('getContacts', ['middleware' => 'resetLastActive', 'uses' => 'AddressBookController@show']);
Route::get('getPoisContacts', ['middleware' => 'resetLastActive', 'uses' => 'UserController@searchPOI']);


/*
|--------------------------------------------------------------------------
| END ADDRESSBOOK ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| RELATIONSHIP ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| POSITIONS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-relationships', ['middleware' => 'resetLastActive', function () {
    return view('relationships.list');

}]);

Route::get('relationships-list', ['middleware' => 'resetLastActive', 'uses' => 'RelationshipController@index']);
Route::get('relationships/{id}', ['middleware' => 'resetLastActive', 'uses' => 'RelationshipController@edit']);
Route::post('updateRelationship', ['middleware' => 'resetLastActive', 'uses' => 'RelationshipController@update']);
Route::post('addRelationship', ['middleware' => 'resetLastActive', 'uses' => 'RelationshipController@store']);


/*
|--------------------------------------------------------------------------
| END POSITIONS ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| END RELATIONSHIP ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| RESPONDERS ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('getsubSubResponders/{id}', ['middleware' => 'resetLastActive', 'uses' => 'RespondersController@subSubResponder']);
Route::post('addSubSubCategoryResponder', ['middleware' => 'resetLastActive', 'uses' => 'RespondersController@storeSubSubResponder']);
Route::get('getSubResponders/{id}', ['middleware' => 'resetLastActive', 'uses' => 'RespondersController@subResponder']);
Route::post('addSubCategoryResponder', ['middleware' => 'resetLastActive', 'uses' => 'RespondersController@storeSubResponder']);
Route::get('caseResponders-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'RespondersController@index']);


/*
|--------------------------------------------------------------------------
| END RESPONDERS ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| WORKFLOWS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('workflows-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'WorkflowsController@index']);
Route::get('saveWorkFlowOrder', ['middleware' => 'resetLastActive', 'uses' => 'WorkflowsController@saveWorkFlowOrder']);
Route::post('AddWorkF', ['middleware' => 'resetLastActive', 'uses' => 'WorkflowsController@store']);
Route::post('removeWorkFlow', ['middleware' => 'resetLastActive', 'uses' => 'WorkflowsController@removeWorkFlow']);


/*
|--------------------------------------------------------------------------
| END WORKFLOWS ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| CASE NOTES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('caseNotes-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'CaseNotesController@index']);
Route::get('poi-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'CasesController@list_case_poi']);

Route::post('addCaseNote', ['middleware' => 'resetLastActive', 'uses' => 'CaseNotesController@store']);


/*
|--------------------------------------------------------------------------
| END CASE NOTES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| CASE FILES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::post('addCaseFile', ['middleware' => 'resetLastActive', 'uses' => 'CaseFilesController@store']);
Route::get('fileDescription/{id}/{name}', ['middleware' => 'resetLastActive', 'uses' => 'CaseFilesController@index']);


/*
|--------------------------------------------------------------------------
| END CASE FILES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| CASE ACTIVITIES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('caseActivities-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'CaseActivitiesController@index']);

/*
|--------------------------------------------------------------------------
| END CASE ACTIVITIES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| POSITIONS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-positions', ['middleware' => 'resetLastActive', function () {
    return view('positions.list');
}]);

Route::get('positions-list', ['middleware' => 'resetLastActive', 'uses' => 'PositionsController@index']);
Route::get('positions/{id}', ['middleware' => 'resetLastActive', 'uses' => 'PositionsController@edit']);
Route::post('updatePosition', ['middleware' => 'resetLastActive', 'uses' => 'PositionsController@update']);
Route::post('addPosition', ['middleware' => 'resetLastActive', 'uses' => 'PositionsController@store']);

Route::get('getPositions', ['middleware' => 'resetLastActive', 'uses' => 'PositionsController@show']);


/*
|--------------------------------------------------------------------------
| END POSITIONS ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| CALENDAR ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('calendar', ['middleware' => 'resetLastActive', 'uses' => 'CalendarController@index']);
Route::post('getEvents', ['middleware' => 'resetLastActive', 'uses' => 'CalendarController@show']);


/*
|--------------------------------------------------------------------------
| END CALENDAR ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| CASE OWNERS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('caseOwner/{user}/{id}', ['middleware' => 'resetLastActive', 'uses' => 'CaseOwnerController@index']);


/*
|--------------------------------------------------------------------------
| CASE OWNERS ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
|  PASSWORD  ROUTING
|--------------------------------------------------------------------------
|
*/


Route::get('resend_password/{id}', 'UserController@resendPassword');
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');


// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

/*
|--------------------------------------------------------------------------
|  END PASSWORD  ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| REPORTS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('reports', ['middleware' => 'resetLastActive', function () {
    return view('reports.list');
}]);

Route::get('reports-list', ['middleware' => 'resetLastActive', 'uses' => 'ReportsController@index']);
Route::post('filterReports', ['middleware' => 'resetLastActive', 'uses' => 'ReportsController@show']);


/*
|--------------------------------------------------------------------------
| END REPORTS ROUTING
|--------------------------------------------------------------------------
|
*/


$router->resource('users', 'UserController');

Route::get('/api/dropdown/{to}/{from}', function ($to, $from) {
    $name = Input::get('option');

    if ($from == 'province') {
        $object = Province::where('slug', '=', $name)->first();
    }
    if ($from == 'district') {
        $object = District::where('slug', '=', $name)->first();
    }

    if ($from == 'municipality') {
        $object = Municipality::where('slug', '=', $name)->first();
        $listing = DB::table($to)->where($from, $object->id)->lists('name', 'slug');

    } else {

        $listing = DB::table($to)->where($from, $object->id)->orderBy('name', 'ASC')->lists('name', 'slug');
    }


    return $listing;

});

Route::get('/api/dropdownDepartment/{to}/{from}', function ($to, $from) {

    $name = Input::get('option');

    if ($from == 'department') {
        $object = Department::where('slug', '=', $name)->first();
        $listing = DB::table('categories')
            ->where('department', '=', $object->id)
            ->orderBy('name', 'ASC')
            ->lists('name', 'slug');
    }

    if ($from == 'category') {
        $object = Category::where('slug', '=', $name)->first();
        $listing = DB::table('sub_categories')
            ->where('category', '=', $object->id)
            ->orderBy('name', 'ASC')
            ->lists('name', 'slug');
    }

    if ($from == 'sub_category') {
        $object = SubCategory::where('slug', '=', $name)->first();
        $listing = DB::table('sub_sub_categories')
            ->where('sub_category', '=', $object->id)
            ->orderBy('name', 'ASC')
            ->lists('name', 'slug');
    }

    return $listing;
});

Route::get('/api/dropdownCaseType/{to}/{from}', function ($to, $from) {

    $id = Input::get('option');

    if ($from == 'case_type') {
        $object = CaseType::where('id', '=', $id)->first();
        $listing = DB::table('cases_sub_types')
            ->where('case_type', '=', $object->id)
            ->orderBy('name', 'ASC')
            ->lists('name', 'id');
    }

    return $listing;
});

Route::get('/api/dropdownCategory/{to}/{from}', function ($to, $from) {

    $name = Input::get('option');

    if ($from == 'category') {
        $object = Category::where('slug', '=', $name)->first();
    } else {

        $object = SubCategory::where('slug', '=', $name)->first();

    }

    if ($from == 'category') {
        $listing = DB::table('sub-categories')
            ->where('category', '=', $object->id)
            ->orderBy('name', 'ASC')
            ->lists('name', 'slug');

    } else {

        $listing = DB::table('sub-sub-categories')
            ->where('sub_category', '=', $object->id)
            ->orderBy('name', 'ASC')
            ->lists('name', 'slug');
    }

    return $listing;
});


Route::get('/api/dropdown/{table}', function ($table) {

    $listing = DB::table($table)->orderBy('name', 'ASC')->lists('name', 'id');

    return $listing;

});


Route::post('postChat', ['middleware' => 'auth', 'uses' => 'ChatController@postChat']);


Event::listen('auth.login', function () {
    $user = User::find(\Auth::user()->id);
    $user->availability = 1;
    $user->last_login = new DateTime;
    $user->save();
});

Event::listen('auth.logout', function () {
    $user = User::find(\Auth::user()->id);
    $user->availability = 0;
    $user->last_logout = new DateTime;
    $user->save();
});


Route::get('getLoggedInUsers', function () {

    $allUsers = User::where('id', '<>', \Auth::user()->id)->orderBy('availability', 'desc')->get();
    $html = "";

    foreach ($allUsers as $user) {

        $availability = ($user->availability == 1) ? "<i class='fa fa-circle-o status m-r-5'></i>" : "<i class='fa fa-circle-o offline m-r-5'></i>";
        $html .= "<div class='media'>";
        $html .= "<a href='#' onClick='chatStart(this)' class='chatWith' data-userid = '$user->id' data-names = '$user->name $user->surname'> <img class='pull-left' src='img/profile-pics/7.png' width='30' alt=''></a>";
        $html .= "<div class='media-body'>";
        $html .= "<span class='t-overflow p-t-5'>$user->name  $user->surname $availability</span>";
        $html .= "</div>";
        $html .= "</div>";

    }
    return $html;

});


/*
|--------------------------------------------------------------------------
| CASE MESSAGE ROUTING
|--------------------------------------------------------------------------
|
*/

Route::post('addCaseMessage', ['middleware' => 'resetLastActive', 'uses' => 'MessageController@store']);

Route::get('/getOfflineMessage', function () {

    $offlineMessages = Message::where('to', '=', \Auth::user()->id)
        ->where('online', '=', 0)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    $html = "";

    foreach ($offlineMessages as $message) {

        $user = User::where('id', '=', $message->from)->first();
        $read = ($message->read == 0) ? "<span class='label label-danger'>New</span>" : "";
        $html .= "<div class='media'>";
        $html .= "<div class='pull-left'>";
        $html .= "<a href='#' onClick='chatStart(this)'> <img class='pull-left' src='img/profile-pics/7.png' width='30' alt=''></a>";
        $html .= "</div>";
        $html .= "<div class='media-body'>";
        $html .= "<small class='text-muted'>$user->name  $user->surname - $message->created_at</small> $read<br>";
        $html .= "<a class='t-overflow' href='message-detail/$message->id'>$message->message .Ref:Case ID $message->caseId</a>";
        $html .= "</div>";
        $html .= "</div>";

    }
    return $html;

});

Route::get('message-detail/{id}', 'MessageController@edit');
Route::get('all-messages', 'MessageController@index');


/*
|--------------------------------------------------------------------------
| END CASE MESSAGE ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| AFFILIATIONS ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-affiliations', ['middleware' => 'resetLastActive', function () {
    return view('affiliations.list');
}]);

Route::get('list-affiliation-positions/{affiliation}', ['middleware' => 'resetLastActive', function ($affiliation) {

    $affiliationObj = Affiliation::find($affiliation);

    return view('affiliations.positions', compact('affiliationObj'));
}]);

Route::get('affiliations-list', ['middleware' => 'resetLastActive', 'uses' => 'AffiliationsController@index']);
Route::get('affiliations/{id}', ['middleware' => 'resetLastActive', 'uses' => 'AffiliationsController@edit']);
Route::get('affiliation-positions/{id}', ['middleware' => 'resetLastActive', 'uses' => 'AffiliationsController@getAffiliationPositions']);
Route::post('updateAffiliation', ['middleware' => 'resetLastActive', 'uses' => 'AffiliationsController@update']);
Route::post('addAffiliation', ['middleware' => 'resetLastActive', 'uses' => 'AffiliationsController@store']);
Route::post('addAffiliationPosition', ['middleware' => 'resetLastActive', 'uses' => 'AffiliationsController@addAffiliationPosition']);


/*
|--------------------------------------------------------------------------
| END PRIORITIES ROUTING
|--------------------------------------------------------------------------
|
*/


Route::get('list-permissions', ['middleware' => 'resetLastActive', function () {
    return view('permissions.list');
}]);

Route::get('permissions-list', ['middleware' => 'resetLastActive', 'uses' => 'PermissionController@index']);


Route::get('permissions/{id}', ['middleware' => 'resetLastActive', 'uses' => 'PermissionController@edit']);


Route::post('updatePermission', ['middleware' => 'resetLastActive', 'uses' => 'PermissionController@update']);


Route::get('permissions-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'PermissionController@list_permissions']);


Route::get('getPermissions', ['middleware' => 'resetLastActive', 'uses' => 'PermissionController@show']);

Route::post('addGroupPermission', ['middleware' => 'resetLastActive', 'uses' => 'PermissionController@storeGroupPermissions']);

Route::post('removeGroupPermission', ['middleware' => 'resetLastActive', 'uses' => 'PermissionController@removeGroupPermission']);


Route::get('list-permissions-per-group/{group}', ['middleware' => 'resetLastActive', function ($group) {
    //$deptObj = Department::find($department);


    return view('permissions.group', compact('group', $group));
}]);

Route::get('group-users-list/{id}', ['middleware' => 'resetLastActive', 'uses' => 'PermissionController@group_users_list']);


Route::get('map', ['middleware' => 'resetLastActive', 'uses' => 'MapController@index']);


Route::get('poimap/{id}', ['middleware' => 'resetLastActive', 'uses' => 'UserController@poimap']);



Route::post('session/ajaxCheck', ['uses' => 'SessionController@ajaxCheck', 'as' => 'session.ajax.check']);

Route::post('resetSession', ['uses' => 'SessionController@resetSession', 'as' => 'resetSession']);


/*Route::get('list-forms/{id?}', ['middleware' => 'resetLastActive', function ($id = null) {
    return view('forms.list', compact('id', $id));
}]);
Route::get('list-forms', ['middleware' => 'resetLastActive', function () {
    return view('forms.list');
}]);*/
Route::get('list-forms/{id?}', ['middleware' => 'resetLastActive', 'uses' => 'FormsController@list_forms']);
Route::get('forms-list', ['middleware' => 'resetLastActive', 'uses' => 'FormsController@index']);
Route::get('forms/{id}', ['middleware' => 'resetLastActive', 'uses' => 'FormsController@edit']);
Route::post('addForm', ['middleware' => 'resetLastActive', 'uses' => 'FormsController@store']);
Route::post('assignForm', ['middleware' => 'resetLastActive', 'uses' => 'FormsController@assign']);
Route::get('closeAssigned/{id}', ['middleware' => 'resetLastActive', 'uses' => 'FormsController@closeAssigned']);
Route::post('updateForm', ['middleware' => 'resetLastActive', 'uses' => 'FormsController@update']);

Route::get('forms/assigned/{uid}', ['middleware' => 'resetLastActive', 'uses' => 'FormsController@assigned']);

Route::get('forms/database/tables', ['middleware' => 'resetLastActive', 'uses' => 'DatabaseController@getTables']);
Route::get('forms/database/tables/{name}', ['middleware' => 'resetLastActive', 'uses' => 'DatabaseController@getTable']);
Route::get('forms/database/tables/{name}/{form_id}', ['middleware' => 'resetLastActive', 'uses' => 'DatabaseController@getTable']);
Route::get('forms/database/data/{form_id}', ['middleware' => 'resetLastActive', 'uses' => 'DatabaseController@getData']);
/*Route::get('list-formsdata', ['middleware' => 'resetLastActive', function () {
    return view('forms.listdata');
}]);*/
//Route::get('list-formsdata', ['middleware' => 'resetLastActive', 'uses' => 'FormsDataController@index']);
//Route::get('formsdata-list', ['middleware' => 'resetLastActive', 'uses' => 'FormsDataController@index']);
Route::any('list-formsdata/{form_id}', ['middleware' => 'resetLastActive', 'uses' => 'FormsDataController@anyFormId'])->where('form_id', '[0-9]+');
Route::controller('list-formsdata', 'FormsDataController', array('getData'=>'formsdata.data','anyIndexx'=>"list-formss"));
Route::get('forms/data/{id}/{form_id?}', ['middleware' => 'resetLastActive', 'uses' => 'FormsDataController@edit']);
Route::post('updateFormData', ['middleware' => 'resetLastActive', 'uses' => 'FormsDataController@update']);



//Route::controller('formsdata', 'FormsDataController');

/*Route::controller('datatables', 'DataTablesController', [
    'anyData'  => 'datatables.data',
    'getIndex' => 'datatables',
]);*/
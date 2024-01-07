<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Instation;
use App\Models\JobModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $start = $now->subDay(7)->toDateString() . ' 00:00:00';
        $applies = Apply::where('created_at', '>', $start)->get();

        $dates = $applies->pluck('created_at');
        $dates = $dates->map(function($map){
            return  $map->toDateString();
        })->sort();
        $days = $dates->countBy(function(string $key){
            return $key;
        });
        $result_days = $days->all();
        $grafik['label'] = $this->mergeArray(array_keys($result_days));
        $grafik['value'] = $this->mergeArray(array_values($result_days));
        
        $users = User::all();
        $type = $users->pluck('type');

        $count_users = $users->map(function($user) use($type){
            $counted = $type->countBy(function(string $key){
                return $key;
            });

            return (object) $counted->all();
        })->first();

        $instation = Instation::count();
        return view('admin.dashboard', compact(
            'count_users',
            'instation',
            'grafik'
        ));
    }

    protected function mergeArray($array)
    {
        $result= [];
        foreach ($array as $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->mergeArray($value));
            } else {
                $result[] = $value;
            }
        }

        return implode(',', $result);
    }
}

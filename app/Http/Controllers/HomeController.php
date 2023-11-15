<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data=[];

        $year = date("Y");
        $month = date("m");
        $current_ticket = Ticket::whereYear('start_time', $year)->whereMonth('start_time', $month)->whereNotNull('end_time')->count();

        $total_duration_start_end = Ticket::whereYear('start_time', $year)->whereMonth('start_time', $month)->whereNotNull('end_time')->get()->sum('duration_start_end');
        $avg_start_end = CEIL($total_duration_start_end/$current_ticket);

        $total_duration_start_pic = Ticket::whereYear('start_time', $year)->whereMonth('start_time', $month)->whereNotNull('end_time')->get()->sum('duration_start_pic');
        $avg_start_pic = CEIL($total_duration_start_pic/$current_ticket);

        $total_duration_pic_end = Ticket::whereYear('start_time', $year)->whereMonth('start_time', $month)->whereNotNull('end_time')->get()->sum('duration_pic_end');
        $avg_pic_end = CEIL($total_duration_pic_end/$current_ticket);

        $data['avg_start_end_time'] = gmdate("H:i:s", $avg_start_end);
        $data['diff_avg_start_end_time'] = "+00:00:03";
        $data['avg_start_pic_time'] = gmdate("H:i:s", $avg_start_pic);
        $data['diff_avg_start_pic_time'] = "-00:00:03";
        $data['avg_pic_end_time'] = gmdate("H:i:s", $avg_pic_end);
        $data['diff_avg_pic_end_time'] = "-00:00:03";
        $data['current_open_ticket'] = Ticket::whereYear('start_time', $year)->whereMonth('start_time', $month)->whereStatus('Open')->count();

        $pic_labels = Ticket::whereYear('start_time', $year)->whereMonth('start_time', $month)->select('pic')->groupBy('pic')->get()->pluck('pic')->toArray();
        $pic_count = Ticket::whereYear('start_time', $year)->whereMonth('start_time', $month)->select(DB::raw('count(id) as tot_pic'))->groupBy('pic')->get()->pluck('tot_pic')->toArray();

        $data['pic_count'] = [
            "labels" => $pic_labels,
            "value" => $pic_count
        ];

        $rating_labels = Ticket::whereYear('start_time', $year)->whereMonth('start_time', $month)->select('rate')->groupBy('rate')->get()->pluck('rate')->toArray();
        $rating_count = Ticket::whereYear('start_time', $year)->whereMonth('start_time', $month)->select(DB::raw('count(id) as tot_rate'))->groupBy('rate')->get()->pluck('tot_rate')->toArray();

        $data['rating_count'] = [
            "labels" => $rating_labels,
            "value" => $rating_count
        ];
        $category_labels = Ticket::whereYear('start_time', $year)->whereMonth('start_time', $month)->select('category')->groupBy('category')->pluck('category')->toArray();

        $ticket_per_category  = [];
        // \Log::info($category_labels);
        $i = 0;
        foreach($category_labels as $cat){
            $color = $this->getRandomColor(1);
            $ticket_per_category[$i]["label"] = $cat != null ? $cat : "Null";
            $ticket_per_category[$i]["fill"] = true;
            $ticket_per_category[$i]["backgroundColor"] = $color[0];
            $ticket_per_category[$i]["borderColor"] = $color[0];
            $ticket_per_category[$i]["data"] = $this->getDataMonthly($cat);
            $i++;
        }
        $data['ticket_per_category'] = $ticket_per_category;

        $min_max_resolution_time = $this->getMinMaxResolutionTime($year);
        $data['min_max_resolution_time'] = $min_max_resolution_time;
        $data['min_resolution_time'] = $this->getMinResolutionTime($year);
        $data['max_resolution_time'] = $this->getMaxResolutionTime($year);

        // \Log::info($data);
        return view('home', compact('data'));
    }

    public function getRandomColor($count){
        $arr = [];
        $colors = [];
        for ($i = 0; $i < $count; $i++) {
            $letters = explode(',','0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F');
            $color = '#';
            for ($x = 0; $x < 6; $x++) {
                // \Log::info(floor(rand(0,15)));
                $color .= $letters[floor(rand(0,15))];
            }
            $colors[] = $color;
        }
        return $colors;
    }

    public function getDataMonthly($cat){
        $arr_month = [
            0,0,0,0,0,0,0,0,0,0,0,0,
        ];
        $ticket = Ticket::where('category', $cat)->select(DB::raw('MONTH(start_time) as bulan'), DB::raw('count(id) as total'))->groupBy( DB::raw('MONTH(start_time)'))->get()->pluck('total', 'bulan');

        foreach($ticket as $key => $value){
            $arr_month[($key-1)] = $value;
        }
        return $arr_month;       
    }

    public function getMinMaxResolutionTime($year){
        $min_max_resolution_time = [[0,0],[0,0],[0,0],[0,0],[0,0],[0,0],[0,0],[0,0],[0,0],[0,0],[0,0],[0,0]];
        $months = Ticket::whereYear('start_time', $year)->whereNotNull('end_time')->select(DB::raw('month(start_time) as m'))->groupBy(DB::raw('month(start_time)'))->get();
        $arr_duration = [];
        foreach($months as $m){
            $this_month = Ticket::whereYear('start_time', $year)->whereMonth('start_time', $m->m)->get();
            foreach($this_month as $data){
                $month = $m->m - 1;
                $arr_duration[$month][] = $data->duration_start_end;
            }
        }
        // \Log::info($arr_duration);
        $min = [];
        $max = [];
        foreach($arr_duration as $m => $dur){
            sort($dur);
            $min[$m] = min($dur);
            $max[$m] = max($dur);
            $minm = $min[$m];
            $maxm = $max[$m];
            if($maxm == $minm){
                $minm = 0;
            }
            $min_max_resolution_time[$m] = [round($minm/60,2), round($maxm/60,2)];
        }

        return $min_max_resolution_time;
    }

    
    public function getMinResolutionTime($year){
        $min_resolution_time = [0,0,0,0,0,0,0,0,0,0,0,0];
        $months = Ticket::whereYear('start_time', $year)->whereNotNull('end_time')->select(DB::raw('month(start_time) as m'))->groupBy(DB::raw('month(start_time)'))->get();
        $arr_duration = [];
        foreach($months as $m){
            $this_month = Ticket::whereYear('start_time', $year)->whereMonth('start_time', $m->m)->get();
            foreach($this_month as $data){
                $month = $m->m - 1;
                $arr_duration[$month][] = $data->duration_start_end;
            }
        }
        // \Log::info($arr_duration);
        $min = [];
        $max = [];
        foreach($arr_duration as $m => $dur){
            sort($dur);
            $min[$m] = min($dur);
            $max[$m] = max($dur);
            $minm = $min[$m];
            $maxm = $max[$m];
            if($maxm == $minm){
                $minm = 0;
            }
            $min_resolution_time[$m] = round($minm/60,2);
        }

        return $min_resolution_time;
    }

    
    public function getMaxResolutionTime($year){
        $max_resolution_time = [0,0,0,0,0,0,0,0,0,0,0,0];
        $months = Ticket::whereYear('start_time', $year)->whereNotNull('end_time')->select(DB::raw('month(start_time) as m'))->groupBy(DB::raw('month(start_time)'))->get();
        $arr_duration = [];
        foreach($months as $m){
            $this_month = Ticket::whereYear('start_time', $year)->whereMonth('start_time', $m->m)->get();
            foreach($this_month as $data){
                $month = $m->m - 1;
                $arr_duration[$month][] = $data->duration_start_end;
            }
        }
        // \Log::info($arr_duration);
        $min = [];
        $max = [];
        foreach($arr_duration as $m => $dur){
            sort($dur);
            $min[$m] = min($dur);
            $max[$m] = max($dur);
            $minm = $min[$m];
            $maxm = $max[$m];
            if($maxm == $minm){
                $minm = 0;
            }
            $max_resolution_time[$m] = round($maxm/600,2);
        }

        return $max_resolution_time;
    }
}

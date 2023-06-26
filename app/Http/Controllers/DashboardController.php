<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Charts\exampleChart;
use App\Models\Commit;
use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        if (Auth::check()) {
            // The user is logged in...

            $tot_projs = Project::count();
            $comp_projs = Project::where('status', 'Completed')->count();
            $curr_projs = Project::where('status', 'Active')->count();

            $active_projs = Project::where('status', 'Active')
                ->take(4)
                ->get();

            foreach ($active_projs as $proj) {

                $tot_tasks = Task::where('project_id', $proj->project_id)->count();
                $tot_members = Team::where('project_id', $proj->project_id)->count();
                $tot_commits = Commit::where('project_id', $proj->project_id)->count();
                $proj->tot_tasks = $tot_tasks;
                $proj->tot_members = $tot_members;
                $proj->tot_commits = $tot_commits;
            }

            $data = $active_projs
                ->map(function ($item) {
                    // Return the number of persons with that age
                    return $item['tot_tasks'];
                });
            $data2 = $active_projs
                ->map(function ($item) {
                    // Return the number of persons with that age
                    return $item['tot_commits'];
                });
            $data3 = $active_projs
                ->map(function ($item) {
                    // Return the number of persons with that age
                    return $item['tot_members'];
                });

            $labels = $active_projs
                ->map(function ($item) {
                    // Return the number of persons with that age
                    return $item['project_name'];
                });


            $chart = new exampleChart;
            $chart->labels($labels->values());
            $chart->dataset('Total Tasks', 'line', $data->values());
            $chart->dataset('Total Commits', 'line', $data2->values());
            $chart->dataset('Total Members', 'line', $data3->values());
            $chart->options([
                'tooltip' => [
                    'show' => true // or false, depending on what you want.
                ]
            ]);
            return view('welcome', [
                'session' => $request->session()->all(),
                'chart' => $chart,
                'tot_projs' => $tot_projs,
                'comp_projs' => $comp_projs,
                'curr_projs' => $curr_projs,
                'active_projs' => $active_projs

            ]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Kpi\KpiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $kpiController = new KpiController();

        $data = ['user' => $user];

        if ($user->role_id == 2) {
            $kpiData = $kpiController->getCoordinatorKpis();
            $data = array_merge($data, $kpiData);
        } elseif ($user->role_id == 3) {
            $kpiData = $kpiController->getProgramHeadKpis($user->program_id);
            $data = array_merge($data, $kpiData);
        } else {
            // Para otros roles, por ahora enviamos vacío o lo que retorne getKpisUser si tuviera lógica
            $kpisUser = $kpiController->getKpisUser($user->id);
            $data['kpisUser'] = $kpisUser;
        }

        return view('panel.dashboard', $data);
    }
}

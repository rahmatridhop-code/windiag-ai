<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Models\Hypothesis;
use App\Models\Rule;

class DiagnosisController extends Controller
{
    public function index()
    {
        $symptoms = Symptom::all();
        $rules = Rule::with(['hypothesis', 'symptom'])->get();
        $activeTab = 'beranda';

        return view('diagnosis.index', compact('symptoms', 'rules', 'activeTab'));
    }

    public function analyze(Request $request)
    {
        $userInputs = $request->input('symptoms', []);
        $selectedSymptoms = array_filter($userInputs, fn($val) => floatval($val) > 0);

        $symptoms = Symptom::all();
        $rules = Rule::with(['hypothesis', 'symptom'])->get();
        $activeTab = 'konsultasi';

        if (empty($selectedSymptoms)) {
            return view('diagnosis.index', compact('symptoms', 'rules', 'activeTab'))
                ->with('error', 'Silakan pilih minimal satu gejala terlebih dahulu!');
        }

        $hypotheses = Hypothesis::with('rules.symptom')->get();
        $results = [];

        foreach ($hypotheses as $hypothesis) {
            $cfCombine = 0;
            $steps = [];

            foreach ($hypothesis->rules as $rule) {
                $symptomId = $rule->symptom_id;

                if (isset($selectedSymptoms[$symptomId])) {
                    $cfUser = floatval($selectedSymptoms[$symptomId]);
                    $cfPakar = floatval($rule->cf_pakar);
                    $cfTunggal = $cfPakar * $cfUser;

                    if ($cfCombine == 0) {
                        $cfCombine = $cfTunggal;
                        $steps[] = "CF({$rule->symptom->code}) = {$cfPakar} × {$cfUser} = " . number_format($cfTunggal, 4);
                    } else {
                        $prevCf = $cfCombine;
                        $cfCombine = $prevCf + $cfTunggal * (1 - $prevCf);
                        $steps[] = "CF({$rule->symptom->code}) = {$cfPakar} × {$cfUser} = " . number_format($cfTunggal, 4) .
                                   " → CF_combine = " . number_format($prevCf, 4) . " + " . number_format($cfTunggal, 4) .
                                   " × (1 - " . number_format($prevCf, 4) . ") = " . number_format($cfCombine, 4);
                    }
                }
            }

            if ($cfCombine > 0) {
                $results[] = [
                    'code' => $hypothesis->code,
                    'name' => $hypothesis->name,
                    'category' => $hypothesis->category,
                    'solution' => $hypothesis->solution,
                    'cf_final' => $cfCombine,
                    'percentage' => round($cfCombine * 100, 1),
                    'steps' => $steps
                ];
            }
        }

        usort($results, fn($a, $b) => $b['cf_final'] <=> $a['cf_final']);

        return view('diagnosis.index', compact('symptoms', 'rules', 'results', 'selectedSymptoms', 'activeTab'));
    }
}
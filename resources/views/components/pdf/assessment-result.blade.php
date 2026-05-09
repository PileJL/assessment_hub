<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; color: #0F1729; line-height: 1.4; }
        .header { text-align: center; border-bottom: 2px solid #0f2156; padding-bottom: 10px; }
        .status { padding: 10px; margin: 20px 0; border-radius: 8px; text-align: center; font-weight: bold; font-size: 18px; }
        .passed { background: #dcfce7; color: #166534; }
        .failed { background: #fee2e2; color: #991b1b; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { text-align: left; color: #65758B; font-size: 11px; text-transform: uppercase; border-bottom: 1px solid #e2e8f0; padding: 8px; }
        td { padding: 8px; border-bottom: 1px solid #f1f5f9; font-size: 13px; }
        .score { text-align: right; font-weight: bold; }
        .section-title { margin-top: 25px; font-size: 15px; font-weight: bold; color: #0f2156; background: #f8fafc; padding: 5px 8px; border-radius: 4px; }
        .label { color: #64748b; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin-bottom: 5px;">BPEd Assessment Result</h1>
        <p style="margin: 0; font-size: 12px; color: #64748b;">Generated on {{ now()->format('M d, Y h:i A') }}</p>
    </div>

    <div class="status {{ $applicant->isPassed ? 'passed' : 'failed' }}">
        {{ $applicant->isPassed ? 'OVERALL STATUS: PASSED' : 'OVERALL STATUS: DID NOT PASS' }}
    </div>

    <table style="margin-bottom: 20px;">
        <tr>
            <td style="border: none; width: 50%"><span class="label">NAME:</span> <br><strong>{{ $applicant->fullName }}</strong></td>
            <td style="border: none; width: 50%; text-align: right;"><span class="label">APPLICANT ID:</span> <br><strong>{{ $applicant->applicantID }}</strong></td>
        </tr>
    </table>

    {{-- BMI Section --}}
    <div class="section-title">BMI Assessment</div>
    <table>
        <tr><td>Height</td><td class="score">{{ $applicant->height }} m</td></tr>
        <tr><td>Weight</td><td class="score">{{ $applicant->weight }} kg</td></tr>
        <tr><td>BMI Value</td><td class="score">{{ number_format($applicant->weight / ($applicant->height * $applicant->height), 2) }}</td></tr>
        <tr><td><strong>Classification</strong></td><td class="score" style="color: #0f2156;">{{ (new class { use \App\Utilities; })->getBMICategory($applicant->weight, $applicant->height) }}</td></tr>
    </table>

    {{-- Skills Section --}}
    <div class="section-title">Skills-Related Fitness</div>
    <table>
        <thead><tr><th>Test</th><th style="text-align: right">Score</th></tr></thead>
        <tbody>
            <tr><td>Agility T-Test</td><td class="score">{{ $applicant->skillsFitness->agilityTtestResult }}s</td></tr>
            <tr><td>Standing Long Jump</td><td class="score">{{ $applicant->skillsFitness->standingLongJumpResult }}cm</td></tr>
            <tr><td>Hexagon Agility Test</td><td class="score">{{ $applicant->skillsFitness->hexagonAgilityResult }}s</td></tr>
            <tr><td>40-Yard Dash</td><td class="score">{{ $applicant->skillsFitness->fortyYardDashResult }}s</td></tr>
            <tr><td>Stork Balance Stand</td><td class="score">{{ $applicant->skillsFitness->storkBalanceStandResult }}s</td></tr>
        </tbody>
    </table>

    {{-- Health Section --}}
    <div class="section-title">Health-Related Fitness</div>
    <table>
        <thead><tr><th>Test</th><th style="text-align: right">Score</th></tr></thead>
        <tbody>
            <tr><td>Push-ups</td><td class="score">{{ $applicant->healthFitness->pushUpsResult }} reps</td></tr>
            <tr><td>Sit and Reach</td><td class="score">{{ $applicant->healthFitness->sitAndReachResult }}cm</td></tr>
            <tr><td>3-Min Step Test</td><td class="score">{{ $applicant->healthFitness->threeMinStepResult }} bpm</td></tr>
            <tr><td>Plank</td><td class="score">{{ $applicant->healthFitness->plankTestResult }}s</td></tr>
        </tbody>
    </table>
</body>
</html>
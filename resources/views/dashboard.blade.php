@extends('layout')

@section('content')
<div class="card p-4">
    <h3>G-Scores Dashboard</h3>
    <p>Welcome to <strong>G-Scores</strong>, the exam results management system for the 2024 national high school exam.</p>

    <h4 class="mt-3">Features:</h4>
    <ul>
        <li><strong>Import Data:</strong> Convert raw exam data (<code>diem_thi_thpt_2024.csv</code>) into the database using migrations and seeders.</li>
        <li><strong>Search Scores:</strong> Look up student scores by registration number.</li>
        <li><strong>Score Reports:</strong>
            <ul>
                <li>Categorize students into four levels: <strong>>= 8</strong>, <strong>6 - 7.9</strong>, <strong>4 - 5.9</strong>, <strong>< 4</strong>.</li>
                <li>View statistics for each subject using interactive charts.</li>
            </ul>
        </li>
        <li><strong>Top 10 Students in Group A:</strong> Identify the highest-scoring students in Math, Physics, and Chemistry.</li>
    </ul>

    <h4 class="mt-3">Technical Stack:</h4>
    <ul>
        <li><strong>Frontend:</strong> HTML, CSS, JavaScript.</li>
        <li><strong>Backend:</strong> Laravel (PHP) with MySQL.</li>
        <li><strong>Database:</strong> MySQL for storing student scores and reports.</li>
    </ul>

    <h4 class="mt-3">Source Code:</h4>
    <ul>
        <li><strong>GitHub Repository:</strong> <a href="https://github.com/lyhtc/GScore" target="_blank">https://github.com/lyhtc/GScore</a></li>
    </ul>

    <p class="mt-4"><strong>Explore the system and manage student scores efficiently!</strong></p>
</div>
@endsection

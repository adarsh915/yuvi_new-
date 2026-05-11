<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Submissions Report</title>
    <style>
        :root {
            --border: #d7dde6;
            --text: #1f2937;
            --muted: #6b7280;
            --brand: #1d4ed8;
            --bg: #f8fafc;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--text);
            background: #fff;
        }
        .page {
            padding: 24px;
        }
        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--brand);
        }
        .report-header h1 {
            font-size: 24px;
            margin: 0 0 6px;
        }
        .report-header p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
        }
        .meta {
            font-size: 13px;
            color: var(--muted);
            text-align: right;
        }
        .submission {
            margin-bottom: 24px;
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            page-break-inside: avoid;
        }
        .submission__head {
            background: var(--bg);
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
        }
        .submission__head strong {
            display: block;
            font-size: 16px;
            margin-bottom: 4px;
        }
        .submission__head span {
            color: var(--muted);
            font-size: 13px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px 18px;
            padding: 16px;
            border-bottom: 1px solid var(--border);
        }
        .info-item label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 4px;
            letter-spacing: .04em;
        }
        .info-item div {
            font-size: 14px;
        }
        .answers {
            width: 100%;
            border-collapse: collapse;
        }
        .answers th,
        .answers td {
            border-top: 1px solid var(--border);
            padding: 10px 14px;
            vertical-align: top;
            font-size: 14px;
        }
        .answers th {
            background: #f9fafb;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            color: var(--muted);
            letter-spacing: .04em;
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            background: #e5edff;
            color: #1d4ed8;
        }
        .print-controls {
            margin-bottom: 16px;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .print-btn {
            padding: 10px 14px;
            border: 0;
            border-radius: 8px;
            background: var(--brand);
            color: #fff;
            cursor: pointer;
            font-weight: 700;
        }
        .back-link {
            color: var(--brand);
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
        }
        @media print {
            .print-controls { display: none; }
            body { background: #fff; }
            .page { padding: 0; }
            .submission { break-inside: avoid; }
        }
        @media (max-width: 720px) {
            .report-header, .meta { text-align: left; flex-direction: column; }
            .info-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="print-controls">
            <button class="print-btn" onclick="window.print()">Print / Save as PDF</button>
            <a href="{{ route('admin.quiz.submissions', request()->all()) }}" class="back-link">Back to Submissions</a>
        </div>

        <div class="report-header">
            <div>
                <h1>Quiz Submissions Report</h1>
                <p>Printable report with user details and answer tables.</p>
            </div>
            <div class="meta">
                <div>Generated: {{ now()->format('d M, Y H:i') }}</div>
                <div>Total Submissions: {{ $submissions->count() }}</div>
            </div>
        </div>

        @forelse($submissions as $submission)
            <section class="submission">
                <div class="submission__head">
                    <strong>{{ $submission->name }}</strong>
                    <span>{{ $submission->created_at->format('d M, Y H:i') }}</span>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Phone</label>
                        <div>{{ $submission->phone }}</div>
                    </div>
                    <div class="info-item">
                        <label>Email</label>
                        <div>{{ $submission->email ?? 'N/A' }}</div>
                    </div>
                    <div class="info-item">
                        <label>City</label>
                        <div>{{ $submission->city ?? 'N/A' }}</div>
                    </div>
                    <div class="info-item">
                        <label>Responses Count</label>
                        <div>{{ count($submission->answers_json ?? []) }}</div>
                    </div>
                </div>
                <table class="answers">
                    <thead>
                        <tr>
                            <th style="width: 70%;">Question</th>
                            <th>Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submission->answers_json as $questionId => $answer)
                            <tr>
                                <td>{{ $questionMap[$questionId] ?? 'Question Deleted' }}</td>
                                <td><span class="badge">{{ $answer }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        @empty
            <div class="submission">
                <div class="submission__head">
                    <strong>No submissions found</strong>
                    <span>Try adjusting the filters and print again.</span>
                </div>
            </div>
        @endforelse
    </div>
</body>
</html>
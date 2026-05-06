<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>EZE POST Transfer Receipt</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align:center; border-bottom:2px solid #111; margin-bottom:20px; }
        table { width:100%; border-collapse:collapse; }
        th, td { border:1px solid #999; padding:8px; text-align:left; }
    </style>
</head>
<body>
    <div class="header">
        <h1>EZE POST</h1>
        <h2>File Transfer Receipt</h2>
    </div>

    <p><strong>Transfer Reference:</strong> {{ $tracking->transfer_reference }}</p>
    <p><strong>Status:</strong> {{ ucfirst($tracking->status) }}</p>
    <p><strong>Transferred At:</strong> {{ optional($tracking->transferred_at)->format('d M Y H:i') }}</p>
    <p><strong>Package Size:</strong> {{ $tracking->package_size }} bytes</p>

    <table>
        <thead><tr><th>#</th><th>File Name</th></tr></thead>
        <tbody>
        @foreach(($tracking->file_names ?? []) as $index => $fileName)
            <tr><td>{{ $index + 1 }}</td><td>{{ $fileName }}</td></tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Items List</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
<h1>Items List</h1>
<button id="toggleTableBtn">Toggle Table</button>
<div class="table-wrapper" id="tableWrapper">
    <div class="table-row header">
        <div class="table-cell">Name</div>
        <div class="table-cell">Amount</div>
        <div class="table-cell">Price</div>
        <div class="table-cell">UUID</div>
    </div>
    @foreach ($items as $item)
        <div class="table-row">
            <div class="table-cell">{{ $item->name }}</div>
            <div class="table-cell">{{ $item->amount }}</div>
            <div class="table-cell">{{ $item->price }}</div>
            <div class="table-cell">{{ $item->uuid }}</div>
        </div>
    @endforeach
</div>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

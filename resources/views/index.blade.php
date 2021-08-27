<!DOCTYPE html>
<html lang="en">
<head>
    <title>Current World Population</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#country').on('input', function (event) {
                $.get(`/countries?q=${event.target.value}`, function(data) {
                    $('#search-list').empty();
                    $('#search-list').removeClass('d-none');
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                        html += `<li class="list-group-item" data-id="${data[i]}">${data[i]}</li>`;
                    }
                    $('#search-list').append(html);
                });
            });
            $('#search-list').on('click', '.list-group-item', function (event) {
                $('#country').val(event.currentTarget.textContent);
                $('#search-list').addClass('d-none');
            });
        });
    </script>

    <style>
        .list-group-item {
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mt-5">Current World Population: {{ number_format($worldPopulation) }}</h2>

    <h2 class="mt-3">Top 20 Largest Countries By Population:</h2>

    <ul class="list-group">
        @foreach($largestCountries as $country)
            <li class="list-group-item">{{ $country->country_name }}</li>
        @endforeach
    </ul>

    <h2 class="mt-3">Population All Countries:</h2>

    <div class="d-flex justify-content-between mb-3 position-relative">
        <form class="form-inline" action="{{ route('index') }}" autocomplete="off">
            <label for="country" class="mr-3 d-none">Type Country:</label>
            <input type="text" class="form-control mr-3" id="country" name="country"
                   style="width: 300px" value="{{ request('country') }}">
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
        <ul class="list-group position-absolute" id="search-list" style="z-index: 2; top: 30px"></ul>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Country Name</th>
                <th>Population</th>
                <th>Ranking</th>
            </tr>
        </thead>
        <tbody>
        @foreach($populations as $population)
            <tr>
                <td>{{ $population->country_name }}</td>
                <td>{{ number_format($population->population) }}</td>
                <td>{{ $population->ranking }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between mb-5">
        <a class="btn btn-primary {{ $populations->previousPageUrl() ? '' : 'disabled' }}"
           href="{{ $populations->previousPageUrl() }}">Previous
        </a>
        <a class="btn btn-primary {{ $populations->nextPageUrl() ? '' : 'disabled' }}"
           href="{{ $populations->nextPageUrl() }}">Next
        </a>
    </div>
</div>

</body>
</html>

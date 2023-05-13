@extends('layouts.app')

@section('title', 'Data Records')

@section('content')
    <h1>User Records</h1>

    {{-- <a href="{{ route('data_records.create') }}">Create New Record</a> --}}
    <a href="{{ route('data_records.create') }}" class="create-button" id="create">
        <i class="fa fa-plus"></i>Create New Record
    </a>

    <form action="{{ route('data_records.search') }}" method="GET">
        <select name="searchField">
            <option value="name">Name</option>
            <option value="address">Address</option>
            <option value="city">City</option>
            <option value="state">State</option>
            <option value="zip">ZIP</option>
            <option value="phone">Phone</option>
            <option value="email">Email</option>
        </select>
        <input type="text" name="searchValue" placeholder="Search">
        <button id ="search" type="submit">Search</button>
    </form>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>ZIP</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataRecords as $record)
                <tr>
                    <td>{{ $record->name }}</td>
                    <td>{{ $record->address }}</td>
                    <td>{{ $record->city }}</td>
                    <td>{{ $record->state }}</td>
                    <td>{{ $record->zip }}</td>
                    <td>{{ $record->phone }}</td>
                    <td>{{ $record->email }}</td>
                    {{-- <td>
                        <a href="{{ route('data_records.edit', $record->id) }}">Edit</a>
                        <form action="{{ route('data_records.destroy', $record->id) }}" method="POST">
                            @csrf
                            <button type="submit">Delete</button>
                        </form>
                    </td> --}}
                    <td class="icon-cell">
                        <a href="{{ route('data_records.edit', $record->id) }}" class="edit-link">
                            <i class="fa fa-edit edit-icon"></i>
                        </a>
                        <form action="{{ route('data_records.destroy', $record->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="delete-icon" onclick="return confirm('Are you sure you want to delete this record?');">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Spinner markup -->
    <div id="spinner-overlay">
        <div class="spinner"></div>
    </div>
@endsection

@section('styles')
    <style>
        /* Styles for the spinner overlay */
        #spinner-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 9999;
        }

        .spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Show spinner overlay
            function showSpinner() {
                $('#spinner-overlay').fadeIn();
            }

            // Hide spinner overlay
            function hideSpinner() {
                $('#spinner-overlay').fadeOut();
            }

            // Trigger spinner on link click
            $('.create-button').click(function(e) {
                e.preventDefault(); // Prevent default link behavior

                // Show spinner overlay
                showSpinner();

                // Delay the navigation to the new page
                setTimeout(function() {
                    // Navigate to the new page
                    window.location.href = "{{ route('data_records.create') }}";
                }, 1000); // Adjust the delay duration (in milliseconds) as per your requirement
            });

            // Trigger spinner on edit icon click
            $('.edit-link').click(function(e) {
                e.preventDefault(); // Prevent default link behavior

                // Show spinner overlay
                showSpinner();

                // Get the URL from the href attribute of the link
                var url = $(this).attr('href');

                // Delay the navigation to the new page
                setTimeout(function() {
                    // Navigate to the new page
                    window.location.href = url;
                }, 1000); // Adjust the delay duration (in milliseconds) as per your requirement
            });
            
            // Listen for the pageshow event when navigating back
            window.addEventListener('pageshow', function(event) {
                if (event.persisted) {
                    // Show spinner overlay
                    showSpinner();

                    // Delay hiding the spinner for 1 second
                    setTimeout(function() {
                        // Hide spinner overlay
                        hideSpinner();
                    }, 1000); // Adjust the delay duration (in milliseconds) as per your requirement
                }
            });
        });
    </script>
@endsection



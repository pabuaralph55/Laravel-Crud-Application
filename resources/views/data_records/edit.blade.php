@extends('layouts.app')

@section('title', 'Data Records')

@section('content')

<h1 class="update-heading">Edit Data Record</h1>

<form action="{{ route('data_records.update', $dataRecord->id) }}" method="POST" class="update-form">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $dataRecord->name }}" required>
    </div>
    
    <div>
        <label for="address">Address:</label>
        <input type="text" name="address" value="{{ $dataRecord->address }}" required>
    </div>
    
    <div>
        <label for="city">City:</label>
        <input type="text" name="city" value="{{ $dataRecord->city }}" required>
    </div>
    
    <div>
        <label for="state">State:</label>
        <input type="text" name="state" value="{{ $dataRecord->state }}" required>
    </div>
    
    <div>
        <label for="zip">ZIP:</label>
        <input type="text" name="zip" value="{{ $dataRecord->zip }}" required>
    </div>
    
    <div>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="{{ $dataRecord->phone }}" required>
    </div>
    
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $dataRecord->email }}" required>
    </div>
     <!-- Spinner markup -->
     <div id="spinner-overlay">
        <div class="spinner"></div>
    </div>
    <button type="submit" class="update">Update</button>
</form>

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
            $('.update').click(function(e) {
                e.preventDefault(); // Prevent default link behavior

                // Show spinner overlay
                showSpinner();

                // Delay the navigation to the new page
                setTimeout(function() {
                    // Navigate to the new page
                    window.location.href = "{{ route('data_records.index') }}";
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

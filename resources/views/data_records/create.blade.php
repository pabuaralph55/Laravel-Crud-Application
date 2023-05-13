@extends('layouts.app')

@section('title', 'Data Records')

@section('content')

<h1 class="create-heading">User Information</h1>
<form action="{{ route('data_records.store') }}" method="POST" class="create-form" id="create-record">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required>
    </div>
    <div>
        <label for="city">City:</label>
        <input type="text" name="city" id="city" required>
    </div>
    <div>
        <label for="state">State:</label>
        <input type="text" name="state" id="state" required>
    </div>
    <div>
        <label for="zip">ZIP:</label>
        <input type="text" name="zip" id="zip" required>
    </div>
    <div>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div id="error-message" class="alert alert-danger" style="display: none;"></div>
    <button type="submit" class="create-record">Create</button>
</form>

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(e) {

            function showSpinner() {
                $('#spinner-overlay').fadeIn();
            }
            function hideSpinner() {
                $('#spinner-overlay').fadeOut();
            }
            // Retrieve the CSRF token from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Add the CSRF token to the headers of all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $('#create-record').submit(function(e) {
                e.preventDefault();

                // Collect data from input fields
                var formData = {
                    name: $('#name').val(),
                    address: $('#address').val(),
                    city: $('#city').val(),
                    state: $('#state').val(),
                    zip: $('#zip').val(),
                    phone: $('#phone').val(),
                    email: $('#email').val()
                };

                // Send data to the backend using AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    success: function(response) {
                        showSpinner();
                        setTimeout(function() {
                            hideSpinner();
                            window.location.href = "{{ route('data_records.index') }}";
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        var response = JSON.parse(xhr.responseText); // Parse the JSON error response
                        var errorMessage = response.errors.email[0]; // Extract the specific error message
                        $('#error-message').text(errorMessage).show(); // Display the error message
                        hideSpinner();
                    }
                });
            });

            window.addEventListener('pageshow', function(event) {
                if (event.persisted) {
                    showSpinner();
                    setTimeout(function() {
                        hideSpinner();
                    }, 1000); 
                }
            });
        });
    </script>
@endsection


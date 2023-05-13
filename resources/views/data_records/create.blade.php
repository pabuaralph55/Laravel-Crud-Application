@extends('layouts.app')

@section('title', 'Data Records')

@section('content')

<h1 class="create-heading">Create New Data Record</h1>

{{-- @if (session('errorMessage'))
        <div class="alert alert-danger">
            {{ session('errorMessage') }}
        </div>
@endif --}}

<form action="{{ route('data_records.store') }}" method="POST" class="create-form">
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
    @if ($errors->has('email') && old('email'))
        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
    @endif
    <button type="submit" class="create-record">Create</button>

    <!-- Spinner markup -->
    <div id="spinner-overlay">
        <div class="spinner"></div>
    </div>
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            function showSpinner() {
                $('#spinner-overlay').fadeIn();
            }
            function hideSpinner() {
                $('#spinner-overlay').fadeOut();
            }
            $('.create-form').submit(function(e) {
                e.preventDefault();
                showSpinner();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        hideSpinner();
                        window.location.href = "{{ route('data_records.index') }}";
                    },
                    error: function(xhr, status, error) {
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


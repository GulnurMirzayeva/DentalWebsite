@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h5 class="m-0 font-weight-bold text-primary">Update Profile</h5>
                    </div>
                    <div class="card-body">

                        <!-- Display success message for profile update -->
                        @if(session('profile_success'))
                            <div class="alert alert-success mb-4">
                                {{ session('profile_success') }}
                            </div>
                        @endif

                        <!-- Form for updating name and email -->
                        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-4 justify-content-center">
                                <div class="col-md-4 text-center position-relative">
                                    @if($admin->profile_image)
                                        <img id="profileImage" src="{{ asset('storage/' . $admin->profile_image) }}" alt="Profile Image" class="rounded-circle img-fluid" width="150">
                                    @else
                                        <img id="profileImage" src="https://via.placeholder.com/150" alt="Profile Image" class="rounded-circle img-fluid" width="150">
                                    @endif

                                    <!-- Overlay for changing image -->
                                    <label for="profile_image" class="profile-image-change">
                                        <i class="fas fa-camera"></i> Change
                                    </label>
                                    <input type="file" class="d-none" id="profile_image" name="profile_image" accept="image/*" onchange="previewImage(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>

                    </div>
                </div>

                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h5 class="m-0 font-weight-bold text-primary">Update Password</h5>
                    </div>
                    <div class="card-body">

                        <!-- Form for changing password -->
                        <form method="POST" action="{{ route('admin.profile.password.update') }}">
                            @csrf
                            @method('PUT')

                            <!-- Error messages section -->
                            @if ($errors->any())
                                <div class="alert alert-danger mb-4">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Display success message for password update -->
                            @if(session('password_success'))
                                <div class="alert alert-success mb-4">
                                    {{ session('password_success') }}
                                </div>
                            @endif

                            <!-- Old Password Field -->
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Old Password</label>
                                <input type="password" class="form-control" id="old_password" name="old_password" required>
                            </div>

                            <!-- New Password Field -->
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <!-- Confirm New Password Field -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-danger">Change Password</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to preview the selected image before form submission
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('profileImage');
                output.src = reader.result; // Display the image preview
            };
            reader.readAsDataURL(event.target.files[0]); // Read the selected file
        }
    </script>

@endsection

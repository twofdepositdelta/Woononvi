@extends('back.layouts.master')
@section('title', 'Nouveau Utilisateur')
@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-body p-24">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-8 col-lg-10">
                <div class="card border">
                    <div class="card-body">
                        <h6 class="text-md text-primary-light mb-16">Profile Information</h6>

                        <!-- Upload Image Start -->
                        <div class="mb-24 mt-16">
                            <div class="avatar-upload">
                                <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" hidden>
                                    <label for="imageUpload"
                                        class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                        <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                    </label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Upload Image End -->

                        <form action="#" method="POST">
                            @csrf
                            <div class="mb-20">
                                <label for="firstname" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                    First Name <span class="text-danger-600">*</span>
                                </label>
                                <input type="text" class="form-control radius-8" id="firstname" name="firstname"
                                    value="{{ old('firstname') }}" placeholder="Enter First Name">
                                @error('firstname')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-20">
                                <label for="lastname" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                    Last Name <span class="text-danger-600">*</span>
                                </label>
                                <input type="text" class="form-control radius-8" id="lastname" name="lastname"
                                    value="{{ old('lastname') }}" placeholder="Enter Last Name">
                                @error('lastname')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-20">
                                <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                    Email <span class="text-danger-600">*</span>
                                </label>
                                <input type="email" class="form-control radius-8" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="Enter Email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-20">
                                <label for="phone" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                    Phone <span class="text-danger-600">*</span>
                                </label>
                                <input type="text" class="form-control radius-8" id="phone" name="phone"
                                    value="{{ old('phone') }}" placeholder="Enter Phone Number">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-20">
                                <label for="role" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                    Role <span class="text-danger-600">*</span>
                                </label>
                                <select class="form-control radius-8 form-select" id="role" name="role">
                                    <option value="">Select Role</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="moderator" {{ old('role') == 'moderator' ? 'selected' : '' }}>Moderator</option>
                                </select>
                                @error('role')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-flex align-items-center justify-content-center gap-3">
                                <button type="button" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

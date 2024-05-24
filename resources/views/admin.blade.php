<!-- create.blade.php -->
@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Hostel Details') }}</div>

                <div class="card-body">
                    <form action="{{ route('hostels.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Enter hostel name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="location">{{ __('Location') }}</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="{{ __('Enter hostel location') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea class="form-control" id="description" name="description" placeholder="{{ __('Enter hostel description') }}"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">{{ __('Upload Image') }}</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

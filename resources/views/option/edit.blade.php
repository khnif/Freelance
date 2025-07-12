@extends('layouts.freelancer_layout')

@section('title', 'Edit Gig Option')

@section('content')
    <section class=" bg-gray py-5">
        <div class="container">
            <form action="{{ route('option.update', $gig->id) }}" method="POST">
                @csrf
                @method('PUT')
                <fieldset class="border border-gary p-4 mb-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Edit Gig Options</h3>
                        </div>
                        @foreach ($gig->option as $option)
                            <div class="col-lg-12 border p-3 mb-3">
                                <input type="hidden" name="option_ids[]" value="{{ $option->id }}">
                                <h6>Name</h6>
                                <input type="text" name="names[]" class="form-control" value="{{ $option->name }}">

                                <h6>Description</h6>
                                <textarea name="descriptions[]" rows="4" class="form-control">{{ $option->description }}</textarea>

                                <h6>Price</h6>
                                <input type="number" name="prices[]" class="form-control" value="{{ $option->price }}">

                                <h6>Deadline</h6>
                                <input type="text" name="deadlines[]" class="form-control"
                                    value="{{ $option->deadline }}">
                            </div>
                        @endforeach
                    </div>
                </fieldset>
                <a href="{{ route('thumbnail.edit', $gig->id) }}" class="btn btn-primary">Next</a>
            </form>
        </div>
    </section>
@endsection

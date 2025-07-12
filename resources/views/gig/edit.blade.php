@extends('layouts.freelancer_layout')

@section('title', 'Edit Gig')

@section('content')
    <section class="bg-gray py-5">
        <div class="container">
            <form action="{{ route('gig.update', $gig->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Post Your ad start -->
                <fieldset class="border border-gary p-4 mb-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Edit Your Gig</h3>
                        </div>
                        <div class="col-lg-12">
                            <h6 class="font-weight-bold pt-4 pb-1">Title Of Gig:</h6>
                            <input type="text" name="title" class="border w-100 p-2 bg-white text-capitalize"
                                value="{{ $gig->title }}">

                            <input type="hidden" name="freelancer_id" class="border w-100 p-2 bg-white text-capitalize"
                                value="{{ $gig->freelancer_id }}">

                            <h6 class="font-weight-bold pt-4 pb-1">Description:</h6>
                            <textarea name="description" id="text-editor" class="border p-3 w-100" rows="7">{{ $gig->description }}</textarea>
                        </div>

                        <div class="col-lg-12">
                            <h6 class="font-weight-bold pt-4 pb-1">Select Gig Category:</h6>
                            <select name="category_id" id="inputGroupSelect" class="w-100">
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $gig->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>

                            <h6 class="font-weight-bold pt-4 pb-1">Select Gig Sub Category:</h6>
                            <select name="sub_category_id" id="inputGroupSelect" class="w-100 ignore select2 form-control"
                                style="height: 15px">
                                @foreach ($sub_category as $sub)
                                    <option value="{{ $sub->id }}"
                                        {{ $gig->sub_category_id == $sub->id ? 'selected' : '' }}>{{ $sub->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>
                <a href="{{ route('option.edit', $gig->id) }}" class="btn btn-primary d-block mt-2">Next</a>
            </form>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('select:not(.ignore)').niceSelect();
            FastClick.attach(document.body);
        });
    </script>
@endsection

@extends('layouts.freelancer_layout')

@section('title', 'Edit Thumbnails')

@section('content')
    <section class=" bg-gray py-5">
        <div class="container">
            {{-- Form untuk Update Gig (Jika ada data gig lain yang diupdate) --}}
            {{-- Ini form utama untuk update, Anda bisa saja TIDAK perlu input file di sini
                 jika semua penambahan dilakukan via form "Add New Thumbnail" --}}
            <form action="{{ route('thumbnail.update', $gig->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <fieldset class="border border-gary p-4 mb-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Edit Gig Thumbnails</h3>
                        </div>
                        {{-- Hapus bagian input file di sini jika ingin sepenuhnya terpisah --}}
                        {{-- <div class="col-lg-12 mb-3">
                            <label for="thumbnail">Add New Thumbnails (via this form)</label>
                            <input type="file" name="thumbnail[]" multiple class="form-control">
                        </div> --}}

                        <div class="col-lg-12">
                            <label>Existing Thumbnails:</label>
                            <div class="row">
                                @forelse ($gig->thumbnail as $thumb)
                                    <div class="col-md-3 mb-3">
                                        <img src="{{ $thumb->url }}" class="img-fluid mb-2" alt="thumbnail">
                                        <form action="{{ route('thumbnail.delete', $thumb->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                @empty
                                    <div class="col-lg-12">
                                        <p>No existing thumbnails found for this gig.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-success">Update Gig Data (optional)</button>
            </form>

            <hr class="my-5">

            {{-- Bagian untuk menambahkan thumbnail baru, mirip dengan thumbnail.create --}}
            <div class="row py-4">
                <div class="col-lg-6 mx-auto">
                    <h2>Add New Thumbnail</h2>
                    {{-- Form ini akan menunjuk ke route store --}}
                    <form action="{{ route('thumbnail.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="gig_id" value="{{ $gig->id }}">
                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                            <input id="upload" type="file" name="image" onchange="readURL(this);"
                                class="form-control border-0">
                            <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                            <div class="input-group-append">
                                <label for="upload" class="btn btn-light m-0 rounded-pill px-4">
                                    <i class="fa fa-cloud-upload mr-2 text-muted"></i><small
                                        class="text-uppercase font-weight-bold text-muted">Choose file</small>
                                </label>
                            </div>
                        </div>
                        <div class="flex-random">
                            <input type="submit" class="btn btn-primary d-block mt-2" value="Add Thumbnail">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    {{-- Jika Anda menggunakan stack untuk JS --}}
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Di sini Anda mungkin ingin menampilkan preview gambar jika diperlukan
                    // Misalnya: $('#imagePreview').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function() {
            // Untuk styling input file custom dari template Anda
            $('#upload').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $('#upload-label').text(fileName);
            });
        });
    </script>
@endpush

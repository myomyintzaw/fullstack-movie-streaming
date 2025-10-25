@extends('layout.master')

@section('content')
    <div class="mt-5 container">
        <div class="row">

            <div class="col-8 offset-2">
                <div class="card bg-dark p-3 text-center">
                    <h4 class="alert alert-info">{{ $data->total_day }} days ({{ $data->price }} mmk)</h4>
                    <div>
                        <b class="text-muted">{{ $data->name }}</b>
                        <p>Experience unforgettable moments with our exclusive package. Enjoy beautiful destinations,
                            comfortable accommodation, and excellent service — all at an unbeatable price.</p>
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="" class="text-white">Enter Payment Name</label>
                            <input type="text" name="payment_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="text-white">Enter Payment Phone</label>
                            <input type="tel" name="payment_phone" class="form-control">
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Enter Payment Screenshot</label>
                            <input type="file" name="payment_image" class="form-control">
                        </div> --}}

                        <div
                            class="form-group w-full max-w-md mx-auto mt-10 p-5 bg-gradient-to-b from-white to-gray-50 rounded-3xl shadow-xl border border-gray-100">
                            {{-- text-gray-800 --}}
                            <h2 class="text-xl font-semibold text-white mb-2 text-center">Upload Payment Screenshot</h2>

                            <div class="flex flex-col items-center justify-center w-full space-y-1">
                                <!-- Upload Box -->
                                <label for="payment_image"
                                    class="flex flex-col items-center justify-center w-full h-20 border-2 border-dashed border-indigo-300 rounded-2xl cursor-pointer bg-indigo-50/30 hover:bg-indigo-50 hover:border-indigo-400 hover:shadow-lg transition duration-300 ease-in-out">
                                    {{-- pt-6 pb-6 --}}
                                    <div class="flex flex-col items-center justify-center ">
                                        {{-- w-12 h-12 mb-3 --}}
                                        {{-- <svg class=" text-indigo-400" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 54 54">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12m-9 0l-3 3m0 0l3 3m-3-3h16" />
                                        </svg> --}}
                                        <div class="text-sm text-gray-600">
                                            <span class="font-semibold text-indigo-600">Click to upload</span> or drag &
                                            drop
                                        </div>
                                        <p class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG (max 5MB)</p>
                                    </div>
                                </label>

                                <!-- Hidden File Input -->
                                <input id="payment_image" type="file" name="payment_image" accept="image/*"
                                    class="hidden" />

                                <!-- Image Preview -->
                                <div id="preview_container" class="hidden w-full">
                                    <p class="text-sm text-gray-500 mb-2 text-center">Preview:</p>
                                    <img id="preview"
                                        class="col-auto object-cover rounded-2xl border border-gray-200 shadow-md mx-auto transition-transform duration-300 hover:scale-105 hover:shadow-lg" />
                                </div>
                            </div>
                        </div>

                        <script>
                            const input = document.getElementById('payment_image');
                            const preview = document.getElementById('preview');
                            const previewContainer = document.getElementById('preview_container');

                            input.addEventListener('change', (e) => {
                                const file = e.target.files[0];
                                if (file) {
                                    preview.src = URL.createObjectURL(file);
                                    previewContainer.classList.remove('hidden');
                                }
                            });
                        </script>




                        <input type="submit" class="btn btn-primary" value="Buy Now">
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection

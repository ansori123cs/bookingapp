@extends('layouts._layout')
@section('content')


    @if (session()->has('success'))
        <script>
            Swal.fire({
                title: "Success!",
                text: "{{ session()->get('success') }}",
                icon: "success"
            });
        </script>
    @endif

    @if ($errors->any())
        <div class="col">
            @foreach ($errors->all() as $error)
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "{{ $error }}"
                    });
                </script>
            @endforeach
        </div>
    @endif

    <!-- Home Section Start -->
    <div class="home"
        style=" background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.2)),
        url({{ asset('storage/images/background-img.png') }});">
        <div class="content">
            <h5>Kost-in Aja</h5>
            <h1>Book At <span class="changecontent"></span></h1>
            <p>Kost Se Indonesia, Semuanya Ada di Kost-in Aja.</p>
            <a href="#book">Booking Sekarang</a>
        </div>
    </div>
    <!-- Home Section End -->





    <!-- Section Book Start -->
    <section class="book" id="book">
        <div class="container">

            <div class="main-text">
                <h1><span>Booking</span>Now</h1>
            </div>

            <div class="row">

                <div class="col-md-6 py-3 py-md-0">
                    <div class="card">
                        <img src='{{ asset('storage/images/book-img.png') }}' alt="">
                    </div>
                </div>

                <div class="col-md-6 py-3 py-md-0">
                    <div class="card p-5">
                        <form action="{{ route('booking.addDataBooking') }}" method="POST">
                            @csrf
                            <div class="mb-3">

                                <label for="id_kost" class="form-label">Pilih Kost</label>
                                <select class="form-select" id="id_kost" name="id_kost"
                                    aria-label="Default select example">
                                    <option selected>Pilih Kosan</option>
                                    @foreach ($kost as $index => $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kost }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                                <input type="text" class="form-control border border-black" id="nama_pemesan"
                                    name="nama_pemesan" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="text" class="form-control border border-black" id="no_hp" name="no_hp"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="pesan_khusus" class="form-label">Pesan Khusus</label>
                                <textarea class="form-control border border-black" id="pesan_khusus" name="pesan_khusus"></textarea>
                            </div>
                            <input type="hidden" value="1000000" id="total_harga" name="total_harga" required>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Section Book End -->








    <!-- Section Packages Start -->
    <section class="packages" id="packages">
        <div class="container">

            <div class="main-txt">
                <h1><span>Our</span>Kost</h1>
            </div>

            <div class="row" style="margin-top: 30px;">
                @foreach ($kost as $index => $item)
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card m-2">
                            <img src="{{ asset('storage/images/' . ($index + 1) . '.png') }}" alt="">
                            <div class="card-body">
                                <h3>{{ $item->nama_kost }}</h3>
                                <p>{{ $item->fasilitas }}</p>
                                <div class="star">
                                    <i class="fa-solid fa-star checked"></i>
                                    <i class="fa-solid fa-star checked"></i>
                                    <i class="fa-solid fa-star checked"></i>
                                    <i class="fa-solid fa-star "></i>
                                    <i class="fa-solid fa-star "></i>
                                </div>
                                <h6>Harga: <strong>{{ $item->harga }}</strong></h6>
                                <a href="#book">Booking Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Section Packages End -->


    <!-- Section Gallary Start -->
    <section class="gallary" id="gallary">
        <div class="container">

            <div class="main-txt">
                <h1><span>Ga</span>leri</h1>
            </div>

            <div class="row" style="margin-top: 30px;">
                @foreach ($kost as $index => $item)
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card m-3">
                            <img src="{{ asset('storage/images/' . ($index + 1) . '.png') }}" alt=""
                                height="230px">
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- Section Gallary End -->


    <!-- About Start -->
    <section class="about" id="about">
        <div class="container">

            <div class="main-txt">
                <h1>About <span>Me</span></h1>
            </div>

            <div class="row" style="margin-top: 50px;">

                <div class="col-md-6 py-3 py-md-0">
                    <div class="card">
                        <img class="p-3"src="{{ asset('storage/images/about-img.png') }}" alt="">
                    </div>
                </div>

                <div class="col-md-6 py-3 py-md-0">
                    <h2>Krisna Febriansyah</h2>
                    <p>.</p>
                    <hr>
                    <a id="about-btn"class="btn btn-primary" href="/kelolaKost">Monitoring</a>
                    <hr>
                </div>

            </div>

        </div>
    </section>
    <!-- About End -->






@stop

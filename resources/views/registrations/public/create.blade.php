<!DOCTYPE html>
<html>

<head>
    <title>Pendaftaran Layanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Formulir Pendaftaran Layanan</div>
                    <div class="card-body">

                        <!-- @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif -->

                        <form method="POST" action="{{ route('registration.public.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="full_name" class="form-label">Nama Lengkap*</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                                @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email*</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Nomor Telepon*</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                                @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="school_name" class="form-label">Nama Sekolah (Opsional)</label>
                                <input type="text" class="form-control @error('school_name') is-invalid @enderror" id="school_name" name="school_name" value="{{ old('school_name') }}">
                                @error('school_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="payment_package" class="form-label">Paket Pembayaran*</label>
                                <select class="form-select @error('payment_package') is-invalid @enderror" id="payment_package" name="payment_package" required>
                                    <option value="">-- Pilih Paket Pembayaran --</option>
                                    @foreach($paymentPackages as $package)
                                    <option value="{{ $package }}" {{ old('payment_package') == $package ? 'selected' : '' }}>{{ ucfirst($package) }}</option>
                                    @endforeach
                                </select>
                                @error('payment_package')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.getElementById('phone_number');
            const phoneError = document.querySelector('.invalid-feedback[for="phone_number"]'); // Cari elemen error feedback untuk phone_number

            phoneInput.addEventListener('input', function() {
                const phoneValue = phoneInput.value;
                const phoneRegex = /^(?:\+62|0)[2-9][0-9]{8,15}$/; // Regex yang sama dengan di backend

                if (!phoneRegex.test(phoneValue)) {
                    phoneInput.classList.add('is-invalid'); // Tambahkan class 'is-invalid' untuk menandai input error secara visual
                    if (phoneError) {
                        phoneError.style.display = 'block'; // Pastikan pesan error feedback terlihat
                    }
                } else {
                    phoneInput.classList.remove('is-invalid'); // Hapus class 'is-invalid' jika input valid
                    if (phoneError) {
                        phoneError.style.display = 'none'; // Sembunyikan pesan error feedback jika input valid
                    }
                }
            });
        });
    </script>
</body>

</html>
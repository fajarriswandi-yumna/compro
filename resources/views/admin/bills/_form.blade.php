<div class="mb-3">
    <label for="client_name" class="form-label">Nama Klien</label>
    <input type="text" class="form-control" id="client_name_search" placeholder="Cari Nama Client">
    <select class="form-select" id="client_id" name="client_id" required>
        <option value="" selected disabled>-- Pilih Klien --</option>
        @foreach($clients as $client)
        <option value="{{ $client->id }}" data-nama="{{ $client->full_name }}" data-email="{{ $client->email }}" data-subscribe-type="{{ $client->subscribe_type }}">{{ $client->full_name }} ({{ $client->email }})</option>
        @endforeach
    </select>
    <div id="client-suggestions" class="list-group" style="position: absolute; z-index: 1000; width: 100%; display: none;"></div>
</div>

<div class="form-group">
    <label for="bill_number">Nomor Tagihan <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('bill_number') is-invalid @enderror" id="bill_number" name="bill_number" value="{{ old('bill_number') }}" required>
    @error('bill_number')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="bill_date">Tanggal Tagihan <span class="text-danger">*</span></label>
    <input type="date" class="form-control @error('bill_date') is-invalid @enderror" id="bill_date" name="bill_date" value="{{ old('bill_date') }}" required>
    @error('bill_date')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="due_date">Tanggal Jatuh Tempo <span class="text-danger">*</span></label>
    <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date') }}" required>
    @error('due_date')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="payment_status">Status Pembayaran <span class="text-danger">*</span></label>
    <select class="form-control @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status" required>
        <option value="">-- Pilih Status Pembayaran --</option>
        <option value="Unpaid" {{ old('payment_status') == 'Unpaid' ? 'selected' : '' }}>Belum Dibayar</option>
        <option value="Paid" {{ old('payment_status') == 'Paid' ? 'selected' : '' }}>Sudah Dibayar</option>
        <option value="Pending" {{ old('payment_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
    </select>
    @error('payment_status')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="amount">Jumlah Tagihan <span class="text-danger">*</span></label>
    <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" required step="0.01" readonly disabled>
    @error('amount')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<br><br>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clientNameSearchInput = document.getElementById('client_name_search'); // GANTI ID INPUT PENCARIAN
        const clientIdDropdown = document.getElementById('client_id'); // DROPDOWN SELECT KLIEN
        const amountInput = document.getElementById('amount');
        const monthlyPrice = 50000;

        clientNameSearchInput.addEventListener('input', function() { // EVENT LISTENER UNTUK INPUT PENCARIAN
            const searchTerm = clientNameSearchInput.value.trim().toLowerCase(); // AMBIL KATA KUNCI PENCARIAN DAN KONVERSI KE HURUF KECIL

            // LOOP MELALUI SEMUA OPTION DI DROPDOWN SELECT KLIEN
            for (let i = 0; i < clientIdDropdown.options.length; i++) {
                const option = clientIdDropdown.options[i];
                if (option.value !== "") { // Lewati option "Pilih Klien" (yang value-nya kosong)
                    const clientName = option.dataset.nama.toLowerCase(); // AMBIL NAMA KLIEN DARI DATA ATTRIBUTE data-nama DAN KONVERSI KE HURUF KECIL
                    const clientEmail = option.dataset.email.toLowerCase(); // AMBIL EMAIL KLIEN DARI DATA ATTRIBUTE data-email DAN KONVERSI KE HURUF KECIL

                    // CEK APAKAH NAMA KLIEN ATAU EMAIL KLIEN MENGANDUNG KATA KUNCI PENCARIAN
                    if (clientName.includes(searchTerm) || clientEmail.includes(searchTerm)) {
                        option.style.display = 'block'; // TAMPILKAN OPTION JIKA SESUAI DENGAN PENCARIAN
                    } else {
                        option.style.display = 'none'; // SEMBUNYIKAN OPTION JIKA TIDAK SESUAI
                    }
                }
            }
        });

        clientIdDropdown.addEventListener('change', function() { // EVENT LISTENER UNTUK DROPDOWN SELECT KLIEN
            const selectedOption = clientIdDropdown.options[clientIdDropdown.selectedIndex];
            if (selectedOption.value !== "") { // Pastikan bukan option "Pilih Klien" yang dipilih
                const subscribeType = selectedOption.dataset.subscribeType; // AMBIL TIPE SUBSCRIBE DARI DATA ATTRIBUTE
                amountInput.value = calculateAmountBasedOnSubscribeType(subscribeType); // HITUNG DAN ISI AMOUNT
            } else {
                amountInput.value = ''; // Kosongkan amount jika option "Pilih Klien" dipilih
            }
        });


        function calculateAmountBasedOnSubscribeType(subscribeType) {
            let calculatedAmount = 0;
            if (subscribeType === 'Tahunan') {
                calculatedAmount = monthlyPrice * 12;
            } else if (subscribeType === 'Bulanan') {
                calculatedAmount = monthlyPrice;
            }
            return calculatedAmount.toFixed(0);
        }

        // Event listener untuk perubahan pada dropdown pembayaran (opsional)
        document.getElementById('payment_status').addEventListener('change', function() {
            // ... (Tambahkan logika lain jika ada perubahan status pembayaran mempengaruhi hal lain) ...
        });
    });
</script>
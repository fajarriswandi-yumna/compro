<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<div class="mb-3">
    <label for="client_id" class="form-label">Nama Klien</label>
    <select class="form-control select2" id="client_id" name="client_id" required {{ isset($bill) ? 'disabled' : '' }}> {{-- ADDED: Disable in edit mode --}}
        <option value="" selected disabled>-- Pilih Klien --</option>
        @foreach($clients as $client)
            <option value="{{ $client->id }}" data-client-id="{{ $client->id }}" data-subscribe-type="{{ $client->subscribe_type }}" data-email="{{ $client->email }}"
                    {{-- ADDED: Select Client if editing and client ID matches --}}
                    {{ isset($bill) && $bill->client_id == $client->id ? 'selected' : '' }}>
                {{ $client->full_name }} ({{ $client->email }})
            </option>
        @endforeach
    </select>
    @if(isset($bill)) {{-- ADDED: Hidden input to send client_id in edit mode --}}
        <input type="hidden" name="client_id" value="{{ $bill->client_id }}">
    @endif
</div>

<div class="mb-3">
    <label for="no_invoice" class="form-label">Nomor Invoice</label>
    <input type="text" class="form-control" id="no_invoice" name="no_invoice" placeholder="Nomor Invoice akan di-generate otomatis" readonly
           value="{{ isset($bill) ? $bill->no_invoice : ($no_invoice ?? '') }}"> {{-- MODIFIED: Display $bill->no_invoice if editing --}}
</div>

<div class="mb-3">
    <label for="bill_date" class="form-label">Tanggal Tagihan <span class="text-danger">*</span></label>
    <input type="date" class="form-control @error('bill_date') is-invalid @enderror" id="bill_date" name="bill_date"
           value="{{ old('bill_date', isset($bill) ? (is_object($bill->bill_date) ? $bill->bill_date->format('Y-m-d') : $bill->bill_date) : '') }}" required>
    @error('bill_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="due_date" class="form-label">Tanggal Jatuh Tempo <span class="text-danger">*</span></label>
    <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date"
           value="{{ old('due_date', isset($bill) ? (is_object($bill->due_date) ? $bill->due_date->format('Y-m-d') : $bill->due_date) : '') }}" required>
    @error('due_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="payment_status" class="form-label">Status Pembayaran <span class="text-danger">*</span></label>
    <select class="form-control @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status" required>
        <option value="" selected disabled>-- Pilih Status Pembayaran --</option>
        <option value="Not Paid" {{ old('payment_status', isset($bill) ? $bill->payment_status : '') == 'Not Paid' ? 'selected' : '' }}>Belum Dibayar</option> {{-- MODIFIED: Select 'Not Paid' if editing and status is 'Not Paid' --}}
        <option value="Paid" {{ old('payment_status', isset($bill) ? $bill->payment_status : '') == 'Paid' ? 'selected' : '' }}>Sudah Dibayar</option> {{-- MODIFIED: Select 'Paid' if editing and status is 'Paid' --}}
    </select>
    @error('payment_status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="amount" class="form-label">Jumlah Tagihan <span class="text-danger">*</span></label>
    <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', isset($bill) ? $bill->amount : '') }}" required step="0.01" readonly> {{-- MODIFIED: Display $bill->amount if editing --}}
    @error('amount')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<br><br>

<script>
    $(document).ready(function() {
        // Inisialisasi Select2 pada dropdown Nama Klien
        $('.select2').select2({
            placeholder: '-- Pilih Klien --',
            allowClear: true
        });

        // Set selected client on edit form load
        @if(isset($bill) && $bill->client_id)
            $('#client_id').val({{ $bill->client_id }}).trigger('change'); // Set Select2 value and trigger change
        @endif

        // Disable Select2 in edit mode after initialization
        @if(isset($bill))
            $('#client_id').prop('disabled', true);
            $('.select2-selection--single').addClass('disabled'); // Optional: visually disable Select2
        @endif


        // Event handler ketika nilai pada Select2 (Nama Klien) berubah
        $('.select2').on('change', function() {
            var selectedClientId = $(this).val();
            var selectedOption = $(this).find('option:selected');

            if (selectedOption.length > 0 && selectedClientId) {
                var subscribeType = selectedOption.data('subscribe-type');
                var calculatedAmount = calculateAmountBasedOnSubscribeType(subscribeType);
                $('#amount').val(calculatedAmount);
            } else {
                $('#amount').val('');
            }
        });

        // Fungsi untuk menghitung jumlah tagihan berdasarkan tipe subcription
        function calculateAmountBasedOnSubscribeType(subscribeType) {
            let calculatedAmount = 0;
            if (subscribeType === 'Tahunan') {
                calculatedAmount = 50000 * 12;
            } else if (subscribeType === 'Bulanan') {
                calculatedAmount = 50000;
            }
            return calculatedAmount.toFixed(0);
        }
    });
</script>
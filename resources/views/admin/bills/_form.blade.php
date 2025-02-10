<div class="mb-3">
    <label for="client_id" class="form-label">Client <span class="text-danger">*</span></label>
    <select class="form-select @error('client_id') is-invalid @enderror" id="client_id" name="client_id" required>
        <option value="">Pilih Client</option>
        @foreach ($clients as $client)
        <option value="{{ $client->id }}" {{ isset($bill) && $bill->client_id == $client->id ? 'selected' : (old('client_id') == $client->id ? 'selected' : '') }}>
            {{ $client->full_name }}
        </option>
        @endforeach
    </select>
    @error('client_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="subscribe_type" class="form-label">Tipe Berlangganan <span class="text-danger">*</span></label>
    <select class="form-select @error('subscribe_type') is-invalid @enderror" id="subscribe_type" name="subscribe_type" required>
        <option value="">Pilih Tipe Berlangganan</option>
        <option value="Bulanan" {{ isset($bill) && $bill->subscribe_type == 'Bulanan' ? 'selected' : (old('subscribe_type') == 'Bulanan' ? 'selected' : '') }}>Bulanan</option>
        <option value="Tahunan" {{ isset($bill) && $bill->subscribe_type == 'Tahunan' ? 'selected' : (old('subscribe_type') == 'Tahunan' ? 'selected' : '') }}>Tahunan</option>
    </select>
    @error('subscribe_type')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="payment_status" class="form-label">Status Pembayaran</label>
    <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status">
        <option value="Not Paid" {{ isset($bill) && $bill->payment_status == 'Not Paid' ? 'selected' : (old('payment_status') == 'Not Paid' ? 'selected' : '') }}>Not Paid</option>
        <option value="Paid" {{ isset($bill) && $bill->payment_status == 'Paid' ? 'selected' : (old('payment_status') == 'Paid' ? 'selected' : '') }}>Paid</option>
    </select>
    @error('payment_status')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
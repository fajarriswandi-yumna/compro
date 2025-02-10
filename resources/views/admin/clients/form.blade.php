<div class="mb-3">
    <label for="full_name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', isset($client) ? $client->full_name : '') }}" required>
    @error('full_name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', isset($client) ? $client->email : '') }}" required>
    @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="no_phone" class="form-label">No. Telepon <span class="text-danger">*</span> (Contoh: 628123456789)</label>
    <input type="text" class="form-control @error('no_phone') is-invalid @enderror" id="no_phone" name="no_phone" value="{{ old('no_phone', isset($client) ? $client->no_phone : '') }}" required placeholder="Contoh: 628123456789">
    @error('no_phone')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="text-muted">Gunakan kode negara (contoh: 62 untuk Indonesia) tanpa simbol + atau 0 di depan.</small>
</div>

<div class="mb-3">
    <label for="photo_profile" class="form-label">Foto Profil</label>
    <input type="file" class="form-control @error('photo_profile') is-invalid @enderror" id="photo_profile" name="photo_profile">
    @error('photo_profile')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if(isset($client) && $client->photo_profile)
    <div class="mt-2">
        <img src="{{ Storage::url($client->photo_profile) }}" alt="Foto Profil" class="img-thumbnail" width="100">
    </div>
    @endif
</div>

<div class="mb-3">
    <label for="institution" class="form-label">Institusi</label>
    <input type="text" class="form-control @error('institution') is-invalid @enderror" id="institution" name="institution" value="{{ old('institution', isset($client) ? $client->institution : '') }}">
    @error('institution')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="subscribe_status" class="form-label">Status Berlangganan <span class="text-danger">*</span></label>
    <select class="form-select @error('subscribe_status') is-invalid @enderror" id="subscribe_status" name="subscribe_status" required>
        <option value="">Pilih Status</option>
        <option value="Aktif" {{ old('subscribe_status', isset($client) && $client->subscribe_status == 'Aktif' ? 'selected' : '') }}>Aktif</option>
        <option value="Non Aktif" {{ old('subscribe_status', isset($client) && $client->subscribe_status == 'Non Aktif' ? 'selected' : '') }}>Non Aktif</option>
    </select>
    @error('subscribe_status')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="subscription_start_date" class="form-label">Tanggal Mulai Berlangganan</label>
    <input type="date" class="form-control @error('subscription_start_date') is-invalid @enderror" id="subscription_start_date" name="subscription_start_date" value="{{ old('subscription_start_date', isset($client) ? $client->subscription_start_date : '') }}">
    @error('subscription_start_date')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="subscription_end_date" class="form-label">Tanggal Berakhir Berlangganan</label>
    <input type="date" class="form-control @error('subscription_end_date') is-invalid @enderror" id="subscription_end_date" name="subscription_end_date" value="{{ old('subscription_end_date', isset($client) ? $client->subscription_end_date : '') }}">
    @error('subscription_end_date')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
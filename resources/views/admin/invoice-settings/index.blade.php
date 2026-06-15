@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
        /* ── Design Tokens ──────────────────────────────────────── */
        :root {
            --bg: #f1f2f4;
            --surface: #ffffff;
            --border: #e3e5e8;
            --text-primary: #202223;
            --text-secondary: #6d7175;
            --text-hint: #8c9196;
            --accent: #303d89;
            --accent-light: #f0f1fc;
            --green: #007a5e;
            --green-bg: #e3f1ec;
            --red: #b22222;
            --radius-sm: 8px;
            --radius-md: 12px;
            --shadow-card: 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 1px var(--border);
            --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .create-page {
            background: var(--bg);
            padding: 24px 28px;
            min-height: 100vh;
            font-family: var(--font);
            color: var(--text-primary);
        }

        .create-page * {
            box-sizing: border-box;
        }

        /* ── Page header ────────────────────────────────────────── */
        .create-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
        }

        .create-page-header h1 {
            font-size: 20px;
            font-weight: 650;
            color: var(--text-primary);
            margin: 0;
        }

        .crumb {
            font-size: 12.5px;
            color: var(--text-hint);
            margin-top: 3px;
        }

        .crumb a {
            color: var(--accent);
            text-decoration: none;
        }

        .crumb a:hover {
            text-decoration: underline;
        }

        .crumb span {
            margin: 0 5px;
        }

        /* ── Buttons ────────────────────────────────────────────── */
        .btn-primary-dash {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent);
            color: #fff !important;
            border: none;
            border-radius: var(--radius-sm);
            padding: 8px 18px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none !important;
            font-family: var(--font);
            transition: background .15s, box-shadow .15s;
            box-shadow: 0 1px 3px rgba(48, 61, 137, .25);
        }

        .btn-primary-dash:hover {
            background: #252f70;
        }

        .btn-secondary-dash {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--surface);
            color: var(--text-primary) !important;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 8px 18px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none !important;
            font-family: var(--font);
            transition: background .15s;
        }

        .btn-secondary-dash:hover {
            background: var(--bg);
        }

        /* ── Two-column layout ──────────────────────────────────── */
        .create-layout {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 20px;
            align-items: start;
        }

        @media(max-width:900px) {
            .create-layout {
                grid-template-columns: 1fr;
            }
        }

        /* ── Section card ───────────────────────────────────────── */
        .section-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-card);
            overflow: hidden;
            margin-bottom: 16px;
        }

        .section-card:last-child {
            margin-bottom: 0;
        }

        .section-card-header {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            background: #fafafa;
        }

        .section-card-header h5 {
            font-size: 13px;
            font-weight: 650;
            color: var(--text-primary);
            margin: 0;
            letter-spacing: .01em;
        }

        .section-card-body {
            padding: 20px;
        }

        /* ── Form fields ────────────────────────────────────────── */
        .field-group {
            margin-bottom: 16px;
        }

        .field-group:last-child {
            margin-bottom: 0;
        }

        .field-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            letter-spacing: .03em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .field-label .req {
            color: var(--red);
            margin-left: 2px;
        }

        .field-input,
        .field-select,
        .field-textarea {
            width: 100%;
            height: 38px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 0 12px;
            font-size: 13.5px;
            color: var(--text-primary);
            background: var(--surface);
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            font-family: var(--font);
        }

        .field-input:focus,
        .field-select:focus,
        .field-textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(48, 61, 137, .12);
        }

        .field-textarea {
            height: auto;
            padding: 10px 12px;
            resize: vertical;
            min-height: 80px;
        }

        .field-hint {
            font-size: 11.5px;
            color: var(--text-hint);
            margin-top: 4px;
        }

        /* ── Slug field ─────────────────────────────────────────── */
        .slug-wrap {
            position: relative;
        }

        .slug-prefix {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            padding: 0 10px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-right: none;
            border-radius: var(--radius-sm) 0 0 var(--radius-sm);
            font-size: 12px;
            color: var(--text-hint);
            white-space: nowrap;
            pointer-events: none;
        }

        .slug-input {
            padding-left: 76px !important;
        }

        /* ── File upload ────────────────────────────────────────── */
        .file-upload-area {
            border: 2px dashed var(--border);
            border-radius: var(--radius-md);
            padding: 28px 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color .15s, background .15s;
            position: relative;
        }

        .file-upload-area:hover {
            border-color: var(--accent);
            background: var(--accent-light);
        }

        .file-upload-area input[type=file] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .file-upload-area .upload-icon {
            font-size: 26px;
            color: var(--text-hint);
            margin-bottom: 8px;
        }

        .file-upload-area p {
            font-size: 13px;
            color: var(--text-secondary);
            margin: 0;
        }

        .file-upload-area small {
            font-size: 11.5px;
            color: var(--text-hint);
        }

        /* ── Toggle / select rows ───────────────────────────────── */
        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--bg);
        }

        .toggle-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .toggle-row:first-child {
            padding-top: 0;
        }

        .toggle-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .toggle-sub {
            font-size: 11.5px;
            color: var(--text-hint);
            margin-top: 2px;
        }

        .field-select-sm {
            height: 32px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 0 28px 0 10px;
            font-size: 12.5px;
            color: var(--text-primary);
            background: var(--surface);
            outline: none;
            font-family: var(--font);
            transition: border-color .15s, box-shadow .15s;
            min-width: 90px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%238c9196'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 9px center;
        }

        .field-select-sm:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(48, 61, 137, .12);
        }

        /* ── Action bar (sticky bottom) ─────────────────────────── */
        .action-bar {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-card);
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        @media(max-width:768px) {
            .create-page {
                padding: 16px;
            }
        }
    </style>

    <div class="app-content content container-fluid">
        <div class="create-page">

            <!-- Page header -->
            <div class="create-page-header">
                <div>
                    <h1>Invoice & GST Settings</h1>

                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">
                            Dashboard
                        </a>

                        <span>›</span>

                        Invoice & GST Settings
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.invoice-settings.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="create-layout">

                    <!-- ── LEFT column ──────────────────────────────── -->
                    <div>

                        {{-- Company Information --}}
                        <div class="section-card">

                            <div class="section-card-header">
                                <h5>Company Information</h5>
                            </div>

                            <div class="section-card-body">

                                <div class="field-group">
                                    <label class="field-label">
                                        Company Name
                                        <span class="req">*</span>
                                    </label>

                                    <input type="text" name="company_name" class="field-input"
                                        value="{{ old('company_name', $setting->company_name ?? '') }}" required>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">
                                        Contact Number
                                    </label>

                                    <input type="text" name="company_phone" class="field-input"
                                        value="{{ old('company_phone', $setting->company_phone ?? '') }}">
                                </div>

                                <div class="field-group">
                                    <label class="field-label">
                                        GST Number
                                    </label>

                                    <input type="text" name="company_gstin" class="field-input"
                                        value="{{ old('company_gstin', $setting->company_gstin ?? '') }}">
                                </div>

                                <div class="field-group">
                                    <label class="field-label">
                                        State
                                    </label>

                                    <select name="company_state" id="state_id" class="field-select">

                                        <option value="">
                                            Select State
                                        </option>

                                        @foreach($states as $state)

                                            <option value="{{ $state->id }}" {{ old('company_state', $setting->company_state ?? '') == $state->id ? 'selected' : '' }}>

                                                {{ $state->name }}

                                            </option>

                                        @endforeach

                                    </select>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">
                                        City
                                    </label>

                                    <select name="company_city" id="city_id" class="field-select">

                                        <option value="">
                                            Select City
                                        </option>

                                        @if(!empty($setting->company_city) && $setting->city)

                                            <option value="{{ $setting->city->id }}" selected>

                                                {{ $setting->city->name }}

                                            </option>

                                        @endif

                                    </select>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">
                                        Pincode
                                    </label>

                                    <input type="text" name="company_pincode" class="field-input"
                                        value="{{ old('company_pincode', $setting->company_pincode ?? '') }}">
                                </div>

                                <div class="field-group">
                                    <label class="field-label">
                                        Full Address
                                        <span class="req">*</span>
                                    </label>

                                    <textarea name="company_address" class="field-textarea" rows="4"
                                        required>{{ old('company_address', $setting->company_address ?? '') }}</textarea>
                                </div>

                            </div>

                        </div>

                        {{-- Invoice Settings --}}
                        <div class="section-card">

                            <div class="section-card-header">
                                <h5>Invoice Settings</h5>
                            </div>

                            <div class="section-card-body">

                                <div class="field-group">
                                    <label class="field-label">
                                        Invoice Prefix
                                    </label>

                                    <input type="text" name="invoice_prefix" class="field-input"
                                        value="{{ old('invoice_prefix', $setting->invoice_prefix ?? 'INV') }}">
                                </div>

                                <div class="field-group">
                                    <label class="field-label">
                                        Invoice Type
                                    </label>

                                    <select name="invoice_type" id="invoice_type" class="field-select">

                                        <option value="serial" {{ old('invoice_type', $setting->invoice_type ?? 'serial') == 'serial' ? 'selected' : '' }}>
                                            Serial
                                        </option>

                                        <option value="random" {{ old('invoice_type', $setting->invoice_type ?? '') == 'random' ? 'selected' : '' }}>
                                            Random
                                        </option>

                                    </select>
                                </div>

                                <div class="field-group" id="serial_box">

                                    <label class="field-label">
                                        Invoice Serial
                                    </label>

                                    <input type="number" name="invoice_serial" class="field-input"
                                        value="{{ old('invoice_serial', $setting->invoice_serial ?? 1) }}">

                                </div>

                                <div class="field-group" id="random_box">

                                    <label class="field-label">
                                        Random Length
                                    </label>

                                    <input type="number" name="random_length" class="field-input"
                                        value="{{ old('random_length', $setting->random_length ?? 6) }}">

                                </div>

                                <div class="field-group">

                                    <label class="field-label">
                                        Terms & Conditions
                                    </label>

                                    <textarea name="terms_conditions" id="terms_conditions"
                                        class="field-textarea">{{ old('terms_conditions', $setting->terms_conditions ?? '') }}</textarea>

                                </div>

                            </div>

                        </div>

                        {{-- GST Settings --}}
                        <div class="section-card">

                            <div class="section-card-header">
                                <h5>GST Settings</h5>
                            </div>

                            <div class="section-card-body">

                                <div class="field-group">

                                    <label class="field-label">
                                        CGST (%)
                                    </label>

                                    <input type="number" step="0.01" name="cgst" class="field-input"
                                        value="{{ old('cgst', $setting->cgst ?? 9) }}">

                                </div>

                                <div class="field-group">

                                    <label class="field-label">
                                        SGST (%)
                                    </label>

                                    <input type="number" step="0.01" name="sgst" class="field-input"
                                        value="{{ old('sgst', $setting->sgst ?? 9) }}">

                                </div>

                                <div class="field-group">

                                    <label class="field-label">
                                        IGST (%)
                                    </label>

                                    <input type="number" step="0.01" name="igst" class="field-input"
                                        value="{{ old('igst', $setting->igst ?? 18) }}">

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- ── RIGHT column ─────────────────────────────── -->
                    <!-- ── RIGHT column ─────────────────────────────── -->
                    <div>

                        <!-- Company Logo -->
                        <div class="section-card">

                            <div class="section-card-header">
                                <h5>Company Logo</h5>
                            </div>

                            <div class="section-card-body">

                                <div class="file-upload-area" id="uploadArea">

                                    <input type="file" id="imageInput" name="company_logo" accept="image/*">

                                    <div class="upload-icon">
                                        <i class="fa fa-cloud-upload"></i>
                                    </div>

                                    <p>Click or drag company logo</p>

                                    <small>
                                        PNG, JPG, JPEG supported
                                    </small>

                                </div>

                                {{-- Existing Logo --}}
                                @if(!empty($setting->company_logo))

                                            <div style="margin-top:15px;text-align:center">

                                                <img src="{{ asset('storage/' . $setting->company_logo) }}" alt="Company Logo" style="
                                        max-width:100%;
                                        max-height:120px;
                                        border-radius:8px;
                                        border:1px solid #ddd;
                                        padding:5px;
                                    ">

                                            </div>

                                @endif

                                {{-- Preview --}}
                                <div id="imagePreview" style="display:none;margin-top:15px;text-align:center">

                                    <img id="previewImg" src="" alt="Preview" style="
                        max-width:100%;
                        border-radius:8px;
                        border:1px solid #ddd;
                    ">

                                    <div style="margin-top:8px">

                                        <button type="button" onclick="clearImage()" style="
                            font-size:12px;
                            color:#b22222;
                            background:none;
                            border:none;
                            cursor:pointer;
                            padding:0;
                        ">

                                            <i class="fa fa-times"></i>
                                            Remove

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- GST Status -->
                        <div class="section-card">

                            <div class="section-card-header">
                                <h5>GST Configuration</h5>
                            </div>

                            <div class="section-card-body">

                                <div class="toggle-row">

                                    <div>

                                        <div class="toggle-label">
                                            Enable GST
                                        </div>

                                        <div class="toggle-sub">
                                            Apply GST calculations to invoices
                                        </div>

                                    </div>

                                    <select name="gst_enabled" class="field-select-sm">

                                        <option value="1" {{ old('gst_enabled', $setting->gst_enabled ?? 1) ? 'selected' : '' }}>
                                            Enabled
                                        </option>

                                        <option value="0" {{ !old('gst_enabled', $setting->gst_enabled ?? 1) ? 'selected' : '' }}>
                                            Disabled
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <!-- Quick Information -->
                        <div class="section-card">

                            <div class="section-card-header">
                                <h5>Information</h5>
                            </div>

                            <div class="section-card-body">

                                <div class="field-hint">

                                    <strong>Invoice Prefix</strong><br>
                                    Example: INV-1001

                                    <hr>

                                    <strong>Serial Mode</strong><br>
                                    Sequential invoice numbers.

                                    <hr>

                                    <strong>Random Mode</strong><br>
                                    Generates random invoice numbers.

                                    <hr>

                                    <strong>GST Enabled</strong><br>
                                    Taxes will be applied automatically on invoices.

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Action bar -->
                <div class="action-bar">
                    <button type="submit" class="btn-primary-dash">
    <i class="fa fa-save"></i> Save Settings
</button>
                </div>

            </form>

        </div>
    </div>
</div>


@include('admin.footer')

<script>

@if(!empty($setting->company_state))
    $('#state_id').trigger('change');
@endif

    // Image preview
    document.getElementById('imageInput').addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
            document.getElementById('uploadArea').style.display = 'none';
        };
        reader.readAsDataURL(file);
    });

    function clearImage() {
        document.getElementById('imageInput').value = '';
        document.getElementById('imagePreview').style.display = 'none';
        document.getElementById('uploadArea').style.display = 'block';
    }

    function toggleInvoiceType() {

    let type = document.getElementById('invoice_type').value;

    document.getElementById('serial_box').style.display =
        type === 'serial' ? 'block' : 'none';

    document.getElementById('random_box').style.display =
        type === 'random' ? 'block' : 'none';
}

document.getElementById('invoice_type')
    .addEventListener('change', toggleInvoiceType);

toggleInvoiceType();


$('#state_id').on('change', function () {

    let stateId = $(this).val();

    $('#city_id').html('<option value="">Loading...</option>');

    if (stateId) {

        $.ajax({
            url: "{{ route('admin.get-cities') }}",
            type: "GET",
            data: {
                state_id: stateId
            },
            success: function (response) {

                let html = '<option value="">Select City</option>';

                $.each(response, function (key, city) {
                    html += `<option value="${city.id}">${city.name}</option>`;
                });

                $('#city_id').html(html);
            }
        });

    } else {

        $('#city_id').html('<option value="">Select City</option>');

    }
});

</script>
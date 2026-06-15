@include('admin.top-header')
<div class="main-section">
    @include('admin.header')

    <style>
    :root {
        --bg: #f1f2f4;
        --surface: #ffffff;
        --border: #e3e5e8;
        --text-primary: #202223;
        --text-secondary:#6d7175;
        --text-hint: #8c9196;
        --accent: #303d89;
        --accent-light: #f0f1fc;
        --green: #007a5e;
        --green-bg: #e3f1ec;
        --red: #b22222;
        --red-bg: #fce8e8;
        --amber: #916a00;
        --amber-bg: #fff5cc;
        --radius-sm: 8px;
        --radius-md: 12px;
        --shadow-card: 0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }
    .detail-page { 
        background: var(--bg); 
        padding: 24px 28px; 
        min-height: 100vh; 
        font-family: var(--font); 
        color: var(--text-primary); 
    }
    .detail-page * { box-sizing: border-box; }

    .detail-page-header { 
        display: flex; 
        align-items: flex-start; 
        justify-content: space-between; 
        flex-wrap: wrap; 
        gap: 12px; 
        margin-bottom: 20px; 
    }
    .detail-page-header h1 { 
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
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb a:hover { text-decoration: underline; }
    .crumb span { margin: 0 5px; }

    .section-card { 
        background: var(--surface); 
        border: 1px solid var(--border); 
        border-radius: var(--radius-md); 
        box-shadow: var(--shadow-card); 
        overflow: hidden; 
        margin-bottom: 20px; 
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
    }
    .section-card-body { padding: 20px; }

    .field-group { margin-bottom: 16px; }
    .field-label { 
        display: block; 
        font-size: 12px; 
        font-weight: 600; 
        color: var(--text-secondary); 
        letter-spacing: .03em; 
        text-transform: uppercase; 
        margin-bottom: 6px; 
    }
    .field-input, .field-textarea, .field-select {
        width: 100%; 
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
    .field-input, .field-select { height: 38px; }
    .field-textarea { padding: 10px 12px; resize: vertical; min-height: 100px; }
    .field-input:focus, .field-textarea:focus, .field-select:focus {
        border-color: var(--accent); 
        box-shadow: 0 0 0 3px rgba(48,61,137,.12);
    }

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
        .detail-page { padding: 16px; } 
    }
    </style>

    <div class="app-content content container-fluid">
        <div class="detail-page">
            <!-- Page header -->
            <div class="detail-page-header">
                <div>
                    <h1>Edit Feature Card</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.home-page.index') }}">Manage Home Page</a>
                        <span>›</span>
                        <a href="{{ route('admin.home-feature-cards.index') }}">Feature Cards</a>
                        <span>›</span>
                        Edit
                    </div>
                </div>
            </div>

            <div class="section-card">
                <div class="section-card-header">
                    <h5>Card Details</h5>
                </div>
                <div class="section-card-body">
                    <form method="POST" action="{{ route('admin.home-feature-cards.update', $card->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="field-group">
                                    <label class="field-label">Icon <span style="color:var(--red)">*</span></label>
                                    <input type="text" name="icon" value="{{ old('icon', $card->icon) }}" 
                                           class="field-input" placeholder="fal fa-truck" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field-group">
                                    <label class="field-label">Title <span style="color:var(--red)">*</span></label>
                                    <input type="text" name="title" value="{{ old('title', $card->title) }}" 
                                           class="field-input" required>
                                </div>
                            </div>
                        </div>

                        <div class="field-group">
                            <label class="field-label">Description</label>
                            <textarea name="content" rows="4" class="field-textarea">{{ old('content', $card->content) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="field-group">
                                    <label class="field-label">Card Class</label>
                                    <select name="card_class" class="field-input">
                                        <option value="aqf-pastel-peach" {{ $card->card_class == 'aqf-pastel-peach' ? 'selected' : '' }}>Peach</option>
                                        <option value="aqf-pastel-sage" {{ $card->card_class == 'aqf-pastel-sage' ? 'selected' : '' }}>Sage</option>
                                        <option value="aqf-pastel-champagne" {{ $card->card_class == 'aqf-pastel-champagne' ? 'selected' : '' }}>Champagne</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="field-group">
                                    <label class="field-label">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', $card->sort_order) }}" 
                                           class="field-input">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="field-group">
                                    <label class="field-label">Status</label>
                                    <select name="status" class="field-input">
                                        <option value="1" {{ $card->status ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ !$card->status ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Action bar -->
                        <div class="action-bar">
                            <a href="{{ route('admin.home-feature-cards.index') }}" class="btn-secondary-dash">
                                Cancel
                            </a>
                            <button type="submit" class="btn-primary-dash">
                                <i class="fa fa-save"></i> Update Card
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')
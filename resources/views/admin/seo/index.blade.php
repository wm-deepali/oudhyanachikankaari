@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
    :root {
        --bg:            #f1f2f4;
        --surface:       #ffffff;
        --border:        #e3e5e8;
        --text-primary:  #202223;
        --text-secondary:#6d7175;
        --text-hint:     #8c9196;
        --accent:        #303d89;
        --accent-light:  #f0f1fc;
        --green:         #007a5e;
        --green-bg:      #e3f1ec;
        --red:           #b22222;
        --red-bg:        #fce8e8;
        --radius-sm:     8px;
        --radius-md:     12px;
        --shadow-card:   0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font:          'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .list-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .list-page * { box-sizing: border-box; }

    /* ── Page header ── */
    .list-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .list-page-header h1 { font-size: 20px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb a:hover { text-decoration: underline; }
    .crumb span { margin: 0 5px; }

    /* ── Alert banner ── */
    .alert-banner { display: flex; align-items: center; gap: 8px; padding: 11px 16px; border-radius: var(--radius-sm); font-size: 13px; font-weight: 500; margin-bottom: 16px; }
    .alert-success { background: var(--green-bg); color: var(--green); border: 1px solid rgba(0,122,94,.18); }

    /* ── Main card ── */
    .list-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; }
    .list-card-header { padding: 16px 20px; border-bottom: 1px solid var(--border); }
    .list-card-header h5 { font-size: 14px; font-weight: 650; color: var(--text-primary); margin: 0; }

    /* ── Table ── */
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead tr { background: #fafafa; border-bottom: 1px solid var(--border); }
    .data-table thead th { padding: 10px 16px; font-size: 11px; font-weight: 650; text-transform: uppercase; letter-spacing: .05em; color: var(--text-secondary); white-space: nowrap; text-align: left; }
    .data-table tbody tr { border-bottom: 1px solid var(--border); transition: background .12s; }
    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #fafbfc; }
    .data-table td { padding: 13px 16px; font-size: 13px; color: var(--text-primary); vertical-align: middle; }

    /* ── ID chip ── */
    .id-chip { display: inline-block; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; padding: 2px 8px; font-size: 11.5px; font-family: 'SF Mono','Fira Mono',monospace; color: var(--text-secondary); }

    /* ── Text cells ── */
    .page-name { font-size: 13.5px; font-weight: 600; color: var(--text-primary); line-height: 1.4; }
    .meta-title-cell { font-size: 12.5px; color: var(--text-secondary); max-width: 420px; display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .text-empty { color: var(--text-hint); }

    /* ── Action buttons ── */
    .action-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px; border-radius: var(--radius-sm);
        border: 1px solid var(--border); background: var(--surface);
        color: var(--text-secondary); cursor: pointer; text-decoration: none;
        transition: all .15s; font-size: 12px;
    }
    .action-btn:hover      { background: var(--bg); color: var(--text-primary); border-color: #c9cccf; }
    .action-btn.edit:hover { background: var(--accent-light); color: var(--accent); border-color: rgba(48,61,137,.25); }

    /* ── Empty state ── */
    .empty-state { text-align: center; padding: 56px 24px; }
    .empty-icon-wrap { width: 56px; height: 56px; border-radius: 50%; background: var(--accent-light); margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 22px; }
    .empty-state h6 { font-size: 14px; font-weight: 650; color: var(--text-primary); margin: 0 0 6px; }
    .empty-state p  { font-size: 13px; color: var(--text-hint); margin: 0; }

    @media(max-width:768px) { .list-page { padding: 16px; } }

    /* ════════════════ MODAL (restyled Bootstrap modal) ════════════════ */
    #seoModal .modal-content {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: var(--radius-md); box-shadow: var(--shadow-card);
        overflow: hidden; font-family: var(--font);
    }
    #seoModal .modal-header {
        padding: 16px 20px; border-bottom: 1px solid var(--border);
        background: #fafafa; align-items: center;
    }
    #seoModal .modal-title { font-size: 14px; font-weight: 650; color: var(--text-primary); }
    #seoModal .modal-header .close {
        font-size: 20px; color: var(--text-hint); opacity: 1; text-shadow: none;
        transition: color .15s;
    }
    #seoModal .modal-header .close:hover { color: var(--text-primary); }
    #seoModal .modal-body { padding: 20px; }
    #seoModal .modal-footer {
        padding: 14px 20px; border-top: 1px solid var(--border);
        display: flex; align-items: center; justify-content: flex-end; gap: 10px;
    }

    #seoModal .field-group { margin-bottom: 16px; }
    #seoModal .field-group:last-child { margin-bottom: 0; }
    #seoModal .field-label {
        display: block; font-size: 12px; font-weight: 600; color: var(--text-secondary);
        letter-spacing: .03em; text-transform: uppercase; margin-bottom: 6px;
    }
    #seoModal .field-input, #seoModal .field-textarea {
        width: 100%; border: 1px solid var(--border);
        border-radius: var(--radius-sm); padding: 0 12px;
        font-size: 13.5px; color: var(--text-primary);
        background: var(--surface); outline: none;
        transition: border-color .15s, box-shadow .15s;
        font-family: var(--font);
    }
    #seoModal .field-input { height: 38px; }
    #seoModal .field-textarea { padding: 10px 12px; resize: vertical; font-family: var(--font); }
    #seoModal .field-textarea.code { font-family: 'SF Mono','Fira Mono',monospace; font-size: 12.5px; }
    #seoModal .field-input:focus, #seoModal .field-textarea:focus {
        border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12);
    }
    #seoModal .field-hint { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }

    #seoModal .btn-primary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--accent); color: #fff !important; border: none;
        border-radius: var(--radius-sm); padding: 8px 18px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        font-family: var(--font); transition: background .15s;
        box-shadow: 0 1px 3px rgba(48,61,137,.25);
    }
    #seoModal .btn-primary-dash:hover { background: #252f70; }
    #seoModal .btn-secondary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--surface); color: var(--text-primary) !important;
        border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 8px 18px; font-size: 13px; font-weight: 500;
        font-family: var(--font); transition: background .15s; cursor: pointer;
    }
    #seoModal .btn-secondary-dash:hover { background: var(--bg); }
    #seoModal .img-preview-wrap {
    display: none;
    align-items: center;
    gap: 10px;
    margin-top: 8px;
    padding: 8px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
}
#seoModal .img-preview-wrap img {
    width: 56px; height: 56px; object-fit: cover;
    border-radius: 6px; border: 1px solid var(--border); background: #fff;
}
#seoModal .img-preview-wrap .img-preview-label {
    font-size: 11.5px; color: var(--text-hint); word-break: break-all;
}
    </style>

    <div class="app-content content container-fluid">
        <div class="list-page">

            <!-- Page header -->
            <div class="list-page-header">
                <div>
                    <h1>Manage SEO</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Manage SEO
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert-banner alert-success">
                    <i class="fa fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Main card -->
            <div class="list-card">

                <div class="list-card-header">
                    <h5>SEO Pages</h5>
                </div>

                <div style="overflow-x:auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="width:60px">ID</th>
                                <th>Page</th>
                                <th>Meta Title</th>
                                <th style="width:90px">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($pages as $page)

                                <tr>

                                    <td><span class="id-chip">{{ $page->id }}</span></td>

                                    <td>
                                        <span class="page-name">{{ $page->page_name }}</span>
                                    </td>

                                    <td>
                                        @if($page->meta_title)
                                            <span class="meta-title-cell" title="{{ $page->meta_title }}">{{ $page->meta_title }}</span>
                                        @else
                                            <span class="meta-title-cell text-empty">—</span>
                                        @endif
                                    </td>

                                    <td>
                                      <button type="button" class="action-btn edit" title="Edit SEO" onclick="openSeoModal(
            {{ $page->id }},
            '{{ $page->page_name }}',
            '{{ $page->slug }}',
            `{!! $page->meta_title !!}`,
            `{!! $page->meta_description !!}`,
            `{!! $page->scripts !!}`,
            `{!! $page->canonical_url !!}`,
            `{!! $page->og_title !!}`,
            `{!! $page->og_description !!}`,
            `{{ $page->og_image }}`,
            `{!! $page->og_url !!}`,
            `{{ $page->twitter_card }}`,
            `{{ $page->twitter_image }}`
        )">
    <i class="fa fa-pencil"></i>
</button>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state">
                                            <div class="empty-icon-wrap">
                                                <i class="fa fa-magnifying-glass-chart"></i>
                                            </div>
                                            <h6>No SEO Pages Found</h6>
                                            <p>SEO entries will appear here once pages are registered.</p>
                                        </div>
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

@include('admin.footer')


{{-- ================= MODAL ================= --}}
<div class="modal fade" id="seoModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="seoForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit SEO</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    {{-- SLUG --}}
                    <input type="hidden" name="slug" id="seo_slug">

                    {{-- META TITLE --}}
                    <div class="field-group">
                        <label class="field-label">Meta Title</label>
                        <input type="text" name="meta_title" id="seo_title" class="field-input">
                    </div>

                    {{-- META DESCRIPTION --}}
                    <div class="field-group">
                        <label class="field-label">Meta Description</label>
                        <textarea name="meta_description" id="seo_desc" class="field-textarea" rows="3"></textarea>
                    </div>

{{-- modal-body ke andar, meta_description ke baad add karo --}}

<div class="field-group">
    <label class="field-label">Canonical URL</label>
    <input type="text" name="canonical_url" id="seo_canonical" class="field-input" placeholder="https://example.com/page">
</div>

<div class="field-group">
    <label class="field-label">OG Title</label>
    <input type="text" name="og_title" id="seo_og_title" class="field-input">
</div>

<div class="field-group">
    <label class="field-label">OG Description</label>
    <textarea name="og_description" id="seo_og_desc" class="field-textarea" rows="3"></textarea>
</div>

<div class="field-group">
    <label class="field-label">OG Image</label>
    <input type="file" name="og_image" id="seo_og_image" class="field-input" accept="image/*" style="padding-top:8px;">
    <div class="img-preview-wrap" id="seo_og_image_preview_wrap">
        <img id="seo_og_image_preview" src="" alt="OG Image">
        <a href="#" target="_blank" id="seo_og_image_link" class="img-preview-label">View full image</a>
    </div>
</div>

<div class="field-group">
    <label class="field-label">OG URL</label>
    <input type="text" name="og_url" id="seo_og_url" class="field-input" placeholder="https://example.com/page">
</div>

<div class="field-group">
    <label class="field-label">Twitter Card</label>
    <select name="twitter_card" id="seo_twitter_card" class="field-input">
        <option value="summary_large_image">summary_large_image</option>
        <option value="summary">summary</option>
    </select>
</div>

<div class="field-group">
    <label class="field-label">Twitter Image</label>
    <input type="file" name="twitter_image" id="seo_twitter_image" class="field-input" accept="image/*" style="padding-top:8px;">
    <div class="img-preview-wrap" id="seo_twitter_image_preview_wrap">
        <img id="seo_twitter_image_preview" src="" alt="Twitter Image">
        <a href="#" target="_blank" id="seo_twitter_image_link" class="img-preview-label">View full image</a>
    </div>
</div>

                    {{-- SCRIPTS (ONLY HOME) --}}
                    <div class="field-group" id="scriptBox">
                        <label class="field-label">Scripts (Only for Home Page)</label>
                        <textarea name="scripts" id="seo_scripts" class="field-textarea code" rows="4"></textarea>
                        <div class="field-hint">Raw script tags injected into the page &lt;head&gt;.</div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary-dash" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-primary-dash">
                        <i class="fa-solid fa-save"></i> Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


{{-- ================= SCRIPT ================= --}}
<script>

   function openSeoModal(id, name, slug, title, desc, scripts, canonical, ogTitle, ogDesc, ogImage, ogUrl, twitterCard, twitterImage) {

    $('#seo_slug').val(slug);
    $('#seo_title').val(title);
    $('#seo_desc').val(desc);
    $('#seo_scripts').val(scripts);

    $('#seo_canonical').val(canonical);
    $('#seo_og_title').val(ogTitle);
    $('#seo_og_desc').val(ogDesc);
    $('#seo_og_url').val(ogUrl);
    $('#seo_twitter_card').val(twitterCard || 'summary_large_image');

    $('#seo_og_image').val('');
    $('#seo_twitter_image').val('');

    setImagePreview('og', ogImage);
    setImagePreview('twitter', twitterImage);

    $('#seoForm').attr('action', '/admin/seo/' + id);

    if (name === 'Home') {
        $('#scriptBox').show();
    } else {
        $('#scriptBox').hide();
    }

    $('#seoModal').modal('show');
}

function setImagePreview(type, url) {
    const $wrap = $('#seo_' + type + '_image_preview_wrap');
    const $img  = $('#seo_' + type + '_image_preview');
    const $link = $('#seo_' + type + '_image_link');

    if (url) {
        $img.attr('src', url);
        $link.attr('href', url);
        $wrap.css('display', 'flex');
    } else {
        $wrap.hide();
    }
}

// naya file select karne par turant preview dikhana (upload se pehle)
$(document).on('change', '#seo_og_image, #seo_twitter_image', function () {
    const type = this.id === 'seo_og_image' ? 'og' : 'twitter';
    const file = this.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = e => setImagePreview(type, e.target.result);
    reader.readAsDataURL(file);
});

</script>
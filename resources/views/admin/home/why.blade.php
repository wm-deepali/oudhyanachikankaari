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
    .field-input, .field-textarea {
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
    .field-input { height: 38px; }
    .field-textarea { padding: 10px 12px; resize: vertical; min-height: 80px; }
    .field-input:focus, .field-textarea:focus {
        border-color: var(--accent); 
        box-shadow: 0 0 0 3px rgba(48,61,137,.12);
    }

    .data-table { 
        width: 100%; 
        border-collapse: collapse; 
        font-size: 13px; 
    }
    .data-table thead th { 
        font-size: 11px; 
        font-weight: 650; 
        letter-spacing: .06em; 
        text-transform: uppercase; 
        color: var(--text-hint); 
        padding: 12px 16px; 
        border-bottom: 1px solid var(--border); 
        background: #fafafa; 
        text-align: left; 
    }
    .data-table tbody tr { 
        border-bottom: 1px solid var(--border); 
        transition: background .1s; 
    }
    .data-table tbody tr:hover { background: #fafbfc; }
    .data-table td { padding: 14px 16px; vertical-align: middle; }

    .action-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px; border-radius: var(--radius-sm);
        border: 1px solid var(--border); background: var(--surface);
        color: var(--text-secondary); cursor: pointer; text-decoration: none;
        transition: all .15s;
    }
    .action-btn:hover { background: var(--bg); color: var(--text-primary); }

    @media(max-width:768px) { .detail-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="detail-page">
            <!-- Page header -->
            <div class="detail-page-header">
                <div>
                    <h1>Why Choose Us</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.home-page.index') }}">Manage Home Page</a>
                        <span>›</span>
                        Why Choose Us
                    </div>
                </div>
            </div>

            <!-- Section Content -->
            <div class="section-card">
                <div class="section-card-header">
                    <h5>Section Content</h5>
                </div>
                <div class="section-card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.home.why.update') }}">
                        @csrf
                        <div class="field-group">
                            <label class="field-label">Heading <span style="color:var(--red)">*</span></label>
                            <input type="text" name="heading" value="{{ old('heading', $why->heading ?? '') }}" 
                                   class="field-input" required>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Sub Heading <span style="color:var(--red)">*</span></label>
                            <input type="text" name="sub_heading" value="{{ old('sub_heading', $why->sub_heading ?? '') }}" 
                                   class="field-input" required>
                        </div>
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-save"></i> Update Section
                        </button>
                    </form>
                </div>
            </div>

            <!-- Add New Card -->
            <div class="section-card">
                <div class="section-card-header">
                    <h5>Add New Card</h5>
                </div>
                <div class="section-card-body">
                    <form method="POST" action="{{ route('admin.home.why.card.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="field-group">
                                    <label class="field-label">Title <span style="color:var(--red)">*</span></label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="field-input" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="field-group">
                                    <label class="field-label">Icon <span style="color:var(--red)">*</span></label>
                                    <input type="text" name="icon" value="{{ old('icon') }}" class="field-input" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="field-group">
                                    <label class="field-label">Content</label>
                                    <input type="text" name="content" value="{{ old('content') }}" class="field-input">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-plus"></i> Add Card
                        </button>
                    </form>
                </div>
            </div>

            <!-- Cards List -->
            <div class="section-card">
                <div class="section-card-header">
                    <h5>Cards List</h5>
                </div>
                <div class="section-card-body">
                    <div style="overflow-x:auto">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th width="80">ID</th>
                                    <th>Icon</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cards as $card)
                                    <tr id="row{{ $card->id }}">
                                        <td><span class="id-chip">{{ $card->id }}</span></td>
                                        <td>
                                            <i class="{{ $card->icon }}" style="font-size:22px"></i>
                                            <small class="text-muted ml-2">{{ $card->icon }}</small>
                                        </td>
                                        <td>{{ $card->title }}</td>
                                        <td>{{ $card->content }}</td>
                                        <td>
                                            <button class="action-btn" onclick="editCard({{ $card->id }})" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button class="action-btn" style="color:var(--red)" onclick="deleteCard({{ $card->id }})" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            No Cards Found
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
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editCardModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editCardForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Card</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="field-group">
                        <label class="field-label">Title</label>
                        <input type="text" name="title" id="editTitle" class="field-input">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Content</label>
                        <input type="text" name="content" id="editContent" class="field-input">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Icon</label>
                        <input type="text" name="icon" id="editIcon" class="field-input">
                    </div>
                    <div id="currentIconPreview" style="margin-top:10px"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary-dash" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-primary-dash">Update Card</button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('admin.footer')

<script>
// Your existing scripts remain unchanged
function editCard(id) {
    $.get("{{ url('admin/home-why/card') }}/" + id, function (data) {
        $('#editTitle').val(data.title);
        $('#editContent').val(data.content);
        $('#editIcon').val(data.icon);
        $('#editCardForm').attr('action', "{{ url('admin/home-why/card') }}/" + id);
        
        if (data.icon) {
            $('#currentIconPreview').html(`<i class="${data.icon}" style="font-size:32px;"></i><div class="mt-2">${data.icon}</div>`);
        } else {
            $('#currentIconPreview').html('<span class="text-muted">No icon</span>');
        }
        $('#editCardModal').modal('show');
    });
}

function deleteCard(id) {
    Swal.fire({
        title: 'Delete Card?',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#b22222',
        cancelButtonColor: '#6d7175',
        confirmButtonText: 'Yes, Delete'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ url('admin/home-why/card') }}/" + id,
                type: "DELETE",
                data: { _token: "{{ csrf_token() }}" },
                success: function (res) {
                    Swal.fire('Deleted!', res.message || 'Card removed successfully', 'success');
                    $("#row" + id).fadeOut(300, function () { $(this).remove(); });
                }
            });
        }
    });
}
</script>
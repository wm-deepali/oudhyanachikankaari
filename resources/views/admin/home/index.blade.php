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
    .list-page { 
        background: var(--bg); 
        padding: 24px 28px; 
        min-height: 100vh; 
        font-family: var(--font); 
        color: var(--text-primary); 
    }
    .list-page * { box-sizing: border-box; }

    .list-page-header { 
        display: flex; 
        align-items: flex-start; 
        justify-content: space-between; 
        flex-wrap: wrap; 
        gap: 12px; 
        margin-bottom: 20px; 
    }
    .list-page-header h1 { 
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

    .list-card { 
        background: var(--surface); 
        border: 1px solid var(--border); 
        border-radius: var(--radius-md); 
        box-shadow: var(--shadow-card); 
        overflow: hidden; 
    }

    .data-table { 
        width: 100%; 
        border-collapse: collapse; 
        font-size: 13px; 
        font-family: var(--font); 
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
    .data-table tbody tr:hover { 
        background: #fafbfc; 
    }
    .data-table td { 
        padding: 14px 16px; 
        color: var(--text-primary); 
        vertical-align: middle; 
    }

    .badge { 
        font-size: 11.5px; 
        font-weight: 600; 
        padding: 4px 10px; 
        border-radius: 20px; 
    }

    .btn-outline-dark {
        border: 1px solid var(--border);
        color: var(--text-primary);
        padding: 6px 12px;
        font-size: 13px;
    }

    @media(max-width:768px) { 
        .list-page { padding: 16px; } 
    }
    </style>

    <div class="app-content content container-fluid">
        <div class="list-page">
            <!-- Page header -->
            <div class="list-page-header">
                <div>
                    <h1>Manage Home Page</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Manage Home Page
                    </div>
                </div>
            </div>

            <!-- Main card -->
            <div class="list-card">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th width="80">#</th>
                                <th>Section Name</th>
                                <th width="150">Type</th>
                                <th width="150">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><strong>Home Sliders</strong></td>
                                <td><span class="badge badge-info">Multiple</span></td>
                                <td>
                                    <a href="{{ route('admin.home.sliders.index') }}" class="btn btn-sm btn-outline-dark">
                                        <i class="fa fa-pencil"></i> Manage
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><strong>Text Slider Section</strong></td>
                                <td><span class="badge badge-info">Multiple</span></td>
                                <td>
                                    <a href="{{ route('admin.home.text-sliders.index') }}" class="btn btn-sm btn-outline-dark">
                                        <i class="fa fa-pencil"></i> Manage
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><strong>Feature Cards</strong></td>
                                <td><span class="badge badge-info">Multiple</span></td>
                                <td>
                                    <a href="{{ route('admin.home-feature-cards.index') }}" class="btn btn-sm btn-outline-dark">
                                        <i class="fa fa-pencil"></i> Manage
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><strong>Deal Banners</strong></td>
                                <td><span class="badge badge-info">Multiple</span></td>
                                <td>
                                    <a href="{{ route('admin.home-deal-banners.index') }}" class="btn btn-sm btn-outline-dark">
                                        <i class="fa fa-pencil"></i> Manage
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><strong>Hero Slides</strong></td>
                                <td><span class="badge badge-info">Multiple</span></td>
                                <td>
                                    <a href="{{ route('admin.home-hero-slides.index') }}" class="btn btn-sm btn-outline-dark">
                                        <i class="fa fa-pencil"></i> Manage
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td><strong>Hero Side Banners</strong></td>
                                <td><span class="badge badge-info">Multiple</span></td>
                                <td>
                                    <a href="{{ route('admin.home-hero-banners.index') }}" class="btn btn-sm btn-outline-dark">
                                        <i class="fa fa-pencil"></i> Manage
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td><strong>Brand Promotion Section</strong></td>
                                <td><span class="badge badge-primary">Fixed + Slider</span></td>
                                <td>
                                    <a href="{{ route('admin.home.brand-section.edit') }}" class="btn btn-sm btn-outline-dark">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <a href="{{ route('admin.home-brand-section-images.index') }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-images"></i> Slider Images
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td><strong>Premium Gifting Gallery</strong></td>
                                <td><span class="badge badge-info">Multiple</span></td>
                                <td>
                                    <a href="{{ route('admin.gallery-images.index') }}" class="btn btn-sm btn-outline-dark">
                                        <i class="fa fa-pencil"></i> Manage
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td><strong>Why Choose Us</strong></td>
                                <td><span class="badge badge-info">Multiple</span></td>
                                <td>
                                    <a href="{{ route('admin.home.why.index') }}" class="btn btn-sm btn-outline-dark">
                                        <i class="fa fa-pencil"></i> Manage
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')
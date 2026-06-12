@include('admin.top-header')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>

/* Main Content */
.content-area{
    padding:20px;
    min-height:100vh;
}

/* Hero */
.hero{
    background:linear-gradient(135deg,#4f46e5,#7c3aed);
    border-radius:20px;
    padding:30px;
    box-shadow:0 8px 25px rgba(79,70,229,.15);
}

.hero h1,
.hero h2,
.hero h3,
.hero h4,
.hero h5,
.hero h6,
.hero p,
.hero small{
    color:#fff !important;
}

/* Cards */
.cardx{
    background:#fff;
    color:#212529;
    border-radius:18px;
    padding:20px;
    box-shadow:0 2px 15px rgba(0,0,0,.06);
    transition:.3s;
    height:100%;
}

.cardx:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

.cardx h1,
.cardx h2,
.cardx h3,
.cardx h4,
.cardx h5,
.cardx h6,
.cardx p,
.cardx td,
.cardx th,
.cardx li{
    color:#212529 !important;
}

/* KPI */
.kpi{
    position:relative;
    overflow:hidden;
}

.kpi i{
    position:absolute;
    right:20px;
    top:20px;
    font-size:30px;
    opacity:.12;
}

/* Badge */
.badge-soft{
    background:#eef2ff;
    color:#4f46e5;
}

/* Table Images */
.table img{
    width:40px;
    height:40px;
    border-radius:8px;
    object-fit:cover;
}

/* Scrollbar */
#cssmenu::-webkit-scrollbar{
    width:6px;
}

#cssmenu::-webkit-scrollbar-thumb{
    background:#d1d5db;
    border-radius:10px;
}



@media(max-width:768px){


    .content-area{
        padding:15px;
    }

    .hero{
        padding:20px;
    }
}
</style>

<div class="main-section">
  @include('admin.header')

 <div class="container-fluid">

    <div class="content-area">

        <!-- HERO -->
        <div class="hero mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-2">
                        Welcome Back, {{ auth()->user()->name }}
                    </h2>

                    <p class="mb-0">
                        Monitor revenue, orders, customers, inventory and enquiries from one dashboard.
                    </p>
                </div>

                <div class="col-md-4 text-md-end">
                    <h2>₹12,54,890</h2>
                    <small>Total Revenue This Month</small>
                </div>
            </div>
        </div>

        <!-- KPI -->
        <div class="row g-4 mb-4">

            <div class="col-lg-3 col-md-6">
                <div class="cardx kpi">
                    <i class="fa fa-box"></i>
                    <h6>Total Products</h6>
                    <h2>2458</h2>
                    <span class="badge badge-soft">+12%</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="cardx kpi">
                    <i class="fa fa-shopping-cart"></i>
                    <h6>Total Orders</h6>
                    <h2>8245</h2>
                    <span class="badge bg-success">+18%</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="cardx kpi">
                    <i class="fa fa-users"></i>
                    <h6>Customers</h6>
                    <h2>1456</h2>
                    <span class="badge bg-info">+8%</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="cardx kpi">
                    <i class="fa fa-wallet"></i>
                    <h6>Pending Payments</h6>
                    <h2>₹58,900</h2>
                    <span class="badge bg-warning text-dark">
                        Pending
                    </span>
                </div>
            </div>

        </div>

        <!-- CHARTS -->
        <div class="row g-4 mb-4">

            <div class="col-lg-8">
                <div class="cardx">
                    <h5>Sales Analytics</h5>
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="cardx">
                    <h5>Order Status</h5>

                    <p>Pending</p>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-warning"
                             style="width:35%"></div>
                    </div>

                    <p>Processing</p>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-info"
                             style="width:60%"></div>
                    </div>

                    <p>Delivered</p>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-success"
                             style="width:90%"></div>
                    </div>

                </div>
            </div>

        </div>

          <!-- Orders -->
            <div class="row g-4 mb-4">

                <div class="col-lg-8">
                    <div class="cardx">
                        <h5>Recent Orders</h5>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Order</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>#ORD001</td>
                                <td>John Smith</td>
                                <td>₹2500</td>
                                <td><span class="badge bg-success">Delivered</span></td>
                            </tr>

                            <tr>
                                <td>#ORD002</td>
                                <td>Amit Kumar</td>
                                <td>₹4200</td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                            </tr>

                            <tr>
                                <td>#ORD003</td>
                                <td>Sara Khan</td>
                                <td>₹1850</td>
                                <td><span class="badge bg-info">Processing</span></td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="cardx">
                        <h5>Top Selling Products</h5>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">iPhone 16 Pro <span class="float-end">450</span></li>
                            <li class="list-group-item">Samsung S26 <span class="float-end">390</span></li>
                            <li class="list-group-item">MacBook Pro <span class="float-end">280</span></li>
                            <li class="list-group-item">AirPods Pro <span class="float-end">250</span></li>
                        </ul>

                    </div>
                </div>

            </div>

    </div>

</div>

  </div>
</div>

    @include('admin.footer')
  </div>
</div>

<script>
new Chart(document.getElementById('salesChart'),{
type:'line',
data:{
labels:['Jan','Feb','Mar','Apr','May','Jun','Jul'],
datasets:[{
label:'Revenue',
data:[12000,19000,15000,26000,32000,28000,41000],
fill:true,
tension:.4
}]
}
});
</script>
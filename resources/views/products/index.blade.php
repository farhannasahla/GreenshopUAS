<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenShop - Katalog Produk</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f7f6;
        }

        .header-card{
            background: linear-gradient(135deg,#198754,#20c997);
            color:white;
            border-radius:15px;
            padding:25px;
            margin-bottom:25px;
        }

        .product-table{
            background:white;
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 4px 12px rgba(0,0,0,0.1);
        }

        .price{
            color:#198754;
            font-weight:bold;
        }

        .stock-badge{
            font-size:14px;
        }

        .table th{
            background:#198754;
            color:white;
        }

        .pagination{
            justify-content:center;
        }
    </style>
</head>
<body>

<div class="container mt-4">

    <div class="header-card">
        <h2>🌱 GreenShop Product Catalog</h2>
        <p class="mb-0">
            Sustainable Application Development Project
        </p>
    </div>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <div class="row text-center">

                <div class="col-md-4">
                    <h4>{{ $products->total() }}</h4>
                    <small>Total Produk</small>
                </div>

                <div class="col-md-4">
                    <h4>{{ $products->currentPage() }}</h4>
                    <small>Halaman Saat Ini</small>
                </div>

                <div class="col-md-4">
                    <h4>{{ $products->perPage() }}</h4>
                    <small>Produk per Halaman</small>
                </div>

            </div>
        </div>
    </div>

    <div class="product-table">

        <table class="table table-hover align-middle mb-0">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>

            <tbody>

                @foreach($products as $product)

                <tr>
                    <td>{{ $product->id }}</td>

                    <td>
                        <strong>{{ $product->name }}</strong>
                    </td>

                    <td>
                        <span class="badge bg-primary">
                            {{ $product->category->name }}
                        </span>
                    </td>

                    <td class="price">
                        Rp {{ number_format($product->price,0,',','.') }}
                    </td>

                    <td>

                        @if($product->stock > 50)

                            <span class="badge bg-success stock-badge">
                                {{ $product->stock }} Tersedia
                            </span>

                        @elseif($product->stock > 20)

                            <span class="badge bg-warning text-dark stock-badge">
                                {{ $product->stock }} Tersedia
                            </span>

                        @else

                            <span class="badge bg-danger stock-badge">
                                {{ $product->stock }} Tersedia
                            </span>

                        @endif

                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>

</div>

</body>
</html>
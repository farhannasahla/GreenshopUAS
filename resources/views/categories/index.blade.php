<h2>Daftar Kategori</h2>

<table border="1">
    <tr>
        <th>Kategori</th>
        <th>Jumlah Produk</th>
    </tr>

    @foreach($categories as $category)
    <tr>
        <td>{{ $category->name }}</td>
        <td>{{ $category->products_count }}</td>
    </tr>
    @endforeach
</table>
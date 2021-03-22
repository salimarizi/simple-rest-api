@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">RSS</div>

                <div class="card-body">
                    <form class="col-md-12" action="" method="get">
                      <div class="row">
                        <select class="form-control col-md-2" name="source">
                          <option value="rss">RSS</option>
                          <option value="api">API</option>
                        </select>
                        <input type="text" name="search" class="form-control col-md-4" placeholder="Cari Judul Berita disini...">
                        <button type="submit" class="btn btn-primary">Cari</button>
                      </div>
                    </form>
                    <br>

                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Judul</th>
                          <th>Tanggal Publis</th>
                          <th>Link</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php($salim = 1)
                        @foreach ($news as $berita)
                          <tr>
                            <td>{{ $salim++ }}</td>
                            <td>{{ $berita['title'] }}</td>
                            <td>{{ $berita['published_date'] }}</td>
                            <td>{{ $berita['link'] }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

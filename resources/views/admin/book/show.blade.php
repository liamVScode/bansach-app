@extends('admin.layout.default')

@section('template_title')
    {{ $book->BookTitle }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Thông tin') }} sách</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('book.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>BookID:</strong>
                            {{ $book->BookID }}
                        </div>
                        <div class="form-group">
                            <strong>Tên sách:</strong>
                            {{ $book->BookTitle }}
                        </div>
                        <div class="form-group">
                            <strong>Tác giả:</strong>
                            {{ $book->Author }}
                        </div>
                        <div class="form-group">
                            <strong>Nhà xuất bản:</strong>
                            {{ $book->PublisherID }}
                        </div>
                        <div class="form-group">
                            <strong>Giá nhập:</strong>
                            {{ $book->CostPrice }}
                        </div>
                        <div class="form-group">
                            <strong>Giá bán:</strong>
                            {{ $book->SellingPrice }}
                        </div>
                        <div class="form-group">
                            <strong>Số lượng:</strong>
                            {{ $book->QuantityInStock }}
                        </div>
                        <div class="form-group">
                            <strong>Số trang:</strong>
                            {{ $book->PageCount }}
                        </div>
                        <div class="form-group">
                            <strong>Trọng lượng:</strong>
                            {{ $book->Weight }}
                        </div>
                        <div class="form-group">
                            <strong>Đường dẫn ảnh:</strong>
                            {{ $book->Avatar }}
                        </div>
                        <div class="form-group">
                            <strong>Loại bìa:</strong>
                            {{ $book->CoverStyle }}
                        </div>
                        <div class="form-group">
                            <strong>Kích thước:</strong>
                            {{ $book->Size }}
                        </div>
                        <div class="form-group">
                            <strong>Năm xuất bản:</strong>
                            {{ $book->YearPublished }}
                        </div>
                        <div class="form-group">
                            <strong>Thuộc tập:</strong>
                            {{ $book->SetID }}
                        </div>
                        <div class="form-group">
                            <strong>Thể loại:</strong>
                            @foreach($genres as $genre)
                                <button type="button" class="btn btn-outline-primary btn-sm">{{ $genre->GenreName }}</button>

                            @endforeach
                        </div>
                        <div class="form-group">
                            <strong>Lượt xem:</strong>
                            {{ $book->ViewCount }}
                        </div>
                        <div class="form-group">
                            <strong>Ngày tạo:</strong>
                            {{ $book->CreatedDate }}
                        </div>
                        <div class="form-group">
                            <strong>Người tạo:</strong>
                            {{ $book->CreatedBy }}
                        </div>
                        <div class="form-group">
                            <strong>Ngày sửa:</strong>
                            {{ $book->ModifiedDate }}
                        </div>
                        <div class="form-group">
                            <strong>Người sửa:</strong>
                            {{ $book->ModifiedBy }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
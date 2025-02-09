@extends('layouts.main')

@section('title', '人口 取り込み')

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        @csrf <!-- {{ csrf_field() }} -->
        @if (isset($import_status))
        <div class="row">
            @if ($import_status)
                <div class="alert alert-success" role="alert">
                    取り込みが終了しました。
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    取り込み中エラーが発生しました。
                </div>
            @endif
        </div>
        @endif
        
        <div class="form-group">
            <label for="file">CSVファイル</label>
            <input name="csv_file" type="file" class="form-control-file" id="file">
            <button type="submit" class="btn btn-primary mb-2">アップロード</button>
        </div>
        <div class="row">
            <p>＊取り込みの際に現在保存されているデータは削除されます。</p>
        </div>
    </form>
@endsection
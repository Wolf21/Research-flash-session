@extends('layouts.main')
@section('title')
    <title>Confirm</title>
@stop
@section('content')
    <main class="l-main">
        <div class="l-inner">
            {{ Form::open(['url' => "/product/complete", 'method' => 'POST']) }}
            <input type="hidden" name="product_name_txt" value="{{ $inputs['product_name_txt'] }}">
            <input type="hidden" name="status" value="{{ $inputs['status'] }}">
            <input type="hidden" name="product_id" value="{{ $inputs['product_id'] ?? '' }}">
            <input type="hidden" name="redirect" value="{{ url()->previous() }}">
            @if ($inputs['product_id'])
                <input type="hidden" name="updated_at" value="{{ old('updated_at', $inputs['updated_at']) }}">
            @endif
            <h1 class="title-level01">Confirm</h1>
            <div class="l-container">
                <div class="l-block">
                    <div class="l-block__inner">
                        <div class="post-content">
                            <div class="post-list">
                                <div class="post-list__item">
                                    <div class="form-parts__title">
                                        <p class="title-level04">商品名</p>
                                    </div>
                                    <div class="form-parts__contents">
                                        <div class="form-parts__content is-m pct-mail">
                                            <p class="td-wrap-text">{{ $inputs['product_name_txt'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-list__item">
                                    <div class="form-parts__title">
                                        <p class="title-level04">ステータス</p>
                                    </div>
                                    <div class="form-parts__contents">
                                        <div class="form-parts__content is-m">
                                            @if ($inputs['status'] == 1)
                                                <p><i class='fas fa-circle clg'></i> Active</p>
                                            @else
                                                <p><i class='fas fa-circle clr'></i> InActive</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="l-container">
                <div class="post-button">
                    <div class="post-button__item">
                        <button class="button-basic" type="submit">保存</button>
                    </div>
                    <div class="post-button__item">
                        <a class="button-basic" href="{{ $previous }}">キャンセル</a>
                    </div>
                    <div class="post-button__item">
                        <a class="button-basic" href="{{ $previous }}">戻る</a>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </main>
@stop

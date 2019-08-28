@extends('layouts.main')
@section('title')
    <title></title>
@stop
@section('content')
    <main class="l-main">
        <div class="l-inner">
            {{ Form::open(['url' => "/product/confirm", 'id' => 'submit-form', 'method' => 'POST', 'autocomplete' => 'off']) }}
            <input type="hidden" name="product_id"
                   value="{{ $productDetail->product_id ?? old('product_id') }}">
            @if (isset($productDetail->product_id))
                <input type="hidden" name="updated_at"
                       value="{{ old('updated_at') ? old('updated_at') : encrypt((string)$productDetail['updated_at'])}}">
            @endif
            <h1 class="title-level01">Add/Edit</h1>
            <div class="l-container">
                <div class="l-block is-alert">
                    <div class="l-block__inner">
                        @if(\Session::has('error'))
                            <div class="post-content no-header">
                                <div class="post-content__note">
                                    <p class="message__title text-error">ERROR</p>
                                    <p class="text-error">{{ \Session::get('error') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @php $old = session()->getOldInput(); @endphp
                <div class="l-block">
                    <div class="l-block__inner">
                        <div class="post-content">
                            <div class="post-list">
                                <div class="post-list__item">
                                    <div class="form-parts__title">
                                        <p class="title-level04 form-required">商品名</p>
                                    </div>
                                    <div class="form-parts__contents">
                                        <div class="form-parts__content is-m">
                                            <div class="form-text">
                                                <input type="text" name="product_name_txt" placeholder="入力してください。"
                                                       value="{{ !empty($old) ? old('product_name_txt') : ($productDetail->name ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="form-parts__caption">
                                            <p class="text-error">{{ $errors->first('product_name_txt') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-list__item">
                                    <div class="form-parts__title">
                                        <p class="title-level04 form-required">ステータス</p>
                                    </div>
                                    <div class="form-parts__contents">
                                        <div class="form-parts__content">
                                            <div class="form-radio">
                                                @php $status = (old('status') ?? ($productDetail->is_active ?? '-1')) @endphp
                                                <div class="form-radio__item">
                                                    <input id="status_1" type="radio" name="status"
                                                           value="1" {{ ($status == 1) ? 'checked' : null }}>
                                                    <label for="status_1">
                                                        <div class="form-radio__name">アクティブ</div>
                                                    </label>
                                                </div>
                                                <div class="form-radio__item">
                                                    <input id="status_2" type="radio" name="status"
                                                           value="0" {{ ($status == 0) ? 'checked' : null }}>
                                                    <label for="status_2">
                                                        <div class="form-radio__name">非アクティブ</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-parts__caption">
                                            <p class="text-error">{{ $errors->first('status') }}</p>
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
                    @if (isset($productDetail->product_id))
                        <input type="hidden" name="delete" id="delete_input" value="0">
                        <div class="post-button__item">
                            <button class="button-basic" type="submit">編集</button>
                        </div>
                        <div class="post-button__item">
                            <a class="js-popup button-basic" onClick="submitDelete()">削除</a>
                        </div>
                    @else
                        <div class="post-button__item">
                            <button class="button-basic" type="submit">登録</button>
                        </div>
                    @endif
                    <div class="post-button__item">
                        <a class="button-basic" href="{{ route('productIndex')}}">戻る</a>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </main>
@stop

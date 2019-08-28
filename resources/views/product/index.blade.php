@extends('layouts.main')
@section('title')
    <title>Index</title>
@stop
@section('content')
    <main class="l-main">
        <div class="l-inner">
            <h1 class="title-level01">List</h1>
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
                <div class="l-block is-msg">
                    <div class="l-block__inner">
                        @if(\Session::has('info'))
                            <div class="post-content no-header">
                                {{ \Session::get('info') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="l-block">
                    <div class="l-block__inner">
                        <div class="post-heading">
                            <div class="post-heading__title">
                                <div class="post-button__item u-ml0">
                                    <a href="{{ url('') }}/product/add"
                                       class="button-basic">商品新規登録</a>
                                </div>
                            </div>
                        </div>
                        {{ Form::open(['url' => "/product", 'method' => 'GET', 'autocomplete' => 'off']) }}
                        <div class="post-content">
                            <div class="post-list">
                                <div class="post-list__item">
                                    <div class="form-parts__title">
                                        <p class="title-level04">商品名</p>
                                    </div>
                                    <div class="form-parts__content is-m">
                                        <div class="form-text">
                                            <input type="text" name="product_name_txt"
                                                   value="{{ request()->product_name_txt }}"
                                                   placeholder="入力してください。">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-content">
                            <div class="post-button">
                                <div class="post-button__item">
                                    <button class="button-basic" type="submit">検索</button>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                        @if ($listProduct->total())
                            <div class="post-content">
                                <div class="table-dispnum">{{ App\Helpers\PaginationHelper::getNumberPage($listProduct) }}</div>
                                <div class="table-wrapper">
                                    <table class="table-basic">
                                        <colgroup>
                                            <col>
                                            <col>
                                            <col>
                                            <col>
                                        </colgroup>
                                        <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                        @foreach($listProduct as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->is_active ? 'Active' : 'Inactive' }}</td>
                                                <td><a class='button-basic'
                                                       href='{{ url('') }}/product/edit/{{ $product->product_id }}'>編集</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="post-content">
                                {{ $listProduct->links('pagination.paging') }}
                            </div>
                        @else
                            <p class="text-no-result">No result</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="l-container">
                <div class="post-button">
                    <div class="post-button__item">
                        <a class="button-basic" href="{{ url('/') }}">戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop

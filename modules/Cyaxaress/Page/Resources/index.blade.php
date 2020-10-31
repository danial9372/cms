@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('pages.index') }}" title="صفحه ها">صفحه ها</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">دوره ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>ردیف</th>
                        <th>شناسه</th>
                        <th>وضعیت</th>
                        <th>وضعیت تایید</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
                    <tr role="row" class="">
                         <td><a href="">{{ $page->id }}</a></td>
                         <td><a href="">{{ $page->title }}</a></td>
                        <td class="status">@lang($page->status)</td>
                         <td>
                            <a href="" onclick="deleteItem(event, '{{ route('pages.destroy', $page->id) }}')" class="item-delete mlg-15" title="حذف"></a>
                            <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                            <a href="{{ route('pages.edit',  $page->id) }}" class="item-edit mlg-15 " title="ویرایش"></a>
                            <a href="" onclick="updateConfirmationStatus(event, '{{ route('pages.changeStatus', $page->id) }}',
                                'وضعیت انتشار تغییر کند؟' , 'تایید شده','status')"
                               class="item-confirm mlg-15" title="تایید"></a>

                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

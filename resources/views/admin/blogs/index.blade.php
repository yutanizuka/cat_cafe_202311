@extends('layouts.admin')

@section('content')
    <section>
        <div class="mb-6 py-4 bg-white rounded">
            <div class="flex px-6 pb-4 border-b">
                <h2 class="text-xl font-bold">ブログ一覧</h2>
                <div class="ml-auto">
                    <a href="/admin/blogs/create"
                        class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">新規投稿</a>
                </div>
            </div>
            <div class="pt-4 px-4 overflow-x-auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="text-xs text-gray-500 text-left">
                            <th class="font-medium text-center">タイトル</th>
                            <th class="font-medium">カテゴリ</th>
                            <th class="font-medium">投稿者</th>
                            <th class="font-medium">更新日時</th>
                            <th class="font-medium">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr @class(['text-sm', 'bg-gray-50' => $loop->odd])>
                                <td class="flex px-4 py-3 items-center">
                                    <img class="w-12 h-12 mr-4 object-cover rounded-md"
                                        src="{{ asset('storage/' . $blog->image) }}" alt="Blog">
                                    <p class="font-medium"><a
                                            href="{{ route('admin.blogs.edit', ['blog' => $blog->id]) }}">{{ $blog->title }}</a>
                                    </p>
                                </td>
                                <td class="font-medium">成長</td>
                                <td class="font-medium">高橋</td>
                                <td>{{ $blog->updated_at }}</td>
                                <td>
                                    <div class="flex">
                                        <a class="mr-2" href="{{ route('admin.blogs.edit', ['blog' => $blog->id]) }}">
                                            <svg width="18" height="18" viewbox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M16.4999 9C16.2789 9 16.0669 9.0878 15.9106 9.24408C15.7544 9.40036 15.6666 9.61232 15.6666 9.83333V14.8333C15.6666 15.0543 15.5788 15.2663 15.4225 15.4226C15.2662 15.5789 15.0542 15.6667 14.8332 15.6667H3.16656C2.94555 15.6667 2.73359 15.5789 2.57731 15.4226C2.42103 15.2663 2.33323 15.0543 2.33323 14.8333V3.16667C2.33323 2.94565 2.42103 2.73369 2.57731 2.57741C2.73359 2.42113 2.94555 2.33333 3.16656 2.33333H8.16657C8.38758 2.33333 8.59954 2.24554 8.75582 2.08926C8.9121 1.93298 8.9999 1.72101 8.9999 1.5C8.9999 1.27899 8.9121 1.06702 8.75582 0.910744C8.59954 0.754464 8.38758 0.666667 8.16657 0.666667H3.16656C2.50352 0.666667 1.86764 0.930059 1.3988 1.3989C0.929957 1.86774 0.666565 2.50363 0.666565 3.16667V14.8333C0.666565 15.4964 0.929957 16.1323 1.3988 16.6011C1.86764 17.0699 2.50352 17.3333 3.16656 17.3333H14.8332C15.4963 17.3333 16.1322 17.0699 16.601 16.6011C17.0698 16.1323 17.3332 15.4964 17.3332 14.8333V9.83333C17.3332 9.61232 17.2454 9.40036 17.0892 9.24408C16.9329 9.0878 16.7209 9 16.4999 9ZM3.9999 9.63333V13.1667C3.9999 13.3877 4.0877 13.5996 4.24398 13.7559C4.40026 13.9122 4.61222 14 4.83323 14H8.36657C8.47624 14.0006 8.58496 13.9796 8.68649 13.9381C8.78802 13.8967 8.88037 13.8356 8.95823 13.7583L14.7249 7.98333L17.0916 5.66667C17.1697 5.5892 17.2317 5.49703 17.274 5.39548C17.3163 5.29393 17.3381 5.18501 17.3381 5.075C17.3381 4.96499 17.3163 4.85607 17.274 4.75452C17.2317 4.65297 17.1697 4.5608 17.0916 4.48333L13.5582 0.908333C13.4808 0.830226 13.3886 0.768231 13.287 0.725924C13.1855 0.683617 13.0766 0.661835 12.9666 0.661835C12.8566 0.661835 12.7476 0.683617 12.6461 0.725924C12.5445 0.768231 12.4524 0.830226 12.3749 0.908333L10.0249 3.26667L4.24156 9.04167C4.16433 9.11953 4.10323 9.21188 4.06176 9.31341C4.02029 9.41494 3.99926 9.52366 3.9999 9.63333ZM12.9666 2.675L15.3249 5.03333L14.1416 6.21667L11.7832 3.85833L12.9666 2.675ZM5.66656 9.975L10.6082 5.03333L12.9666 7.39167L8.0249 12.3333H5.66656V9.975Z"
                                                    fill="#382CDD"></path>
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.blogs.destroy', ['blog' => $blog->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button>
                                                <svg width="20" height="20" viewbox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.33333 15C8.55435 15 8.76631 14.9122 8.92259 14.7559C9.07887 14.5996 9.16667 14.3877 9.16667 14.1667V9.16666C9.16667 8.94564 9.07887 8.73368 8.92259 8.5774C8.76631 8.42112 8.55435 8.33332 8.33333 8.33332C8.11232 8.33332 7.90036 8.42112 7.74408 8.5774C7.5878 8.73368 7.5 8.94564 7.5 9.16666V14.1667C7.5 14.3877 7.5878 14.5996 7.74408 14.7559C7.90036 14.9122 8.11232 15 8.33333 15ZM16.6667 4.99999H13.3333V4.16666C13.3333 3.50362 13.0699 2.86773 12.6011 2.39889C12.1323 1.93005 11.4964 1.66666 10.8333 1.66666H9.16667C8.50363 1.66666 7.86774 1.93005 7.3989 2.39889C6.93006 2.86773 6.66667 3.50362 6.66667 4.16666V4.99999H3.33333C3.11232 4.99999 2.90036 5.08779 2.74408 5.24407C2.5878 5.40035 2.5 5.61231 2.5 5.83332C2.5 6.05434 2.5878 6.2663 2.74408 6.42258C2.90036 6.57886 3.11232 6.66666 3.33333 6.66666H4.16667V15.8333C4.16667 16.4964 4.43006 17.1322 4.8989 17.6011C5.36774 18.0699 6.00363 18.3333 6.66667 18.3333H13.3333C13.9964 18.3333 14.6323 18.0699 15.1011 17.6011C15.5699 17.1322 15.8333 16.4964 15.8333 15.8333V6.66666H16.6667C16.8877 6.66666 17.0996 6.57886 17.2559 6.42258C17.4122 6.2663 17.5 6.05434 17.5 5.83332C17.5 5.61231 17.4122 5.40035 17.2559 5.24407C17.0996 5.08779 16.8877 4.99999 16.6667 4.99999ZM8.33333 4.16666C8.33333 3.94564 8.42113 3.73368 8.57741 3.5774C8.73369 3.42112 8.94565 3.33332 9.16667 3.33332H10.8333C11.0543 3.33332 11.2663 3.42112 11.4226 3.5774C11.5789 3.73368 11.6667 3.94564 11.6667 4.16666V4.99999H8.33333V4.16666ZM14.1667 15.8333C14.1667 16.0543 14.0789 16.2663 13.9226 16.4226C13.7663 16.5789 13.5543 16.6667 13.3333 16.6667H6.66667C6.44565 16.6667 6.23369 16.5789 6.07741 16.4226C5.92113 16.2663 5.83333 16.0543 5.83333 15.8333V6.66666H14.1667V15.8333ZM11.6667 15C11.8877 15 12.0996 14.9122 12.2559 14.7559C12.4122 14.5996 12.5 14.3877 12.5 14.1667V9.16666C12.5 8.94564 12.4122 8.73368 12.2559 8.5774C12.0996 8.42112 11.8877 8.33332 11.6667 8.33332C11.4457 8.33332 11.2337 8.42112 11.0774 8.5774C10.9211 8.73368 10.8333 8.94564 10.8333 9.16666V14.1667C10.8333 14.3877 10.9211 14.5996 11.0774 14.7559C11.2337 14.9122 11.4457 15 11.6667 15Z"
                                                        fill="#E85444"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ▼▼▼▼ページャー▼▼▼▼　-->
        {{ $blogs->links() }}
        <!-- ▲▲▲▲ページャー▲▲▲▲　-->
    </section>
@endsection

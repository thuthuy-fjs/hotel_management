@component('mail::panel')
    @component('mail::message')

        Bạn đã gửi yêu cầu thay đổi mật khẩu

        @component('mail::button',['url' => $url,'color' => 'primary'])
            Đến trang thay đổi mật khẩu
        @endcomponent

    @endcomponent

@endcomponent

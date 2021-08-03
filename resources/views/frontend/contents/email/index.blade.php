<h3>Bạn đã đặt phòng tại {{$hotel_name}} ngày {{$booking_date}}</h3>
<b>Tổng giá: {{$total_price}} VND</b><br>
@if ($payment_method == 1)
    <p>Phương thức thanh toán: Tiền mặt<br>
        Vui lòng thanh toán tại quầy dịch vụ</p>
@elseif ($payment_method == 2)
    <p>Phương thức thanh toán: VNPay</p>
@endif
<div class="col-sm-12">
    <table style="width: 60%;">
        <tr>
            <td>Ngày nhận phòng</td>
            <td>Ngày trả phòng</td>
        </tr>
        <tr>
            <td>{{$check_in_date}}</td>
            <td>{{$check_out_date}}</td>
        </tr>
        <tr>
            <td>
                <small>12h00 - 14h00</small>
            </td>
            <td>
                <small>10h00 - 12h00</small>
            </td>
        </tr>
    </table>
</div>
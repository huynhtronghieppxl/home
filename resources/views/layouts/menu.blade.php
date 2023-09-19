<nav>
    <ul class="nav-list">
        <li><a class="" href="/" title=""><i class="fa fa-home"></i> Trang chủ</a></li>
        <li><a class="" href="javascript:void(0)" title=""><i class="fa fa-film"></i> Quản lý thu chi</a>
            <ul>
                <li><a href="{{route('addition-fee-type.index')}}" title="">Hạng mục thu chi</a></li>
                <li><a href="{{route('receipt.index')}}" title="">Phiếu thu</a></li>
                <li><a href="{{route('payment.index')}}" title="">Phiếu chi</a></li>
            </ul>
        </li>
        <li><a class="" href="{{route('asset.index')}}" title=""><i class="fa fa-female"></i> Quỹ</a>
            <ul>
                <li><a href="{{route('fund-period.index')}}" title="">Quỹ tháng</a></li>
                <li><a href="pittube-detail.html" title="">Khẩn cấp</a></li>
                <li><a href="{{route('reserve-fund.index')}}" title="">Tiêu dùng</a></li>
                <li><a href="{{route('invest-fund.index')}}" title="">Đầu tư</a></li>
            </ul>
        </li>
        <li><a class="" href="{{route('asset.index')}}" title=""><i class="fa fa-female"></i> Tài sản</a></li>
        <li><a class="" href="javascript:void(0)" title=""><i class="fa fa-graduation-cap"></i> Tiện ích</a>
            <ul>
                <li><a href="career.html" title="">Lịch đỏ</a></li>
                <li><a href="{{route('event.index')}}" title="">Sự kiện</a></li>
            </ul>
        </li>
        <li><a class="" href="javascript:void(0)" title=""><i class="fa fa-graduation-cap"></i> Báo cáo</a>
            <ul>
                <li><a href="{{route('revenue-report.index')}}" title="">Doanh thu</a></li>
                <li><a href="{{route('cost-report.index')}}" title="">Chi phí</a></li>
                <li><a href="{{route('reserve-report.index')}}" title="">Tiêu dùng</a></li>
                <li><a href="{{route('invest-report.index')}}" title="">Đầu tư</a></li>
            </ul>
        </li>
        <li><a class="" href="{{route('setting.index')}}" title=""><i class="fa fa-female"></i> Thiết lập</a></li>
    </ul>

</nav><!-- nav menu -->

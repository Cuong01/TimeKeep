<div class="w-full p-1 md:p-4">
    <x-lf.card title="Cập nhật" class="warning">
        <div style="width:50%">
            <span>
                <b>Loại đơn</b>
                <x-lf.form.select name="type" :default="['----Chon loại đơn----']" :params="[1 => 'Đơn xin nghỉ', 2 => 'Đơn xin đi sớm về muộn', 3 => 'Đơn đăng ký đi làm ngày lễ']" disabled
                    style="background-color: #DDDDDD; padding-left:10px" />
            </span>
        </div>

        @if ($type == 1)
            <div style="display: flex; width:100%">
                <div style="width:50%">
                    <span>
                        <b>Mã nhân viên</b>
                        <x-lf.form.input name="user_id" type="integer" disabled
                            style="background-color: rgb(235, 235, 235); border-radius: 5px" />
                    </span>
                    <span>
                        <b>Người nộp đơn</b>
                        <x-lf.form.input name="name" type="string" disabled
                            style="background-color: rgb(235, 235, 235); border-radius: 5px" />
                    </span>
                    <span>
                        <b>Tên công ty</b>
                        <x-lf.form.input name="company_id" type="string" disabled
                            style="background-color: rgb(235, 235, 235); border-radius: 5px" />
                    </span>
                    <span>
                        <b>Từ ngày</b>
                        <x-lf.form.input name="from" type="date" disabled
                            style="background-color: rgb(235, 235, 235); border-radius: 5px" />
                    </span>
                    <span>
                        <b>Đến ngày</b>
                        <x-lf.form.input name="to" type="date" disabled
                            style="background-color: rgb(235, 235, 235); border-radius: 5px" />
                    </span>
                    <span>
                        <b>Người duyệt đơn</b>
                        <x-lf.form.select name="censor" type="string" :default="['---Chọn---']" :params="$users"
                            style="background-color: rgb(235, 235, 235)" disabled />
                    </span>

                    @if ($censor == Auth::user()->id)
                        <span>
                            <b>Trạng thái</b>
                            <x-lf.form.select name="status" type="integer" :default="['---Chọn---']" :params="['0' => 'Đang chờ duyệt', '1' => 'Đã duyệt', '2' => 'Từ chối']" />
                        </span>
                    @else
                        <span>
                            <b>Trạng thái</b>
                            <x-lf.form.select name="status" type="integer" :default="['---Chọn---']" :params="['0' => 'Đang chờ duyệt', '1' => 'Đã duyệt', '2' => 'Từ chối']"
                                style="background-color: rgb(235, 235, 235)" disabled />
                        </span>
                    @endif

                </div>
                <div style="width:50%">
                    <span>
                        <b>Tên loại nghỉ</b>
                        <x-lf.form.select name="appli_id" type="integer" :default="['---Chọn---']" :params="$appli" disabled
                            style="background-color: rgb(235, 235, 235); border-radius: 5px" />
                    </span>
                    <span>
                        <b>Phần trăm lương</b>
                        <x-lf.form.input name="count" type="string" disabled
                            style="background-color: rgb(235, 235, 235); border-radius: 5px" />
                    </span>
                    <span>
                        <b>Số ngày nghỉ tối đa</b>
                        <x-lf.form.input name="day_max" type="string" disabled
                            style="background-color: rgb(235, 235, 235); border-radius: 5px" />
                    </span>
                    <span>
                        <b>Số ngày đã nghỉ</b>
                        <x-lf.form.input name="day_of" type="string" disabled
                            style="background-color: rgb(235, 235, 235); border-radius: 5px" />
                    </span>
                    <span>
                        <b>Lý do nghỉ</b>
                        <x-lf.form.textarea name="reason" type="string" rows="4" disabled
                            style="background-color: rgb(235, 235, 235); border-radius: 5px; resize:none" />
                    </span>

                </div>
            </div>
        @endif
        @if ($type == 2)
            <div style="display: flex; width:100%">

                <div style="width:50%">
                    <span>
                        <b>Mã nhân viên</b>
                        <x-lf.form.input name="user_id" type="string" style="background-color: rgb(235, 235, 235)"
                            disabled />
                    </span>
                    <span>
                        <b>Người nộp đơn</b>
                        <x-lf.form.input name="name" type="string" style="background-color: rgb(235, 235, 235)"
                            disabled />
                    </span>
                    <span>
                        <b>Tên công ty</b>
                        <x-lf.form.input name="company_id" type="string" style="background-color: rgb(235, 235, 235)"
                            disabled />
                    </span>

                    <span>
                        <b>Lý do nghỉ</b>
                        <x-lf.form.textarea name="reason" rows="4" style="resize:none;"
                            style="background-color: rgb(235, 235, 235)" disabled />
                    </span>

                </div>
                <div style="width:50%">
                    <span>
                        <b>Ngày áp dụng</b>
                        <x-lf.form.input name="day_apply" type="date" style="background-color: rgb(235, 235, 235)"
                            disabled />
                    </span>
                    <span>
                        <b>Đến muộn số phút</b>
                        <x-lf.form.input name="late" type="number" style="background-color: rgb(235, 235, 235)"
                            disabled />
                    </span>
                    <span>
                        <b>Về sớm số phút</b>
                        <x-lf.form.input name="soon" type="number" style="background-color: rgb(235, 235, 235)"
                            disabled />
                    </span>
                    <span>
                        <b>Người duyệt đơn</b>
                        <x-lf.form.select name="censor" type="string" :default="['---Chọn---']" :params="$users"
                            style="background-color: rgb(235, 235, 235)" disabled />
                    </span>
                    @if ($censor == Auth::user()->id)
                        <span>
                            <b>Trạng thái</b>
                            <x-lf.form.select name="status" type="integer" :default="['---Chọn---']" :params="['0' => 'Đang chờ duyệt', '1' => 'Đã duyệt', '2' => 'Từ chối']" />
                        </span>
                    @else
                        <span>
                            <b>Trạng thái</b>
                            <x-lf.form.select name="status" type="integer" :default="['---Chọn---']" :params="['0' => 'Đang chờ duyệt', '1' => 'Đã duyệt', '2' => 'Từ chối']"
                                style="background-color: rgb(235, 235, 235)" disabled />
                        </span>
                    @endif


                </div>
            </div>
        @endif

        @if ($type == 3)
            <div style="display: flex; width:100%">

                <div style="width:50%">
                    <span>
                        <b>Mã nhân viên</b>
                        <x-lf.form.input name="user_id" type="string" style="background-color: rgb(235, 235, 235)"
                            disabled />
                    </span>
                    <span>
                        <b>Người nộp đơn</b>
                        <x-lf.form.input name="name" type="string" style="background-color: rgb(235, 235, 235)"
                            disabled />
                    </span>
                    <span>
                        <b>Tên công ty</b>
                        <x-lf.form.input name="company_id" type="string" style="background-color: rgb(235, 235, 235)"
                            disabled />
                    </span>
                    <span>
                        <b>Lý do</b>
                        <x-lf.form.textarea name="reason" type="string" style="  resize: none" rows="4" disabled
                            style="background-color: rgb(225, 225, 225)" />
                    </span>

                </div>
                <div style="width:50%">
                    <span>
                        <b>Tên ngày lễ</b>
                        <x-lf.form.select name="holiday_id" type="number" :default="['---Chọn---']" :params="$holiday"
                            style="background-color: rgb(235, 235, 235)" disabled />
                    </span>
                    <span>
                        <b>Từ ngày</b>
                        <x-lf.form.input name="from_day" type="date" style="background-color: rgb(235, 235, 235)"
                            disabled />
                    </span>
                    <span>
                        <b>Đến ngày</b>
                        <x-lf.form.input name="to_day" type="date" style="background-color: rgb(235, 235, 235)"
                            disabled />
                    </span>
                    <span>
                        <b>Phần trăm lương</b>
                        <x-lf.form.input name="salary_working" type="number"
                            style="background-color: rgb(235, 235, 235)" disabled />
                    </span>
                    <span>
                        <b>Người duyệt đơn</b>
                        <x-lf.form.select name="censor" type="string" :default="['---Chọn---']" :params="$users"
                            style="background-color: rgb(235, 235, 235)" disabled />
                    </span>
                    @if ($censor == Auth::user()->id)
                        <span>
                            <b>Trạng thái</b>
                            <x-lf.form.select name="status" type="integer" :default="['---Chọn---']" :params="['0' => 'Đang chờ duyệt', '1' => 'Đã duyệt', '2' => 'Từ chối']" />
                        </span>
                    @else
                        <span>
                            <b>Trạng thái</b>
                            <x-lf.form.select name="status" type="integer" :default="['---Chọn---']" :params="['0' => 'Đang chờ duyệt', '1' => 'Đã duyệt', '2' => 'Từ chối']"
                                style="background-color: rgb(235, 235, 235)" disabled />
                        </span>
                    @endif

                </div>
            </div>
        @endif

        <x-slot name="tools">
            @can('time-keep.singles.show')
                <a class="btn-success sm"
                    href="{{ route('time-keep.singles.show', $record_id) }}">{!! lfIcon('launch', 11) !!}</a>
            @endcan
            <a class="btn-primary sm" href="{{ route('time-keep.singles') }}">{!! lfIcon('list', 11) !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Cập nhật</label>
                <a class="btn" href="{{ route('time-keep.singles') }}">Hủy bỏ</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>

<style>
    span {
        display: flex;
        padding: 10px 10px 5px 10px;
    }

    b {
        padding-top: 5px;
        width: 200px;
        line-height: 46px;
        font-size: 14px;
    }
</style>

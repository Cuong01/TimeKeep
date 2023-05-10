<div class="w-full p-1 md:p-4">
    <x-lf.card title="Thêm" class="info">

        <div style="width:50%">
            <span>
                <b>Chọn loại đơn</b>
                <x-lf.form.select name="type" :default="['----Chọn loại đơn----']" :params="[1 => 'Đơn xin nghỉ', 2 => 'Đơn xin đi muộn, về sớm', 3 => 'Đơn đăng ký đi làm ngày lễ']" style="padding-left:10px" />
            </span>
        </div>
        @if ($type == 1)
            <div style="display: flex; width:100%">
                <div style="width:50%">
                    <span>
                        <b>Mã nhân viên </b>
                        <x-lf.form.input name="user_id" type="integer" disabled
                            style="background-color: rgb(235, 235, 235)" />
                    </span>
                    <span>
                        <b>Người nộp đơn</b>
                        <x-lf.form.input name="name" type="string" disabled
                            style="background-color: rgb(235, 235, 235)" />
                    </span>
                    <span>
                        <b>Tên công ty</b>
                        <x-lf.form.input name="company_id" type="string" disabled
                            style="background-color: rgb(235, 235, 235)" />
                    </span>
                    <span>
                        <b>Từ ngày <a style="color: red">(*)</a></b>
                        <x-lf.form.input name="from" type="date" />
                    </span>
                    <span>
                        <b>Đến ngày <a style="color: red">(*)</a></b>
                        <x-lf.form.input name="to" type="date" />
                    </span>
                    <span>
                        <b>Người duyệt đơn <a style="color: red">(*)</a></b>
                        <x-lf.form.select name="censor" type="string" :default="['---Chọn---']" :params="$users" />
                    </span>
                    <span>
                        <b>Trạng thái</b>
                        <x-lf.form.select name="status" type="integer" :default="['---Chọn---']" :params="['0' => 'Đang chờ duyệt', '1' => 'Đã duyệt', '2' => 'Từ chối']" disabled
                            style="background-color: rgb(235, 235, 235)" />
                    </span>

                </div>

                <div style="width:50%">
                    <span>
                        <b>Tên loại nghỉ <a style="color: red">(*)</a></b>
                        <x-lf.form.select name="appli_id" type="integer" :default="['---Chọn---']" :params="$appli" />
                    </span>
                    <span>
                        <b>Phần trăm lương</b>
                        <x-lf.form.input name="count" type="string" disabled
                            style="background-color: rgb(235, 235, 235)" />
                    </span>
                    <span>
                        <b>Số ngày nghỉ tối đa</b>
                        <x-lf.form.input name="day_max" type="string" disabled
                            style="background-color: rgb(235, 235, 235)" />
                    </span>
                    <span>
                        <b>Số ngày đã nghỉ</b>
                        <x-lf.form.input name="day_of" type="string" disabled
                            style="background-color: rgb(235, 235, 235)" />
                    </span>
                    <span>
                        <b>Lý do nghỉ <a style="color: red">(*)</a></b>
                        <x-lf.form.textarea name="reason" type="string" rows="4" />
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
                        <b>Lý do nghỉ <a style="color: red">(*)</a></b>
                        <x-lf.form.textarea name="reason" rows="4" style="resize:none" />
                    </span>

                </div>
                <div style="width:50%">
                    <span>
                        <b>Ngày áp dụng <a style="color: red">(*)</a></b>
                        <x-lf.form.input name="day_apply" type="date" />
                    </span>
                    <span>
                        <b>Đến muộn số phút <a style="color: red">(*)</a></b>
                        <x-lf.form.input name="late" type="number" />
                    </span>
                    <span>
                        <b>Về sớm số phút <a style="color: red">(*)</a></b>
                        <x-lf.form.input name="soon" type="number" />
                    </span>
                    <span>
                        <b>Người duyệt đơn <a style="color: red">(*)</a></b>
                        <x-lf.form.select name="censor" type="string" :default="['---Chọn---']" :params="$users" />
                    </span>
                    <span>
                        <b>Trạng thái</b>
                        <x-lf.form.select name="status" type="integer" :default="['---Chọn---']" :params="['0' => 'Đang chờ duyệt', '1' => 'Đã duyệt', '2' => 'Từ chối']"
                            style="background-color: rgb(235, 235, 235)" disabled />
                    </span>


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
                        <b>Lý do <a style="color: red">(*)</a></b>
                        <x-lf.form.textarea name="reason" type="string" style=" resize: none" rows="4" />
                    </span>

                </div>
                <div style="width:50%">
                    <span>
                        <b>Tên ngày lễ <a style="color: red">(*)</a></b>
                        <x-lf.form.select name="holiday_id" type="number" :default="['---Chọn---']" :params="$holiday" />
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
                        <b>Người duyệt đơn <a style="color: red">(*)</a></b>
                        <x-lf.form.select name="censor" type="string" :default="['---Chọn---']" :params="$users" />
                    </span>
                    <span>
                        <b>Trạng thái</b>
                        <x-lf.form.select name="status" type="integer" :default="['---Chọn---']" :params="['0' => 'Đang chờ duyệt', '1' => 'Đã duyệt', '2' => 'Từ chối']"
                            style="background-color: rgb(235, 235, 235)" disabled />
                    </span>

                </div>
            </div>
        @endif

        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Thêm mới</label>
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

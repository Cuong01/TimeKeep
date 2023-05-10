<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}

        <body onload="Refresh()">
            <div class="qr_code" style="padding: 5%">
                {{ QrCode::size(200)->generate('http://192.168.1.18:8012/chamcong1/' . $time) }}</div>
        </body>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div> --}}
    @if (session()->has('error'))
        {{ session()->get('error') }}
    @else
        <form>
            <a href="{{ route('.store2') }}"> <input type="btn" placeholder="Chấm công"
                    style="background-color: rgb(181, 237, 181)"></a>
        </form>
        <table style="margin: 20px">
            <tr>
                <th style="padding: 20px">User Name</th>

                <th style="padding: 20px">IP</th>

                <th style="padding: 20px">Nhận ca</th>

                <th style="padding: 20px">Chốt ca</th>

            </tr>
            @foreach ($timekeep as $key => $item)
                @if (Auth::user()->id == $item->user_id)
                    <tr>
                        <td style="padding: 20px">
                            @foreach ($user as $k => $us)
                                @if ($us->id == $item->user_id)
                                    {{ $us->name }}
                                @endif
                            @endforeach
                        </td>

                        <td style="padding: 20px">{{ $item->note }}</td>

                        <td style="padding: 20px">{{ $item->created_at }}</td>

                        <td style="padding: 20px">{{ $item->updated_at }}</td>


                    </tr>
                @endif
            @endforeach
        </table>
    @endif
</x-app-layout>
{{-- <script>
 init_reload();
    function init_reload(){
        setInterval( function() {
                   window.location.reload();
 
          },3000);
    }
</script> --}}
{{-- <script>
    function Refresh() {
        var t = setTimeout("location.reload(true)", 1000);
    }
</script> --}}

<div id="a">

    <body>
        <div id="dong_ho">
            <h2>Thời gian bây giờ là:</h2>
            <div id="thoi_gian">
                <div>
                    <span id="gio">00</span><span>Giờ</span>
                </div>
                <div>
                    <span id="phut">00</span><span>Phút</span>
                </div>
                <div>
                    <span id="giay">00</span><span>Giây</span>
                </div>
            </div>
        </div>
        <audio id="audio_1" src="photos/Em-Cua-Qua-Khu-Nguyen-Dinh-Vu.mp3" style="audio/mpeg" controls>
        </audio>


    </body>

    <script>
        var a = document.getElementById('audio_1');
        var h = 0,
            i = 0,
            s = 0;

        function setupGiay() {
            s += 1;
            if (s >= 60) {
                i += 1;
                s = 0;
            }
            if (i >= 60) {
                h += 1;
                i = 0;
                s = 0;
            }
            if (h >= 24) {
                h = 0;
                i = 0;
                s = 0;
            }

            if (s < 10) {
                giay = '0' + s;
            } else {
                giay = s;
            }

            if (i < 10) {
                phut = '0' + i;
            } else {
                phut = i;
            }

            if (h < 10) {
                gio = '0' + h;
            } else {
                gio = h;
            }
            document.getElementById("gio").innerHTML = gio;
            document.getElementById("phut").innerHTML = phut;
            document.getElementById("giay").innerHTML = giay;

            if (h == 1 && i == 0) {
                a.play();
            }

        }
        setInterval(setupGiay, 1000);
    </script>

    {{-- <script>
        var a = document.getElementById('audio_1');

        function Dong_ho() {
            var Gio_hien_tai = new Date().getHours();
            var Phut_hien_tai = new Date().getMinutes();
            var Giay_hien_tai = new Date().getSeconds();
            document.getElementById("gio").innerHTML = Gio_hien_tai;
            document.getElementById("phut").innerHTML = Phut_hien_tai;
            document.getElementById("giay").innerHTML = Giay_hien_tai;
            if (Gio_hien_tai == 15 && Phut_hien_tai == 9) {
                a.play();
            }
        }
        setInterval(Dong_ho, 1000);
    </script> --}}

</div>
<style>
    #a {
        padding: 50px;
        width: 35%;
        text-align: center;
    }

    #dong_ho h2 {
        position: relative;
        display: block;
        color: rgb(0, 0, 0);
        margin: 10px 0;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 30px;
    }

    #dong_ho #thoi_gian {
        text-align: center;
        display: flex;
    }

    #dong_ho #thoi_gian div {
        position: relative;
        margin: 0 5px;
    }

    #dong_ho #thoi_gian div span {
        position: relative;
        display: block;
        width: 200px;
        height: 160px;
        background: #2196f3;
        color: #fff;
        font-weight: 300;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 5rem;
        z-index: 3;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.2);
    }

    #dong_ho #thoi_gian span:nth-child(2) {
        height: 65px;
        font-size: 2rem;
        letter-spacing: 0.3rem;
        z-index: 2;
        box-shadow: none;
        background: #127fd6;
        text-transform: uppercase;
    }

    #dong_ho #thoi_gian div:last-child span {
        background: #ff006a;
    }

    #dong_ho #thoi_gian div:last-child span:nth-child(2) {
        background: #ec0062;
    }
</style>

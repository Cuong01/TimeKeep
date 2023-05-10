<div> 
    <div  class = "container mx-auto" > 
        <button  type = "button" 
            wire: click = "openDiv" 
            class = "px-4 py-2 text-Purple-100 bg-Purple-500"> Hiển thị & Ẩn nút Div
        </button>
        @if ($showDiv)
        <div>
            <p>Show and Hide Dive Elements in laravel livewire</p>
        </div>
        @endif
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light justify-content-between sticky-top" style="background-color: #e3f2fd;">
    <h4 class="font-semibold navbar-brand  mx-2" >
        <i class="bi bi-box"></i>
        <span>TicketRaiser</span>
    </h4>
    <div class="dropdown" style="margin-right: 40px">
        <a class="nav-link dropdown-toggle" role="button" href="#" id="navbarDropdownMenuLink"  style="color: black;" data-bs-toggle="dropdown" aria-expanded="false">
            {{auth()->user()->name}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{route('profile.edit')}}">Profile</a>
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <button type="submit" class="dropdown-item" >logout</button>
            </form>
        </div>
    </div>
</nav>

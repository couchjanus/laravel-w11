<div class="list-group">
    <a href="{{ route('profile') }}"
       class="list-group-item {{ Request::is('profile') ? 'bg-primary text-white' : '' }}">Contact Info
   </a>
   <a href="{{ route('profile.security') }}"
       class="list-group-item {{ Request::is('profile/security') ? 'bg-primary text-white' : '' }}">Security
   </a>
</div>
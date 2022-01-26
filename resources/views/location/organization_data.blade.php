<div>
    @foreach($organizations as $organization)
    <text style="font-weight:bold;">{{ $organization->organization_name }}</text><br>
    @foreach ($organization->user as $user)
    @if($user->role == "super_admin")
    <input type="checkbox" value="{{ $user->id }}" name="users[]" id="users[]">{{ $user->firstname }}<br>
    @endif
    @endforeach
    <br>
    @endforeach
</div>
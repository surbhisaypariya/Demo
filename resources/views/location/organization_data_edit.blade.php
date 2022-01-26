<div>
    @foreach($organizations as $organization)
    <text style="font-weight:bold;">{{ $organization->organization_name }}</text><br>
    @foreach ($organization->user as $user)
    @if($user->role == "super_admin")
    <?php   
    $user_ids = $organization->user()->pluck('user_id')->toArray();  
    ?>
    <input type="checkbox" value="{{ $user->id }}" {{ in_array($user->id , $user_ids)?"checked":"" }} name="users[]" id="users[]">{{ $user->firstname }}<br>
    @endif
    @endforeach
    <br>
    @endforeach
</div>
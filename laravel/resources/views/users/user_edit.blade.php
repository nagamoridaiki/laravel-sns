<p>画像の変更</p>
    <form method='POST' action="{{ route('users.store',['name' => $user->name] ) }}" enctype="multipart/form-data">
    @csrf
        <input type="file" id="file1" name='image' class="form-control-file">
        <input type='submit' class='btn btn-primary' value='変更する'>
    </form>
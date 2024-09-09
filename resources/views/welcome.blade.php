<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
<form action="{{ route("upload.file.post") }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="fileUpload">
    <br><br>
    <button type="submit">Submit</button>
</form>
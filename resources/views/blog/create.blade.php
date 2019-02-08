<form method="POST">
   {{ csrf_field() }}
   {{--  @csrf
   @method("POST")  --}}

   <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
   </div>
   <div class="form-group">
      {{--  @input(['type' => 'email', 'placeholder' => 'Enter Email'])  --}}
   </div>
   <div class="form-group">
   <label for="content">Content:</label>
   <input id="content" type="text" class="form-control" name="content"> </div>
   <button type="submit" class="btn btn-primary">Save</button>
</form>

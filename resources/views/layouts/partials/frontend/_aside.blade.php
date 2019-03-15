<aside class="col-md-4 blog-sidebar">
        <div class="p-3 mb-3 bg-light rounded">
            <h4 class="font-italic">Search</h4>
            <form action="{{ url('/search') }}" method="get">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for..." name="q" value="{{ request('q') }}">
                  <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">Go!</button>
                  </span>
                </div>
           </form>
        </div>

        <div class="p-3">
            @widget('categories')
        </div>
        
        <div class="p-3">
            <h4 class="font-italic">Elsewhere</h4>
            <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
            </ol>
        </div>
    </aside><!-- /.blog-sidebar -->
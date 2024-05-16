@auth
    <h4> Create Your Ticket </h4>
    <div class="row">
        <form action="{{ route('tickets.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <p>
                    Titile: <input type="text" name="title" id="title" class="rounded">
                    Category:
                    <select name="category_id" id="" class="rounded">
                        <option value=""> not yet</option>
                    </select>
                    Urgent:
                    <select class="rounded" name="urgent" id="urgent" onchange="changeColor(this)">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </p>
                <textarea name="content" class="form-control mt-2" id="content" rows="3"></textarea>
                @error('content')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark"> Create </button>
            </div>
        </form>
    </div>
@endauth
@guest()
    <h4>Login to Create your tickets</h4>
@endguest

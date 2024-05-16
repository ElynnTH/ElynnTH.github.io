@auth()
    @can('ticket.edit', $ticket)
        <div class="card">
            <div class="px-3 pt-4 pb-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $ticket->user->getImageURL() }}"
                            alt="{{ $ticket->user->name }}">
                        <div>
                            <h5 class="card-title mb-0"><a href="{{ route('users.show', $ticket->user->id) }}">
                                    {{ $ticket->user->name }}
                                </a></h5>
                        </div>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('tickets.destroy', $ticket->id) }}">
                            @csrf
                            @auth()
                                @can('ticket.edit', $ticket)
                                    @method('delete')
                                    @if ($ticket->status == 'solved')
                                        <strong style="text-transform: uppercase; color:aqua">
                                            <span class=" mx-4 ">TICKET HAS BEEN SOLVED</span>
                                        </strong>
                                        <a href="{{ route('tickets.show', $ticket->id) }}"> View </a>
                                        @if (Auth::user()->is_admin)
                                            <button class="ms-1 btn btn-danger btn-sm">X</button>
                                        @endif
                                    @elseif($ticket->status == 'in-process')
                                        <a class="mx-2" href="{{ route('tickets.edit', $ticket->id) }}"> Edit </a>
                                        <a href="{{ route('tickets.show', $ticket->id) }}"> View </a>
                                        @if (Auth::user()->is_admin)
                                            <a class="mx-2" href="{{ route('tickets.edit', $ticket->id) }}"> Edit </a>
                                            <button class="ms-1 btn btn-danger btn-sm">X</button>
                                        @endif
                                    @else
                                        <a class="mx-2" href="{{ route('tickets.edit', $ticket->id) }}"> Edit </a>
                                        <a href="{{ route('tickets.show', $ticket->id) }}"> View </a>
                                        @if (Auth::user()->is_admin)
                                            <button class="ms-1 btn btn-danger btn-sm">X</button>
                                        @endif
                                    @endif
                                @endcan
                            @endauth
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($editing ?? false && $ticket->status != 'solved')
                    <form action="{{ route('tickets.update', $ticket->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <div>
                                Titile: <input class="" type="text" name="title" id="title"
                                    placeholder="{{ $ticket->title }}">
                                @if (Auth::user()->is_admin)
                                    Status:
                                    <select name="status" id="status">
                                        <option value="active" {{ $ticket->status == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="in-process" {{ $ticket->status == 'in-process' ? 'selected' : '' }}>
                                            In-Process</option>
                                        <option value="solved" {{ $ticket->status == 'solved' ? 'selected' : '' }}>Solved
                                        </option>
                                    </select>
                                @endauth
                        </div>
                        <textarea name="content" class="form-control mt-2" id="content" rows="3">{{ $ticket->content }}</textarea>
                        @error('content')
                            <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-dark mt-1"> Update </button>
                    </div>
                </form>
            @else
                <p class="fs-6 fw-light text-muted">
                <h3>Title: {{ $ticket->title }}</h3>
                <p>Satus: <strong style="text-transform: uppercase; color:aqua">{{ $ticket->status }}</strong> -
                    Urgent: @if ($ticket->urgent == 'low')
                        <strong style="text-transform: uppercase; color:rgb(0, 255, 0)">{{ $ticket->urgent }}</strong>
                    @elseif($ticket->urgent == 'medium')
                        <strong style="text-transform: uppercase; color:yellow">{{ $ticket->urgent }}</strong>
                    @else
                        <strong style="text-transform: uppercase; color:red">{{ $ticket->urgent }}</strong>
                    @endif
                </p>
                </p>

                <p class="fs-6 fw-light text-muted">
                    {{ $ticket->content }}
                </p>
            @endif
            <div class="d-flex justify-content-between">
                <div>
                    <a href="#" class="fw-light nav-link fs-6">
                        <span class="fas fa-star me-1"></span> {{ $ticket->rate }}
                        &nbsp;&nbsp;
                        <span class="fas fa-comment me-1"></span> {{ $ticket->comments->count() }}
                    </a>
                </div>

                <div>
                    <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                        {{ $ticket->created_at }} </span>
                </div>
            </div>
            @include('created.comments-box')
        </div>
    </div>
@endcan
@endauth

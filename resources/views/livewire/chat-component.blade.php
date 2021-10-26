<div wire:poll class="container mt-5">
{{--    <h1 class="h3 mb-3">Messages</h1>--}}
    <div class="card">
        <div class="row g-0">
            <div class="col-12 col-lg-5 col-xl-3 border-right">

                <div class="card text-center border-0">
                    <div class="card-header">
                        All users
                    </div>
                </div>

                <!-- online users -->
                @foreach($users as $user)
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-action border-0">
                            @if(!Cache::has('user-is-online-' . $user->id))
                            <p class="badge bg-success float-right">{{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</p>
                            @endif
                                <div class="d-flex align-items-start">
                                    <img src="{{ asset($user->image) }}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                                    <div class="flex-grow-1 d-block ml-3">
                                        {{ $user->name }}
                                        <div class="small">
                                            @if(Cache::has('user-is-online-' . $user->id))
                                                <span class="text-success">Online</span>
                                            @else
                                                <span class="text-secondary">Offline</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                        </li>
                    </ul>
                @endforeach

                <!-- /online users -->
                <hr class="d-block d-lg-none mt-1 mb-0">
            </div>

            <div class="col-12 col-lg-7 col-xl-9">
                <div class="py-2 px-4 border-bottom d-none d-lg-block">
                    <div class="d-flex align-items-center py-1">
                        <div class="position-relative">
                            <h1>Chat room</h1>
                        </div>
                    </div>
                </div>

                <div class="position-relative">
                    <div class="chat-messages p-4">
                    @forelse($messages as $message)
                        @if($message->user->name == auth()->user()->name)
                        <!-- sender -->
                        <div class="chat-message-right pb-4">
                            <div>
                                <img src="{{ asset($message->user->image) }}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                <div class="text-muted small text-nowrap mt-2">
                                    {{ $message->created_at->format('H:i:s') }}
                                </div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
{{--                                <div class="font-weight-bold mb-1">You</div>--}}
                                {{ $message->message_text }}
                            </div>
                        </div>
                        <!-- /sender -->
                        @else
                        <!-- receiver -->
                        <div class="chat-message-left pb-4">
                            <div>
                                <img src="{{ asset($message->user->image) }}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                <div class="text-muted small text-nowrap mt-2">{{ $message->created_at->format('H:i:s') }}</div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                <div class="font-weight-bold mb-1">{{ $message->user->name }}</div>
                                {{ $message->message_text }}
                            </div>
                        </div>
                        <!-- /receiver -->
                            @endif
                        @empty
                            <div class="col-12">
                                <h1>
                                    No Messages
                                </h1>
                            </div>
                        @endforelse

                    </div>
                </div>

                <form wire:submit.prevent="sendMessage" class="flex-grow-0 py-3 px-4 border-top">
                    <div class="input-group">
                        <input wire:model.defer="messageText" type="text" class="form-control" placeholder="Type your message">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

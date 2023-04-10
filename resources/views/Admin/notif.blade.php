 @if (session()->has('add'))
                    <div class="alert alert-success alert-dismissible fade show timeout"
                        style="width: 30%;margin-left:70%;" role="alert">
                        <strong>{{session('add')}}</strong>
                        <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="Close"><i
                                class="bi bi-x-lg"></i></button>
                    </div>
                    @endif

                    @if (session()->has('edit'))
                    <div class="alert alert-warning alert-dismissible fade show timeout"
                        style="width: 30%;margin-left:70%;" role="alert">
                        <strong>{{session('edit')}}</strong>
                        <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="Close"><i
                                class="bi bi-x-lg"></i></button>
                    </div>
                    @endif

                    @if (session()->has('delete'))
                    <div class="alert alert-danger alert-dismissible fade show timeout"
                        style="width: 30%;margin-left:70%;" role="alert">
                        <strong>{{session('delete')}}</strong>
                        <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="Close"><i
                                class="bi bi-x-lg"></i></button>
                    </div>
                    @endif

                    @if (session()->has('failed'))
                    <div class="alert alert-danger">
                        <strong>Failed!!</strong>
                        <strong>{{session('failed')}}</strong>
                    </div>
                    @endif

                    @if (count($errors)>0)
                    <div class="alert alert-danger">
                        <strong>Failed</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

@extends('frontend/frame')
@section('nav-style', 'nav-profile')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend/profile/user-menu')
                <div class="col-md-9">
                    <div class="tabbed-content text-tabs display-after-load">
                        <div class="modal-container text-right">
                            <a class="btn btn-modal hovered mb-0px" href="#">New question</a>
                            @include('frontend/elements/question')
                        </div>
                        <ul class="tabs mb-0px">
                            <li class="active">
                                <div class="tab-title">
                                    <span>Pending</span>
                                </div>
                                <div class="tab-content">
                                    @if($user->questions()->where(['status' => 1])->count() > 0)
                                        <table class="table">
                                            @foreach($user->questions()->where(['status' => 1])->get() as $question)
                                                <tr>
                                                    <td><img width="25" src="{{ $question->image()->first() ? url()->to('/').$question->image()->first()->path.$question->image()->first()->filename : url()->to('/').'/images/avatar/nu_image.png' }}"></td>
                                                    <td>{{ date('d M, Y H:i', strtotime($question->created_at)) }}</td>
                                                    <td>{{ implode(' ', array_slice(explode(' ', $question->question), 0, 5)) }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <p>No pending questions.</p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="tab-title">
                                    <span>Answered</span>
                                </div>
                                <div class="tab-content">
                                    @if($user->questions()->where(['status' => 2])->count() > 0)
                                        <table class="table">
                                            @foreach($user->questions()->where(['status' => 2])->get() as $question)
                                                <tr>
                                                    <td><img width="25" src="{{ $question->image()->first() ? url()->to('/').$question->image()->first()->path.$question->image()->first()->filename : url()->to('/').'/images/avatar/nu_image.png' }}"></td>
                                                    <td>{{ date('d M, Y H:i', strtotime($question->created_at)) }}</td>
                                                    <td>{{ implode(' ', array_slice(explode(' ', $question->question), 0, 5)) }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <p>No answered questions.</p>
                                    @endif
                                </div>
                            </li>
                            <li id="drafts">
                                <div class="tab-title">
                                    <span><a href="#drafts">Drafts</a></span>
                                </div>
                                <div class="tab-content">
                                    @if($user->questions()->where(['status' => 0])->count() > 0)
                                        <table class="table">
                                            @foreach($user->questions()->where(['status' => 0])->get() as $question)
                                                <tr>
                                                    <td><img width="25" src="{{ $question->image()->first() ? url()->to('/').$question->image()->first()->path.$question->image()->first()->filename : url()->to('/').'/images/avatar/nu_image.png' }}"></td>
                                                    <td>{{ date('d M, Y H:i', strtotime($question->created_at)) }}</td>
                                                    <td>{{ implode(' ', array_slice(explode(' ', $question->question), 0, 5)) }}</td>
                                                    <td class="w170px"><a href="" class="mr-15px">Delete</a> <a href="#" class="btn btn-sm hovered mb-0px">Send</a></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <p>No questions drafts.</p>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
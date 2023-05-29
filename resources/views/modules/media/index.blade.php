@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title">Gallery
                    </h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li>
                                <a data-action="collapse"><i class="feather icon-minus"></i></a>
                            </li>
                            <li>
                                <a data-action="reload"><i class="feather icon-rotate-cw"></i></a>
                            </li>
                            <li>
                                <a data-action="expand"><i class="feather icon-maximize"></i></a>
                            </li>
                            <li>
                                <a data-action="close"><i class="feather icon-x"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

                    <livewire:media.index>

                </div>

            </div>
        </div>
    </div>

@endsection

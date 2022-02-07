@extends('user::layouts.master')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-block nk-block-lg">
                <div class="nk-block-between mb-2">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Become a Dropshipper</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                {{-- Categories/Add Category --}}
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
                <div class="card">
                    <div class="card-inner">

                        <form method="POST" action="{{ route('user.become-a-dropshipper.post') }}" enctype="multipart/form-data" name="demoform" id="demoform">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" id="" class="btn btn-primary float-right">Become a Dropshipper</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div><!-- card -->

        </div>
    </div>
@endsection

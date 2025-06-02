@extends('v_layouts.app') <!-- Assuming 'app' is your layout file name -->

@section('content')
<div class="row">
    <!-- column -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Latest Posts</h4>
            </div>
            <div class="comment-widgets scrollable">
                <!-- Comment Row -->
                <div class="d-flex flex-row comment-row m-t-0">
                    <div class="p-2"><img src="assets/images/users/1.jpg" alt="user" width="50" class="rounded-circle"></div>
                    <div class="comment-text w-100">
                        <h6 class="font-medium">James Anderson</h6>
                        <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry.</span>
                        <div class="comment-footer">
                            <span class="text-muted float-right">April 14, 2016</span>
                            <button type="button" class="btn btn-cyan btn-sm">Edit</button>
                            <button type="button" class="btn btn-success btn-sm">Publish</button>
                            <button type="button" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </div>
                <!-- Comment Row -->
                <div class="d-flex flex-row comment-row">
                    <div class="p-2"><img src="assets/images/users/4.jpg" alt="user" width="50" class="rounded-circle"></div>
                    <div class="comment-text active w-100">
                        <h6 class="font-medium">Michael Jorden</h6>
                        <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry.</span>
                        <div class="comment-footer">
                            <span class="text-muted float-right">May 10, 2016</span>
                            <button type="button" class="btn btn-cyan btn-sm">Edit</button>
                            <button type="button" class="btn btn-success btn-sm">Publish</button>
                            <button type="button" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </div>
                <!-- Comment Row -->
                <div class="d-flex flex-row comment-row">
                    <div class="p-2"><img src="assets/images/users/5.jpg" alt="user" width="50" class="rounded-circle"></div>
                    <div class="comment-text w-100">
                        <h6 class="font-medium">Johnathan Doeting</h6>
                        <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry.</span>
                        <div class="comment-footer">
                            <span class="text-muted float-right">August 1, 2016</span>
                            <button type="button" class="btn btn-cyan btn-sm">Edit</button>
                            <button type="button" class="btn btn-success btn-sm">Publish</button>
                            <button type="button" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">To Do List</h4>
                <div class="todo-widget scrollable" style="height:450px;">
                    <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                        <!-- To Do List items -->
                        <li class="list-group-item todo-item" data-role="task">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                <label class="custom-control-label todo-label" for="customCheck">
                                    <span class="todo-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span> <span class="badge badge-pill badge-danger float-right">Today</span>
                                </label>
                            </div>
                            <ul class="list-style-none assignedto">
                                <li class="assignee"><img class="rounded-circle" width="40" src="assets/images/users/1.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Steave"></li>
                                <li class="assignee"><img class="rounded-circle" width="40" src="assets/images/users/2.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jessica"></li>
                                <li class="assignee"><img class="rounded-circle" width="40" src="assets/images/users/3.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
                                <li class="assignee"><img class="rounded-circle" width="40" src="assets/images/users/4.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
                            </ul>
                        </li>
                        <!-- Additional To Do List items -->
                    </ul>
                </div>
            </div>
        </div>
        <!-- Card -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title m-b-0">Progress Box</h4>
                <div class="m-t-20">
                    <div class="d-flex no-block align-items-center">
                        <span>81% Clicks</span>
                        <div class="ml-auto">
                            <span>125</span>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 81%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <!-- Additional Progress items -->
            </div>
        </div>
        <!-- card new -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title m-b-0">News Updates</h4>
            </div>
            <ul class="list-style-none">
                <!-- News Update items -->
                <li class="d-flex no-block card-body">
                    <i class="fa fa-check-circle w-30px m-t-5"></i>
                    <div>
                        <a href="#" class="m-b-0 font-medium p-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                        <span class="text-muted">dolor sit amet, consectetur adipiscing</span>
                    </div>
                    <div class="ml-auto">
                        <div class="tetx-right">
                            <h5 class="text-muted m-b-0">20</h5>
                            <span class="text-muted font-16">Jan</span>
                        </div>
                    </div>
                </li>
                <!-- Additional News Update items -->
            </ul>
        </div>
    </div>
    <!-- column -->

    <div class="col-lg-6">
        <!-- Card -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chat Option</h4>
                <div class="chat-box scrollable" style="height:475px;">
                    <ul class="chat-list">
                        <!-- Chat items -->
                        <li class="chat-item">
                            <div class="chat-img"><img src="assets/images/users/1.jpg" alt="user"></div>
                            <div class="chat-content">
                                <h6 class="font-medium">James Anderson</h6>
                                <div class="box bg-light-info">Lorem Ipsum is simply dummy text of the printing & type setting industry.</div>
                            </div>
                            <div class="chat-time">10:56 am</div>
                        </li>
                        <!-- Additional Chat items -->
                    </ul>
                </div>
            </div>
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-9">
                        <div class="input-field m-t-0 m-b-0">
                            <textarea id="textarea1" placeholder="Type and enter" class="form-control border-0"></textarea>
                        </div>
                    </div>
                    <div class="col-3">
                        <a class="btn-circle btn-lg btn-cyan float-right text-white" href="javascript:void(0)"><i class="fas fa-paper-plane"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- card -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Our partner (Box with Fix height)</h4>
            </div>
            <div class="comment-widgets scrollable" style="max-height: 130px;">
                <!-- Comment Row -->
                <div class="d-flex flex-row comment-row m-t-0">
                    <div class="p-2"><img src="assets/images/users/1.jpg" alt="user" width="50" class="rounded-circle"></div>
                    <div class="comment-text w-100">
                        <h6 class="font-medium">James Anderson</h6>
                        <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry.</span>
                        <div class="comment-footer">
                            <span class="text-muted float-right">April 14, 2016</span>
                            <button type="button" class="btn btn-cyan btn-sm">Edit</button>
                            <button type="button" class="btn btn-success btn-sm">Publish</button>
                            <button type="button" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </div>
                <!-- Additional Comment Rows -->
            </div>
        </div>
        <!-- accordion part -->
        <div class="accordion" id="accordionExample">
            <!-- Accordion items -->
            <div class="card m-b-0">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="m-r-5 fa fa-magnet" aria-hidden="true"></i>
                            <span>Accordion Example 1</span>
                        </a>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                    </div>
                </div>
            </div>
            <!-- Additional Accordion items -->
        </div>
        <!-- toggle part -->
        <div id="accordian-4">
            <!-- Toggle items -->
            <div class="card m-t-30">
                <a class="card-header link" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-1" aria-expanded="true" aria-controls="Toggle-1">
                    <i class="seticon fa fa-arrow-right" aria-hidden="true"></i>
                    <span>Toggle, Open by default</span>
                </a>
                <div id="Toggle-1" class="collapse show multi-collapse">
                    <div class="card-body widget-content">
                        This box is opened by default, paragraphs and is full of waffle to pad out the comment.
                    </div>
                </div>
            </div>
            <!-- Additional Toggle items -->
        </div>
        <!-- Tabs -->
        <div class="card">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home" role="tab">Tab1</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile" role="tab">Tab2</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages" role="tab">Tab3</a></li>
            </ul>
            <div class="tab-content tabcontent-border">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="p-20">
                        <p>And is full of waffle to It has multiple paragraphs and is full of waffle to pad out the comment.</p>
                        <img src="assets/images/background/img4.jpg" class="img-fluid">
                    </div>
                </div>
                <!-- Additional Tab panes -->
            </div>
        </div>
    </div>
</div>
@endsection
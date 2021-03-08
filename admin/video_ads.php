<?php
//include('header.php');
include('videosubmit.php');

?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">

                                <div class="card-block">
                                    <h4 class="sub-title">Video ads</h4>
                                    <form action="" method="POST" enctype="multipart/form-data">

                                        <div>
                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-ads" role="tab" aria-controls="pills-home" aria-selected="true">Ads</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-image" role="tab" aria-controls="pills-profile" aria-selected="false">Images ads</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-google" role="tab" aria-controls="pills-profile" aria-selected="false">Google ads</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-cta" role="tab" aria-controls="pills-contact" aria-selected="false">CTAs</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-button" role="tab" aria-controls="pills-contact" aria-selected="false">Buy buttons</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-option" role="tab" aria-controls="pills-contact" aria-selected="false">Optin form</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-ads" role="tabpanel" aria-labelledby="pills-home-tab">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Ads title</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="title" class="form-control form-control" placeholder=".form-control-round">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" method>
                                                        <label class="col-sm-2 col-form-label">Ads name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="name" class="form-control form-control" placeholder=".form-control-round">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Upload video</label>
                                                        <div class="col-sm-10">
                                                            <input type="file" name="video" class="form-control form-control" placeholder=".form-control-round">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Thumbnail</label>
                                                        <div class="col-sm-10">
                                                            <input type="file" name="thumbnail" class="form-control form-control" placeholder=".form-control-round">
                                                        </div>
                                                        <div style="margin-left:700px;">
                                                            <button type="submit" name="submitads" class=" btn btn-primary">submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-image" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Display</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="sel1">
                                                                <option>Select option</option>
                                                                <option>Begining of video</option>
                                                                <option>End</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Adertising Link</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control form-control" placeholder="Adertising Link">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Adertising Image</label>
                                                        <div class="col-sm-10">
                                                            <input type="file" class="form-control form-control" placeholder="Adertising Image">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Position</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="sel1">
                                                                <option>Select position</option>
                                                                <option value="">Top left</option>
                                                                <option value="">Top</option>
                                                                <option value="">Top right</option>
                                                                <option value="">Right</option>
                                                                <option value="">Buttom right</option>
                                                                <option value="">Buttom</option>
                                                                <option value="">Buttom left</option>
                                                                <option value="">Left</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div style="float: right;">
                                                        <button type="button" class="btn btn-primary">submit</button>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-google" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Adertising Link</label>
                                                        <div class="col-sm-10">
                                                            <input type="Text" class="form-control form-control" placeholder="Adertising Link">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Adertising VAST Tag</label>
                                                        <div class="col-sm-10">
                                                            <input type="Text" class="form-control form-control" placeholder="Adertising VAST Tag">
                                                        </div>
                                                    </div>
                                                    <div style="float: right;">
                                                        <button type="button" class="btn btn-primary">submit</button>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-cta" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Display</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="sel1">
                                                                <option>Select position</option>
                                                                <option value="">Begining of video </option>
                                                                <option value="">End of video</option>
                                                                <option value="">Top right</option>
                                                                <option value="">After</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">cta text</label>
                                                        <div class="col-sm-10">
                                                            <input type="Text" class="form-control form-control" placeholder="Adertising VAST Tag">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Redirect link</label>
                                                        <div class="col-sm-10">
                                                            <input type="Text" class="form-control form-control" placeholder="Adertising VAST Tag">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Text color</label>
                                                        <div class="col-sm-10">
                                                            <input type="color" class="form-control form-control" placeholder="Adertising VAST Tag">
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Button color</label>
                                                        <div class="col-sm-10">
                                                            <input type="color" class="form-control form-control" placeholder="Adertising VAST Tag">
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Position</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="sel1">
                                                                <option>Select position</option>
                                                                <option value="">Top left</option>
                                                                <option value="">Top</option>
                                                                <option value="">Top right</option>
                                                                <option value="">Right</option>
                                                                <option value="">Buttom right</option>
                                                                <option value="">Buttom</option>
                                                                <option value="">Buttom left</option>
                                                                <option value="">Left</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div style="float: right;">
                                                        <button type="button" class="btn btn-primary">submit</button>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-button" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Display</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="sel1">
                                                                <option>Select position</option>
                                                                <option value="">Top left</option>
                                                                <option value="">Top</option>
                                                                <option value="">Top right</option>
                                                                <option value="">Right</option>
                                                                <option value="">Buttom right</option>
                                                                <option value="">Buttom</option>
                                                                <option value="">Buttom left</option>
                                                                <option value="">Left</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Redirect Link</label>
                                                        <div class="col-sm-10">
                                                            <input type="Text" class="form-control form-control" placeholder="Redirect Link">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Button style</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="sel1">
                                                                <option>style 1</option>
                                                                <option>style 2</option>
                                                                <option>style 3</option>
                                                                <option>style 4</option>
                                                                <option>style 5</option>
                                                                <option>style 6</option>
                                                                <option>style 7</option>
                                                                <option>style 8</option>
                                                                <option>style 9</option>
                                                                <option>style 10</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">position</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="sel1">
                                                                <option>Select position</option>
                                                                <option value="">Top left</option>
                                                                <option value="">Top</option>
                                                                <option value="">Top right</option>
                                                                <option value="">Right</option>
                                                                <option value="">Buttom right</option>
                                                                <option value="">Buttom</option>
                                                                <option value="">Buttom left</option>
                                                                <option value="">Left</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div style="float: right;">
                                                        <button type="button" class="btn btn-primary">submit</button>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-option" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Display</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="sel1">
                                                                <option>Select position</option>
                                                                <option value="">Begining of video </option>
                                                                <option value="">End of video</option>
                                                                <option value="">Top right</option>
                                                                <option value="">After</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">CTA text</label>
                                                        <div class="col-sm-10">
                                                            <input type="Text" class="form-control form-control" placeholder="Redirect Link">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Text color</label>
                                                        <div class="col-sm-10">
                                                            <input type="color" class="form-control form-control" placeholder="Text color">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="comment">Custom code</label>
                                                        <textarea class="form-control" rows="5" id="comment"></textarea>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Display</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="sel1">
                                                                <option>Select position</option>
                                                                <option value="">Begining of video </option>
                                                                <option value="">End of video</option>
                                                                <option value="">Top right</option>
                                                                <option value="">After</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div style="float: right;">
                                                        <button type="button" class="btn btn-primary">submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- Basic Form Inputs card end -->
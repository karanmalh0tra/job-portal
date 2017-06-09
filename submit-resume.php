<?php include "header.php";?>

    <!-- =============== Start of Page Header 1 Section =============== -->
    <section class="page-header">
        <div class="container">

            <!-- Start of Page Title -->
            <div class="row">
                <div class="col-md-12">
                    <h2>submit resume</h2>
                </div>
            </div>
            <!-- End of Page Title -->

            <!-- Start of Breadcrumb -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">home</a></li>
                        <li class="active">for canditates</li>
                    </ul>
                </div>
            </div>
            <!-- End of Breadcrumb -->

        </div>
    </section>
    <!-- =============== End of Page Header 1 Section =============== -->





    <!-- ===== Start of Main Wrapper Section ===== -->
    <section class="ptb80" id="post-job">
        <div class="container">

            <h3 class="uppercase text-blue">have an account?</h3>

            <!-- Start of Account Question -->
            <div class="row account-question">
                <div class="col-md-10 nopadding">
                    <p class="nomargin">If you don’t have an account you can create one on the form below by entering your email address. Your account details will be confirmed via email.</p>
                </div>

                <div class="col-md-2 text-right nopadding">
                    <a href="login.html" class="btn btn-blue btn-effect mt5">signin</a>
                </div>
            </div>
            <!-- End of Account Question -->




            <!-- Start of Post Resume Form -->
            <form action="#" class="post-job-resume mt50">

                <!-- Start of Resume Details -->
                <div class="row">
                    <div class="col-md-12">

                        <!-- Form Group -->
                        <div class="form-group">
                            <label>your name</label>
                            <input class="form-control" type="text" required>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label>your email</label>
                            <input class="form-control" type="text" required>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label>your profession</label>
                            <input class="form-control" type="text" placeholder='e.g. "Android App Developer"' required>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label>location <span>(optional)</span></label>
                            <input class="form-control" type="text" placeholder='e.g. "Paris, France"'>
                            <span class="form-msg">Leave this blank if the Location is not important.</span>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label>your photo <span>(optional)</span></label>

                            <!-- Upload Button -->
                            <div class="upload-file-btn">
                                <span><i class="fa fa-upload"></i> Upload</span>
                                <input type="file" name="application_attachment" accept=".jpg,.png,.gif">
                            </div>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label>video <span>(optional)</span></label>
                            <input class="form-control" type="text" placeholder='Link to a Video about yourself'>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label>resume category</label>
                            <select name="job-type" class="selectpicker" data-size="5" data-container="body" required>
                                <option value="">Choose Category</option>
                                <option value="1">Accountance</option>
                                <option value="2">Banking</option>
                                <option value="3">Design & Art</option>
                                <option value="4">Developement</option>
                                <option value="5">Insurance</option>
                                <option value="6">IT Engineer</option>
                                <option value="7">Healthcare</option>
                                <option value="8">Marketing</option>
                                <option value="9">Management</option>
                            </select>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label>resume content</label>
                            <textarea class="tinymce"></textarea>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label>Skills</label>
                            <input class="form-control" type="text" placeholder="Separate each skill with a comma" required>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label>education</label>
                            <textarea class="tinymce"></textarea>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label>experience</label>
                            <textarea class="tinymce"></textarea>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group pt30 nomargin" id="last">
                            <button class="btn btn-blue btn-effect">submit</button>
                        </div>

                    </div>
                </div>
                <!-- End of Resume Details -->

            </form>
            <!-- End of Post Resume Form -->

        </div>
    </section>
    <!-- ===== End of Main Wrapper Section ===== -->




<?php include "footer.php";?>

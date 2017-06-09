<?php
session_start();

if(!$_SESSION['company_email'])
{
  header("Location: companylogin.php");
}
else {
  require_once "class/user-service.php";
  require_once "class/company-service.php";
  $companyId = $_SESSION['company_id'];
  $userService = new UserService();
  $view_industry=$userService->viewIndustry();
  $view_functionalarea=$userService->viewFunctionalArea();
}

 ?>

<?php include "header.php";?>

<!-- Text editor start here -->
<script src="js1/tinymce/tinymce.dev.js"></script>
<script src="js1/tinymce/plugins/table/plugin.dev.js"></script>
<script src="js1/tinymce/plugins/paste/plugin.dev.js"></script>
<script src="js1/tinymce/plugins/spellchecker/plugin.dev.js"></script>
<script src="js1/tinymce/plugins/codesample/plugin.dev.js"></script>
<script type="text/javascript">/*



	tinymce.init({
		selector: "textarea#elm1",
		theme: "modern",
		plugins: [
			"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker codesample"
		],
		external_plugins: {
			//"moxiemanager": "/moxiemanager-php/plugin.js"
		},
		content_css: "css/development.css",
		add_unload_trigger: false,
		autosave_ask_before_unload: false,

		toolbar1: "save newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
		toolbar2: "cut copy paste pastetext | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media help code | insertdatetime preview | forecolor backcolor",
		toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft | insertfile insertimage codesample",
		menubar: false,
		toolbar_items_size: 'small',

		style_formats: [
			{title: 'Bold text', inline: 'b'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
		],

		templates: [
			{title: 'My template 1', description: 'Some fancy template 1', content: 'My html'},
			{title: 'My template 2', description: 'Some fancy template 2', url: 'development.html'}
		],

        spellchecker_callback: function(method, data, success) {
			if (method == "spellcheck") {
				var words = data.match(this.getWordCharPattern());
				var suggestions = {};

				for (var i = 0; i < words.length; i++) {
					suggestions[words[i]] = ["First", "second"];
				}

				success({words: suggestions, dictionary: true});
			}

			if (method == "addToDictionary") {
				success();
			}
		}
	}); */
</script>
<!--Text editor end here-->

<!-- =============== Start of Page Header 1 Section =============== -->
<section class="page-header">
    <div class="container">

        <!-- Start of Page Title -->
        <div class="row">
            <div class="col-md-12">
                <h2>Post Job Requirement</h2>
            </div>
        </div>
        <!-- End of Page Title -->

        <!-- Start of Breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="#">home</a></li>
                    <li class="active">pages</li>
                </ul>
            </div>
        </div>
        <!-- End of Breadcrumb -->

    </div>
</section>

<!-- Start of Tab Content -->
<div class="tab-content ptb60">

    <!-- Start of Tabpanel for Personal Account -->
    <div role="tabpanel" class="tab-pane active" id="personal">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <!-- Form -->
                <form class="" id="jobform" name="jobform" action="controller/addjob.php?companyId=<?php echo $companyId; ?>" method="post">

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Job Title</label>
                    <input type="text" id="jobtitle" name="jobtitle" class="form-control" placeholder="Enter Job Title" required/>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Job Description</label>
                    <!-- //TODO: add a text editor -->
                    <input type="text" id="jobdescription" name="jobdescription" class="form-control" placeholder="Enter Job Description" required/>

                  </div>
                  <!-- <textarea id="elm1" name="description" cols="50" rows="12" class="form-control ng-invalid ng-invalid-required"></textarea> -->
                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Experience Required</label>
                    <select class="form-control" name="jobexperience" id="jobdexperience">
                      <<option value="">Select Years</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                    </select>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group mb30">
                    <label>Skills Required</label>
                    <textarea class="form-control" id="jobskills" name="jobskills" rows="1" cols="30"></textarea>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group mb30">
                    <label>Salary</label>
                    <input type="text" name="jobsalary" id="jobsalary" class="form-control" placeholder="in Rs.">
                  </div>

                  <!-- Form Group -->
                  <div class="form-group mb30">
                    <label>Location</label>
                    <input type="text" name="joblocation" id="joblocation" class="form-control" placeholder="Enter Job Location">
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                      <label>industry</label>
                      <select id="jobindustry" class="form-control" name="jobindustry">
                        <option value="">Select Industry</option><?php
                        foreach($view_industry as $industry)
                        {
                          ?>
                          <option value="<?php echo $industry['industry_id']; ?>">
                            <?php echo $industry['industry_name']; ?></option>
                          <?php
                        }
                        ?>
                      </select>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                      <label>functional area</label>
                      <select class="form-control" name="jobfunctionalarea" id="jobfunctionalarea">
                        <option value="">Select Functional Area</option><?php
                        foreach($view_functionalarea as $functionalarea)
                        {
                          ?>
                          <option value="<?php echo $functionalarea['functionalarea_id']; ?>"><?php echo $functionalarea['functionalarea_name']; ?></option>
                          <?php
                        }
                        ?>
                      </select>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group text-center">
                    <input type="checkbox" id="agree">
                    <label for="agree">Agree with the <a href="#">Terms and Conditions</a></label>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group text-center nomargin">
                    <button type="submit" class="btn btn-blue btn-effect">create account</button>
                  </div>

                </form>

            </div>
        </div>
    </div>
  </div>

<?php include "footer.php";?>

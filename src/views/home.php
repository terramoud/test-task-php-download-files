<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="robots" content="noindex,nofollow"/>
    <title>Home page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/style.min.css" rel="stylesheet"/>
</head>
<body class="bg-dark">
<h1 class="text-light d-flex justify-content-center my-5">
    Welcome to the home page
</h1>
<div class="main-wrapper">
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div class="auth-wrapper d-flex no-block justify-content-center
                        align-items-top bg-dark px-3 pb-3 mx-auto row container">
        <!-- ============================================================== -->
        <!-- login block -->
        <!-- ============================================================== -->
        <div class="auth-box bg-dark border-top border-secondary col-md-6 col-sm-8 px-3">
            <div>
                <div class="text-center pt-3 pb-3">
                    <h2 class="text-light">
                        Upload files form
                    </h2>
                </div>
                <div id="error-message" class="text-danger bg-light font-bold"></div>
                <form enctype="multipart/form-data"
                      id="file-upload-form"
                      onkeydown="return event.key != 'Enter'">
                    <div class="row pb-4">
                        <div class="col-12">
                            <!-- upload documents -->
                            <div class="input-group mb-5">
                                <div class="input-group-prepend w-100">
                                    <span class="input-group-text bg-danger text-white h-100">
                                       <em class="mdi mdi-file fs-4"></em>
                                        Upload Document Files (Max 3 files)
                                    </span>
                                </div>
                                <input type="file" class="form-control form-control-file form-control-lg m-0"
                                       id="document-files"
                                       name="document_files[]"
                                       multiple required accept=".pdf, .doc, .docx, .txt"
                                       placeholder="Upload Document Files (Max 3 files)"/>
                            </div>
                            <!-- upload images -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend w-100">
                                    <span class="input-group-text bg-danger text-white h-100">
                                       <em class="mdi mdi-file fs-4"></em>
                                        Upload Image Files (Max 4 files)
                                    </span>
                                </div>
                                <input type="file" class="form-control form-control-file form-control-lg m-0"
                                       id="image-files"
                                       name="image_files[]"
                                       multiple required accept=".jpg, .jpeg, .png, .gif"
                                       placeholder="Upload Document Files (Max 4 files)"/>
                            </div>
                        </div>
                    </div>
                    <div class="row border-top border-secondary">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="pt-3 d-grid">
                                    <button class="btn btn-block btn-lg btn-success text-white" type="submit">
                                        Upload files
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <footer class="footer text-center text-light ">
            PHP test task, 2023
        </footer>
    </div>
</div>
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/home.js"></script>
</body>
</html>


    var paths = [];
    var img_names = [];
    
    var uploaderImage = new plupload.Uploader({
        runtimes: 'html5,flash,silverlight,html4',
//            max_file_count: 1,
        browse_button: 'browseImage', // this can be an id of a DOM element or the DOM element itself
        url: '/web/vendors/plupload/uploadimage.php',
        filters: {
            max_file_size: '10mb',
            mime_types: [
                {title: "Image files", extensions: extensions}
            ]
        },
           // Flash settings
        flash_swf_url: '/web/vendors/plupload/Moxie.swf',
        // Silverlight settings
        silverlight_xap_url: '/web/vendors/plupload//Moxie.xap',
        init: {
            PostInit: function () {
                document.getElementById('filelistImage').innerHTML = '';
                document.getElementById('uploadfilesImage').onclick = function () {
                    uploaderImage.start();
                    return false;
                };
            },
            FilesAdded: function (up, files) {
                plupload.each(files, function (file) {
                    document.getElementById('filelistImage').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                    $('#uploadfilesImage').show();
                    uploaderImage.start();
                    $('.confirmationImage').hide();
                });
            },
            UploadProgress: function (up, file) {
                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            },
            Error: function (up, err) {
                document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
            },
            FileUploaded: function (up, file, info) {
                // Called when file has finished uploading
                //     log('[FileUploaded] File:', file, "Info:", info);

                console.log(info.response);
                var data = JSON.parse(info.response);
                var newFileName = data.name;
                
                var path = "/uploads/catalog/" + newFileName;

//                $('.prewview-container').append('\
//                    <div class ="row">\n\
//                            <div class = "col-md-5">\n\
//                                <img class="preview" src="/uploads/catalog/' + newFileName+'">\n\
//                            </div>\n\
//                            <div class = "col-md-2">\n\
//                                <h4>'+ newFileName+'</h4>\n\
//                            </div>\n\
//                    </div>');
                paths.push(path);
                img_names.push(newFileName); 
                
                $('#img_path').attr('value', paths);
                $('#img_name').attr('value', img_names);


            },
            Browse: function (up) {
                document.getElementById('filelistImage').innerHTML = '';

            }

        }
    });
        uploaderImage.init();




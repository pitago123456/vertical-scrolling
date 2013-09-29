<!--Begin Header-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Uploadify Demo - Try Out Our Multiple File Upload Jquery Script</title>



<script type="text/javascript" src="uploadify/jquery.min.js"></script>

<script type="text/javascript" src="uploadify/swfobject.js"></script>

<script type="text/javascript" src="uploadify/jquery.uploadify.min.js"></script>

<link  rel="stylesheet" href="uploadify/uploadify.css" type="text/css"/>



<body >






  <!--End Header-->

<!--Begin Content-->

<div id="left">

  <div id="content">

	        	

        	<div id="custom-demo" class="demo">

      	<h2>Custom Demo</h2>
        <script type="text/javascript">

				$(function() {

				$('#custom_file_upload').uploadify({

  'uploader'       : './uploadify/uploadify.swf',

  'script'         : './uploadify/uploadify.php',

  'cancelImg'      : './uploadify/cancel.png',

  'folder'         : './uploads',

  'multi'          : false,

  'auto'           : true,

  'fileExt'        : '*.jpg;*.gif;*.png',

  'fileDesc'       : 'Image Files (.JPG, .GIF, .PNG)',

  'queueID'        : 'custom-queue',

  'queueSizeLimit' : 3,

  'simUploadLimit' : 3,

  'sizeLimit'   : 102400,

  'removeCompleted': false,

  'onSelectOnce'   : function(event,data) {

      $('#status-message').text(data.filesSelected + ' tệp uploaded.');

    },

  'onAllComplete'  : function(event,data) {

      $('#status-message').text(data.filesUploaded + ' tệp uploaded, ' + data.errors + ' lỗi.');
      window.location.reload();
      

    }

});				});

				</script>

              
                <img title="Nhấp chọn phía dưới để upload hình đại diện,chỉ chấp nhận cỡ hình 4x6"
              width="100px" height="100px"  src="./uploads/abc.jpg" />
              <div><div id="status-message"></div>



<input id="custom_file_upload" type="file" name="Filedata" /></div>

      </div>

      </div>

</div>

<!--End Content-->


	